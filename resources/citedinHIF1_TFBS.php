<?php
require_once("ResourceRegistry.php");

class HIFTFBSResource implements Resource {
	function getResourceName() { return "HIF TFBS transcription factor complex composed of HIF1A and ARNT."; }
	function getInfoLink() { return "http://stke.sciencemag.org/cgi/content/abstract/sigtrans;2005/306/re12?view=abstract"; }
	function getResourceType() { return "Published data"; }
	function getResourceDescription() { return "The data was extracted from the following review:
	[DOI: 10.1126/stke.3062005re12] Roland H. Wenger, Daniel P. Stiehl and Gieri Camenisch. Integration of oxygen signaling at the consensus HRE. (2005) Sci STKE. 306:re12."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	include 'connectdb.inc';
	$result = mysql_query("SELECT * from HIF_TFBS where pmid=$pmid");
	$num_rows = mysql_num_rows($result);

	$data = new ResourceData();
	$data->setResourceName($this->getResourceName())
			->setCiteCount($num_rows)
			->setInfoLink($this->getInfoLink())
			->setDetailsLink('http://stke.sciencemag.org/cgi/content/abstract/sigtrans;2005/306/re12?view=abstract'); //TODO: details link

	return $data;
	}
}

ResourceRegistry::register("HIFTFBS", new HIFTFBSResource());

?>
