<!doctype html>
<?
echo `./search.py "$_REQUEST[problem]" 2>&1`;


function write_log($msg) {
   $f = fopen("../schedulingzoolog.txt", "a");
   fputs($f, date("r")."\t$_SERVER[REMOTE_ADDR]\t$msg\n");
   fclose($f);
}

write_log(stripslashes($_REQUEST[problem]));

?>
