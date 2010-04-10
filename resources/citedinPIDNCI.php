<?php
require_once("ResourceRegistry.php");

class PIDNCIResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from NCI where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName("Nature Pathway interaction database (NCI)")
				->setCiteCount($num_rows)
				->setInfoLink('http://pid.nci.nih.gov/PID/index.shtml')
				->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

$info = new ResourceInfo();
$info->setResourceName("Nature Pathway interaction database (NCI)")
       ->setResourceType("Database")
 	   ->setResourceDescription("The Pathway Interaction Database is a highly-structured, curated collection of information about known biomolecular interactions and key cellular processes assembled into signaling pathways. It is a collaborative project between the US National Cancer Institute (NCI) and Nature Publishing Group (NPG), and is an open access online resource.")
	   ->setInfoLink('http://pid.nci.nih.gov/PID/index.shtml')
	   ->setResourceFilename("citedinPIDNCI.php")
	   ->setResourceClassname("PIDNCIResource");
ResourceRegistry::register("PIDNCI", $info);
?>
