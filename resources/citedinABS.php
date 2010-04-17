<?php
require_once("ResourceRegistry.php");

class ABSResource implements Resource {
	function getResourceName() { return "ABS: a database of Annotated regulatory Binding Sites from orthologous promoters"; }
	function getInfoLink() { return "http://genome.imim.es/datasets/abs2005"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from ABS where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink('http://nar.oxfordjournals.org/cgi/content/full/34/suppl_1/D63'); 

		return $data;
	}
}

ResourceRegistry::register("ABS", new ABSResource());
?>
