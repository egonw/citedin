<?php

/**
 * Utility class that helps formatting a result div for a resource
 */
class ResourceFormatter {
	public static function getHTML($data) {
		$numberClass = "numberNotCited";
		if($data->getCiteCount() > 0) {
			$numberClass = "numberCited";
		}
		
		$name = $data->getResourceName();
		if($data->getInfoLink()) {
			$name = "<a href='{$data->getInfoLink()}'>$name</a>";
		}
		
		$content = '';
		
		$error = $data->getError();
		if($error) {
			$content = "<div class='error'>$error</div>";
		} else {
			$content = <<<HTML
		<div class="numberInSources $numberClass">{$data->getCiteCount()}</div>
		<div id="details"><a href="{$data->getDetailsLink()}">Details</a></div>		
HTML;
		}
		
		$html = <<<HTML
	<div id="row">
		<div id="sourceName">$name:</div>
		$content
	</div>
HTML;
	
		return $html;
	}
}

/**
 * Defines the data a resource should return.
 */
class ResourceData {
	private $resourceName;
	private $citeCount;
	private $detailsLink;
	private $infoLink;
	private $error;
	
	function setResourceName($v) { $this->resourceName = $v; return $this; }
	function setCiteCount($v) { $this->citeCount = $v; return $this; }
	function setDetailsLink($v) { $this->detailsLink = $v; return $this; }
	function setInfoLink($v) { $this->infoLink = $v; return $this; }
	function setError($v) { $this->error = $v; return $this; }
	
	function getResourceName() { return $this->resourceName; }
	function getCiteCount() { return $this->citeCount; }
	function getDetailsLink() { return $this->detailsLink; }
	function getInfoLink() { return $this->infoLink; }
	function getError() { return $this->error; }
}
?>
