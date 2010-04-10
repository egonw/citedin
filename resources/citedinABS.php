<?php
require_once("ResourceRegistry.php");


class ABSResource extends ResourceData {
	//TODO: infolink methods etc.

	public function getData($pmid) {
	   include 'connectdb.inc';
	   $result = mysql_query("SELECT * from ABS where pmid=$pmid");
	   $num_rows = mysql_num_rows($result);

		$data = new ResourceData();
		$data->setCiteCount($num_rows)
		     ->setResourceName("ABS: a database of Annotated regulatory Binding Sites from orthologous promoters")
			 ->setInfoLink('http://genome.imim.es/datasets/abs2005')
		     ->setDetailsLink('http://nar.oxfordjournals.org/cgi/content/full/34/suppl_1/D63'); 

		return $data;
	}
}


$info = new ResourceInfo();
$info->setResourceName("ABS: a database of Annotated regulatory Binding Sites from orthologous promoters")
       ->setResourceType("Published data")
       ->setResourceDescription("ABS: a database of Annotated regulatory Binding Sites from orthologous promoters
	E. Blanco, D. Farré, M. Albà, X. Messeguer and R. Guigó. ABS: a database of Annotated regulatory Binding Sites from orthologous promoters. Nucleic Acids Research 34:D63-D67 (2006).")
	   ->setInfoLink('http://genome.crg.es/datasets/abs2005/')
	   ->setResourceFilename("citedinABS.php")
	   ->setResourceClassname("ABSResource");
	  
	   
ResourceRegistry::register("ABS", $info);  
?>
	
