<?php
require_once("ResourceFormatter.php");

	if ($_GET["pmid"] != ""){
		$data = new ResourceData();
		$data->setResourceName("Wikipedia")
			->setInfoLink("http://en.wikipedia.org");
			
		$pmid = $_GET["pmid"];
		$results = "http://en.wikipedia.org/w/api.php?format=xml&action=query&list=search&srsearch=$pmid";
		//print $results;
		$headers = get_headers($results, 1);
		if ($headers[0] == "HTTP/1.1 200 OK"){ 
			$xml_results = file_get_contents($results);
			$xml = simplexml_load_string($xml_results);
			
			$data->setCiteCount($xml->query->searchinfo["totalhits"]);
			$data->setDetailLink("http://en.wikipedia.org/w/index.php?title=Special:Search&search=$pmid");
	   	} else {
	   		$data->setError($headers[0]);
		}
		print ResourceFormatter::getHTML($data);
}
?>
