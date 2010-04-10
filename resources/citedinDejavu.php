<?php
require_once("ResourceRegistry.php");

class DejavuResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from dejavu where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName("DejaVu")
				->setCiteCount($num_rows)
		                ->setInfoLink("http://dejavu.vbi.vt.edu/dejavu/")
				->setDetailsLink(''); //TODO: details link

		return $data;
	}
}
$info = new ResourceInfo();
$info->setResourceName("Deja Vu: a Database of Highly Similar Citations")
       ->setResourceType("Database")
 	   ->setResourceDescription("Deja vu is a database of extremely similar Medline citations. Many, but not all, of which contain instances of duplicate publication and potential plagiarism.")
	   ->setInfoLink('http://dejavu.vbi.vt.edu/dejavu/')
	   ->setResourceFilename("citedinDejavu.php")
	   ->setResourceClassname("DejavuResource");
ResourceRegistry::register("Dejavu", $info);   
?>
