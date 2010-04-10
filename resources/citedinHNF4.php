<?php
require_once("ResourceRegistry.php");

class HNF4Resource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from HNF4 where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("HNF4")
			->setCiteCount($num_rows)
			->setInfoLink("http://www.sladeklab.ucr.edu/")
			->setDetailsLink(''); //TODO: details link

		return $data;
	}
}
$info = new ResourceInfo();
$info->setResourceName("HNF4: data from the Sladek lab at UC Riverside")
       ->setResourceType("Database")
 	   ->setResourceDescription("The HNF4 project houses data from the Sladek lab at UC Riverside (http://www.sladeklab.ucr.edu/). The project includes 107 expert curated TFBS that were bulk-uploaded with the interacting transcription factor labeled as human HNF4A. Consult each original publication to determine the actual species source of TF used in the experiments. H4 numbers assigned to regulatory sequences refer to specific binding sites.")
	   ->setInfoLink('http://www.sladeklab.ucr.edu/')
	   ->setResourceFilename("citedinHNF4.php")
	   ->setResourceClassname("HNF4Resource");
ResourceRegistry::register("HNF4", $info); 
?>
