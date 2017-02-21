<?php

// Create connection
$db = mysqli_connect("localhost","root","root","start");

// Echo error if you couldn't connect
if (mysqli_connect_errno()) {
   echo "Failed to connect: " . mysqli_connect_error();
}

?>
