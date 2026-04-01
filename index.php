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

<body onload="update_pb()">
<script type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>

<script type="text/javascript">

/*
@licstart  The following is the entire license notice for the JavaScript code in this page.

Copyright (C) 2016 Christoph Dürr

    The JavaScript code in this page is free software: you can
    redistribute it and/or modify it under the terms of the GNU
    General Public License (GNU GPL) as published by the Free Software
    Foundation, either version 3 of the License, or (at your option)
    any later version.  The code is distributed WITHOUT ANY WARRANTY;
    without even the implied warranty of MERCHANTABILITY or FITNESS
    FOR A PARTICULAR PURPOSE.  See the GNU GPL for more details.

    As additional permission under GNU GPL version 3 section 7, you
    may distribute non-source (e.g., minimized or compacted) forms of
    that code without the copy of the GNU GPL normally required by
    section 4, provided you include this license notice and a URL
    through which recipients can access the Corresponding Source.

@licend  The above is the entire license notice for the JavaScript code in this page.
*/

var pb_list = [];
var pb_name = "";
var pb_attr = {};

// evaluates a given boolean expression formed of and, or, not and ().
// boolean atoms are strings in pb_list and pb_attr
function eval_bool_expr(elem) {
    if (! elem.hasAttribute('requires'))
        return true;
    var expr = elem.getAttribute('requires');
    var val_stack = [];
    var op_stack = [];
    var priority = [';', '(', ')', 'or', 'and', 'not'];
    var list = (expr + ' ;').split(' ');
    var last_val = '';
    for (var i = 0; i < list.length; i++) {
        var tok = list[i];
        var prio = priority.indexOf(tok);
        if (prio != -1) {  // tok est un opérateur
            while (tok != '(' && op_stack.length > 0 &&
                   priority.indexOf(op_stack[op_stack.length - 1]) >= prio) {
                op = op_stack.pop()
                var right = val_stack.pop();
                if (op == 'not') {
                    val_stack.push( ! right );
                }
                else {
                    var left = val_stack.pop()
                    if (op == 'and')
                        val_stack.push(left && right);
                    else if (op == 'or')
                        val_stack.push(left || right);
                }
            }
            if (tok == ')')
                op_stack.pop(); // ceci devrait être la ’(’ correspondante
            else
                op_stack.push(tok);
            last_val = '';
        }
        else if (tok != '') {
            var val = '';
            if (last_val != '') {
                val = last_val + ' ' + tok;
                val_stack.pop();
            }
            else
                val = tok;
            val_stack.push(pb_list.indexOf(val) != -1 || val in pb_attr && pb_attr[val] != "");
            last_val = val;
        }
    }
    return val_stack.pop()
}

function strEndsWith(str, suffixChar) {
    n = str.length;
    return n > 0 && str.charAt(n - 1) == suffixChar;
}


function hide(item) {
    //item.style.visibility = "hidden";
	item.style.display = "none";
}

function show(item) {
    //item.style.visibility = "visible";
	item.style.display = "inline-block";
	item.style.width = "100%";
}

function is_shown(item) {
//    return item.style.visibility != "hidden";
	return item.style.display != "none";
	}

function hide_option(item){
	var labelName = "label:" + item.name + ":" + item.value;
	var label = document.getElementById(labelName);
	label.style.display = "none";
}

function show_option(item){
	var labelName = "label:" + item.name + ":" + item.value;
	var label = document.getElementById(labelName);
	label.style.display = "inline-block";
}


function update_pb() {
    pb_name = "";
    pb_list = [];
    pb_attr = {};
    nb_sep = 0;
    var rows = document.getElementsByTagName("TR");

    for(var i = 0; i < rows.length; i++) {             // loop over all rows
        var tr = rows[i];
        if (tr.hasAttribute('add_separator')) {       // add separator
            nb_sep += 1;
            if (nb_sep < 3) {
                pb_name += "|";
            }
        }
		if (! eval_bool_expr(tr)) {
             hide(tr);                                 // do not process further this row
		} else {
			show(tr);                                  // row is active
            var has_options = false;
            var td = tr.children[1].children;          // options are in 2nd column
            for(var j=0; j<td.length; j++) {
                if (td[j].type == "radio") {
                    var option = td[j];
    				if (! eval_bool_expr(option)) {    // option is not active
    					hide_option(option);
    				}
    				else {
    					show_option(option);           // option is active
                        has_options = true;
        				if (option.checked) {
        					pb_attr[option.name] = option.value;
                            pb_list.push(option.value);
        					if (! tr.hasAttribute('hide') && option.value != "" ) {
    							if (pb_name != "" && ! strEndsWith(pb_name, "|") 
                                    && ! option.hasAttribute("separation") && nb_sep != 3)
    								pb_name += ";";
                                if (nb_sep == 3) {
                                    nb_sep = 4;         // encountered first parameter
                                    pb_name += " [";
                                }
    							pb_name += option.value;
        					}
        				}
        			}
    			}
            }
            if (! has_options)
                hide(tr);
		}
	}
    if (nb_sep == 4)
        pb_name += "]";

    document.getElementById('problem').value = pb_name;

    sec = document.getElementById('Parameters');
    if (eval_bool_expr(sec)) {    // option is not active
        show(sec);
    }
    else {
        hide(sec);
    }

    // MathJax.Hub.Queue(["Typeset",MathJax.Hub,"explanation_div"]);
}

</script>

<h1>The Scheduling Zoo</h1>

<form action="search.php" id="form" method="POST" >

<?php include("form.php"); ?>

<p><input value="search" type="submit">
<input type="hidden" id="problem" name="problem" />
</form>

<p align="right">
 <a href="https://en.wikipedia.org/wiki/Notation_for_theoretic_scheduling_problems">notation</a> | <a href="https://github.com/xtof-durr/schedulingzoo/wiki/The-Scheduling-Zoo-project">about</a> 
</body>
</html>
