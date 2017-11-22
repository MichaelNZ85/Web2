<?php
	session_start();
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

	
	$userPassword = "";

	if(isset($_POST['username']))
	{
		$userName = strip_tags($_POST['username']);
	}
	else if (isset($_SESSION['username']))
	{
		$userName = $_SESSION['username'];
	}
	
	if(isset($_POST['password']))
	{
		$userPassword = strip_tags($_POST['password']);
	}
	else if (isset($_SESSION['password']))
	{
		$userPassword = $_SESSION['password'];
	}
	
	
	
	if(!isset($userName))
	{
		include 'login.html.php';
		exit();
	}
	else
	{
		$selectQuery = "select * from tblUser where (username = :name) ";
		$stmt = $pdo->prepare($selectQuery);
		$stmt->bindParam(':name', $userName);
		$stmt->execute();
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		
		if($count > 0)
		{
			if(crypt($userPassword, $row['password']) === $row['password'])
			{
				$_SESSION['userId'] = $row['userId'];
				$_SESSION['username'] = $userName;
				$_SESSION['password'] = $userPassword;
				
			}
			else
			{
				$error = "Wrong password";
				include 'loginerror.php';
				
				exit;
			}
		}
		else
		{
			include 'unauthorised.php';
			exit;
		}
	}
	
	
	
	
	
	
	
?>