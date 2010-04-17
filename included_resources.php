<?php
require_once("resources/ResourceRegistry.php");
ResourceRegistry::init();
$citedin_resources = ResourceRegistry::listResources();
foreach ($citedin_resources as $resource) {
	var_dump(ResourceRegistry::get($resource));
}

?>
