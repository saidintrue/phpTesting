<!DOCTYPE html>

<head>
<title>Untitled Document</title>

<style>
header{background:#e3e3e3; padding: 2em; text-align:center;}
</style>

</head>

<body>

	<header>
		<!-- //http://localhost/urltest.php/?name=Neil -->
		<!-- ?= is the same as ?php echo -->	
		<h1><?= "Hello, " . htmlspecialchars($_GET['name'])?></h1>
	</header>
	
	<br>
	
	<!--
	<?php
	$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = VLA47)(PORT = 1521)))(CONNECT_DATA=(SID=VGSM)))";
		
    if($c = oci_connect("reporter", "reporter", $db))
    {
        echo "Successfully connected to Oracle.\n";
        OCILogoff($c);
    }
    else
    {
        $err = OCIError();
        echo "Connection failed." . $err[text];
    }
?>
-->


</body>
</html>
