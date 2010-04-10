<?php

if ($_GET["pmid"] != ""){
	print_r($_GET);
	require_once(basename($_GET["script"]));
	require_once("ResourceFormatter.php");
	$class = $_GET["class"];
	$pmid = $_GET["pmid"];
	
	$data = $class::getData($pmid);
	
	echo ResourceFormatter::getHTML($data);

}


?>

