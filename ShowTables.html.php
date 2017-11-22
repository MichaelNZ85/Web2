<!doctype html>
<html lang="en">
<head>
<title>Show all tables</title>
<meta charset="UTF-8">
</head>

<body>
<h2>Users Table</h2>

<table>
	<tr>
		<th>userId</th><th>username</th><th>firstName</th><th>lastName</th><th>password</th><th>email</th><th>ageRange</th><th>target</th>
	<tr>
	<?php
		foreach($tblUser as $row)
		{
			echo ("<tr><td>$row[userId]</td><td>$row[username]</td><td>$row[firstName]</td><td>$row[lastName]</td><td>$row[password]</td><td>$row[email]</td><td>$row[ageRange]</td><td>$row[target]</td></tr>");
		}
	?>
</table>

<h2>Exercise Type Table</h2>

<table>
	<tr>
		<th>exerciseTypeId</th><th>name</th>
	</tr>
	
	<?php
		foreach($tblExerciseType as $row2)
		{
			echo ("<tr><td>$row2[exerciseTypeId]</td><td>$row2[name]</td></tr>");
		}
	?>
	
<table>

<h2>Exercise Table</h2>

<table>
	<tr>
		<th>exerciseId</th><th>date</th><th>duration</th><th>exerciseTypeId</th><th>userId</th>
	<tr>
	
	<?php
		foreach($tblExercise as $row3)
		{
		echo ("<tr><td>$row3[exerciseId]</td><td>$row3[date]</td><td>$row3[duration]</td><td>$row3[exerciseTypeId]</td><td>$row3[userId]</td></tr>");
		}
	?>
</table>
</body>
</html>