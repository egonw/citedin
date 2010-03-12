<?php
set_time_limit(0);

function get_connotea_posts($url){
    $results = "http://andra:nijntje1@www.connotea.org/data/uri/$url";
    $headers = get_headers($results, 1);
    if ($headers[0] == "HTTP/1.1 200 OK"){
    	$xml_results = file_get_contents($results);
    	$doc = new DOMDocument();
    	$doc->loadXML($xml_results);
    	$wp_articles = $doc->getElementsByTagName("Post");
    	return $wp_articles->length;
    } else {
	    return $headers[0];
    }
}

    if ($_GET["pmid"] != ""){
		$pmid = $_GET["pmid"];
                $doi = urldecode($_GET["doi"]);
                $length = get_connotea_posts("http://www.ncbi.nlm.nih.gov/pubmed/$pmid");
		# Since it is more likely that people will link to the full paper in connotea the url to the full paper needs to be acquired

                $results2 = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&id=$pmid&retmode=xml"; 
					
					$xml_results2=file_get_contents($results2);
        
                	$doc2= new DOMDocument();
					$doc2->loadXML($xml_results2);
					$articleid = $doc2->getElementsByTagName("ArticleId");
	  				for ($k=0;$k<$articleid->length; $k++){
						if ($articleid->item($k)->getAttribute("IdType")=="doi"){
							$doi=$articleid->item($k)->nodeValue;
							break;
 						}
					}	
					if ($doi!=""){
						$doiurl = "http://dx.doi.org/$doi";
						$doiheaders = get_headers($doiurl, 1);
 						if (is_array($doiheaders["Location"])) 
                           foreach ($doiheaders["Location"] as $tempurl) 
							$length += get_connotea_posts($tempurl); 
						}
 						print "<div id=\"row\"><div id=\"sourceName\">Connotea:</div><div id=\"numberInSources\">$length</div><div id=\"details\"><a href=\"\">Details</a></div></div>";
}
?>
