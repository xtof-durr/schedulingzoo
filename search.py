#!/usr/bin/env python3

import sys
from results import *
from tools import *
from references import *
from reductions import *

html_head = """
<html>
<head>
<title>The scheduling zoo</title>
  <meta name="GENERATOR"
 content="Mozilla/3.01Gold (X11; I; SunOS 5.4 sun4m) [Netscape]">
  <link href="style.css" type="text/css" rel="stylesheet">
  <meta http-equiv=content-type content="text/html; charset=UTF-8">
  <style type="text/css">
  </style>
</head>
<body>
<script type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});
</script>
"""

def print_list(list):
    retval = []
    print('<table class="TRalternate" width=100%>')
    list.sort()
    for (dist, css_class, pb_name, bound, ref) in list:
        if ref not in references:
            error("unknown reference "+ref)
        try:
            print('<tr><td class="%s" width=150><a href="search.php?problem=%s">$%s$</a></td>'
                  '<td width=200>%s</td><td><small>%s</small></td></tr>' %
                  (css_class, pb_name, pb2latex(pb_name), bound, bib2str(references[ref])))
        except UnicodeEncodeError:
            print('<tr><td class="%s" width=150><a href="search.php?problem=%s">$%s$</a></td>'
                  '<td width=200>%s</td><td><small>ERROR: bad utf8 characters in the bibtex entry %s</small></td></tr>' %
                  (css_class, pb_name, pb2latex(pb_name), bound, ref))
    print("</table>")
    return retval

# ---- test reduction between problems

def reduces(src, dst):
    """ is src problem a particular case of dst problem?
    """
    # first try simple reductions
    failed = [] # is list of fields where simple reductions failed
    for key in src:
        arc = (src[key], dst[key])
        if arc[0] != arc[1] and arc not in simple_reductions[key]:
            failed.append(key)
    if not failed:
        return True
    # now try to find a complex reduction, whose support contains F
    failed_set = set(failed)
    for support in complex_reductions:
        if failed_set.issubset(set(support)):
            S = tuple(src[f] for f in support)
            D = tuple(dst[f] for f in support)
            if (S, D) in complex_reductions[support]:
                return True
    return False


# --------------- main

if len(sys.argv) == 2:
    problem_name = sys.argv[1]
    problem_vec = str2pb(problem_name, field2val, val2field)

    if not problem_vec:
        print("<h2>Error</h2>The problem name '%s' is ill formed." % pb2latex(problem_name))
        sys.exit(0)

    print(html_head)

    # -------- find results

    list_solved = []
    list_upper  = []
    list_lower  = []
    list_other  = []

    for entry in results:
        (pb_vec, css_class, pb_name, bound, ref) = entry
        rest   = (hamming(pb_vec, problem_vec),) + entry[1:]
        if pb_vec == problem_vec:
            list_solved.append(rest)
        elif reduces(pb_vec, problem_vec):
            if css_class == 'lower':
                list_solved.append(rest)
            else:
                list_lower.append(rest)
        elif reduces(problem_vec, pb_vec):
            if css_class == 'upper':
                list_solved.append(rest)
            else:
                list_upper.append(rest)
        else:
            list_other.append(rest)

    # --------- print problem name and explanations

    print("<h1>$%s$</h1>" % pb2latex(problem_name))

    print('<dl class="explanation">')
    for field in fields:
        val = problem_vec[field]
        if val and not(field == 'type' and problem_vec['number of machines'] == '1'):
            print("<dt>%s</dt><dd>%s</dd>" % (pb2latex(val), explanation[val]) )
    print('</dl>')

    # --------- print results

    if list_solved:
        print("<h2>Matching entries found</h2>")
        print_list(list_solved)
    else:
        print("<h2>No matching entries found</h2>")

    if list_upper:
        print("<h2>This problem is a particular case of...</h2>")
        print_list(list_upper)

    if list_lower:
        print("<h2>This problem generalizes...</h2>")
        print_list(list_lower)

    print('<span title="problems with closest Hamming distance">'
          '<h2>Ten related results</h2></span>')
    list_other.sort()
    print_list(list_other[:10])

elif len(sys.argv) == 3:
    part_name = sys.argv[1]
    part_vec = str2pb(part_name, field2val, val2field)
    gen_name = sys.argv[2]
    if '|' in gen_name:
        gen_vec = str2pb(gen_name, field2val, val2field)
        print(part_vec)
        print(gen_vec)
        print(reduces(part_vec, gen_vec))
    else:
        print(eval_bool_expr(parse_bool_expr(gen_name), pb2vals(part_vec)))
else:
    print("<h1>Error</h1>No argument given to search.py<p>")
    print("Usage possibilities:")
    print("search.py problemname                    # prints an HTML document with search results")
    print("search.py problemname1 problemname2      # checks reduction")
    print("search.py problemname booleanexpression  # evaluates the boolean expression")
