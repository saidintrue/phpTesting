<?php
//start the session - see code below must be the very first thing on the page
session_start();
?>
<!DOCTYPE html>

<?php
//setcookie must be used before the html tag
//To delete a cookie, use the setcookie() function with an expiration date in the past i.e. -3600
$cookieName = "user";
$cookieValue = "John Doe";
setcookie($cookieName, $cookieValue, time() + (86400 * 30), "/"); //86400 = 1 day
?>

<html>
	<head>
	<title>Advanced PHP</title>
	</head>

<body>

<!--this menu is housed in a php file but setting it as class means we can create css for it as well-->
<!--require means if the menu.php file is missing the rest of the page will not load, include will skip over it and ignore the missing file-->
<div class="menu">
<?php require 'menu.php';?>
</div>

<?php
//set session variables
$_SESSION["favcolour"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set. <br>";

/* 
<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
?>
*/
?>

<?php
//2D array
$cars = array
	(
	  array("Volvo",22,18),
  	  array("BMW",15,13),
  	  array("Saab",5,2),
 	  array("Land Rover",17,15)
    );
	
echo $cars[0][0].": In stock: ".$cars[0][1].", sold: ".$cars[0][2].".<br>";
echo $cars[1][0].": In stock: ".$cars[1][1].", sold: ".$cars[1][2].".<br>";
echo $cars[2][0].": In stock: ".$cars[2][1].", sold: ".$cars[2][2].".<br>";
echo $cars[3][0].": In stock: ".$cars[3][1].", sold: ".$cars[3][2].".<br>";
?>

<?php
//this is similar to above but using nested loops to itterate through the array
for ($row = 0; $row < 4; $row++ )
{
 echo "<p><b>Row number $row</b></p>";
 echo "<ul>";
 for ($col = 0; $col < 3; $col++) 
 {
   echo "<li>".$cars[$row][$col]."</li>";
 }
 echo"</ul>";
}
?>

<?php
//time stamp code http://www.w3schools.com/php/php_ref_date.asp
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("l") . "<br>"; //lower L
date_default_timezone_set("Europe/London"); //http://php.net/manual/en/timezones.php
echo "The time is " . date("h:i:sa") . "<br>"; //sa = am / pm
$d=strtotime("11:58am August 19 2016"); //string to data will accept things like "+3Months", "next Saturday" etc
echo "Created date is " . date("Y-m-d h:i:sa", $d). "<br><br>";
?>

<?php
//file read write http://www.w3schools.com/php/php_file_open.asp
//open as read only and write to page.
$myFile = fopen("webdictionary.txt", "r") or die ("Unable to open file!");
//echo fread($myFile, filesize("webdictionary.txt")); //read it all
//echo fgets($myFile); //gets the first line
while(!feof($myFile)) //until the end of the file
{
  echo fgets($myFile) . "<br>";  //fgetc reads a character at a time
 }
fclose($myFile);
?>


<?php
/*
//creates and writes to a new files - if files exists it will delete the contents
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
*/
?>

<!-- file uploads are covered here but didn't work for me on this set up: http://www.w3schools.com/php/php_file_upload.asp-->

<p>-------------------------cookies-------------------------</p>
<!--the cookie is set before the html tag-->
<?php
if(!isset($_COOKIE[$cookieName]))
{
 echo "Cookie named '" . $cookieName . "' is not set! <br>";
}
else 
{
 echo "Cookie '" . $cookieName . "' is set! <br>";
 echo "Value is: " . $_COOKIE[$cookieName] . "<br>";
}
?> 

<?php
if(count($_COOKIE) > 0 ) 
{
 echo "Cookies are enabled <br>";
}
else
{
 echo "Cookies are disabled <br>";
}
?> 
 
 <!--
<table>
	<tr>
		<td>filter name</td>
		<td>filter id</td>
	</tr>
<?php
foreach (filter_list() as $id =>$filter)
{
 echo '<tr><td>' . $filter . '</td><td>' .filter_id($filter) . '</td></tr>';
 }
 ?>
 </table>
 -->
 
 <?php
 //removes HTML tags, can also be _IP, _URL, _INT
 //http://www.w3schools.com/php/php_filter.asp
 $str = '<h1>Hello</h1>';
 $newstr = filter_var($str, FILTER_SANITIZE_STRING);
 echo $newstr;
 ?> 


<?php
//error handler function
function customError($errno, $errstr) 
{
  echo "<b>Error:</b> [$errno] $errstr";
}
//set error handler - can take another value i.e. set_error_handler("customError",E_USER_WARNING);
set_error_handler("customError");
//trigger error
echo($test);
?>

<?php
$test = 2;
if($test >= 1) 
{
	trigger_error("Value must be 1 or below<br>");
}
?>


<?php
//create function with an exception
function checkNum($number)
{
  if($number>1) 
  {
    throw new Exception("Value must be 1 or below<br>");
  }
  return true;
}

//trigger exception in a "try" block
try 
{
  checkNum(2);
  //If the exception is thrown, this text will not be shown
  echo 'If you see this, the number is 1 or below<br>';
}
//catch exception - message is part of the exception object.
catch(Exception $e)
{
  echo 'Message: ' .$e->getMessage();
}
?>

</body>

<footer>
<?php include 'footer.php';?>
</footer>

</html>
