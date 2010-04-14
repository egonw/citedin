<?php
	require_once("ResourceRegistry.php");

class BlogsResource implements Resource {
	function getResourceName() { return "Blogs: Through google"; }
	function getInfoLink() { return "http://blogsearch.google.be/"; }
	function getResourceType() { return "API"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		$url = "http://ajax.googleapis.com/ajax/services/search/blogs?v=1.0&"
		. "q=pmid+$pmid&key=ABQIAAAA0NoLZe54qmm3IrZh3Pr8XRQgUD3M0xCwTeybjGNTl64FQvo9AxRuhHRvCyohglYFUYv0p2GJeVp2Rg&userip=".$_SERVER['SERVER_ADDR'];
		$blog_results = file_get_contents($url);
		$json = json_decode($blog_results);

		$data = new ResourceData();
		$data->setResourceName($this->getResourceName())
				->setCiteCount($json->responseData->cursor->estimatedResultCount)
				->setInfoLink($this->getInfoLink())
				->setDetailsLink($json->responseData->cursor->moreResultsUrl);

		return($data);
	}
}

ResourceRegistry::register("Blogs", new BlogsResource());
?>
