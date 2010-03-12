<?php
   $resources = scandir('resources/');
$citedin_resources = array();
        foreach ($resources as $resource){
            if (substr_count($resource, "citedin")>0){
                 array_push($citedin_resources, basename($resource, ".php"));
            }
        }

   foreach ($citedin_resources as $div){
        print "<DIV id=\"$div\"><p></p></DIV>\n";
}

?>
