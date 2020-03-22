<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: token, Content-Type');
	header('Access-Control-Max-Age: 1728000');

	session_start();

	$conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));

	$query = 'Select * From login Where UserId = \''.$_POST['username'].'\'';
	$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

	if(mysqli_num_rows($result) > 0){
		$_SESSION["error"] = "Account already existed"
		header("location: errorDisplay.php");
	} else {
		$query = 'Insert Into login Values (\''.$_POST['username'].'\', \''.$_POST['password'].'\')'
		$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
		$_SESSION["error"] = "Account created! Welcome"
		header("location: errorDisplay.php")
	}
	
	mysqli_free_result($result);
	mysqli_close($conn);		
?>