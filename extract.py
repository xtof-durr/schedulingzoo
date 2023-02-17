#!/usr/bin/env python3

import sys
import bibtexparser
import os
from pprint import PrettyPrinter
from tools import *
import xml.etree.ElementTree as ET

pp = PrettyPrinter()

BIBDIR = "bib"
NOTATION_FILE = "bib/notation.xml"

aliases = {}      # ABBREVIATION -> full text (in explanation and expressions)
explanation = {}  # field -> plain text explanation
val2field = {}    # the value of a field, '' excluded
field2val = {}    # all values in a field, '' included
fields = []       # all fields in order of appearance
reduction = {}    # (value_particular, value_general) -> True or boolean expr.

lower = []
upper = []

# ---------- utilities

# from tryalgo
def topological_order(graph):
    """Topological sorting by maintaining indegree

    :param graph: adjacency list
    :returns: list of vertices in order
    :complexity: `O(|V|+|E|)`
    """
    V = range(len(graph))
    indeg = [0 for _ in V]
    for node in V:    # determiner degree entrant
        for neighbor in graph[node]:
            indeg[neighbor] += 1
    Q = [node for node in V if indeg[node] == 0]
    order = []
    while Q:
        node = Q.pop()                # sommet sans arc entrant
        order.append(node)
        for neighbor in graph[node]:
            indeg[neighbor] -= 1
            if indeg[neighbor] == 0:
                Q.append(neighbor)
    return order


def uppercase_dict(dict):
    return { key.upper(): dict[key] for key in dict }


def unalias(str):
    global aliases
    for old in aliases:
        str = str.replace(old, aliases[old])
    return str


def read_alias(node):
    global aliases
    aliases = {}
    for oldnew in node:
        old = oldnew.attrib['from']
        new = oldnew.attrib['to']
        aliases[old] = new


# ---------- read the parameters file and produce: field2val, val2field, reduction


def valid_val(val):
    return val == '' or val in val2field


def read_xml():
    global field2val, val2field, reduction, explanation
    arcs = {}
    tree = ET.parse(NOTATION_FILE).getroot()

    read_alias(tree[0])

    # ---------- read the form part and associate values to fields
    for section in tree[1]:
        for xml_field in section:
            if 'hide' in xml_field.attrib:
                continue
            field = correctxml(xml_field.attrib['name'])
            fields.append(field)
            arcs[field] = []
            if field not in field2val:
                field2val[field] = []
            for option in xml_field:
                val = correctxml(option.attrib['value'])
                expl_val = correctxml(option.attrib['explanation'])
                if val.startswith(" ") or val.endswith(" ") or "  " in val:
                    error("'%s' contains illegal spaces" % val)
                if val in val2field:
                    error("'%s' appears twice" % val)
                if 'field' in option.attrib:
                    field_of_val = option.attrib['field']
                    assert field_of_val not in field2val
                    field2val[field_of_val] = []
                else:
                    field_of_val = field
                if val != '':
                    val2field[val] = field_of_val
                explanation[val] = unalias(expl_val)
                field2val[field_of_val].append(val)


    # ---------- read the reduction part and collect reductions

    for xml_reductions in tree[2]:
        src = xml_reductions.attrib['from']
        dst = xml_reductions.attrib['to']
        if 'requires' in xml_reductions.attrib:
            requires_str = xml_reductions.attrib['requires']
            requires = parse_bool_expr(unalias(requires_str))
        else:
            requires_str = None
            requires = None
        if not valid_val(src) or not valid_val(dst):
            error("reduction tag has unknown values '%s'" % xml_reductions.attrib)
            continue
        if src != '' and dst != '' and val2field[src] != val2field[dst]:
            error("reduction '%s' has values from different fields" % xml_reductions.attrib)
            continue
        if src == dst:
            error("reduction has indentical values '%s'" % src)
            continue
        if src != '':
            field = val2field[src]
        elif dst != '':
            field = val2field[dst]
        else:
            error("reduction tag has empty values")
            continue
        arcs[field].append((src, dst, requires, requires_str))

    # ---------- build the reduction dictionary

    for field in fields:
        n = len(field2val[field])
        # ------ first consider the unconditioned arcs and build graph
        graph = [set() for p in range(n)]
        grinv = [set() for p in range(n)]
        for (src, dst, requires, requires_str) in arcs[field]:
            p = field2val[field].index(src)
            g = field2val[field].index(dst)
            if requires is None:
                graph[p].add(g)
                grinv[g].add(p)
        # ------ add transitive arcs for unconditioned arcs
        order = topological_order(graph)
        assert len(order) == len(graph)
        for r in range(n):
            p = order[r]
            for g in graph[p]:
                for u in grinv[p]:
                    graph[u].add(g)
                    grinv[g].add(u)
        # ------ mark reductions in dictionary
        for p in range(n):
            for g in graph[p]:
                src = field2val[field][p]
                dst = field2val[field][g]
                reduction[src, dst] = True
        if field == "number of machines":
            a = field2val["number of machines"].index("2")
            b = field2val["number of machines"].index("")
        # ------ then consider the conditioned arcs
        for (src, dst, requires, requires_str) in arcs[field]:
            p = field2val[field].index(src)
            g = field2val[field].index(dst)
            if requires is not None:
                for u in grinv[p] | set([p]):
                    for v in graph[g] | set([g]):
                        val_u = field2val[field][u]
                        val_v = field2val[field][v]
                        arc = (val_u, val_v)
                        if arc not in reduction:
                            reduction[arc] = requires
                        elif reduction[arc] is not True:
                            reduction[arc] = ('or', reduction[arc], requires)
                        else:
                            pass  #  nothing to do since (True or expression) == True
    return arcs


