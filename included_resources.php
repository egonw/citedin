<?php
require_once("resources/ResourceRegistry.php");
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
foreach ($citedin_resources as $resource) {
	$resource_info = ResourceRegistry::get($resource);
	var_dump($resourceInfo->getResourceName());
}

?>
