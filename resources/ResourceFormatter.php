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


?>
