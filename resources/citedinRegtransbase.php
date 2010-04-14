<?php
require_once("ResourceRegistry.php");

class RegtransbaseResource implements Resource {
	function getResourceName() { return "Regtransbase"; }
	function getInfoLink() { return "http://regtransbase.lbl.gov/cgi-bin/regtransbase?page=main"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "RegTransBase consists of two modules - a database of regulatory interactions based on literature and an expertly curated database of transcription factor binding sites."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from regtransbase where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("Regtransbase", new RegtransbaseResource());

?>
