<?php

$servername = "localhost";
$dBUsername = "root";         //login information for database
$dBPassword = "";
$dBName = "forum";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName); // connect to database


if (!$conn) {
	die("Connection failed: ".mysqli_connect_error()); // show error if cant connect
}