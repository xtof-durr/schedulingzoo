#!/usr/bin/env python3

import sys
import bibtexparser
import os
from pprint import PrettyPrinter
from collections import defaultdict
from tools import *
import xml.etree.ElementTree as ET
from typing import *

pp = PrettyPrinter()

BIBDIR = "bib"
NOTATION_FILE = "bib/notation.xml"
NEGATIVE_TAGS = ['NP', 'hard', ">=", "\\geq", " no ", "cannot", "ETH"]

aliases = {}      # ABBREVIATION -> full text (in explanation and expressions)
explanation = {}  # field -> plain text explanation
val2field = {}    # the value of a field, '' excluded, but "not fieldname" included
field2val = {}    # all values in a field, '' included
fields = []       # all fields in order of appearance
simple_reductions = {}  # field -> set of (particular, general) values
complex_reductions = {} # support -> set of (particular, general) vectors
# support is a vector of fields

lower = []
upper = []

# ---------- utilities

def transitive_closure(arcs):
    """Make transitive closure of the arcs of a directed graph.
    Adds the transitive arcs to the given arc set (set of tuples of length 2)
    """
    # first we construct the graph
    in_arcs = defaultdict(set)
    out_arcs = defaultdict(set)
    vertices = set()
    for u, v in arcs:
        in_arcs[v].add(u)
        out_arcs[u].add(v)
        vertices.add(u)
        vertices.add(v) 
    # process vertices in topological order
    in_degree = {v: len(in_arcs[v]) for v in vertices}
    Q = [v for v in in_degree if in_degree[v] == 0]
    while Q:
        # the usual topological sort stuff
        v = Q.pop()
        for u in out_arcs[v]:
            in_degree[u] -= 1
            if in_degree[u] == 0:
                Q.append(u)
        # add transitive arcs
        A = []
        for u in in_arcs[v]:
            for w in in_arcs[u]:    # we already added the transitive arcs entering u
                arcs.add((w, v))
                A.append(w)
        for w in A:
            in_arcs[v].add(w)

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

def extend_complex_reduction(support, particular, general, k=0):
    if k == len(support):
        yield complex 
    else:
        f = support[k] 
        for p, g in simple_reductions[f]:
            if particular[k] == g:
                part1 = particular[:k] + (p,) + particular[k + 1:]
                extend_complex_reduction(support, part1, general, k + 1)
            elif general[k] == p:
                gen1 = general[:k] + (g,) + general[k + 1:] 
                extend_complex_reduction(support, particular, gen1, k + 1)


def valid_val(val: str):
    return val == '' or val in val2field

def read_xml():
    """ Extracts from the XML tree (which was read from notation.xml)
    different informations and stores them in global variables.
    """
    global field2val, val2field, simple_reductions, complex_reductions, explanation
    # arcs[field] contains individual reductions per field.
    # it is viewed as a directed graph, and transitive arcs are added later
    tree = ET.parse(NOTATION_FILE).getroot()

    read_alias(tree[0])

    # ---------- read the form part and associate values to fields
    for section in tree[1]:
        for xml_field in section:
            if 'hide' in xml_field.attrib:
                continue
            field = correctxml(xml_field.attrib['name'])
            fields.append(field)
            simple_reductions[field] = set()
            if field not in field2val:
                field2val[field] = []
            for option in xml_field:
                val = correctxml(option.attrib['value'])
                expl_val = correctxml(option.attrib['explanation'])
                # we could trim the value val, to avoid following cases
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
                if val == '':
                    val2field["not " + field_of_val] = field_of_val
                else:
                    val2field[val] = field_of_val
                explanation[val] = unalias(expl_val)
                field2val[field_of_val].append(val)


    # ---------- read the reduction part and collect reductions

    for xml_reductions in tree[2]:
        src = xml_reductions.attrib['from']
        dst = xml_reductions.attrib['to']
        if src.count(";") != dst.count(";"):
            error("inconsistent number of fields in complex reduction '%s'" % xml_reductions.attrib)
        if src == dst:
            error("reduction has identical values '%s'" % src)
            continue
        # at this stage: same processing for complex and simple reductions
        S = src.split(";")
        D = dst.split(";")
        for val in S + D:
            if not valid_val(val):
                error("reduction tag has unknown values '%s'" % xml_reductions.attrib)
                continue
        support = []                              # = list of field names
        for i, Si in enumerate(S):
            if Si != '' and D[i] != '' and val2field[Si] != val2field[D[i]]:
                error("reduction '%s' has values from different fields" % xml_reductions.attrib)
                continue
            if Si != '':
                field = val2field[Si]
            elif D[i] != '':
                field = val2field[D[i]]
            else:
                error("reduction tag has empty values. Please use 'not field_name' instead")
                continue
            # internally work with empty strings
            for T in [S, D]:
                if T[i][:4] == "not ":
                    T[i] = ""
            support.append(field)
        if len(support) == 1:             # simple reduction
            simple_reductions[support[0]].add((src, dst))
        else:                       # complex reduction
            s = tuple(support)
            if s not in complex_reductions:
                complex_reductions[s] = set()
            complex_reductions[s].add((tuple(S), tuple(D)))