# ---------- read bibtex files into ref, lower, upper

def read_bibtex():
    global ref, results, ref2str
    read_xml()
    ref = {}
    results = []
    for root, dirs, files in os.walk(BIBDIR):    # read all bib files from bib directory
        for file in files:
            if file.endswith(".bib"):
                with open(root + "/" + file) as f:
                    for item in bibtexparser.load(f).entries:
                        item = uppercase_dict(item)
                        key = item['ID']
                        if key in ref:
                            error("'%s' multiple bibtex entry" % key)
                            continue
                        ref[key] = item
                        if 'ANNOTE' not in item:
                            error("in %s bibtex entry '%s' has no annote" % (file, key))
                            continue
                        annote = item['ANNOTE']
                        for result in annote.strip(" \n{}").split("\n"):
                            if result[0] != '$':
                                error("in %s annote '%s' for bibtex entry '%s' does not start with $" % (file, result, key))
                                continue
                            try:
                                p = result.index('$', 1)
                            except ValueError:
                                error("in %s annote for bibtex entry '%s' problem name does not end with $" % (file, key))
                                continue
                            problem_name = result[1:p]
                            problem_vec = str2pb(problem_name, field2val, val2field, file, key)
                            if not problem_vec:
                                continue
                            bound = result[p+1:].strip("\\ ,.")
                            if '|' in bound:
                                error("in %s bibtex entry '%s' has results not separated by newline" % (file, key))
                                continue
                            if 'NP' in bound or 'hard' in bound or ">=" in bound or "\\geq" in bound:
                                css_class = "lower"
                            else:
                                css_class = "upper"
                            results.append((problem_vec, css_class, problem_name, bound, key))

# ---------- produce the html form


