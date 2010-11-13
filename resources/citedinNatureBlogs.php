<?php

require_once("ResourceRegistry.php");
require_once("Pmid2Doi.php");

class NatureBlogsResource implements Resource {
	function getResourceName() { return "Nature.com Blogs"; }
	function getInfoLink() { exit("HERE"); return "http://blogs.nature.com/"; }
	function getResourceType() { return "API"; }
	function getResourceDescription() { return "Blogs is Nature Publishing Group’s community-run blog tracking and indexing service. As well as being a portal to the blogs written by our editors and journalists and members of Nature Network it aggregates posts from hundreds of third party science blogs."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		$doi = Pmid2Doi::getDoiFromPmid($pmid);
		if ($doi !=""){
		$json = file_get_contents("http://blogs.nature.com/posts.json?doi=$doi");
		$num_rows = count(json_decode($json));

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("http://blogs.nature.com/posts?doi=$doi"); 
     }
     else {
	   	$data = new ResourceData();
		$data->setCiteCount(0)
		     ->setResourceName($this->getResourceName())
		     ->setDetailsLink("");
    }
		return $data;
	}
}

ResourceRegistry::register("NatureBlogs", new NatureBlogsResource());

?>
