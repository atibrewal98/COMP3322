<?php

  define("DB_HOST", "sophia.cs.hku.hk");
  define("USERNAME", "tibrewal");
  define("PASSWORD", "KLIipPTB");
  define("DB_NAME", "tibrewal");
	
	$conn=mysqli_connect(DB_HOST, USERNAME, PASSWORD, DB_NAME) or die("Connection Error!".mysqli_connect_error());
	
	if($_GET['show'] =='add') {
		
		$value=$_GET['value'];
		$value2=$_GET['value2'];
		$value3=$_GET['value3'];
		$value4=$_GET['value4'];
		$value5=$_GET['value5'];
		
		$query="insert into attendancelist(studentname,major,course,coursedate,attendOrNot) VALUES('$value','$value2','$value3','$value4','$value5')";
		$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
		
		$query = 'select * from attendancelist';
		$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
	
		while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
			print "<div id=".$row['id'].">";
			print "<span onclick=\"changeState(this)\">".$row['attendOrNot']."</span><h3>".$row['studentname']." (".$row['major'].")</h3><h5>(".$row['course'].") on ".$row['coursedate']."</h5>";
			print "</div>";
		}
	}
	
		
	else{
	if ($_GET['show'] == 'all') {
		$query = 'select * from attendancelist';
	} elseif ($_GET['show'] == 'major') {
		$value = $_GET['value'];
		$query = "select * from attendancelist where major = '$value'";
	} elseif ($_GET['show'] == 'course') {
		$value = $_GET['value'];
		$query = "select * from attendancelist where course = '$value'";
	}
		
	
	$result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
	
	while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
        print "<div id=".$row['id'].">";
	    print "<span onclick=\"changeState(this)\">".$row['attendOrNot']."</span><h3>".$row['studentname']." (".$row['major'].")</h3><h5>(".$row['course'].") on ".$row['coursedate']."</h5>";
	    print "</div>";
	}
	}
	
?>