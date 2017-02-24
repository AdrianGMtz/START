<?php
	function connectionToDataBase() {
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "testStart";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			return null;
		} else {
			return $conn;
		}
	}

	function findUser($userEmail) {
		$conn = connectionToDataBase();

		if ($conn != null) {
			$sql = "SELECT * FROM Users WHERE email='$userEmail'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$conn->close();
					return array("status" => "SUCCESS", "response" => $row['passwrd']);
				}
			} else {
				return array("status" => "User not Found!");
			}
		} else {
			return array("status" => "Connection with DB went wrong!");
		}
		$conn -> close();
	}

	function attemptRegistration($userEmail, $fName, $lName, $userName, $userPassword) {
		$conn = connectionToDataBase();

		if ($conn != null) {
			$sql = "SELECT email FROM Users WHERE email = '$userEmail'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				return array("status" => "Email already exists!");
			} else {
				$sql = "INSERT INTO Users(fName, lName, username, email, passwrd, artist) VALUES('$fName', '$lName', '$userName', '$userEmail', '$userPassword',FALSE);";
				
				if (mysqli_query($conn, $sql)) {
					return array("status" => "SUCCESS");
				}
				else {
					return array("status" => "Couldn't create user!");
				}
			}
		} else {
			return array("status" => "Connection with DB went wrong!");
		}
		$conn -> close();
	}
?>