<?php
require_once("ResourceRegistry.php");

class UniprotResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from uniprot where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Uniprot")
			->setCiteCount($num_rows)
			->setInfoLink('http://www.uniprot.org/')
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("Uniprot", new UniprotResource());   
?>
