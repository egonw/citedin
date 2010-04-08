<?php
require_once("ResourceRegistry.php");
require_once("ResourceFormatter.php");

ResourceRegistry::init();
var_dump(ResourceRegistry::listResources());
print "<hr>";
if ($_GET["pmid"] != ""){
	$resourceName = $_GET["resource"];
	$pmid = $_GET["pmid"];
	
	$resource = ResourceRegistry::get($resourceName);
	$data = $resource->getData($pmid);
	
	echo ResourceFormatter::getHTML($data);

}


?>

