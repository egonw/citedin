<?php
require_once("ResourceRegistry.php");

class JasparResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from jaspar where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Jaspar")
			->setCiteCount($num_rows)
	  		->setInfoLink('http://jaspar.cgb.ki.se/')
			->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("Jaspar", new JasparResource());   
?>
