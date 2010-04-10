<?php
require_once("ResourceRegistry.php");

class OregannoResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from oregano where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Oreganno")
			->setCiteCount($num_rows)
			->setInfoLink("http://www.oreganno.org/oregano/")
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

$info = new ResourceInfo();
$info->setResourceName("Oreganno: The Open REGulatory ANNOtation database")
       ->setResourceType("Database")
 	   ->setResourceDescription("The Open REGulatory ANNOtation database (ORegAnno) is an open database for the curation of known regulatory elements from scientific literature. Annotation is collected from users worldwide for various biological assays.
	Montgomery SB, Griffith OL, Sleumer MC, Bergman CM, Bilenky M, Pleasance ED, Prychyna Y, Zhang X and Jones SJM. (2006) ORegAnno: An open access database and curation system for literature-derived promoters, transcription factor binding sites and regulatory variation. Bioinformatics 22(5):637-40.")
	   ->setInfoLink('	http://www.oreganno.org')
	   ->setResourceFilename("citedinOregano.php")
	   ->setResourceClassname("OregannoResource");
ResourceRegistry::register("Oreganno", $info); 
?>
