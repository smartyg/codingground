<html>
<head>
<title>Online PHP Script Execution</title>
</head>
<body>
<?php
require("AttrObject.php");
require("TagObject.php");
   echo "<h1>Hello, PHP!</h1>";
   
   $obj = new TagObject("a");
   $obj->printHTML();
?>
</body>
</html>
