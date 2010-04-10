<?php

require_once("ResourceRegistry.php");

class HmdbResource extends ResourceData {
	//TODO: infolink methods etc.
	
	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from hmdb where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName("Hmdb: Human Metabolome DataBase")
		     ->setDetailsLink(''); //TODO: details link
	     
		return $data;
	}
}
$info = new ResourceInfo();
$info->setResourceName("Hmdb: Human Metabolome DataBase")
       ->setResourceType("Database")
 	   ->setResourceDescription("The Human Metabolome Database (HMDB) is a freely available electronic database containing detailed information about small molecule metabolites found in the human body.")
	   ->setInfoLink('http://www.hmdb.ca')
	   ->setResourceFilename("citedinHmdb.php")
	   ->setResourceClassname("HmdbResource");
ResourceRegistry::register("Hmdb", $info);

?>
