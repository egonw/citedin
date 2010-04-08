<?php
	require_once("ResourceRegistry.php");

	class CancerCellResource extends ResourceData {
		//TODO: infolink methods etc.

		public function getData($pmid) {
		   include 'connectdb.inc';
		   $result = mysql_query("SELECT * from cancerCell where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setCiteCount($num_rows)
			     ->setResourceName("Cancer Cell Map")
			->setInfoLink("http://cancer.cellmap.org/cellmap/")
			     ->setDetailsLink(''); //TODO: details link

			return $data;
		}
	}

	ResourceRegistry::register("cancerCell", new CancerCellResource());   
?>



