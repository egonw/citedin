
<?
include 'resources/connectdb.inc';


$pmids = explode(",", $_POST["pmids"]);

print "Your requested InCiI-scoure is currently being calculated. It will appear once it is calculated. The result can also be sent to you: 
<FORM action = \"RequestMail.php\" method =\"post\">
<input name=\"pmids\" type=\"hidden\" value=\"".$_POST["pmids"]."\">
<input name=\"Email\" id=\"Email\" type=\"text\" size=\"75\"/><input type=\"submit\"></form><hr>";

exec("/usr/bin/php RunInCiIUpdate.php ".$_POST["pmids"]." >/dev/null &");
$incache = $_POST["incache"];
$notincache = $_POST["notincache"];
$url = "http://chart.apis.google.com/chart?cht=p3&chs=320x100&chd=t:$incache,$notincache&chl=Cache|Not+in+cache";
print "<IMG SRC=\"$url\">";


?>
