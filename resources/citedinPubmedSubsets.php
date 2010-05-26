<?php 

require_once("ResourceRegistry.php");

class PubmedSubResource implements Resource {
	function getResourceName() { return "Pubmed Subsets"; }
	function getInfoLink() { return "http://www.ncbi.nlm.nih.gov/pubmed/limits/"; }
	function getResourceType() { return "API"; }
	function getResourceDescription() { return ""; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		$subsetArray = array("cam", "AIDS", "bioethics", "cancer", "history", "space", "systematic", "tox");
		$count=0;
		$subsets=array();
		foreach ($subsetArray as $subset){
			$url = "http://eutils.ncbi.nlm.nih.gov/entrez/eutils/esearch.fcgi?db=pubmed&term=".$pmid."[uid](".$subset."[sb])&email=andra.waagmeester@bigcat.unimaas.nl";
			$doc= simplexml_load_file($url);
			$count+=$doc->Count;
			if ($doc->Count >0){
				array_push($subsets, $subset."[sb]");
			}
		}
		$data = new ResourceData();
		$data->setResourceName($this->getResourceName())
			->setCiteCount($count)
			->setInfoLink($this->getInfoLink())
			->setDetailsLink("http://www.ncbi.nlm.nih.gov/sites/entrez?db=pubmed&term=20106945[uid] AND ".join(" AND ",$subsets)."&email=andra.waagmeester%40bigcat.unimaas.nl");
			return $data;
	}
}

ResourceRegistry::register("PubmedSub", new PubmedSubResource());
?>
