<?php
require_once("ResourceRegistry.php");

class OregannoResource implements Resource {
	function getResourceName() { return "Oreganno: The Open REGulatory ANNOtation database"; }
	function getInfoLink() { return "http://www.oreganno.org"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "The Open REGulatory ANNOtation database (ORegAnno) is an open database for the curation of known regulatory elements from scientific literature. Annotation is collected from users worldwide for various biological assays.
	Montgomery SB, Griffith OL, Sleumer MC, Bergman CM, Bilenky M, Pleasance ED, Prychyna Y, Zhang X and Jones SJM. (2006) ORegAnno: An open access database and curation system for literature-derived promoters, transcription factor binding sites and regulatory variation. Bioinformatics 22(5):637-40."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from oregano where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
				->setResourceName($this->getResourceName())
				->setInfoLink($this->getInfoLink())
				->setDetailsLink(''); 

		return $data;
	}
}

ResourceRegistry::register("Oreganno", new OregannoResource());

?>
