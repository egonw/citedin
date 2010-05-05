<?php 
// { caching functions 
function cache_load($md5){ 
if(file_exists('cache/'.$md5)){ 
return json_decode(file_get_contents('cache/'.$md5), true); 
} 
return false; 
} 
function cache_save($md5,$vals){ 
file_put_contents('cache/'.$md5, json_encode($vals)); 
} 
// }

// { initialise variables 
$pmid=$_GET["pmid"];
$db = $_GET["db"];
$fields = explode(",", $_GET["fields"]);

$amt=100; 
$start=0; 
// } 
// { connect to database 
function dbRow($sql){ 
$q=mysql_query($sql); 
$r=mysql_fetch_array($q); 
return $r; 
} 
function dbAll($sql){ 
$q=mysql_query($sql); 
while($r=mysql_fetch_array($q)) $rs[]=$r; 
return $rs; 
} 
include 'resoures/connectdb.inc';
// } 
// { count existing records 
$r=dbRow("select count(*) as c from $db where pmid=$pmid"); 
$total_records=$r['c'];
$amt=$r['c'];
// } 
// { start displaying records 
echo '{"iTotalRecords":'.$total_records.',
"iTotalDisplayRecords":'.$total_records.',
"aaData":[['; 
$fieldsString = implode(",",$fields);
$rs=dbAll("select $fieldsString from $db where pmid=$pmid  
order by hmdbid limit $start,$amt"); 
$f=0; 
foreach($rs as $r){ 
if($f++) echo ',[';
$dataArray = array();
foreach ($fields as $field) {
	$dataArray[] = "\"".$r[$field]."\"";
}
print implode(",", $dataArray);
print "]\n"; 
} 
echo ']}'; 
// }