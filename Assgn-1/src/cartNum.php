<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');

    session_start();

    $conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));

    if(isset($_SESSION['username'])){
        $query = "Select ifNull(Sum(Quantity), 0) as CartTot From cart Where UserId = '".$_SESSION['username']."'";
        $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

        while($row = mysqli_fetch_array($result)) {
            print "<sup class = \"cVal\" id = \"cartVal\">".$row['CartTot']."</sup>";
        }
    } else if (isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
        $total = 0;

        foreach ($cart as $key => $row) {
            $total = $total + $row[3];
        }

        print "<sup class = \"cVal\" id = \"cartVal\">".$total."</sup>";
    } else {
        print "<sup class = \"cVal\" id = \"cartVal\">0</sup>";
    }
?>