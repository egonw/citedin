<link rel="stylesheet" type="text/css" href="citedin.css">
<?php

   if (isset($_GET["pubmed_query"])){
	$query = preg_replace('/\s/', '+', $_GET["pubmed_query"]);
	$queryResults = simplexml_load_string(file_get_contents("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&term=$query&retmax=30&usehistory=y&tool=citedin&email=andra.waagmeester@bigcat.unimaas.nl"));

	$webenv = $queryResults->WebEnv;
	$querykey = $queryResults->QueryKey;
	//
	$pmids = array();
	foreach ($queryResults->IdList->Id as $id) array_push($pmids, $id);
	print "<hr>\n";
	
  //  if ($_GET["callscript"]=="citedin")	print "<a href=\"loadBiblioDataMetrics.php?pmids=".implode(",", $pmids)."\" target=\"_blank\">calculate CitedIn Internet Citation Score</a><hr>";

/*if ($_GET["callscript"]=="citedin") print "<form action=\"loadBiblioDataMetrics.php\" method=\"get\" accept-charset=\"utf-8\">
	<input type=\"hidden\" name=\"pmids\" value=\"".implode(",", $pmids)."\" id=\"pmids\">

	<p><input type=\"submit\" class=\"button\" value=\"calculate CitedIn Internet Citation Score\"></p>
</form><hr>";*/

if ($_GET["callscript"]=="citedin") {
	print "<button class=\"calculate\">CitedIn Internet Citation Score</button>
	<script>
	    $(\"button.calculate\").click(function () {
		    var pmids = [];
		    $(\"#resultSet > #row > #col1 > input:checked\").each(function() {pmids.push($(this).val())});
	      	window.open('http://www.citedin.org/loadBiblioDataMetrics.php?pmids='+pmids.join(','));
			return false;
	    });

	</script>\n";
}

	
	$pubmedXml= new DOMDocument;
    
 $pubmedXml->load("http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi?db=pubmed&WebEnv=$webenv&mode=xml&query_key=$querykey&tool=citedin&email=andra.waagmeester@bigcat.unimaas.nl");
  //echo $pubmedXml->saveXML();
  $simplePubmedXml = simplexml_import_dom($pubmedXml);
  // var_dump($simplePubmedXml);
  print "<div id=\"resultSet\"><div id=\"selectalldiv\">";
  print "<input type=\"checkbox\" id=\"selectall\"/ checked>deselect/select all</div>";
  foreach ($simplePubmedXml->PubmedArticle as $PubmedArticle){
	
	print "<div id=\"row\"><div id=\"col1\"><input type=\"checkbox\" class=\"case\" name=\"case\" value=\"".$PubmedArticle->MedlineCitation->PMID."\"/ checked>";
	if ($_GET["callscript"]=="citedin") {
		print "<button class=\"remove\">Remove</button>
	<script>
	    $(\"button.remove\").click(function () {
	      $(this).parent().parent().remove();
	    });

	</script>";}
	print "</div><div id=\"col2\">";

	
	print "<span class='pubmedTitle' id='pubmedTitle'>".$PubmedArticle->MedlineCitation->Article->ArticleTitle."</span><br />";

	
	$authorArray=array();
	foreach($PubmedArticle->MedlineCitation->Article->AuthorList->Author as $author){
		array_push($authorArray, (string) $author->LastName." ".(string )$author->Initials);
	}
	print "<span class='pubmedAuthors' id='pubmedAuthors'>".implode(",", $authorArray)."</span><br />";
	print "<span class='pubmedJournal' id='pubmedJournal'>".$PubmedArticle->MedlineCitation->Article->Journal->Title."</span><br />";
	print "<span class='pmidResult' id='pmidResult'>PMID: <span class='pmidResultValue' id='pmidResultValue'>".$PubmedArticle->MedlineCitation->PMID."</span></span><br />";
	
	print "</div></div>";
} 
print "</div>";	   
/*	  $pubmed_xsl = new DOMDocument;
	  $pubmed_xsl->load('resources/pubmedSubmit.xsl');

	// Configure the transformer
	$proc = new XSLTProcessor;
	$proc->importStyleSheet($pubmed_xsl); // attach the xsl rules

	print "<div id=\"row\"><button type=\"button\">Remove from set</button>";

	   echo $proc->transformToXML($pubmed_xml);
	print "</div>";
	*/
}

?>
	<SCRIPT language="javascript">
	$(function(){

	    // add multiple select / deselect functionality
	    $("#selectall").click(function () {
	          $('.case').attr('checked', this.checked);
	    });

	    // if all checkbox are selected, check the selectall checkbox
	    // and viceversa
	    $(".case").click(function(){

	        if($(".case").length == $(".case:checked").length) {
	            $("#selectall").attr("checked", "checked");
	        } else {
	            $("#selectall").removeAttr("checked");
	        }

	    });
	});
	</SCRIPT>