def make_reductions_transitive():
    """Generate the transitive arcs in the reduction graph
    """

    for field in fields:
        transitive_closure(simple_reductions[field])
    
    for support in complex_reductions:
        transitive_closure(complex_reductions[support])
        E = []
        for particular, general in complex_reductions[support]:
            for ext in extend_complex_reduction(support, particular, general):
                E.append(ext)
        # need to add them after the loop
        # because set should not increase while looping 
        for ext in E:
            complex_reductions[support].add(ext)


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
                            if any(tag in bound for tag in NEGATIVE_TAGS):
                                css_class = "lower"
                            else:
                                css_class = "upper"
                            results.append((problem_vec, css_class, problem_name, bound, key))

# ---------- produce the html form


def print_form():

    try:
        tree = ET.parse(NOTATION_FILE).getroot()
    except ET.ParseError as err:
        print(f"Error in file bib/notation.xml: {err}", file=sys.stderr)
        sys.exit(1)

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
                print(f'    <input onchange="update_pb()" type="radio" name="{name}" id="{name}:{option_value}"', end='')
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

def print_dot_file(filename, arcs):
    f = open(filename, 'w')
    print("digraph G{", file=f)
    print("rankdir=BT;", file=f)
    vertex_id = {}
    for arc in arcs:
        for v in arc:
            if v not in vertex_id:
                vertex_id[v] = len(vertex_id)
    for v in vertex_id:
        i = vertex_id[v]
        print(f'{i} [label="{v}"]', file=f)
    for u, v in arcs:
        i = vertex_id[u]
        j = vertex_id[v]
        print(f"{i} -> {j}", file=f)
    print("}", file=f)
    f.close()

def print_dot():
    read_xml()

    print('<html><head><link href="style.css" type="text/css" rel="stylesheet"></head><body>')
    print("<h1>Reduction rules</h1>")
    print("These graphs are automatically generated from the notation.xml file.")

    print("<h2>Simple reductions</h2>")
    for field in fields:
        print_dot_file(f"dot/{field}.dot", simple_reductions[field])
        print(f"<h3>{field}</h3>")
        print(f'<img src="dot/{field}.dot.png">')

    print("<h2>Complex reductions</h2>")

    c = 0
    for support in complex_reductions:
        c += 1
        print_dot_file(f"dot/{c}.dot", complex_reductions[support])
        print(f"<h3>{support}</h3>")
        print(f'<img src="dot/{c}.dot.png">')
    print("</body></html>")
        
def print_chart(id, field, numbers):
    labels = [x[1] for x in numbers]
    qty = [x[0] for x in numbers]
    print(f""" 
        <div>
    <canvas id="{id}"></canvas>
    </div>

    <script>
    const {id} = document.getElementById('{id}');

    new Chart({id}, {{
        type: 'bar',
        data: {{
        labels: {labels},
        datasets: [{{
            label: '{field}',
            data: {qty},
            borderWidth: 1
        }}]
        }},
        options: {{
        scales: {{
            y: {{
            beginAtZero: true
            }}
        }}
        }}
    }});
    </script>
    """)

def print_stat():
    print('<html><head><link href="style.css" type="text/css" rel="stylesheet"></head><body>')
    print('<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>')

    print("<h1>Statistics</h1>")

    print("Number of referenced problems containing a given value")
    print("among", len(results), "results, described in", len(ref),"bibtex entries.")

    stat = {field:{val:0 for val in field2val[field]} for field in fields}
    for res in results:
        pb = res[0]
        for field in pb:
            try:
                stat[field][pb[field]] += 1
            except KeyError:
                print(f"key error for {field=}")
    f = 0
    for field in fields:
        numbers = [(stat[field][val], val) for val in field2val[field] if val]
        numbers.sort(reverse=True)
        f += 1
        print_chart(f"C{f}", field, numbers)

    # print("<table>")
    # for field in fields:
    #     print(f'<tr><th colspan="2">{field}</th></tr>')
    #     for val in field2val[field]:
    #         print(f'<tr><td style="text-align:right">{val}</td><td>{stat[field][val]}</td></tr>')
    # print("</table>")
    # print("</body></html>")

# ---------- main program

if __name__=="__main__":
    if len(sys.argv) == 1:
        print("Usage: ./extract.py option")
        print("       form:       prints the html form")
        print("       reductions: prints the reduction dictionary")
        print("       references: prints the references")
        print("       results:    prints the results")
        print("       stat:       prints an HTML document with results")
        print("       wikipedia:  prints the notation in wikipedia source format")
        print("       dot:        creates the reduction graphs and prints an HTML document containing them")

    elif sys.argv[1] == "reductions":
        read_xml()
        make_reductions_transitive()
        print("simple_reductions = \\")
        pp.pprint(simple_reductions)
        print("complex_reductions = \\")
        pp.pprint(complex_reductions)
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
        print_stat()

    elif sys.argv[1] == "dot":
        print_dot()

    elif sys.argv[1] == "form":
        print_form()

    elif sys.argv[1] == "wikipedia":
        print_wikipedia()

    else:
        error("invalid option")