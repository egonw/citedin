
<?
include 'resources/connectdb.inc';


$pmids = explode(",", $_POST["pmids"]);

print "Your requested InCiI-scoure is currently being calculated. ";
$commandpmids = $_POST["pmids"];
$bitlyUrl = $_POST["bitlyUrl"];
$email = $_POST["email"];
$twitter = $_POST["twitter"];
if ($email == "") $email = "na";
if ($twitter == "") $twitter = "na";
$command = "/usr/bin/php RunInCiIUpdate.php \"$commandpmids\" \"$bitlyUrl\" \"$email\" \"$twitter\" >/dev/null &";
exec($command);


?>
