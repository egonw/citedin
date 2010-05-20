<?php

require_once("ResourceRegistry.php");

class WormbaseResource implements Resource {
	function getResourceName() { return "Wormbase"; }
	function getInfoLink() { return "http://www.wormbase.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "WormBase is an international consortium of biologists and computer scientists dedicated to providing the research community with accurate, current, accessible information concerning the genetics, genomics and biology of C. elegans and some related nematodes. Founded in 2000, the WormBase Consortium is led by Paul Sternberg of CalTech, Richard Durbin of the Wellcome Trust Sanger Institute, Lincoln Stein of Cold Spring Harbor, and John Spieth of the Washington University Genome Sequencing Center."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from wormbase where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("details.php?db=wormbase&pmid=$pmid&fields=WBPaperID&idField=WBPaperID"); 
	     
		return $data;
	}
}

ResourceRegistry::register("Wormbase", new WormbaseResource());

?>
