<?php
include 'accessControl.php';
/*****************************************************************************
* Add New Type of Exercise Processing Page
*****************************************************************************/
	
	if(isset($_POST['addex']))
	{
		$newEx = strip_tags($_POST['newextype']);
		
		try
		{
			$insertQuery = "insert into tblExerciseType(name) values(:newEx)";
			$stmt = $pdo->prepare($insertQuery);
			$stmt->bindParam(':newEx', $newEx);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Inserting new type of exercise from form failed';
			include 'error.html.php';
		}
		include 'addexsucc.php';
		
	}
	else
	{
		//display form, hasn't been filled out
		include 'addnewex.html.php';
	}
	
	
	
?>