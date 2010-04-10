<?php
	require_once("ResourceRegistry.php");

	class AlzgeneResource extends ResourceData {
		//TODO: infolink methods etc.

		public function getData($pmid) {
		   include 'connectdb.inc';
		   $result = mysql_query("SELECT * from azforum where pmid=$pmid");
		   $num_rows = mysql_num_rows($result);

			$data = new ResourceData();
			$data->setCiteCount($num_rows)
				 ->setInfoLink('http://www.alzforum.org/')
			     ->setResourceName("Alzgene: Alzheimer Research Forum")
			     ->setDetailsLink('http://www.alzforum.org/pap/powsearch.asp'); //TODO: details link

			return $data;
		}
	}

	$info = new ResourceInfo();
	$info->setResourceName("Alzgene: Alzheimer Research Forum")
	       ->setResourceType("Database")
		   ->setInfoLink('http://www.alzforum.org/')
		   ->setResourceFilename("citedinAzforum.php")
		   ->setResourceClassname("AlzgeneResource");

	ResourceRegistry::register("Alzgene", $info);
?>
