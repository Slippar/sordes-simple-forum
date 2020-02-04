<?php

if(isset($_POST['signup-submit'])) { 
	//check if submit
	
	require 'dbh.inc.php'; 
	//connection to db
	
	$username = $_POST['uid'];
	$email = $_POST['mail'];
	$password = $_POST['pwd'];
	$passwordRepeat = $_POST['pwd-repeat'];
	//take the login credentials from signup.php
	
	if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat) ) { 
		//check if any of the fields are empty
		header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email); 								
		//return error with username and email
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) { 
		//check if username and email are correct
		header("Location: ../signup.php?error=invalidmail&uid");	
		//return error
		exit();
	}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
		//check if email is correct
		header("Location: ../signup.php?error=invalidmail&uid=".$username); 
		//return error with username
		exit();
	}
	else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { 
		//check if username is with correct symbols
		header("Location: ../signup.php?error=invaliduid&mail=".$email);	
		//return error with email
		exit();
	}
	else if ($password !== $passwordRepeat) { 
		//check if passwords match
		header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email); 
		//send error with mail and username if not
	}
	else {
		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?"; 
		//check if username exists already, later
		$stmt = mysqli_stmt_init($conn);
		//make connection to database
		if (!mysqli_stmt_prepare($stmt, $sql)){
			//check for errors in connection to database and statements
			header("Location: ../signup.php?error=sqlerror1");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $username);
			//bind information for sending to database later, one s for one string
			mysqli_stmt_execute($stmt);
			//check if there is already existing username by connection to database
			mysqli_stmt_store_result($stmt);
			//store result
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				//check if the result is positive
				header("Location: ../signup.php?error=usertaken&mail=".$email);
				//error user taken return email
				exit();
			}
			else{
				$sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
				//save statement for later
				$stmt = mysqli_stmt_init($conn);
				//connect to database
				if (!mysqli_stmt_prepare($stmt, $sql)){
					//check for errors in connection to database and statements
					header("Location: ../signup.php?error=sqlerror2");
					exit();
				}
				else{
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
					//hash the password for security
					
					mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
					mysqli_stmt_execute($stmt);
					//finally send the credentials to database
					header("Location: ../signup.php?signup=success");
					exit();
				}
			}
		}
		
	}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	//close connection to database
	
}

else {
	header("Location: ../signup.php");
	exit();
	//if user connects through the wrong file, redirect it to right one
}