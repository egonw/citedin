<?php
	require_once("ResourceRegistry.php");
	
class CosmicResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from cosmic where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Cosmic: Catalogue Of Somatic Mutations In Cancer")
			->setCiteCount($num_rows)
	                ->setInfoLink('http://www.sanger.ac.uk/genetics/CGP/cosmic/')
			->setDetailsLink(''); //TODO: details link

		return $data;
	}
}
$info = new ResourceInfo();
$info->setResourceName("Cosmic: Catalogue Of Somatic Mutations In Cancer")
       ->setResourceType("Database")
       ->setResourceDescription("All cancers arise as a result of the acquisition of a series of fixed DNA sequence abnormalities, mutations, many of which ultimately confer a growth advantage upon the cells in which they have occurred. There is a vast amount of information available in the published scientific literature about these changes. COSMIC is designed to store and display somatic mutation information and related details and contains information relating to human cancers.")
	   ->setInfoLink('http://www.sanger.ac.uk/genetics/CGP/cosmic/')
	   ->setResourceFilename("citedinCosmic.php")
	   ->setResourceClassname("CosmicResource");
ResourceRegistry::register("Cosmic", $info);
?>
