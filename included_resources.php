<?php
require_once("resources/ResourceRegistry.php");
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
print "<ol>";
foreach ($citedin_resources as $resource) {
	$resourceInfo = ResourceRegistry::get($resource);
	print "<li>".$resourceInfo->getResourceName();
	print "<br>".$resourceInfo->getResourceDescription();
}

?>
