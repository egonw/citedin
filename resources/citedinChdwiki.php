<?php

require_once("ResourceRegistry.php");

class ChdwikiResource implements Resource {
	function getResourceName() { return "CHDWiki: Congenital Heart Defects Wiki"; }
	function getInfoLink() { return "http://homes.esat.kuleuven.be/~bioiuser/chdwiki/index.php/Main_Page"; }
	function getResourceType() { return "Wiki"; }
	function getResourceDescription() { return "This Wiki is primarily meant for geneticists, clinicians, and molecular biologists working on Congenital Heart Defects (CHDs)."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from chdwiki where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink('http://homes.esat.kuleuven.be/~bioiuser/chdwiki/index.php/CHD:Bibliography'); //TODO: details link
	     
		return $data;
	}
}

ResourceRegistry::register("ChdWiki", new ChdwikiResource());

?>
