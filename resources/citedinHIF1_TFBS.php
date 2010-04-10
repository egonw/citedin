<?php
require_once("ResourceRegistry.php");

class HIFTFBSResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	  include 'connectdb.inc';
	   $result = mysql_query("SELECT * from HIF_TFBS where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("HIF TFBS")
			->setCiteCount($num_rows)
			->setInfoLink("http://stke.sciencemag.org/cgi/content/abstract/sigtrans;2005/306/re12?view=abstract")
			->setDetailsLink('http://stke.sciencemag.org/cgi/content/abstract/sigtrans;2005/306/re12?view=abstract'); //TODO: details link

		return $data;
	}
}
$info = new ResourceInfo();
$info->setResourceName("HIF TFBS: Compilation of binding sites for the HIF1 transcription factor complex composed of HIF1A and ARNT.")
       ->setResourceType("Published data")
 	   ->setResourceDescription("The data was extracted from the following review:
	[DOI: 10.1126/stke.3062005re12] Roland H. Wenger, Daniel P. Stiehl and Gieri Camenisch. Integration of oxygen signaling at the consensus HRE. (2005) Sci STKE. 306:re12.")
	   ->setInfoLink('http://stke.sciencemag.org/cgi/content/abstract/sigtrans;2005/306/re12?view=abstract')
		   ->setResourceFilename("citedinHIF1_TFBS.php")
		   ->setResourceClassname("HIFTFBSResource");
ResourceRegistry::register("HIF TFBS", $info);
?>
