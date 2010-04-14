<?php
require_once("ResourceRegistry.php");

class UniprotResource implements Resource {
	function getResourceName() { return "Uniprot"; }
	function getInfoLink() { return "http://www.uniprot.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "he mission of UniProt is to provide the scientific community with a comprehensive, high-quality and freely accessible resource of protein sequence and functional information."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from uniprot where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("Uniprot", new UniprotResource());
  
?>
