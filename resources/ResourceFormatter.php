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
			$content = "
		<div class=\"numberInSources $numberClass\">".$data->getCiteCount()."</div>";
		if ($data->getCiteCount()>0){
		      $content .= "<div class=\"details\" id=\"details\"><a href=".$data->getDetailsLink()." rel=\"#overlay\"><button type=\"button\">Details</a></button></div>";
		}
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
