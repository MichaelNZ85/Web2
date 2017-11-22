<?php
	include 'accessControl.php';
	
	/************************************************************************
	 * User Stats controller page
	 ***********************************************************************/
		$userId = $_SESSION['userId'];
		$username = $_SESSION['username'];
		
	//get user ids
	try
	{
		$selectString = "select userId, username from tblUser";
		$uids = $pdo->query($selectString);
	}
	 catch(PDOException $e)
	 {
		 $error = "Error getting user ids";
		 include 'error.html.php';
		 exit();
	 }
	 
	 
	 
	 if(isset($_POST['compare']))
	 {
		 $compUserId = strip_tags($_POST['user']);
	 
		//get username
			try
			{
				$selectString = "select username from tblUser where userId = $compUserId";
				$cun = $pdo->query($selectString);
				$compUserName = $cun->fetch();
			}
			catch(PDOException $e)
			 {
				 $error = "Error getting username";
				 include 'error.html.php';
				 exit();
			 }
	 		 
		 //get total function
		function getUserTotal($UId, $date1, $date2, $pdo)
		{
			$selectString = "select sum(duration) from tblExercise where userId = $UId and date between \"$date1\" and \"$date2\"";
			$total = $pdo->query($selectString);
			$row = $total->fetch();
			//print_r ($row);
			return $row;
		}
			//get totals for both users
			try	
			{
				$timeStamp = time();
				$today = date('Y-m-d', $timeStamp);
				$sevenDays = date('Y-m-d', strtotime('-7 days'));
				$U1Total = getUserTotal($userId, $sevenDays, $today, $pdo);
				$U2Total = getUserTotal($compUserId, $sevenDays, $today, $pdo);
				
				$userTotal = $U1Total['sum(duration)'];
				$compUserTotal = $U2Total['sum(duration)'];
				/*echo $userName;
				echo $userTotal;
				echo "<br>";
				echo $compUserName['username'];
				echo $compUserTotal;*/
				
			}
			catch(PDOException $e)
			{
				 $error = "Error getting totals";
				 include 'error.html.php';
				 exit();
			} 			
			
			
			
			include 'comparativestats.html.php';
			
		
	 }
	 else //display form as hasn't been submitted yet
	 {
		 include 'compareuser.php';
	 }
	
?>		