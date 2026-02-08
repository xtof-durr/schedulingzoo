<!doctype html>
<?php
echo `./search.py "$_REQUEST[problem]" 2>&1`;

// This was interesting at the beginning, to see if the website is used
// and to see what are the favorite objective functions for example.
// But today I don't want to spy on the users, so this is unabled.

// function write_log($msg) {
//    $f = fopen("../schedulingzoolog.txt", "a");
//    fputs($f, date("r")."\t$_SERVER[REMOTE_ADDR]\t$msg\n");
//    fclose($f);
// }

// write_log(stripslashes($_REQUEST[problem]));

?>
