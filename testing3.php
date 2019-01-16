<?php
//start the session - see code below must be the very first thing on the page
session_start();
?>
<!DOCTYPE html>

<?php
//setcookie must be used before the html tag
//To delete a cookie, use the setcookie() function with an expiration date in the past i.e. -3600
$cookieName = "user";
$cookieValue = "Bill Doe";
setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/"); //86400 = 1 day
?>

<html>
	<head>
	<title>PHP Tesitng A New File</title>
	</head>

<body>

<!--this menu is housed in a php file but setting it as class means we can create css for it as well-->
<!--require means if the menu.php file is missing the rest of the page will not load, include will skip over it and ignore the missing file-->
<div class="menu">
<?php require 'menu.php';?>
</div>



</body>

<footer>
<?php include 'footer.php';?>
</footer>

</html>
