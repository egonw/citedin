
<?
include 'resources/connectdb.inc';


$pmids = explode(",", $_POST["pmids"]);

print "Your requested InCiI-scoure is currently being calculated. It will appear once it is calculated. The result can also be sent to you: 
<FORM action = \"RequestMail.php\" method =\"post\">
<input name=\"pmids\" type=\"hidden\" value=\"".$_POST["pmids"]."\">
Email: <input name=\"Email\" id=\"Email\" type=\"text\" size=\"75\"/><br>
Twitter: <input name=\"Twitter\" id=\"Twitter\" type=\"text\" size=\"75\"/>
<input type=\"submit\"></form><hr>";
$commandpmids = $_POST["pmids"];
$bitlyUrl = $_POST["bitlyUrl"];
$email = $_POST["email"];
$twitter = $_POST["twitter"];
if ($email == "") $email = "na";
if ($twitter == "") $twitter = "na";
$command = "/usr/bin/php RunInCiIUpdate.php \"$commandpmids\" \"$bitlyUrl\" \"$email\" \"$twitter\" >/dev/null &";
exec($command);
print $command;


?>
