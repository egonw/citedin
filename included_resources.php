<?php
require_once("resources/ResourceRegistry.php");
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
print "<ol>";
$resourceMatrix = array();
foreach ($citedin_resources as $resource) {
	$resourceInfo = ResourceRegistry::get($resource);
	if (!(is_array($resourceMatrix[$resourceInfo->getResourceType()]))){
		$resourceMatrix[$resourceInfo->getResourceType()]=array();
	}
	array_push($resourceMatrix[$resourceInfo->getResourceType()], $resourceInfo );
	
}
ksort($resourceMatrix);
foreach (array_keys($resourceMatrix) as $resourceType){
	print "<h2>".$resourceType."</h2>";
	foreach ($resourceMatrix[$resourceType] as $resource){
		print "<li>".$resource->getResourceName();
	}
};
?>
