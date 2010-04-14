<?php
require_once("ResourceRegistry.php");

class HaembResource implements Resource {
	function getResourceName() { return "HaemBDb: Haemophilia B Mutation Database"; }
	function getInfoLink() { return "http://www.kcl.ac.uk/ip/petergreen/haemBdatabase.html"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "A database of point mutations and short additions and deletions in the factor IX gen"; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from haemBDb  where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName($this->getResourceName())
				->setCiteCount($num_rows)
		      ->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("haemB", new HaembResource());

?>
