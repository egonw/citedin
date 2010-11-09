
<?
include 'resources/connectdb.inc';


$pmids = explode(",", $_POST["pmids"]);
putenv("pmids=".$_POST["pmids"]);
print "Your requested InCiI-scoure is currently being calculated. It will appear once it is calculated. The result can also be sent to you: 
<FORM action = \"RequestMail.php\" method =\"post\">
<input name=\"pmids\" type=\"hidden\" value=\"".$_POST["pmids"]."\">
<input name=\"Email\" id=\"Email\" type=\"text\" size=\"75\"/><input type=\"submit\"></form><hr>";

exec("/usr/bin/php RunInCiIUpdate.php >/dev/null &");

$cwd = '/tmp';
$env = array('pmids' => $_POST["pmids"]);
$process = proc_open('php', $descriptorspec, $pipes, $cwd, $env);

if (is_resource($process)) {
    // $pipes now looks like this:
    // 0 => writeable handle connected to child stdin
    // 1 => readable handle connected to child stdout
    // Any error output will be appended to /tmp/error-output.txt

    fwrite($pipes[0], "RunInCiIUpdate.php");
    

    

    // It is important that you close any pipes before calling
    // proc_close in order to avoid a deadlock
   // $return_value = proc_close($process);

    //echo "command returned $return_value\n";
}



?>
