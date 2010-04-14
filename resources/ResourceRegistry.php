<?php

require_once("ResourceFormatter.php");
  class ResourceRegistry {
	  private static $resources = array();
	
	  static function init() {
			$resources = scandir(dirname(__FILE__));
			foreach ($resources as $resource){
				if (preg_match("/^citedin.+\.php$/", $resource)){
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

  interface Resource {
	function getResourceName();
	function getInfoLink();
	function getResourceType();
	function getResourceDescription();
	function getResourceFilename();
	function getData($pmid);
  }

  class ResourceData {
	
	//Keep fields for serialization public
	public $citeCount;
	public $detailsLink;
	public $resourceName;
   public $infoLink;
	private $error;

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
