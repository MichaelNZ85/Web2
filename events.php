<?php
	include 'accessControl.php';
	
	/***********************************************************************
	 * Calendar Processing page
	 ***********************************************************************/
	 
	 $userId = $_SESSION['userId'];
	
	 
	 $selectString = "select tblExercise.exerciseId, tblExercise.date, tblExercise.duration, tblExerciseType.name as type from tblExercise join tblExerciseType on tblExercise.exerciseTypeId = tblExerciseType.exerciseTypeId where tblExercise.userId = $userId"; 
	 $result = $pdo->query($selectString);
	 $events = array();
	 $color = "green";
	 foreach($result as $row)
	 {
		 $eventArray['title'] = $row ['type'];
		 $eventArray['start'] = $row ['date'];
	 
	 
		 switch($row['type'])
		 {
			 case "Walking":
				$color = "green";
				break;
			case "Exercycle":
				$color = "red";
				break;
			case "Lifting weights":
				$color = "blue";
				break;
		 }
		 
		 $eventArray['color'] = $color;
		 $events[] = $eventArray;
	}
	 echo json_encode($events);
?>