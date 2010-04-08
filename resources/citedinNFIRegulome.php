<?php
require_once("ResourceRegistry.php");

class NFIRegulomeResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from NFIRegulome where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName("NFIRegulome")
				->setCiteCount($num_rows)
				->setInfoLink("http://nfiregulome.ccr.buffalo.edu")
				->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("NFIRegulome", new NFIRegulomeResource());  
?>
