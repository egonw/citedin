<?php

require_once("ResourceRegistry.php");
require_once("Pmid2Doi.php");

class CiteULikeResource implements Resource {
	function getResourceName() { return "citeulike"; }
	function getInfoLink() { return "http://www.citeulike.org/"; }
	function getResourceType() { return "API"; }
	function getResourceDescription() { return "CiteULike is a free service to help you to store, organise and share the scholarly papers you are reading. When you see a paper on the web that interests you, you can click one button and have it added to your personal library. CiteULike automatically extracts the citation details, so there's no need to type them in yourself. It all works from within your web browser so there's no need to install any software. Because your library is stored on the server, you can access it from any computer with an Internet connection."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		$doi = Pmid2Doi::getDoiFromPmid($pmid);
		    $contents = file_get_contents("http://www.citeulike.org/json/pmid/$pmid");
              $json = json_decode($contents, true);
       $num_rows = $json[0]["posted_count"];

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("http://www.citeulike.org/pmid/$pmid"); 
	     
		return $data;
	}
}

ResourceRegistry::register("CiteULike", new CiteULikeResource());

?>
