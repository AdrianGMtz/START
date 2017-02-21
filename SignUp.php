<?php
header('Content-type: application/json');
	// TO CONNECT
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "testStart";

	// VARIABLES PROVIDED IN THE HTML
$theUsername = $_POST['username'];
$theEmail = $_POST['email'];
$thePassword = $_POST['password'];
$conn = new mysqli($servername, $username, $password, $dbname);	
echo $servername;
	// Check connection
if ($conn->connect_error) 
{
	header('HTTP/1.1 500 Bad connection to Database');
	die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}
else 
{
	$sql = "SELECT email FROM Users WHERE email = '$theEmail'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		header('HTTP/1.1 409 Conflict, Email already in use please select another one');
		die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
	}
	else 
	{
		$sql = "INSERT INTO Users(username,email,passwrd) VALUES ('$theUsername','$theEmail','$thePassword')";

		if (mysqli_query($conn, $sql))
		{
			echo json_encode("Registration successful");
		}
		else
		{
			header('HTTP/1.1 500 Bad connection, something went wrong while saving your data, please try again later');
			echo "Error: " . $sql . "\n" . mysqli_error($conn);
		}
	}
}
?>
