#!/usr/bin/env python3


import sys
import re
from reductions import *


def correctxml(s):
    return s.replace("&lt;", "<")


def pb2latex(s):
    s = re.sub('([^\\\\a-zA-Z_]|^)([a-zA-Z -]{3,99})', '\\1\\\\textrm{\\2}', s)
    if len(s)>=3 and s[:3] == "P;1":
        s = s[2:]
    elif len(s)>=3 and s[1] == ';' and s[2].isdigit():
        s = s[0] + s[2:]
    return '$' + s + '$'



# ---- extract problem vector from string
def str2pb(s, field2val, val2field, file, key):
    orig = s
    s = correctxml(s)
    vec = {field:'' for field in field2val}
    if len(s)>=2 and s[1] in "123456789m":     # special rule for number of machines
        s = s[0] + ';' + s[1:]
    if s[0]=='1':                              # special rule for single machine environment
        s = "P;" + s
    # if '(' in s:                             # special rule for time lags
    #     i = s.index('(')
    #     s = s[:i] + ';' + s[i:]
    s = s.replace("|", ";")
    for val in s.split(";"):
        val = val.strip()
        # val = val.replace("\\", "\\\\")
        if val != '':
            if val not in val2field:
                error(f"BibTeX entry '{key}' in file {file} contains a problem {orig} with unknown value '{val}'")
                return {}
            field = val2field[val]
            if vec[field] != '':
                error("'%s' contains twice the value '%s'" % (orig, val))
                return {}
            vec[field] = val
    for field in field2val:
        if vec[field] == '' and '' not in field2val[field]:
                error("'%s' has missing objective function" % orig)
                return {}
    return vec


# ---- hamming distance
def hamming(u, v):
    dist = 0
    for key in u:
        if u[key] != v[key]:
            dist += 1
    return dist


def pb2vals(prob):
    vals = set()
    for key in prob:
        if prob[key] != '':
            vals.add(key)
            vals.add(prob[key])
    return vals

# ---- test reduction between problems
def reduces(src, dst):
    for key in src:
        arc = (src[key], dst[key])
        if arc[0] != arc[1] and \
           (arc not in reduction or not eval_bool_expr(reduction[arc], pb2vals(dst))):
            return False
    return True




# ---------- boolean expressions

def parse_bool_expr(s):
    val_stack = []
    op_stack = []
    priority = [';', '(', ')', 'or', 'and', 'not']
    last_val = ''
    try:
        for tok in (s + ' ;').split(' '):
            if tok in priority:
                prio = priority.index(tok)
                while (tok != '(' and op_stack and
                       priority.index(op_stack[-1]) >= prio):
                    op = op_stack.pop()
                    right = val_stack.pop();
                    if op == 'not':
                        val_stack.append( (op, right) )
                    else:
                        left = val_stack.pop()
                        if op == 'and' or op == 'or':
                            val_stack.append( (op, left, right) )
                        else:
                            error("'%s' bad formed expression" % s)
                            return val_stack.pop()
                if tok == ')':
                    op = op_stack.pop()
                    if op != '(':
                        error("'%s' bad formed expression" % s)
                        return val_stack.pop()
                else:
                    op_stack.append(tok)
                last_val = ''
            elif tok != '':
                if last_val != '':
                    val = last_val + ' ' + tok
                    val_stack.pop()
                else:
                    val = tok
                val_stack.append(val)
                last_val = val
        if op_stack != [ ';' ] :
            error("'%s' bad formed expression" % s)
        return val_stack.pop()
    except IndexError:
        error("'%s' bad formed expression" % s)
        return False

def eval_bool_expr(expr, vals):
    if isinstance(expr, bool):
        return expr
    elif isinstance(expr, tuple):
        op = expr[0]
        if op == 'not':
            return not eval_bool_expr(expr[1], vals)
        elif op == 'and':
            return eval_bool_expr(expr[1], vals) and eval_bool_expr(expr[2], vals)
        elif op == 'or':
            return eval_bool_expr(expr[1], vals) or  eval_bool_expr(expr[2], vals)
        else:
            error("'%s' bad operator in expression")
            return False
    else:
        return expr in vals


def error(msg):
    print("Error: "+ msg, file=sys.stderr)
    sys.exit(1)

