<?php
require_once("ResourceRegistry.php");

class DejavuResource implements Resource {
	function getResourceName() { return "Deja Vu: a Database of Highly Similar Citations"; }
	function getInfoLink() { return "http://dejavu.vbi.vt.edu/dejavu/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "Deja vu is a database of extremely similar Medline citations. Many, but not all, of which contain instances of duplicate publication and potential plagiarism."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from dejavu where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName($this->getResourceName())
				->setCiteCount($num_rows)
		      ->setInfoLink($this->getInfoLink())
				->setDetailsLink("http://dejavu.vbi.vt.edu/dejavu/duplicate/?q=$pmid"); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("Dejavu", new DejavuResource());

?>