def print_form():

    tree = ET.parse(NOTATION_FILE).getroot()

    # ---------- read the aliases
    read_alias(tree[0])
    for section in tree[1]:
        print("<h2>%s</h2>" % section.attrib['name'])
        print("<table>")
        add_separator = 'add_separator' in section.attrib
        for field in section:
            name = field.attrib['name']
            print('<tr min-height=40 width=100%% id="tr:%s" ' %name, end='')
            for a in field.attrib:
                print(' %s="%s"' %(a, field.attrib[a]), end='')
            if add_separator:
                print(' add_separator="True"', end='')        # add it only to the first field
                add_separator = False
            print('> <td width=200 align=right>%s :</td>' % name)
            print('<td>')
            first = True
            for option in field:
                option_value = option.attrib['value']
                print('    <input onchange="update_pb()" type="radio" name="%s" id="%s:%s"' %
                      (name, name, option_value), end='')
                for a in option.attrib:
                    print(' %s="%s"' %(a, option.attrib[a]), end='')
                if first:
                    print(' checked="checked"', end='')
                    first = False
                print('>')
                print('        <label id="label:%s:%s" title="%s" for="%s:%s">' %
                      (name, option_value, option.attrib['explanation'],  name, option_value), end='')
                if option_value:
                    print('%s' % pb2latex(option_value), end='')
                else:
                    print('&Oslash;', end='')
                print('</label>')
            print('</td></tr>')
        print("</table>")


# ---------- produce the wikipedia source

def print_wikipedia():

    tree = ET.parse(NOTATION_FILE).getroot()

    # ---------- read the aliases
    read_alias(tree[0])
    for section in tree[1]:
        print("\n== %s ==\n" % section.attrib['name'])
        for field in section:
            name = field.attrib['name']
            print("\n=== %s ===\n" % name)
            print("")
            for option in field:
                option_value = option.attrib['value']
                print("; <math>%s</math>" % option_value)

                explanation = option.attrib['explanation']
                for before, after in [(" $", " <math>"), ("$ ", "</math> "),
                                      ("$.", "</math>."),  ("$,", "</math>,")]:
                    explanation = explanation.replace(before, after)
                print(": %s" % explanation)


# ---------- produce the reduction graph

def print_dot():
    arcs = read_xml()
    arc_labels = []        # create the graph files
    for field in fields:
        f = open("dot/%s.dot" % field, 'w')
        print("digraph G{", file=f)
        print("rankdir=BT;", file=f)
        for i in range(len(field2val[field])):
            val = field2val[field][i].replace("\\", "\\\\")
            print('%i [label="%s"]' % (i, val), file=f)
        for (src, dst, requires, requires_str) in arcs[field]:
            u = field2val[field].index(src)
            v = field2val[field].index(dst)
            if requires_str is None:
                print("%i -> %i" % (u,v), file=f)
            else:
                if requires_str not in arc_labels:
                    lab = len(arc_labels)
                    arc_labels.append(requires_str)
                else:
                    lab = arc_labels.index(requires_str)
                print('%i -> %i [label="%i."]' % (u, v, lab + 1), file=f)
        print("}", file=f)
        f.close()

    print("<h3>Conditions on dominance arcs</h3>")
    print("<ol>")
    for label in arc_labels:
        print("<li>%s</li>" % str(label))
    print("</ol>")

    for field in fields:
        print("<h3>%s</h3>" % field)
        print('<img src="dot/%s.dot.png">' % field)


# ---------- main program

if __name__=="__main__":
    if len(sys.argv) == 1:
        print("Usage: ./extract.py option")
        print("       form:       prints the html form")
        print("       reductions: prints the reduction dictionary")
        print("       references: prints the references")
        print("       results:    prints the results")
        print("       stat:       prints the number of results")
        print("       wikipedia:  prints the notation in wikipedia source format")
        print("       dot:        creates the reduction graphs")

    elif sys.argv[1] == "reductions":
        read_xml()
        print("reduction = \\")
        pp.pprint(reduction)
        print("explanation = \\")
        pp.pprint(explanation)

    elif sys.argv[1] == "references":
        read_bibtex()
        print("references = \\")
        pp.pprint(ref)

    elif sys.argv[1] == "results":
        read_bibtex()
        print("results = \\")
        pp.pprint(results)
        print("val2field = \\")
        pp.pprint(val2field)
        print("field2val = \\")
        pp.pprint(field2val)
        print("fields = \\")
        pp.pprint(fields)

    elif sys.argv[1] == "stat":
        read_bibtex()
        print(len(results))

    elif sys.argv[1] == "dot":
        print_dot()

    elif sys.argv[1] == "form":
        print_form()

    elif sys.argv[1] == "wikipedia":
        print_wikipedia()

    else:
        error("invalid option")