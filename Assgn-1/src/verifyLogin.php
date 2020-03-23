<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: token, Content-Type');
	header('Access-Control-Max-Age: 1728000');

	session_start();
	
	$username = "";
	$errors = array();
	$same = array();
	$confirm = array();
	$pass = array();

	$conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));

	if (isset($_POST['login'])) {

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Please do not leave the fields empty");
		} else if (empty($password)){
			array_push($errors, "Please do not leave the fields empty");
		} else {
			$query = "Select * From login Where UserId = '$username' And Pwd = '$password'";
			$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

			if(mysqli_num_rows($result) == 1){
				$_SESSION['username'] = $username;
				mysqli_free_result($result);
				array_push($pass, "Account already existed");
			} else {
				mysqli_free_result($result);
				array_push($confirm, "Invalid login, please login again.");
			}
		}
	}

	mysqli_close($conn);
?>