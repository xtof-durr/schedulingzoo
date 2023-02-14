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
<?php include_once("analytics.php") ?>
<script type="text/javascript"
  src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>

<h1>About this website</h1>

<h2>What is this?</h2>

<p>
This is a bibliography on some scheduling problems.  The contributors are
<a href="https://link.springer.com/article/10.1007/s10951-013-0366-5">Peter Brucker</a>,
<a href="http://www-desir.lip6.fr/~durrc/">Christoph Dürr</a>,
<a href="https://www.coga.tu-berlin.de/v_menue/mitarbeitende/sven_jaeger/">Sven Jäger</a>,
<a href="http://www.informatik.uni-osnabrueck.de/knust/">Sigrid Knust</a>,
<a href="https://sites.google.com/site/protfr/">Damien Prot</a>,
<a href="https://www.uni-siegen.de/fb6/aan/optimierung/mitarbeiter/vanstee/?lang=d">Rob van Stee</a>,
<a href="https://sites.google.com/a/usach.cl/oscar-cvasquez/">Óscar C. Vásquez</a>.
</ul>
The first version of this website was online since July 2006, and this version went online in January 2016.
</p>

<h2>How to contribute?</h2>

<p>
If you would like to contribute as well, drop us an email.  You could either provide us the URL to your annotated bibtex file or we give you access to the Dropbox folder. Essentially there is a single <a href="bib/notation.xml">file</a> describing formally the notation and the reductions.  And the complexity results are simple bibtex files with results written in the Annote field.
</p>
<p>
  A technical description of the website can be found <a href="doc/doc.pdf">here</a>.
</p>
<h2>The bibtex files</h2>

<p>
The initial bibtex file was provided by Peter Brucker and Sigrid Knust, which used it for this other <a href="http://www2.informatik.uni-osnabrueck.de/knust/class/">website</a> on the classification of scheduling problems, which has the nice feature of listing minimal and maximal open problems.  Since then more material was added, mainly in order to cover the results mentioned in the following books.
    <table>
        <tr>
            <td> <a href="https://books.google.com/books?id=7SGl9LzwiZwC"><img src="brucker-knust.jpg"></a>  </td>
            <td> <a href="https://books.google.com/books?id=T2jrCAAAQBAJ"><img src="brucker.jpg"></a> </td>
            <td> <a href="https://books.google.com/books?id=QRiDnuXSnVwC"><img src="pinedo.jpg"></a> </td>
        </tr>
    </table>
</p>
<p>
    The following bibtex files are used for this web site.
    <ul>
    <?
    foreach (glob("bib/*.bib") as $filename) {
        $count = `grep -c @ $filename`;
        echo "<li><a href=\"$filename\">$filename</a> with $count entries</li>\n";
    }
    ?>
</ul>
All these files describe <? echo  file_get_contents("stat.txt"); ?> results.
</p>

<h2>The reductions</h2>

<p>
The following reduction rules are used in order to decide if a problem A is a particular case of a problem B.  We adopted a simple mechanism which might not capture all possible reductions between the problems, but which is simple.  First the problems names are viewed as vectors, associating values to different fields.  The fields correspond the pop up selection boxes from the start page, and are called type, number of machines, precedence relation etc.  Then problem B dominates problem A if in every field the value of A dominates the value of B.
</p>
<p>
    Fieldwise dominance is defined by the following relations. Some relations depend on some boolean expression formulated on the presence or absence of some values in B.  For example a problem defined on one machine is a particular of a problem B defined on 2 machines, if the specification of B allows to use dummy jobs that block one of the machines.


<? include("dot.html"); ?>

</p>
</body>
</html>
