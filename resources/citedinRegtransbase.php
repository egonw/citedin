<?php
require_once("ResourceRegistry.php");

class RegtransbaseResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from regtransbase where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("Regtransbase")
			->setCiteCount($num_rows)
			->setDetailsLink('') //TODO: details link
			->setInfoLink("http://regtransbase.lbl.gov/cgi-bin/regtransbase?page=main");
		return $data;
	}
}

ResourceRegistry::register("Regtransbase", new RegtransbaseResource());
?>
