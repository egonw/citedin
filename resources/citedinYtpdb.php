<?php

require_once("ResourceRegistry.php");

class YtpdbResource implements Resource {
	function getResourceName() { return "YTPdb: The Yeast Transport Protein database"; }
	function getInfoLink() { return "http://homes.esat.kuleuven.be/~sbrohee/ytpdb/index.php/Main_Page"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The Yeast Transport Protein database (YTPdb) gives access to manual annotations on 287 yeast proteins classified as established or predicted membrane transporters."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from hmdb where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink('http://homes.esat.kuleuven.be/~sbrohee/ytpdb/index.php/Bibliography'); //TODO: details link
	     
		return $data;
	}
}

ResourceRegistry::register("YTPdb", new YtpdbResource());

?>
