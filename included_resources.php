<?php
   include ('resources/connectdb.inc');
   $resources = scandir('data_files/');
   print "<table><tr><th>Name</th><th>organisation</th><th>last update</th><th>file name</th><th>Update frequency</th></tr>\n";
   foreach ($resources as $resource){
      if (($resource != ".") and ($resource != ".."))
       {
       $sql = "select * from resources where filename = \"$resource\"";
       $result = mysql_query($sql);
       while ($row = mysql_fetch_assoc($result)) {
	print "<tr><td>".$row["name"]."</td>";
        print "<td><a href=\"".$row["orgurl"]."\">".$row["organisation"]."</a></td>";
	print "<td> " . date("F d Y", filectime("data_files/$resource"))."</td>";
        print "<td>$resource [<a href=\"".$row["url"]."\">get</a>]</td>";
        print "<td>".$row["updatefreq"].".</tr>\n";
       }
       }
   }
   print "</table>";
?>
