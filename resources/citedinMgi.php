<?php

require_once("ResourceRegistry.php");

class MgiResource implements Resource {
	function getResourceName() { return "MGI: Mouse Genome Informatics"; }
	function getInfoLink() { return "http://www.informatics.jax.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "MGI is the international database resource for the laboratory mouse, providing integrated genetic, genomic, and biological data to facilitate the study of human health and disease."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from mgidb where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setInfoLink($this->getInfoLink())
		     ->setDetailsLink("details.php?db=mgidb&pmid=$pmid&fields=mgiid,url&idField=mgiid"); 
	     
		return $data;
	}
}

ResourceRegistry::register("Mgi", new MgiResource());

?>
