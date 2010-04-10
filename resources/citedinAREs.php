<?php
	require_once("ResourceRegistry.php");

class AREsResource extends ResourceData {
	//TODO: infolink methods etc.
	
	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from AREs where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setInfoLink("http://hmg.oxfordjournals.org/cgi/content/full/ddm066/DC1")
			->setDetailsLink('http://hmg.oxfordjournals.org/cgi/content/full/ddm066/DC1'); //TODO: details link     
		return $data;
	}
}

$info = new ResourceInfo();
$info->setResourceName("AREs: active antioxidant responsive elements")
       ->setResourceType("Published data")
 	   ->setResourceDescription("The ARE project contains twenty active antioxidant responsive elements (AREs) that are a subset of the AREs originally curated in Wang et al, 2007, Table S1 (PMID: 17409198). Active AREs were selected by Chou and Wasserman (unpublished results) and bulk-uploaded with the interacting transcription factor labeled as human NFE2L2 (NRF2). Consult each original publication to determine the actual species source of TF used in the experiments. The NFE2L2 protein interacts with one of the small Maf proteins to form a functional complex.")
	   ->setInfoLink('http://hmg.oxfordjournals.org/cgi/content/full/ddm066/DC1')
	   ->setResourceFilename("citedinAREs.php")
	   ->setResourceClassname("AREsResource");
ResourceRegistry::register("AREs", $info);


 
?>
