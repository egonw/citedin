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

ResourceRegistry::register("Cosmic", new CosmicResource());
?>
