<?php
	include 'accessControl.php';
	
	/************************************************************************
	 * Enter Data controller page
	 ***********************************************************************/
	
	//get data for exercise type drop down box
	try
	{
		$exTypeString = "select * from tblExerciseType order by name";
		$exType = $pdo->query($exTypeString);
	}
	catch(PDOException $e)
	{
		$error = 'error getting exercise type data for drop box';
		include 'error.html.php';
		exit();
	}
	
	
		//get variables
		if(isset($_POST['enterData']))
		{
			$userId = $_SESSION['userId']; 
			$dateString = strip_tags($_POST['date']);
			$type = strip_tags($_POST['type']);
			$duration = strip_tags($_POST['duration']);
			
			$dateStringCheck = "/^[0-9]{1,2}\-[A-Za-z]{3}\-[0-9]{4}$/"; //check to see if date is in datePicker's returned format
			$durationCheck = "/^[0-9]{1,3}$/"; //check to see if duration is 1-3 digits
			
			$dsc = preg_match($dateStringCheck, $dateString);
			$dc = preg_match($durationCheck, $duration);
			
			if($dsc == 0)
			{
				$error = "Invalid date format";
				include 'enterdataerror.php';
				exit();
			}
		
			
			if($dc == 0)
			{
				$error = "Invalid duration";
				include 'enterdataerror.php';
				exit();
			}
			
			$dateTime = strtotime($dateString);
			$date = date('Y-m-d', $dateTime);
			
			try
			{
				
				$insertQuery = "insert into tblExercise(date, duration, exerciseTypeId, userId) values(:date, :duration, :type, :userId)";
				$stmt = $pdo->prepare($insertQuery);
				$stmt->bindParam(':date', $date);
				$stmt->bindParam(':duration', $duration);
				$stmt->bindParam(':type', $type);
				$stmt->bindParam(':userId', $userId);
				$stmt->execute();
				
				//include 'test.html.php'; //test to display insertQuery string contents
				
					
			}
			catch(PDOException $e)
			{
				$error = 'Inserting data into database failed';
				include 'error.html.php';
			}
			
			include 'insertDataSuc.php';
					
		}
		else
		{	//form hasn't been submitted, display it
			include 'enterdata.html.php';
		}
	
	
	/*else
	{
		include 'unauthorised.php';
	}*/
	
?>