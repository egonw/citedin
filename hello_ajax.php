<html> 
<head> 
 <title>Ajax with jQuery Example</title> 
 <script type="text/JavaScript" src="jquery.js"></script> 
 <script type="text/JavaScript"> 
 $(document).ready(function(){ 
   $("#generate").click(function(){ 
     $("#quote").load("./script.php"); 
   }); 
 }); 
 </script> 
<style type="text/css"> 
   #wrapper { 
     width: 240px; 
     height: 80px; 
     margin: auto; 
     padding: 10px; 
     margin-top: 10px; 
     border: 1px solid black; 
     text-align: center; 
   } 
 </style> 
</head> 
<body> 
 <div id="wrapper"> 
   <div id="quote"><p> </p></div> 
   <input type="submit" id="generate" value="Generate!"> 
 </div> 
</body> 
</html>
