<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');

    session_start();

    $conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));

    if($_POST['show'] == 'delCart'){
        if(isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        } else {
            $query = "Delete from cart Where UserId = '".$_SESSION['username']."'";
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
        }
    } else if ($_POST['show'] == 'invoice'){
        $inv = array(
            array("Full Name:", $_POST['name']),
            array("Company:", $_POST['comp']),
            array("Address Line 1:", $_POST['add1']),
            array("Address Line 2:", $_POST['add2']),
            array("City:", $_POST['city']),
            array("Region:", $_POST['reg']),
            array("Country:", $_POST['cntry']),
            array("Postcode:", $_POST['zip'])
        );
        $_SESSION['inv'] = $inv;
    } else if ($_POST['show'] == 'invoiceAll'){
        if(isset($_SESSION['inv'])){
            foreach ($_SESSION['inv'] as $key => $row) {
                echo "<div class = \"row\">";
                echo "    <div class = \"column leftF\">";
                echo "        <label for=\"fName\" class = \"mr10\"><b>".$row[0]."</b></label>";
                echo "    </div>";
                echo "    <div class = \"column rightF\" style = \"text-align: left;\">";
                echo "        <label for=\"fKey\" class = \"mr10\">".$row[1]."</label>";
                echo "    </div>";
                echo "</div>";
            }
        }
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>