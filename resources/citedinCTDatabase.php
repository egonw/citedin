<?php
require_once("ResourceRegistry.php");

class CTDatabaseResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	   include 'connectdb.inc';
	 $result = mysql_query("SELECT * from CTDatabase where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setResourceName("CTDatabase: Cancer-Testis Database")
			->setCiteCount($num_rows)
	                ->setInfoLink('http://www.cta.lncc.br/')
			->setDetailsLink('http://www.cta.lncc.br/index.php?id=4'); //TODO: details link


		return $data;
	}
}
$info = new ResourceInfo();
$info->setResourceName("CTDatabase: Cancer-Testis Database")
       ->setResourceType("Database")
 	   ->setResourceDescription("This database is aimed at stimulating and providing a reference for further research on Cancer Testis (CT) antigens. and comprises information about each CT gene, its gene products and the immune response induced in cancer patients by these proteins..")
	   ->setInfoLink('http://www.cta.lncc.br/')
	   ->setResourceFilename("citedinCTDatabase.php")
	   ->setResourceClassname("CTDatabaseResource");
ResourceRegistry::register("CTDatabase", $info);  
?>
