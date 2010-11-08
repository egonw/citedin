<PRE>
<?
include 'resources/connectdb.inc';
print_r($_POST);
$pmids = explode(",", $_POST["pmids"]);
foreach ($pmids as $pmid){
	$sqlUpdate = "INSERT INTO InCiIUpdate (pmid, UpdateDate) VALUES ($pmid, CURDATE());";
	mysql_query($sqlUpdate);
	
	}
?>
</PRE>