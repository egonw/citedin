<?php
require_once("ResourceRegistry.php");

class HIFTFBSResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from HIF_TFBS where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("HIF TFBS")
			->setCiteCount($num_rows)
			->setInfoLink("http://stke.sciencemag.org/cgi/content/abstract/sigtrans;2005/306/re12?view=abstract")
			->setDetailsLink('http://stke.sciencemag.org/cgi/content/abstract/sigtrans;2005/306/re12?view=abstract'); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("haemB", new HIFTFBSResource());
?>
