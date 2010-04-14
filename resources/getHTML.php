<?php

if ($_GET["pmid"] != ""){
	require_once("ResourceRegistry.php");
	require_once("ResourceFormatter.php");
	$resource = $_GET["resource"];
	$script = $_GET["script"];
	$pmid = $_GET["pmid"];
	
	if($script) {
		//Initialize required resource only (for better performance)
		require_once($script);
	} else {
		//Initialize all resources	
		ResourceRegistry::init();
	}
	$info = ResourceRegistry::get($resource);
	$data = $info->getData($pmid);
	echo ResourceFormatter::getHTML($data);
}


?>
