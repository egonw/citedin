<?php
    if ($_GET["pmid"] != ""){
		$pmid = $_GET["pmid"];
		$results = "http://en.wikipedia.org/w/api.php?format=xml&action=query&list=search&srsearch=$pmid";
		//print $results;
		$headers = get_headers($results, 1);
		if ($headers[0] == "HTTP/1.1 200 OK"){ 
		$xml_results = file_get_contents($results);
                $xml = simplexml_load_string($xml_results);
print "<div id=\"row\"><div id=\"sourceName\"><a href=\"http://en.wikipedia.org\">Wikipedia</a>:</div><div id=\"numberInSources\">".$xml->query->searchinfo["totalhits"]."</div><div id=\"details\"><a href = \"http://en.wikipedia.org/w/index.php?title=Special:Search&search=$pmid\">Details</a></div></div>";
   } else
   {
	print "<div id=\"row\"><div id=\"sourceName\"><a href=\"http://en.wikipedia.org\">Wikipedia</a>:</div><div id=\"numberInSources\"></div><div id=\"details\">";
	print $headers[0];
	print "</div></div>";
	}

}
?>
