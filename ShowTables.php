<?php
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
	
	//display all users
	try
	{
		$selectString = "select * from tblUser";
		$tblUser = $pdo->query($selectString);
	}
	catch(PDOException $e)
	{
		$error = 'Error selecting from tblUser';
		include 'error.html.php';
		exit();
	}
	
	//display all types of exercise
	try
	{
		$selectString = "select * from tblExerciseType";
		$tblExerciseType = $pdo->query($selectString);
	}
	catch(PDOException $e)
	{
		$error = 'Error selecting from tblExerciseType';
		include 'error.html.php';
		exit();
	}
	
	//display all exercise
	try
	{
		$selectString = "select * from tblExercise";
		$tblExercise = $pdo->query($selectString);
	}
	catch(PDOException $e)
	{
		$error = 'Error selecting from tblExercise';
		include 'error.html.php';
		exit();
	}
	
	include 'ShowTables.html.php';
?>