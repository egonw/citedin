<?php
require_once("ResourceRegistry.php");

class PleiadesGenesResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from pleiades_genes where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName("Pleiades genes")
				->setCiteCount($num_rows)
				->setInfoLink("http://www.pleiades.org/")
				->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("PleiadesGenes", new PleiadesGenesResource()); 
?>
