<?php

/*****************************************************************************
* Registration processing page
*****************************************************************************/

	include 'connect.inc.php';

	//connect to mysql server
	try
	{
		$pdo = new PDO("mysql:host=$host;dbname=$database", $userMS, $passwordMS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	}
	catch(PDOException $e)
	{
		$error = 'error connecting to database';
		include 'error.html.php';
		exit();
	}
	
	
	//salting and hashing function
	function saltAndHash($password)
	{
		$cost = 10;
		
		//create random salt
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		
		//prefix hash info
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		//hash password with salt
		$hash = crypt($password, $salt);
		return $hash;
	}
	
	if(isset($_POST['register']))
	{
		//get variables from form
		$username = strip_tags($_POST['username']);
		$firstName = strip_tags($_POST['firstName']);
		$lastName  = strip_tags($_POST['lastName']);
		$origPasswd = strip_tags($_POST['password']);
		$confirmPasswd = strip_tags($_POST['confpassword']);
		$email = strip_tags($_POST['email']);
		$regCode = strip_tags($_POST['regcode']);
		$age = strip_tags($_POST['age']);
		$target = strip_tags($_POST['target']);
		
		//regex checkers
		$usernameCheck = "^[a-zA-Z0-9_]{5,15}$"; //username must have only uppercase and lowercase lettters and digits, and be from 5 - 15 characters long2
		$firstNameCheck = "^[a-zA-Z]{1,20}$"; //first name must be only letters and from 1-20 letters
		$lastNameCheck = "^[a-zA-Z]{1,20}$"; //last name must be only letters and from 1-20 letters
		$passwordCheck = "^(?=.{8,})(?=.*[0-9]+)(?=.*[A-Z]+)(?=.*[a-z]+)"; //at least 1 uppercase letter, one lowercase letter, one digit
		$emailCheck = "^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-.]+$"; //check for valid email address - must contain an @
		$targetCheck = "^[0-9]+$"; //check for valid target - one or more numbers
		
		$un = preg_match($usernameCheck, $username);
		$fn = preg_match($firstNameCheck, $firstName);
		$ln = preg_match($lastNameCheck, $lastName);
		$pw = preg_match($passwordCheck, $origPasswd);
		$em = preg_match($emailCheck, $email);
		$tg = preg_match($targetCheck, $target);
		
		//if the passwords don't match, display the error page
		if ($origPasswd != $confirmPasswd)
		{
			$error = "Passwords don't match";
			include "regerror.php";
			exit();
		}
		
		//if username is invalid, display the error page
		if(preg_match(/$usernameCheck/, $username))
		{
			$error = "Invalid username";
			include "regerror.php";
			exit();
		}
		
		//if first name is invalid, display the error page
		if($fn == 0)
		{
			$error = "Invalid first name";
			include "regerror.php";
			exit();
		}
		
		//if last name is invalid, display the error page
		if($un == 0)
		{
			$error = "Invalid last name";
			include "regerror.php";
			exit();
		}
		
		//if the password doesn't match the regex, display the error page
		if ($pw == 0)
		{
			$error = "Invalid password. Password must contain at least one uppercase letter, one lowercase letter and one digit";
			include "regerror.php";
			exit();
		}
		
		//if the registration code isn't 777, display the error page
		if($regCode != 777)
		{
			$error = "Incorrect registration code";
			include "regerror.php";
			exit();
		}
		
		//if age hasn't been entered correctly, display the error form
		if($age == "selectAge")
		{
			$error = "Incorrect age";
			include "regerror.php";
			exit();
		}
		
		//check to see if target is at least 1 number
		if($tg == 0)
		{
			$error = "Incorrect target";
			inlcude "regerror.php";
			exit();
		}
		
		
		
		//hash the password
		$password = saltAndHash($origPasswd);
		
		//insert user data into database
		try
		{
			$insertQuery = "insert into tblUser(username, firstName, lastName, password, email, ageRange, target) values(:username, :firstName, :lastName, :password, :email, :ageRange, :target)";
			$stmt = $pdo->prepare($insertQuery);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':firstName', $firstName);
			$stmt->bindParam(':lastName', $lastName);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':ageRange', $age);
			$stmt->bindParam(':target', $target);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Inserting user data failed. from form failed';
			include 'error.html.php';
		}
		include 'regsucc.html.php';
	}
	else
	{//form hasn't been submitted, display it
		include 'register.html.php';
	}
	
?>