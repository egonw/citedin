<?php
require_once("ResourceRegistry.php");

class JasparResource implements Resource {
	function getResourceName() { return "Jaspar"; }
	function getInfoLink() { return "http://genome.imim.es/datasets/abs2005"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The JASPAR CORE database contains a curated, non-redundant set of 123 transcription factor binding profiles from published articles."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from jaspar where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("Jaspar", new JasparResource());
?>
