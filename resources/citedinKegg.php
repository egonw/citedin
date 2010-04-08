<?php
require_once("ResourceRegistry.php");

class KeggResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from kegg where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Kegg")
			->setCiteCount($num_rows)
	                ->setInfoLink('http://www.genome.jp/kegg/')
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("Kegg", new KeggResource());  
?>
