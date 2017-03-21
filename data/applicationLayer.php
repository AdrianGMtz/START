<?php
	header('Content-type: application/json');
	require_once __DIR__ . '/dataLayer.php';

	$action = strip_tags($_POST["action"]);

	switch ($action) {
		case 'LOGIN':
			loginFunction();
			break;
		case 'REGISTRATION':
			registrationFunction();
			break;
		case 'LOGOUT':
			logoutFunction();
			break;
		case 'CHECKSESSION':
			sessionCheck();
			break;
		case 'CHECKCOOKIE':
			cookieCheck();
			break;
		case 'GETUSERINFO':
			userInfo();
			break;
		case 'EDITINFO':
			editInfo();
			break;
		case 'BECOMEARTIST':
			becomeArtist();
			break;
		case 'SAVECOMMISSION':
			saveCommission();
			break;
		case 'CHANGEPSSWD':
			changePassword();
			break;
	}

	function sessionCheck() {
		session_start();

		if (isset($_SESSION['userID']) && isset($_SESSION['userEmail'])) {
			$userID = $_SESSION['userID'];
			$userEmail = $_SESSION['userEmail'];
			echo json_encode(array("ID" => $userID, "Email" => $userEmail));
		} else {
			header('HTTP/1.1 500 No Session');
			die('No Session');
		}
	}

	function cookieCheck() {
		if (isset($_COOKIE['userEmail'])) {
			echo json_encode(array("cookie" => $_COOKIE['userEmail']));
		} else {
			header('HTTP/1.1 500 No Cookie');
			die('No cookie');
		}
	}

	function userInfo() {
		session_start();

		if (isset($_SESSION['userID']) && isset($_SESSION['userEmail'])) {
			$userID = $_SESSION['userID'];
			$userEmail = $_SESSION['userEmail'];

			$result = getInfo($userEmail);

			if ($result["status"] == "SUCCESS") {
				echo json_encode(array("ID" => $userID, "Email" => $userEmail, "Description" => $result["description"], "Artist" => $result['artist'], "Categories" => $result['categories'], "Subcategories" => $result['subcategories']));
			} else {
				header('HTTP/1.1 500 ' . $result["status"]);
				die($result["status"]);
			}
		} else {
			header('HTTP/1.1 500 Connection Error');
			die('Connection Error');
		}
	}

	function editInfo() {
		$userEmail = strip_tags($_POST["userEmail"]);
		$description = strip_tags($_POST["description"]);

		$result = saveInfo($userEmail, $description);

		if ($result["status"] == "SUCCESS") {
			echo json_encode(array("message" => 'Save Successful!'));
		} else {
			header('HTTP/1.1 500 ' . $result["status"]);
			die($result["status"]);
		}
	}

	function saveCommission() {
		$userEmail = strip_tags($_POST["userEmail"]);
		$commissionDescription = strip_tags($_POST["commissionDescription"]);
		$commissionPrice = strip_tags($_POST["commissionPrice"]);
		$commissionType = 'N/A';

		$result = saveCommissionInfo($userEmail, $commissionDescription, $commissionPrice, $commissionType);

		if ($result["status"] == "SUCCESS") {
			echo json_encode(array("message" => 'Save Successful!'));
		} else {
			header('HTTP/1.1 500 ' . $result["status"]);
			die($result["status"]);
		}
	}

	function becomeArtist() {
		$userEmail = strip_tags($_POST["userEmail"]);

		$result = changeUserType($userEmail);

		if ($result["status"] == "SUCCESS") {
			echo json_encode(array("message" => 'User is now an Artist!'));
		} else {
			header('HTTP/1.1 500 ' . $result["status"]);
			die($result["status"]);
		}
	}

	function logoutFunction() {
		session_start();

		if (isset($_SESSION['userID']) && isset($_SESSION['userEmail'])) {
			session_destroy();
			echo json_encode(array("message" => 'Session removed'));
		} else {
			header('HTTP/1.1 500 No Session');
			die('No Session');
		}
	}

	function passwordDecryption($password) {
		$key = pack('H*', "dbf14c7e313a05bfa34763051cef08bc55abe029fdebae5e1d417e2ffb2c11a3");

		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

		$ciphertext_dec = base64_decode($password);
		$iv_dec = substr($ciphertext_dec, 0, $iv_size);
		$ciphertext_dec = substr($ciphertext_dec, $iv_size);

		$password = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
			
			$count = 0;
			$length = strlen($password);

		for ($i = $length - 1; $i >= 0; $i --) {
			if (ord($password{$i}) === 0) {
				$count ++;
			}
		}

		$password = substr($password, 0, $length - $count); 

		return $password;
	}

	function passwordEncryption($password) {
		$key = pack('H*', "dbf14c7e313a05bfa34763051cef08bc55abe029fdebae5e1d417e2ffb2c11a3");

		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
		$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $password, MCRYPT_MODE_CBC, $iv);
		$ciphertext = $iv . $ciphertext;
		
		$userPassword = base64_encode($ciphertext);

		return $userPassword;
	}

	function loginFunction() {
		$userEmail = strip_tags($_POST["email"]);
		$userPassword = strip_tags($_POST["password"]);
		$cookie = $_POST["cookie"];

		$result = findUser($userEmail);

		if ($result["status"] == "SUCCESS") {
			// Decrypt password
			$pass = passwordDecryption($result["responseP"]);

			if ($userPassword == $pass) {
				session_start();

				// Add them to the session
				$_SESSION['userEmail'] = $userEmail;
				$_SESSION['userID'] = $result["responseU"];

				// Set cookie if true
				if($cookie == "true"){
					if($_COOKIE["userEmail"] != username){
						setcookie("userEmail", $userEmail, time()+(60*60*24*20), "/", "", 0);
					}
				} else {
					setcookie("userEmail", '', time()-(60*60*24*30), "/", "", 0);
				}
				echo json_encode(array("message" => 'Login Successful!'));
			} else {
				header('HTTP/1.1 500 ' . 'Incorrect user or password');
				die('Incorrect user or password');
			}
		} else {
			header('HTTP/1.1 500 ' . $result["status"]);
			die($result["status"]);
		}
	}

	function registrationFunction() {
		// VARIABLES PROVIDED IN THE HTML
		$userName = strip_tags($_POST['username']);
		$userEmail = strip_tags($_POST['email']);
		$userPassword = strip_tags($_POST['password']);
		$fName = 'FNAME';
		$lName = 'LNAME';

		$userPassword = passwordEncryption($userPassword);

		$result = attemptRegistration($userEmail, $fName, $lName, $userName, $userPassword);

		if ($result["status"] == "SUCCESS") {
			session_start();
			
			// Add them to the session
			$_SESSION['userEmail'] = $userEmail;
			$_SESSION['userID'] = $userName;

			echo json_encode(array("message" => 'Registration Successful!'));
		} else {
			header('HTTP/1.1 500 ' . $result["status"]);
			die($result["status"]);
		}
	}

	function changePassword() {
		$userEmail = strip_tags($_POST["email"]);
		$userOldPassword = strip_tags($_POST["oldPass"]);
		$userNewPassword = strip_tags($_POST["newPass"]);
		$userNewPassword2 = strip_tags($_POST["newPass2"]);

		$result = findUser($userEmail);

		if ($result["status"] == "SUCCESS") {
			// Decrypt password
			$pass = passwordDecryption($result["responseP"]);

			if ($userOldPassword == $pass) {
				//If new password matches.
				if ($userNewPassword == $userNewPassword2) {
					//Save password in database.
					$userNewPassword = passwordEncryption($userNewPassword);
					$result = changePass($userEmail, $userNewPassword);
					echo json_encode(array("message" => 'Password Changed!'));
				}else{
				echo json_encode(array("message" => 'Something went wrong!'));
				}
			} else {
				header('HTTP/1.1 500 ' . 'Incorrect user or password');
				die('Incorrect user or password');
			}
		} else {
			header('HTTP/1.1 500 ' . $result["status"]);
			die($result["status"]);
		}
	}
?>
