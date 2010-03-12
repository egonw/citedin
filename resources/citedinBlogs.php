<?php
    if ($_GET["pmid"] != ""){
		$pmid = $_GET["pmid"];
	 	$url = "http://ajax.googleapis.com/ajax/services/search/blogs?v=1.0&"
                    . "q=pmid+$pmid&key=ABQIAAAA0NoLZe54qmm3IrZh3Pr8XRQgUD3M0xCwTeybjGNTl64FQvo9AxRuhHRvCyohglYFUYv0p2GJeVp2Rg&userip=".$_SERVER['SERVER_ADDR'];
		//print $results;
		$blog_results = file_get_contents($url);
                $json = json_decode($blog_results);


		if ($json->responseData->cursor->estimatedResultCount>0){
		print "	<b class=\"b1f\"></b><b class=\"b2f\"></b><b class=\"b3f\"></b><b class=\"b4f\"></b>
			    <div class=\"contentf\">";
		print "<div id=\"row\"><div id=\"sourceName\">Blogs:</div><div id=\"numberInSources\">".$json->responseData->cursor->estimatedResultCount. "</div><div id=\"details\"> <a href=\"".$json->responseData->cursor->moreResultsUrl."\">Details</a></div></div>";
		print "</div>
	<b class=\"b4f\"></b><b class=\"b3f\"></b><b class=\"b2f\"></b><b class=\"b1f\"></b>";
	}
		else {
			print "	<b class=\"b1f\"></b><b class=\"b2f\"></b><b class=\"b3f\"></b><b class=\"b4f\"></b>
				    <div class=\"contentf\">";
			print "<div id=\"row\"><div id=\"sourceName\">Blogs:</div><div id=\"numberInSourcesZero\">".$json->responseData->cursor->estimatedResultCount. "</div><div id=\"details\"> <a href=\"".$json->responseData->cursor->moreResultsUrl."\">Details</a></div><div>";
			print "</div>
		<b class=\"b4f\"></b><b class=\"b3f\"></b><b class=\"b2f\"></b><b class=\"b1f\"></b>";
		}

	}
?>
