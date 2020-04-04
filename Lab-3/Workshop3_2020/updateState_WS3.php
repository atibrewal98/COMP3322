<?php
  define("DB_HOST", "sophia.cs.hku.hk");
  define("USERNAME", "tibrewal");
  define("PASSWORD", "KLIipPTB");
  define("DB_NAME", "tibrewal");
	
	$conn=mysqli_connect(DB_HOST, USERNAME, PASSWORD, DB_NAME) or die("Connection Error!".mysqli_connect_error());

	$value = $_POST['newValue'];

	$query = "update attendancelist set attendOrNot = '$value' where id=".$_POST['id'];

	mysqli_query($conn, $query) or die ('Query Error! '.mysqli_error($conn));

	print $value;
?>