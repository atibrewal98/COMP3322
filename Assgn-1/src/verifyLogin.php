<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: token, Content-Type');
	header('Access-Control-Max-Age: 1728000');
	$conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));

	// Implement the code here.
	$query = 'Update attendancelist SET attendOrNot = \''.$_GET['value'].'\' WHERE id = '.$_GET['id'];
	$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

	$query = 'select * from attendancelist';
	$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

	while($row = mysqli_fetch_array($result)) {
		print "<div id=".$row['id'].">";
		print "<span onclick = \"changeState(this)\">".$row['attendOrNot']."</span>";
		print "<h3>".$row['studentname']." (".$row['major'].")</h3>";
		print "<h5>(".$row['course'].") on ".$row['coursedate']."</h5>";
		print "</div>";
	}
	
	mysqli_free_result($result);
	mysqli_close($conn);
?>