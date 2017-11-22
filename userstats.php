<?php
	include 'accessControl.php';
	
	/************************************************************************
	 * User Data controller page
	 ***********************************************************************/
		$userId = $_SESSION['userId'];
		
	 //drop view if it already exists
	 try
	 {
		 $dropString = "drop view if exists vExercise";
		 $pdo->exec($dropString);
		 	 
	 } 
	 catch(PDOException $e)
	 {
		 $error = "Error dropping view";
		 include 'error.html.php';
		 exit();
	 }
	 
	 //create view
	 try
	 {
		$viewString = "create view vExercise as select tblExercise.date, tblExerciseType.name as type, tblExercise.duration from tblExercise join tblExerciseType on tblExercise.exerciseTypeId = tblExerciseType.exerciseTypeId where  tblExercise.userId = $userId";
		$pdo->exec($viewString); 
	 }
	 catch(PDOException $e)
	 {
		 $error = "Error creating view";
		 include 'error.html.php';
		 exit();
	 }
	 
	 //get exercise data for pie graph
	 try
	 {
		 $selectString = "select type, sum(duration) from vExercise group by type";
		 $pgdata = $pdo->query($selectString);
	 }
	 catch(PDOException $e)
	 {
		 $error = "Error querying view";
		 include 'error.html.php';
		 exit();
	 }
	 
	 include 'userstats.html.php';
			
	 



?>	 