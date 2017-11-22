<?php
	
	include 'connect.inc.php';
	
	//connect to mysql server
	try
	{
		//create PDO
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
	
	
	//connection aborted
	try
	{
		$pdo = new PDO("mysql:host=$host;dbname=$database", $userMS, $passwordMS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec('SET NAMES "utf8"');
	}
	catch(PDOException $e)
	{
		$error = 'Connection to database failed';
		include 'error.html.php';
		exit();
	}
	
	/*//drop tables if they exist
	try
	{
		$dropQuery = "drop table if exists tblExercise";
		$pdo->exec($dropQuery);
		$dropQuery = "drop table if exists tblExerciseType";
		$pdo->exec($dropQuery);
		$dropQuery = "drop table if exists tblUser";
		$pdo->exec($dropQuery);
				
	}
	catch(PDOException $e)
	{
		$error = 'Error dropping tables';
		include 'error.html.php';
		exit();
	}*/
	
	//create tblUser
	try
	{
		$dropQuery = "drop table if exists tblUser";
		$pdo->exec($dropQuery);
		$createQuery = "create table tblUser
		(
			userId int(6) not null auto_increment,
			username varchar(20) not null,
			firstName varchar(30) not null,
			lastName varchar(30) not null,
			password varchar(100) not null,
			email varchar(30) not null,
			ageRange varchar(10) not null,
			target int(4) not null,
			
			primary key(userId),
			unique(username)
			
		)";
		$pdo->exec($createQuery);
	}
	catch(PDOException $e)
	{
		$error = 'Error creating tblUser';
		include 'error.html.php';
		exit();
	}
	
	//create tblExerciseType
	try
	{
		$dropQuery = "drop table if exists tblExerciseType";
		$pdo->exec($dropQuery);
		$createQuery = "create table tblExerciseType
		(
			exerciseTypeId int (6) not null auto_increment,
			name varchar(30),
			
			primary key(exerciseTypeId)
		)";
		$pdo->exec($createQuery);
	}
	catch(PDOException $e)
	{
		$error = 'Error creating tblExerciseType';
		include 'error.html.php';
		exit();
	}
	
	
	
	//create table tblExercise
	try
	{
		$dropQuery = "drop table if exists tblExercise";
		$pdo->exec($dropQuery);
		
		$createQuery = "create table tblExercise
		(
			exerciseId int(6) not null auto_increment,
			date date not null,
			duration int(4) not null,
			exerciseTypeId int(6) not null,
			userId int(6) not null,
			
			primary key(exerciseId),
			foreign key(exerciseTypeId) references tblExerciseType(exerciseTypeId),
			foreign key(userId) references tblUser(userId)
		)";
		$pdo->exec($createQuery);
	}
	catch(PDOException $e)
	{
		$error = 'Error creating tblExercise';
		include 'error.html.php';
		exit();
	}
	
	//insert basic types of exercise into tblExerciseType
	try
	{
		$insertQuery = "insert into tblExerciseType(name) values('Exercycle')";
		$pdo->exec($insertQuery);
		$insertQuery = "insert into tblExerciseType(name) values('Walking')";
		$pdo->exec($insertQuery);
		$insertQuery = "insert into tblExerciseType(name) values('Lifting weights')";
		$pdo->exec($insertQuery);
	}
	catch(PDOException $e)
	{
		$error = 'Error inserting into tblExerciseType';
		include 'error.html.php';
		exit();
	}
	
	
	
	
	
?>	