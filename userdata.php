<?php
	include 'accessControl.php';
	
	/************************************************************************
	 * User Data controller page
	 ***********************************************************************/
	
	//get target for user
	try 
	{
		$userId = $_SESSION['userId'];
		$selectQuery = "select target from tblUser where userId = $userId";
		$userTarget = $pdo->query($selectQuery);
	}
	catch(PDOException $e)
	{
		$error = 'Error getting target';
		include 'error.html.php';
		exit();
	}
	
	
	//get data for exercise table
	try
	{
		$userId = $_SESSION['userId'];
		$selectQuery = "select tblUser.username, tblExercise.date, tblExerciseType.name, tblExercise.duration from tblUser join tblExercise on tblUser.userId = tblExercise.userId join tblExerciseType on tblExercise.exerciseTypeId = tblExerciseType.exerciseTypeId where tblExercise.userId = $userId";
		$userData = $pdo->query($selectQuery);
	}
	catch(PDOException $e)
	{
		$error = 'error getting data for user exercise';
		include 'error.html.php';
		exit();
	}
	
	/* //get total minutes
	try
	{
		$userId = $_SESSION['userId'];
		$selectQuery = "select sum(duration) from tblExercise where userId = $userId";
		$totalDuration = $pdo->query($selectQuery);
		
	}
	catch(PDOException $e)
	{
		$error = 'error getting total duration';
		include 'error.html.php';
		exit();
	} */
	
	//get average minutes
	try
	{
		$userId = $_SESSION['userId'];
		$selectQuery = "select sum(duration) from tblExercise where userId = $userId";
		$totalDuration = $pdo->query($selectQuery);
		$selectQuery2 = "select count(duration) from tblExercise where userId = $userId";
		$exerciseCount = $pdo->query($selectQuery2);
		foreach($exerciseCount as $row)
		{
			$exCount = $row[0];
		}
		foreach($totalDuration as $row)
		{
			$totalD = $row[0];
		}
		$avg = $totalD / $exCount;
	}
	catch(PDOException $e)
	{
		$error = 'error getting average duration';
		include 'error.html.php';
		exit();
	}
	include 'userdata.html.php'
	
?>	