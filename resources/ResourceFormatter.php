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
		
		
		$rawname = $data->getResourceName();
		if($data->getInfoLink()) {
			$name = "<a href=\"".$data->getInfoLink()."\">$rawname</a>";
		}
		
		$content = '';
		
		$error = $data->getError();
		if($error) {
			$content = "<div class='error'>$error</div>";
		} else {
			$content = "
		<div class=\"numberInSources $numberClass\">".$data->getCiteCount()."</div>";
		if ($data->getCiteCount()>0){
		      $content .= "<div class=\"details\" id=\"details\"><a href=".$data->getDetailsLink()." rel=\"#overlay\"><button type=\"button\">Details</a></button><button class=\"button$rawname\" id=\"button$rawname\">x</button>
		<script>
			    $(\"button$rawname\").click(function () {
			      $(\"row$rawname\").remove();
			    });

			</script></div>";
		}
	}
		
		$html = <<<HTML
	<div id="row$rawname">

		<div id="sourceName">$name</div>
		$content
	</div>
HTML;
	
		return $html;
	}
}


?>
