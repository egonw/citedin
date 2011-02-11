<?php

require_once("ResourceRegistry.php");

class CtdResource implements Resource {
	function getResourceName() { return "CTD: Comparative Toxicogenomics Database"; }
	function getInfoLink() { return "http://ctd.mdibl.org"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "CTD advances understanding of the effects of environmental chemicals on human health.

The etiology of most chronic diseases involves interactions between environmental factors and genes that modulate important physiological processes.1,2 This assumption is supported by the many complex diseases caused by reversible behaviors or avoidable exposures, and by the relatively rare number of diseases attributed to single gene mutations.2 Environmental factors are implicated in many common conditions such as asthma, cancer, diabetes, hypertension, immune deficiency disorders and Parkinson’s disease; however, the molecular mechanisms underlying these correlations are not well understood.3

CTD includes manually curated data describing cross-species chemical–gene/protein interactions and chemical– and gene–disease relationships to illuminate molecular mechanisms underlying variable susceptibility and environmentally influenced diseases. These data will also provide insights into complex chemical–gene and protein interaction networks."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from ctd where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
                     ->setInfoLink($this->getInfoLink())
		     ->setDetailsLink("http://ctd.mdibl.org/detail.go?view=ixn&type=reference&acc=$pmid"); //TODO: details link
	     
		return $data;
	}
}

ResourceRegistry::register("Ctd", new CtdResource());

?>
