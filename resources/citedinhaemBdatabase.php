<?php
require_once("ResourceRegistry.php");

class HaembResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from haemBDb  where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName("HaemBDb: Haemophilia B Mutation Database")
				->setCiteCount($num_rows)
		                ->setInfoLink('http://www.kcl.ac.uk/ip/petergreen/haemBdatabase.html')
				->setDetailsLink(''); //TODO: details link

		return $data;
	}
}
$info = new ResourceInfo();
$info->setResourceName("HaemBDb: Haemophilia B Mutation Database")
       ->setResourceType("Database")
 	   ->setResourceDescription("A database of point mutations and short additions and deletions in the factor IX gene")
	   ->setInfoLink('http://www.kcl.ac.uk/ip/petergreen/haemBdatabase.html')
	   ->setResourceFilename("citedinhaemBdatabase.php")
	   ->setResourceClassname("HaembResource");
ResourceRegistry::register("haemB", $info);   
?>
