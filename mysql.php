<!DOCTYPE html>

<head>
	<title>PHP MySQL</title>
	<style>
	table, td{border-style: solid; border-width: thin;}
	</style>
</head>

<body>


<?php
//using MySQLi OO
$servername = 'localhost';
$username = 'root';
$password = 'php9Q!7';
$dbname = 'myDB'; //optional extra to connect to specific table i.e. update, create so on

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection
if($conn -> connect_error)
{
	die("Connection Failed: " . $conn -> connect_error) . "<br>";
}
echo "Connected Successfully<br>";

//createDatabase($conn);
//createTable($conn);
//insertIntoTable($conn);
//insertIntoTableMulti($conn);
//prepareBind($conn);
//deleteData($conn);
//updateData($conn);

selectData($conn);

$conn -> close();
?>

<?php
function createDatabase($conn)
{
	$sql = "CREATE DATABASE myDB";
	if ($conn -> query($sql) === TRUE)
	{
		echo "Database Created<br>";
	}
	else
	{
		echo "Error Creating database " . $conn -> error . "<br>";
	}
}
?>

<?php
function createTable($conn)
{
	$sql = "CREATE TABLE MyGuests(
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(30) NOT NULL,
	lastname VARCHAR(30) NOT NULL, 
	email VARCHAR(50),
	reg_date TIMESTAMP)";
	
	if ($conn -> query($sql) === TRUE)
	{
		echo "Table created<br>";
	}
	else
	{
		echo "Error creating table " . $conn -> error . "<br>";
	}
}
?>

<?php
function insertIntoTable($conn)
{
	$sql = "INSERT INTO MyGuests (firstname, lastname, email)
		    VALUES ('John', 'Doe', 'john@example.com')";

	if ($conn->query($sql) === TRUE) 
	{
		$last_id = $conn -> insert_id;
    	echo "New record created successfully. Last ID is " . $last_id  ."<br>";
	}
	else
	{
    	echo "Error: " . $sql . "<br>" . $conn->error ."<br>";
	}
}
?>

<?php
function insertIntoTableMulti($conn)
{
	$sql = "INSERT INTO MyGuests (firstname, lastname, email)
		    VALUES ('Jim', 'Doe', 'jim@example.com');";
	$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
		    VALUES ('Jane', 'Doe', 'jane@example.com');";
	$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
		    VALUES ('Jenny', 'Doe', 'jenny@example.com')";

	if ($conn->multi_query($sql) === TRUE) 
	{
    	echo "New records created successfully<br>";
	}
	else
	{
    	echo "Error: " . $sql . "<br>" . $conn->error ."<br>";
	}
}
?>

<?php
//much faster and safer to do it this way
//sss = data type of variables  i.e. strings
function prepareBind($conn)
{
	// prepare and bind
	$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $firstname, $lastname, $email);

	// set parameters and execute
	$firstname = "John";
	$lastname = "Doe";
	$email = "john@example.com";
	$stmt->execute();

	$firstname = "Mary";
	$lastname = "Moe";
	$email = "mary@example.com";
	$stmt->execute();
	
	$firstname = "Julie";
	$lastname = "Dooley";
	$email = "julie@example.com";
	$stmt->execute();
	
	echo "New records created successfully";

	$stmt->close();
}
?>

<?php
function deleteData($conn)
{
	// sql to delete a record
	$sql = "DELETE FROM MyGuests WHERE id=2";

	if ($conn->query($sql) === TRUE)
	{
    	echo "Record deleted successfully";
	} 
	else 
	{
   		echo "Error deleting record: " . $conn->error;
	}
}
?>

<?php
function updateData($conn)
{
	$sql = "UPDATE MyGuests SET lastname='Bob' WHERE id=1";

	if ($conn->query($sql) === TRUE)
	{
    	echo "Record updated successfully";
	} 
	else 
	{
    	echo "Error updating record: " . $conn->error;
	}
}
?>


<?php
//edited to test returned html with CSS limited to first 5 results (note you can uses OFFSET 5 after LIMIT to start at say 5 and return 5-10
function selectData($conn)
{
	$sql = "SELECT id, firstname, lastname FROM MyGuests LIMIT 5";
	$result = $conn -> query($sql);
	
	if($result -> num_rows > 0 )
	{
		echo "<table><tr><th>ID</th></tr>";
		//output data from each row
		while($row = $result -> fetch_assoc())
		{
			echo "<tr><td>id: " . $row["id"]. " - Name: " . $row["firstname"] . " " . $row["lastname"] . "</td></tr>";
		}
		echo "</table>";
	} 
	else
	{
		echo "No results";
	}
}
?>

<!-- *********************not used for this document, alternate method using PDO not MySQLi********************************
<?php
//this method has would allow you to connect to other databases by changing the connection string.
$servername = "localhost";
$username = "root";
$password = "php9Q!7";
$database = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
-->

</body>


<footer>
<?php include 'footer.php';?>
</footer>

</html>