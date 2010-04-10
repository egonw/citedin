<?php
require_once("ResourceFormatter.php");
require_once("Pmid2Doi.php");


class ConnoteaResource extends ResourceData {
public function get_connotea_posts($url){
	set_time_limit(0);
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

	public function getData($pmid) {
		       set_time_limit(0);
                $length = self::get_connotea_posts("http://www.ncbi.nlm.nih.gov/pubmed/$pmid");
		# Since it is more likely that people will link to the full paper in connotea the url to the full paper needs to be acquired
                    $doi = Pmid2Doi::getDoiFromPmid($pmid);
	
					if ($doi!=""){
						$doiurl = "http://dx.doi.org/$doi";
						$doiheaders = get_headers($doiurl, 1);
 						if (is_array($doiheaders["Location"])) 
                           foreach ($doiheaders["Location"] as $tempurl) 
							$length += self::get_connotea_posts($tempurl); 
						}
						
			$data = new ResourceData();
			$data->setResourceName("Connotea")
				->setCiteCount($length)
                                ->setInfoLink("http://www.connotea.org/")
				->setDetailsLink(''); //TODO: details link
	
		  return $data;
}
}
$info = new ResourceInfo();
$info->setResourceName("Connotea")
       ->setResourceType("API")
	   ->setInfoLink('http://www.connotea.org/')
	   ->setResourceFilename("citedinConnotea.php")
	   ->setResourceClassname("ConnoteaResource");
ResourceRegistry::register("Connotea", $info); 
?>
