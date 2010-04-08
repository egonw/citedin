<?php
	require_once("ResourceRegistry.php");

class BlogsResource extends ResourceData {
	//TODO: infolink methods etc.
	
	public function getData($pmid) {
			$url = "http://ajax.googleapis.com/ajax/services/search/blogs?v=1.0&"
	                    . "q=pmid+$pmid&key=ABQIAAAA0NoLZe54qmm3IrZh3Pr8XRQgUD3M0xCwTeybjGNTl64FQvo9AxRuhHRvCyohglYFUYv0p2GJeVp2Rg&userip=".$_SERVER['SERVER_ADDR'];
							$blog_results = file_get_contents($url);
					                $json = json_decode($blog_results);

							$data = new ResourceData();
							$data->setResourceName("Blogs: Through google")
								->setCiteCount($json->responseData->cursor->estimatedResultCount)
								->setInfoLink('http://blogsearch.google.be/')
								->setDetailsLink($json->responseData->cursor->moreResultsUrl);

							print ResourceFormatter::getHTML($data);
	
	}
}

ResourceRegistry::register("Blogs", new BlogsResource());
?>