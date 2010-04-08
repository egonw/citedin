<?php
require_once("ResourceRegistry.php");

class DejavuResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from dejavu where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName("DejaVu")
				->setCiteCount($num_rows)
		                ->setInfoLink("http://dejavu.vbi.vt.edu/dejavu/")
				->setDetailsLink(''); //TODO: details link

		return $data;
	}
}

ResourceRegistry::register("Dejavu", new DejavuResource());   
?>
