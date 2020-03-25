<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
	header('Access-Control-Allow-Headers: token, Content-Type');
	header('Access-Control-Max-Age: 1728000');

	$conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));

	if ($_POST['show'] == 'all') {
		$query = 'select * from book';
        $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result)) {
            print "<div class=\"card\">";
            print "<img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" style=\"width:100%\">";
            print "<h3>".$row['BookName']."</h3>";
            print "<p class=\"price\">$ ".$row['Price']."</p>";
            print "<p>Author: ".$row['Author']."</p>";
            print "<p>Publisher: ".$row['Publisher']."</p>";
            print "<button id = \"".$row['BookName']."\" onclick = \"viewBook(this.id)\">View Details</button>";
		    print "</div>";
	    }
    } else if ($_POST['show'] == 'filterC') {
		$query = 'select * from book Where Category = \''.$_POST['category'].'\'';
        $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result)) {
            print "<div class=\"card\">";
            print "<img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" style=\"width:100%\">";
            print "<h3>".$row['BookName']."</h3>";
            print "<p class=\"price\">$ ".$row['Price']."</p>";
            print "<p>Author: ".$row['Author']."</p>";
            print "<p>Publisher: ".$row['Publisher']."</p>";
            print "<button id = \"".$row['BookName']."\" onclick = \"viewBook(this.id)\">View Details</button>";
		    print "</div>";
	    }
    } else if ($_POST['show'] == 'sort') {
		$query = 'select * from book order by Price';
        $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result)) {
            print "<div class=\"card\">";
            print "<img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" style=\"width:100%\">";
            print "<h3>".$row['BookName']."</h3>";
            print "<p class=\"price\">$ ".$row['Price']."</p>";
            print "<p>Author: ".$row['Author']."</p>";
            print "<p>Publisher: ".$row['Publisher']."</p>";
            print "<button id = \"".$row['BookName']."\" onclick = \"viewBook(this.id)\">View Details</button>";
		    print "</div>";
	    }
    } else if ($_POST['show'] == 'search') {
        $query = 'select * from book Where';

        $sKeyword = explode(" ", $_POST['keyword']);
        foreach($sKeyword as $value){
            $query = $query." BookName Like '%".$value."%' Or";
        }
        $query = $query." 0 = 1";

        $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result)) {
            print "<div class=\"card\">";
            print "<img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" style=\"width:100%\">";
            print "<h3>".$row['BookName']."</h3>";
            print "<p class=\"price\">$ ".$row['Price']."</p>";
            print "<p>Author: ".$row['Author']."</p>";
            print "<p>Publisher: ".$row['Publisher']."</p>";
            print "<button id = \"".$row['BookName']."\" onclick = \"viewBook(this.id)\">View Details</button>";
		    print "</div>";
	    }
    } else if ($_POST['show'] == 'allC') {
		$query = 'select distinct Category from book';
        $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result)) {
            print "<li onclick=\"filterC(this)\">".$row['Category']."</li>";
	    }
    }
    
    mysqli_free_result($result);
	mysqli_close($conn);
?>