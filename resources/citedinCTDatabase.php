<?php
require_once("ResourceRegistry.php");

class CTDatabaseResource implements Resource {
	function getResourceName() { return "CTDatabase: Cancer-Testis Database"; }
	function getInfoLink() { return "http://www.cta.lncc.br/"; }
	function getResourceType() { return "Database"; }
	function getResourceDescription() { return "This database is aimed at stimulating and providing a reference for further research on Cancer Testis (CT) antigens. and comprises information about each CT gene, its gene products and the immune response induced in cancer patients by these proteins.."; }
	function getResourceFilename() { return basename(__FILE__); }

	public function getData($pmid) {
		include 'connectdb.inc';
		$result = mysql_query("SELECT * from CTDatabase where pmid=$pmid");
		$num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName($this->getResourceName())
				->setCiteCount($num_rows)
				->setInfoLink($this->getInfoLink())
				->setDetailsLink('http://www.cta.lncc.br/index.php?id=4'); //TODO: details link


		return $data;
	}
}

ResourceRegistry::register("CTDatabase", new CTDatabaseResource());

?>
