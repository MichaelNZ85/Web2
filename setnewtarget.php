<?php
include 'accessControl.php';
/*****************************************************************************
* Set New Target Processing Page
*****************************************************************************/

	if(isset($_POST['setnewtarget']))
	{
		$username = $_SESSION['username'];
		$newTarget = strip_tags($_POST['newtarget']);
		
		$ntCheck = "/^[0-9]{1,4}$/";
		$nt = preg_match($ntCheck, $newTarget);
		
		if($nt == 0)
		{
			$error = "Invalid target";
			include 'settargeterror.php';
			exit();
		}
		
		try
		{
			$updateQuery = "update tblUser set target=:newTarget where username = :username";
			$stmt = $pdo->prepare($updateQuery);
			$stmt->bindParam(':newTarget', $newTarget);
			$stmt->bindParam(':username', $username);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
			$error = 'Setting new target from form failed';
			include 'error.html.php';
		}
		include 'addntsucc.php';
		
	}
	else
	{
		//display form, hasn't been filled out
		include 'setnewtarget.html.php';
	}
	
	
?>