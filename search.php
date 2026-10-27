<!doctype html>
<?php
$problem = $_REQUEST['problem'] ?? '';
if (!is_string($problem) || trim($problem) === '') {
    http_response_code(400);
    echo '<p>Please select a problem using the <a href="index.php">search form</a>.</p>';
} else {
    $argument = escapeshellarg($problem);
    echo `./search.py $argument 2>&1`;
}

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
