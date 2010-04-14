<?php
	require_once("ResourceRegistry.php");

class CancerCellResource implements Resource {
	function getResourceName() { return "Cancer Cell Map"; }
	function getInfoLink() { return "http://cancer.cellmap.org/cellmap/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from cancerCell where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
			->setResourceName($this->getResourceName())
			->setInfoLink($this->getInfoLink())
			->setDetailsLink(''); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("cancerCell", new CancerCellResource());
?>
