<?php
	require_once("ResourceRegistry.php");

class BalmerResource implements Resource {
	function getResourceName() { return "Gene expression regulation by retinoic acid"; }
	function getInfoLink() { return "http://www.jlr.org/cgi/content/full/43/11/1773"; }
	function getResourceType() { return "Published data"; }
	function getResourceDescription() { return "A review paper containing a curated list of pubmed identifiers"; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from balmerRetinoic where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setInfoLink($this->getInfoLink())
				->setDetailsLink('http://www.jlr.org/cgi/content/full/43/11/1773#SEC6'); //TODO: details link     
		return $data;
	}
}

ResourceRegistry::register("BalmerRetinoic", new BalmerResource());
 
?>
