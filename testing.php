<?php
session_start();
?>
<html>
	<head>
		<title>test</title>
		<style>
		div{color:#FF0000;}
		.error {color: #FF0000;}
		</style>
	</head>

	<body>
	
	<div class="menu">
	<?php include 'menu.php';?>
	</div>

<?php
// Echo session variables that were set in testing2.php
echo "Favorite colour is " . $_SESSION["favcolour"] . ".<br>";
echo "Favorite animal is " . $_SESSION["favanimal"] . ".<br>";
print_r($_SESSION); //prints out session variables.
?>

	<div>
	<p> 
	<?php
	echo "testing testing <br />";
	
	$t = date("H");
	
	if($t < "12")
	{
	  echo "Good morning";
	}
	elseif ($t < "20")
	{
	  echo "good afternoon";
	}
	else
	{
	  echo "good night";
	}
	?>
	</p>
	</div>
	
	<p>
	<?php
	$colour = "blue";
	
	switch ($colour)
	{
	  case "red":
	  		echo "the colour is red";
			break;
	  case "blue";
	  		echo "the colour is blue";
			break;
	  default:
	  		echo "the colour is duck";
	}
	?>
	</p>
	
	<p>	<!--http://www.w3schools.com/php/php_looping.asp-->
	<?php 
	$x = 1; 

	while($x <= 5) {
    echo "The number is: $x <br>";
    $x++;
	} 
	?>
	</p>
	
	<code>
	$colour = "blue";
	
	switch ($colour)
	{
	  case "red":
	  		echo "the colour is red";
			break;
	  case "blue";
	  		echo "the colour is blue";
			break;
	  default:
	  		echo "the colour is duck";
	}
	</code>
	<br>
	
	<?php
	for ($x = 0 ; $x <= 10 ; $x++)
	{
	  echo "the number is: $x <br>";
	}
	?>
	<br>
	
	<?php 
	//this defines an array - you could refer to each one like $colors[0] = "pink";
	$colors = array("red", "green", "blue", "yellow");
	sort($colors); //can perfom actions on array see http://www.w3schools.com/php/php_arrays_sort.asp
	foreach ($colors as $value)
	{
	  echo "$value <br>";
	}
	?>
	<br>
	
	
	<?php
	//Class  ammended to use a paramter
	//define("MODEL", "VW"); a constant
	class Car
	{
	  function Car($model = "Unknown") //paramter with a default
	  {
	    $this->model = $model;
	  }
	}
	
	//create an object
	$herbie = new Car("Moose");
	
	//show object
	echo $herbie->model;
	?>
	<br>
	
	<?php
	function writeMsg() {
		echo "Hello";
	}
	
	writeMsg();
	?>
	<br>
	
	<?php
	$x = 75;
	$y = 25;
	
	function addition() {
		$GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
	}
	
	addition();
	echo $z; //this is available as its stored as a global
	?>
	
	<p> ---------------------------Forms-------------------------------------------------------------------</p>
	<!-- uses the php page welcome to repond-->
	<form action="welcome.php" method="post">
	Name: <input type="text" name="name"><br>
	E-mail <input type="text" name="email"><br>
	<input type="submit">
	</form>
	
	
	<p> ---------------------Secure Forms-------------------------------------------------------------------</p> 
	  
	<?php
	//define variables for both form and errors and set to empty values
	$name = $email = $gender = $comment = $website = "";
	$nameErr = $emailErr = $genderErr = $websiteErr = "";
	
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
	  if(empty($_POST["name"]))
	  {
	    $nameErr = "Name is required";
	  }  
	  else
	  {
	    $name = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
		{
          $nameErr = "Only letters and white space allowed"; 
        } 
	  }
	  
	  if (empty($_POST["email"])) 
	  {
	  	$emailErr = "Email is required";
	  }
	  else 
	  { 
	    $email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
      	  $emailErr = "Invalid email format"; 
		}
	  }
	  
	  if (empty($_POST["website"]))
	  {
	    $website = "";
	  }
	  else
	  {
	    $website = test_input($_POST["website"]);
		// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
   		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) 
		{
          $websiteErr = "Invalid URL"; 
    	}
	  }
	  
	  
 	 if (empty($_POST["comment"])) 
	 {
       $comment = "";
  	 } 
	 else 
	 {
       $comment = test_input($_POST["comment"]);
 	 }

  	if (empty($_POST["gender"])) 
	{
      $genderErr = "Gender is required";
    }
	else 
	{
      $gender = test_input($_POST["gender"]);
    }
  }
	
	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	?>
	
	<h2> Web input form</h2>
	<p><span class="error">* required field.</span></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Name:    <input type="text" name="name" value="<?php echo $name;?>">
			 <span class="error">* <?php echo $nameErr;?></span>
			 <br><br>
	E-mail:  <input type="text" name="email" value="<?php echo $email;?>">
			 <span class="error">* <?php echo $emailErr;?></span>
			 <br><br>
	Website: <input type="text" name="website" value="<?php echo $website;?>">
		     <span class="error"> <?php echo $websiteErr;?></span>
			 <br><br>
	Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
	  	     <br><br>
	Gender:  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
			 <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>   value="male"> Male
			 <span class="error">* <?php echo $genderErr;?></span>
		     <br><br>
	<input type="submit" name="submit" value="Submit">
	<!--http://www.w3schools.com/php/php_form_validation.asp htmlspecialchars replaces <> with &gt so people cannot hack the PHP_SELF-->
	
	
	<?php
	echo "<h2>Your Input:</h2>";
	echo $name;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $website;
	echo "<br>";
	echo $comment;
	echo "<br>";
	echo $gender;
	?>

	</body>
<footer>
<?php include 'footer.php';?>
</footer>
</html>