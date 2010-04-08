<?php
require_once("ResourceRegistry.php");

class PIDNCIResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
		include 'connectdb.inc';
		   $result = mysql_query("SELECT * from NCI where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setResourceName("Nature Pathway interaction database (NCI)")
				->setCiteCount($num_rows)
				->setInfoLink('http://pid.nci.nih.gov/PID/index.shtml')
				->setDetailsLink(''); //TODO: details link
		return $data;
	}
}

ResourceRegistry::register("PIDNCI", new PIDNCIResource());
?>
