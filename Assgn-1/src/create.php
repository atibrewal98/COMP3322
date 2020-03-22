<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: token, Content-Type');
	header('Access-Control-Max-Age: 1728000');

	session_start();

	$conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));

	$query = 'Update attendancelist SET attendOrNot = \''.$_GET['value'].'\' WHERE id = '.$_GET['id'];
	$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

	mysqli_free_result($result);
	mysqli_close($conn);		
?>