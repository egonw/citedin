<?php

require_once("ResourceRegistry.php");

class BiogridResource implements Resource {
	function getResourceName() { return "Biogrid: General Repository for Interaction Datasets"; }
	function getInfoLink() { return "http://www.thebiogrid.org/index.php/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The Biological General Repository for Interaction Datasets (BioGRID) database ([[http://www.thebiogrid.org]]) was developed to house and distribute collections of protein and genetic interactions from major model organism species. BioGRID currently contains over 330,000 interactions from major model organism species, as derived from both high-throughput studies and conventional focused studies. Through comprehensive curation efforts, BioGRID now includes a virtually complete set of interactions reported to date in the primary literature for the budding yeast Saccharomyces cerevisiae and the fission yeast Schizosaccharomyces pombe. A number of new features have been added to the BioGRID including an improved user interface to display interactions based on different attributes, a mirror site and a dedicated interaction management system to coordinate curation across different locations. The BioGRID provides interaction data with monthly updates to Saccharomyces Genome Database, Flybase and Entrez Gene. Source code for the BioGRID and the linked Osprey network visualization system is now freely available without restriction."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from biogrid where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink(''); //TODO: details link
	     
		return $data;
	}
}

ResourceRegistry::register("Hmdb", new BiogridResource());

?>
