<?php
//Requires php package XML_Serializer:
//http://pear.php.net/manual/en/package.xml.xml-serializer.php

$debug = $_GET["debug"];

//Prevent warnings to mess up the output format
if($debug) error_reporting(E_ERROR | E_WARNING | E_PARSE); //Show warnings as well
else error_reporting(E_ERROR | E_PARSE); //Only show fatal errors

require_once('XML/Serializer.php');
require_once("resources/ResourceFormatter.php");
require_once("resources/ResourceRegistry.php");

ResourceRegistry::init();

/**
Entry point for the REST web interface to Citedin
*/

//Check if we have a GET request
$method = $_SERVER['REQUEST_METHOD'];
if($method != 'GET') {
	//If not, send a 501 response
	header('Allow: GET', true, 501);
	exit();
}

//Get the parameters
$params = $_GET;

//Get the method (last part of the url)
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', parse_url($uri, PHP_URL_PATH));

$function = end($path);
if(!$function) {
	$function = prev($path);
}
switch($function) {
	case "resources":
		//list resources
		listResources($params);
		break;
	case "citations":
		//get citations
		getCitations($params);
		break;
	default:
		header("HTTP/1.0 404 Not Found");
		break;
}

function listResources($params) {
	$resources = ResourceRegistry::listResources();

	$type = $params['type'];
	switch($type) {
		case 'json':
			echo json_encode($resources);
			break;
		case 'xml':
		default:
			$options = array(
				 "typeHints"       => false,
				 "addDecl"         => true,
				 "encoding"        => "UTF-8",
				 "rootName"        => "resources",
				 "defaultTagName"  => "resource",
			);
			$serializer = new XML_Serializer($options);
			$result = $serializer->serialize($resources);
			if($result === true) {
				echo $serializer->getSerializedData();
			} else {
				header($result, true, 500);
			}	
	}
}

$results = array();

function getCitations($params) {
	$pmid = $params['pmid'];
	$resourceStr = $params['resources'];
	if(!$resourceStr) {
		$resources = ResourceRegistry::listResources();
	} else {
		$resources = split(",", $resourceStr);
	}
	
	$results = array();
	
	foreach($resources as $r) {
		try {
			$rinfo = ResourceRegistry::get($r);
			if($rinfo) {
				$data = $rinfo->getData($pmid);
			} else {
				throw new Exception("Unable to find resource $data");
			}
			$results[$r] = $data;
		} catch(Exception $e) {
			$results[$r] = "Error: $e";
		}
	}
	
	$type = $params['type'];
	switch($type) {
		case 'json':
			echo json_encode($results);
			break;
		case 'xml':
		default:
			$options = array(
				 "typeHints"       => false,
				 "addDecl"         => true,
				 "encoding"        => "UTF-8",
				 "rootName"        => "results",
				 "defaultTagName"  => "citations",
			);
			$serializer = new XML_Serializer($options);
			$s = $serializer->serialize($results);
			if($s === true) {
				echo $serializer->getSerializedData();
			} else {
				header($s, true, 500);
			}	
	}
}
?>
