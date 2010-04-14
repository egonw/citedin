<?php
require_once("ResourceRegistry.php");

class HNF4Resource implements Resource {
	function getResourceName() { return "HNF4: data from the Sladek lab at UC Riverside"; }
	function getInfoLink() { return "http://www.sladeklab.ucr.edu/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The HNF4 project houses data from the Sladek lab at UC Riverside (http://www.sladeklab.ucr.edu/). The project includes 107 expert curated TFBS that were bulk-uploaded with the interacting transcription factor labeled as human HNF4A. Consult each original publication to determine the actual species source of TF used in the experiments. H4 numbers assigned to regulatory sequences refer to specific binding sites."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from HNF4 where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("HNF4", new HNF4Resource());

?>
