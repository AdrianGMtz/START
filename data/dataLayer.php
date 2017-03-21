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
					return array("status" => "SUCCESS", "responseP" => $row['passwrd'], "responseU" => $row['username']);
				}
			} else {
				return array("status" => "User not Found!");
			}
		} else {
			return array("status" => "Connection with DB went wrong!");
		}
		$conn -> close();
	}

	function changePass($userEmail, $userNewPassword) {
		$conn = connectionToDataBase();

		if ($conn != null) {
			$sql = "SELECT * FROM Users WHERE email='$userEmail'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				$sql = "UPDATE Users SET passwrd = '$userNewPassword' WHERE email='$userEmail'";
				
				if (mysqli_query($conn, $sql)) {
					return array("status" => "SUCCESS");
				}
				else {
					return array("status" => "Couldn't update password!");
				}
			} else {
				return array("status" => "Can't update password, check your email!!");
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

	function saveInfo($userEmail, $description) {
		$conn = connectionToDataBase();

		if ($conn != null) {
			$sql = "UPDATE Users SET description = '$description' WHERE email='$userEmail'";

			if (mysqli_query($conn, $sql)) {
				return array("status" => "SUCCESS");
			}
			else {
				return array("status" => "Couldn't update description!");
			}
		} else {
			return array("status" => "Connection with DB went wrong!");
		}
		$conn -> close();
	}

	function changeUserType($userEmail) {
		$conn = connectionToDataBase();

		if ($conn != null) {
			$sql = "UPDATE Users SET artist = TRUE WHERE email='$userEmail'";

			if (mysqli_query($conn, $sql)) {
				return array("status" => "SUCCESS");
			}
			else {
				return array("status" => "Couldn't update user!");
			}
		} else {
			return array("status" => "Connection with DB went wrong!");
		}
		$conn -> close();
	}

	function getInfo($userEmail) {
		$conn = connectionToDataBase();

		if ($conn != null) {
			$sql = "SELECT description, artist, categories, subcategories from Users WHERE email='$userEmail'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$conn->close();
					return array("status" => "SUCCESS", "description" => $row['description'], "artist" => $row['artist'], "categories" => $row['categories'], "subcategories" => $row['subcategories']);
				}
			} else {
				return array("status" => "User not Found!");
			}
		} else {
			return array("status" => "Connection with DB went wrong!");
		}
		$conn -> close();
	}

	function saveCommissionInfo($userEmail, $commissionDescription, $commissionPrice, $commissionType) {
		$conn = connectionToDataBase();

		if ($conn != null) {
			$sql = "SELECT userID FROM Users WHERE email = '$userEmail'";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$userID = $row['userID'];
					$sql = "INSERT INTO CommissionDetails(userID, commissionType, description, price) VALUES('$userID', '$commissionType', '$commissionDescription', '$commissionPrice');";

					if (mysqli_query($conn, $sql)) {
						return array("status" => "SUCCESS");
					}
					else {
						return array("status" => "Couldn't save commission!");
					}
					return array("status" => "SUCCESS", "description" => $row['description'], "artist" => $row['artist'], "categories" => $row['categories'], "subcategories" => $row['subcategories']);
				}
			} else {
				return array("status" => "User not found!");
			}
		} else {
			return array("status" => "Connection with DB went wrong!");
		}
		$conn -> close();
	}
?>