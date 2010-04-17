<?php
	require_once("ResourceRegistry.php");

class AlzgeneResource implements Resource {
	function getResourceName() { return "Alzforum: Alzheimer Research Forum"; }
	function getInfoLink() { return "http://www.alzforum.org/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		   include 'connectdb.inc';
		   $result = mysql_query("SELECT * from azforum where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setCiteCount($num_rows)
				 ->setInfoLink($this->getInfoLink())
			     ->setResourceName($this->getResourceName())
			     ->setDetailsLink('http://www.alzforum.org/pap/powsearch.asp'); //TODO: details link

			return $data;
		}
}

	ResourceRegistry::register("Alzgene", new AlzgeneResource());
?>
