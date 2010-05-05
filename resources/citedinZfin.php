<?php

require_once("ResourceRegistry.php");

class ZfinResource implements Resource {
	function getResourceName() { return "ZFIN: The Zebrafish Model Organism Database"; }
	function getInfoLink() { return "http://zfin.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "ZFIN serves as the zebrafish model organism database. The long term goals for ZFIN are a) to be the community database resource for the laboratory use of zebrafish, b) to develop and support integrated zebrafish genetic, genomic and developmental information, c) to maintain the definitive reference data sets of zebrafish research information, d) to link this information extensively to corresponding data in other model organism and human databases, e) to facilitate the use of zebrafish as a model for human biology and f) to serve the needs of the research community.
"; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from zfinView where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("details.php?db=zfinView&pmid=$pmid&fields=zfinId,url"); 
	     
		return $data;
	}
}

ResourceRegistry::register("Zfin", new ZfinResource());

?>
