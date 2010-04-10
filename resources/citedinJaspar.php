<?php
require_once("ResourceRegistry.php");

class JasparResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from jaspar where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Jaspar")
			->setCiteCount($num_rows)
	  		->setInfoLink('http://jaspar.cgb.ki.se/')
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

$info = new ResourceInfo();
$info->setResourceName("Jaspar")
       ->setResourceType("Database")
 	   ->setResourceDescription("The JASPAR CORE database contains a curated, non-redundant set of 123 transcription factor binding profiles from published articles.")
	   ->setInfoLink('http://jaspar.genereg.net')
	   ->setResourceFilename("citedinJaspar.php")
	   ->setResourceClassname("JasparResource");
ResourceRegistry::register("Jaspar", $info);   
?>
