<?php
require_once("ResourceRegistry.php");

class WikipathwaysResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from wikipathways where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("WikiPathways")
			->setCiteCount($num_rows)
			->setInfoLink("http://www.wikipathways.org")
			->setDetailsLink("resources/details_wikipathways?pmid=$pmid");
		return $data;
	}
}

$info = new ResourceInfo();
$info->setResourceName("WikiPathways")
       ->setResourceType("Database")
 	   ->setResourceDescription("In the new tradition of Wikipedia, WikiPathways is an open, public platform dedicated to the curation of biological pathways by and for the scientific community.")
	   ->setInfoLink('http://www.wikipathways.org')
	   ->setResourceFilename("citedinWikipathways.php")
	   ->setResourceClassname("WikipathwaysResource");
ResourceRegistry::register("Wikipathways", $info);
  
?>


