<?php
require_once("ResourceRegistry.php");

class PdbResource extends ResourceData {

	public function getData($pmid) {
      include 'connectdb.inc';
      $client = new SoapClient('http://www.rcsb.org/pdb/services/pdbws?wsdl', array('trace' => 1));
      $xmlquery = "<orgPdbQuery><version>head</version><queryType>org.pdb.query.simple.PubmedIdQuery</queryType><description>Simple query for a list of PubMed IDs: $pmid</description><runtimeMilliseconds>60</runtimeMilliseconds><pubMedIdList>$pmid</pubMedIdList></orgPdbQuery>";

    $result =$client->runXmlQuery($xmlquery);
    $num_rows = count($result);

        $data = new ResourceData();
        $data->setResourceName("PDB: RCSB Protein Data Bank")
                ->setCiteCount($num_rows)
                ->setInfoLink('http://www.pdb.org/pdb/home/home.do')
                ->setDetailsLink(''); //TODO: details link

        return $data;
   }
}
$info = new ResourceInfo();
$info->setResourceName("PDB: RCSB Protein Data Bank")
       ->setResourceType("Database")
 	   ->setResourceDescription("The PDB archive contains information about experimentally-determined structures of proteins, nucleic acids, and complex assemblies. As a member of the wwPDB, the RCSB PDB curates and annotates PDB data according to agreed upon standards.

	The RCSB PDB also provides a variety of tools and resources. Users can perform simple and advanced searches based on annotations relating to sequence, structure and function. These molecules are visualized, downloaded, and analyzed by users who range from students to specialized scientists.")
	   ->setInfoLink('http://www.pdb.org/pdb/home/home.do')
	   ->setResourceFilename("citedinPdb.php")
	   ->setResourceClassname("PdbResource");
ResourceRegistry::register("PDB", $info);
?>