def getattr(bib, attr):
    a = attr.upper()
    if a in bib:
        return bib[a]
    else:
        return "unknown " + attr

def bib2str(bib):
    """Write entry to html"""

    s = ""

    # --- chapter ---
    chapter = False
    if 'CHAPTER' in bib:
      chapter = True
      s += '<span class="title">'
      s += bib['CHAPTER']
      s += '</span>'
      s += ', '



    # --- title ---
    if not(chapter):
        s += '<span class="title">'
        s += '<a href="https://scholar.google.fr/scholar?q=%s">%s</a>' % (getattr(bib, 'title'), getattr(bib, 'title'))
        s += '</span>'
        s += ', '


    # --- author ---
    s += '<span class="author">'
    s += getattr(bib, 'author')
    s += '</span>'
    s += ', '

    # -- if book chapter --
    if chapter:
      s += 'in: '
      s += '<i>'
      s += getattr(bib, 'title')
      s += '</i>'
      s += ', '
      s += getattr(bib, 'publisher')


    # --- journal or similar ---
    journal = False
    if 'JOURNAL' in bib:
        journal = True
        s += '<i>'
        s += bib['JOURNAL']
        s += '</i>'
    elif 'BOOKTITLE' in bib:
        journal = True
        s += bib['BOOKTITLE']
    elif bib['ENTRYTYPE'] == 'phdthesis':
        journal = True
        s += 'PhD thesis, '
        s += getattr(bib, 'school')
    elif bib['ENTRYTYPE'] == 'techreport':
        journal = True
        s += 'Tech. Report, '
        s += getattr(bib, 'number')

    # --- volume, pages, notes etc ---
    if 'VOLUME' in bib:
        s += ', Vol. '
        s += bib['VOLUME']
    if ('NUMBER' in bib and bib['ENTRYTYPE']!='techreport'):
        s += ', No. '
        s += bib['NUMBER']
    if 'PAGES' in bib:
            s += ', p.'
            s += bib['PAGES']
    elif 'NOTE' in bib:
        if journal or chapter: s += ', '
        s += bib['NOTE']
    if 'MONTH' in bib:
        s += ', '
        s += bib['MONTH']

    # --- year ---
    s += '<span class="year">'
    #s += ', ';
    s += ' ';
    s += getattr(bib, 'year')
    s += '</span>'
    #s += ',\n'

    # final period
    s += '.'

    # --- Links ---
    pdf = False
    url = False
    if 'PDF' in bib:
        pdf = True
    if 'URL' in bib or 'DOI' in bib:
        url = True

    if pdf or url:
        s += '\n['
        if pdf:
            s += '<a href="'
            s += pdfpath + bib['PDF']
            s += '">pdf</a>'
            if url:
                s += '|'
        if url:
            s += '<a href="'
            if 'URL' in bib:
                s += bib['URL']
            else:
                s += 'http://dx.doi.org/' + bib['DOI']
            s += '">doi</a>&nbsp;'
        s += ']\n'
    s += ' <a href="ref2bibtex.php?ID=%s">[bibtex]</a>' % bib['ID']

    return s


if __name__=="__main__":
    d = {'ANNOTE': '$1|prec;p_j=p;s-batch|\\sum C_j$ is in $P$,\\\\\n$1|p_j=p;s-batch|\\sum w_jC_j$ is in $P$,\\\\\n$1|chains;s-batch|\\sum C_j$ is NP-hard,\\\\\n$1|chains;p_j=1;s-batch|\\sum w_jC_j$ is strongly NP-hard,\\\\\n$1|s-batch|\\sum w_jC_j$ is strongly NP-hard.', 'TITLE': 'The complexity of one-machine batching problems', 'ID': 'AlbersBrucker:93:The-complexity-of-one-machine', 'FJOURNAL': 'Discrete Applied Mathematics. Combinatorial Algorithms, Optimization and Computer Science', 'NUMBER': '2', 'DATE-MODIFIED': '2015-12-11 22:11:19 +0000', 'PAGES': '87-107', 'JOURNAL': 'Discrete Appl. Math.', 'ENTRYTYPE': 'article', 'VOLUME': '47', 'YEAR': '1993', 'AUTHOR': 'Albers, S. and Brucker, P.'}
    print(bibdict2str(d))
