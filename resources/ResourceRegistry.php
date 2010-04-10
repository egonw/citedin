<?php

require_once("ResourceFormatter.php");
  class ResourceRegistry {
	  private static $resources = array();
	
	  static function init() {
			$resources = scandir('./');
			foreach ($resources as $resource){
				if (substr_count($resource, "citedin")>0){
					require_once(basename($resource));			
				}
			}		
	}
      static function register($resourceName, $resourceInfo) {
             self::$resources[$resourceName] = $resourceInfo;
   }
    
      static function listResources() {
	 		return(array_keys(self::$resources));
      }

      static function get($resourceName) {   
	      return(self::$resources[$resourceName]);
      }
  }

  class ResourceInfo {
    private $resourceName;
    private $infoLink;
    private $resourceType;
    private $resourceDescription;
    private $resourceClassname;
    private $resourceFilename;

    function setResourceType($v) { $this->resourceType = $v; return $this; }
   	function setResourceName($v) { $this->resourceName = $v; return $this; }
	function setInfoLink($v) { $this->infoLink = $v; return $this; }
    function setResourceDescription($v) { $this->resourceDescription = $v; return $this; }
    function setResourceClassname($v) { $this->resourceClassname = $v; return $this; }
    function setResourceFilename($v) { $this->resourceFilename = $v; return $this; }

    function getResourceName() { return $this->resourceName; }
   	function getInfoLink() { return $this->infoLink; }
	function getResourceType() { return $this->resourceType; }
	function getResourceDescription() { return $this->resourceDescription; }
	function getResourceClassname() { return $this->resourceClassname; }
	function getResourceFilename() { return $this->resourceFilename; }
	
	
	function getData($pmid) {
		throw new Exception("not implemented");
	}
  }

  class ResourceData {
	
	private $citeCount;
	private $detailsLink;
	private $error;
	private $resourceName;
    private $infoLink;

	function setCiteCount($v) { $this->citeCount = $v; return $this; }	
	function setDetailsLink($v) { $this->detailsLink = $v; return $this; }
	function setError($v) { $this->error = $v; return $this; }
	
	function getCiteCount() { return $this->citeCount; }
	function getDetailsLink() { return $this->detailsLink; }
	function getError() { return $this->error; }
	
	function setResourceName($v) { $this->resourceName = $v; return $this; }
	function setInfoLink($v) { $this->infoLink = $v; return $this; }

    function getResourceName() { return $this->resourceName; }
   	function getInfoLink() { return $this->infoLink; }
	}



	?>