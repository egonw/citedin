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

ResourceRegistry::register("Wikipathways", new WikipathwaysResource());
  
?>


