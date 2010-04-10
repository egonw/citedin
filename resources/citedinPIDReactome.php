<?php
require_once("ResourceRegistry.php");

class PIDReactomeResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	 include 'connectdb.inc';
	   $result = mysql_query("SELECT * from PID_Reactome where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Nature Pathway interaction database (Reactome)")
			->setCiteCount($num_rows)
	 		->setInfoLink('http://pid.nci.nih.gov/PID/index.shtml')
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

$info = new ResourceInfo();
$info->setResourceName("Nature Pathway interaction database (Reactome)")
       ->setResourceType("Database")
 	   ->setResourceDescription("REACTOME is a free, online, open-source, curated pathway database encompassing many areas of human biology. Information is authored by expert biological researchers, maintained by the Reactome editorial staff and cross-referenced to a wide range of standard biological databases. ")
	   ->setInfoLink('http://www.reactome.org/')
	   ->setResourceFilename("citedinPIDReactome.php")
	   ->setResourceClassname("PIDReactomeResource");
ResourceRegistry::register("PIDReactome", $info);
?>
