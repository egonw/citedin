<?php
require_once("ResourceRegistry.php");

class NFIRegulomeResource implements Resource {
	function getResourceName() { return "NFIRegulome: Database for genes regulated by Nuclear Factor I Family"; }
	function getInfoLink() { return "http://nfiregulome.ccr.buffalo.edu"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The purpose of the NFI regulome database is to create a single source of information to examine the structure of the control elements of genes known to be regulated by NFI proteins. This database is designed to be able to group genes by common regulatory elements and to find patterns of structure and function of transcription factors in control elements. Information on the location and function of specific transcription factor binding sites is stored and can be retrieved by gene, transcription factor and tissue in which the gene is expressed."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from NFIRegulome where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("NFIRegulomeResource", new NFIRegulomeResource());
?>
