<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');

    session_start();

    $conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));


    if($_POST['show'] == 'add'){
        if(!isset($_SESSION['username'])){
            $cart = array();
            $newB = array();

            $book = $_POST['book'];
            $quantity = $_POST['quantity'];

            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];

                $rows = count($cart);
                $flag = FALSE;
                for ($row = 0; $row < $rows; $row++) {
                    if($cart[$row][0] == $book){
                        $cart[$row][4] = $cart[$row][4] + ($cart[$row][4]/$cart[$row][3]) * $quantity;
                        $cart[$row][3] = $cart[$row][3] + $quantity;
                        $flag = TRUE;
                    }
                }

                if($flag == FALSE){
                    $query = "Select * From book Where BookId = ".$book;
                    $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

                    while($row = mysqli_fetch_array($result)) {
                        $newB = array($book, $row['BookImg'], $row['BookName'], $quantity, $quantity * $row['Price']);
                        array_push($cart, $newB);
                        $_SESSION['cart'] = $cart;
                    }
                }

                $_SESSION['cart'] = $cart;
            } else {
                $query = "Select * From book Where BookId = ".$book;
                $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

                while($row = mysqli_fetch_array($result)) {
                    $newB = array($book, $row['BookImg'], $row['BookName'], $quantity, $quantity * $row['Price']);
                    $cart = array($newB);
                    $_SESSION['cart'] = $cart;
                }
            }
        } else {
            $username = $_SESSION['username'];
            $book = $_POST['book'];
            $quantity = $_POST['quantity'];

            $query = "Select * From cart Where UserId = '".$username."' And BookId = ".$book;
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            if(mysqli_num_rows($result) == 1){
                $query = "Update cart Set Quantity = Quantity + ".$quantity." Where UserId = '".$username."' And BookId = ".$book;
                $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
            } else {
                $query = "Insert Into cart(BookId, UserId, Quantity) Values (".$book.", '".$username."', ".$quantity.")";
                $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
            }
        }
    } else if ($_POST['show'] == 'allChk'){
        if(!isset($_SESSION['username'])){
            $cart = array();
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                $total = 0;

                foreach ($cart as $key => $row) {
                    $total = $total + $row[4];
                    print "<div class=\"row1\">";
                    print "<div class=\"column1 colA\">";
                    print "    <img src=\"Assets/images/".$row[1]."\" alt=\"Book Image\" class=\"mt20\" style = \"max-height:180px; width:auto; max-width: 90%;\">";
                    print "</div>";

                    print "<div class=\"column1 colA\">";
                    print "    <h3>".$row[3]." x ".$row[2]."</h3>";
                    print "</div>";

                    print "<div class=\"column1 colA\">";
                    print "    <h3 style=\"color: deepskyblue;\">Subtotal: $".$row[4]."</h3>";
                    print "</div>";
                    print "</div>";
                }

                print "<div class=\"mgCart\">";
                print "<h1 style=\"color: deepskyblue; text-align: left;\">Total Price: $".$total."</h1>";
                print "</div>";
            }
        } else {
            $username = $_SESSION['username'];
            $query = "Select B.BookId, B.BookImg, B.bookName, C.Quantity, B.Price * C.Quantity as SubTotal From cart as C Inner Join book as B on B.bookId = C.bookId Where UserId = '".$username."'";
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            $total = 0;
            
            while($row = mysqli_fetch_array($result)) {
                $total = $total + $row['SubTotal'];
                print "<div class=\"row1\">";
                print "<div class=\"column1 colA\">";
                print "    <img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" class=\"mt20\" style = \"max-height:180px; width:auto; max-width: 90%;\">";
                print "</div>";

                print "<div class=\"column1 colA\">";
                print "    <h3>".$row['Quantity']." x ".$row['bookName']."</h3>";
                print "</div>";

                print "<div class=\"column1 colA\">";
                print "    <h3 style=\"color: deepskyblue;\">Subtotal: $".$row['SubTotal']."</h3>";
                print "</div>";
                print "</div>";
            }

            print "<div class=\"mgCart\" style = \"margin-top: 15px;\">";
            print "<h1 style=\"color: deepskyblue; text-align: left;\">Total Price: $".$total."</h1>";
            print "</div>";
            
        }
    } else if ($_POST['show'] == 'all'){
        if(!isset($_SESSION['username'])){
            $cart = array();
            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];
                $total = 0;

                foreach ($cart as $key => $row) {
                    $total = $total + $row[4];
                    print "<div class=\"row1 whitebox1\">";
                    print "<div class=\"column1 colA\">";
                    print "    <img src=\"Assets/images/".$row[1]."\" alt=\"Book Image\" class=\"mt20\" style = \"max-height:180px; width:auto; max-width: 90%;\">";
                    print "</div>";

                    print "<div class=\"column1 colA\">";
                    print "    <h4>".$row[2]."</h4>";
                    print "    <br>";
                    print "    <br>";
                    print "    <br>";
                    print "    <h4 style=\"color: deepskyblue;\">Quantity: ".$row[3]."</h4>";
                    print "</div>";

                    print "<div class=\"column1 colA\">";
                    print "    <h4 style=\"color: deepskyblue;\">Subtotal: $".$row[4]."</h4>";
                    print "    <br>";
                    print "    <br>";
                    print "    <br>";
                    print "    <input type = \"button\" class = \"btn1\" id = \"".$row[0]."\" onclick = \"deleteBook(this.id)\" value = \"Delete\">";
                    print "</div>";
                    print "</div>";
                }

                print "<div class=\"mgCart\">";
                print "<h1 style=\"color: deepskyblue;\">Total Price: $".$total."</h1>";
                print "</div>";
            }
        } else {
            $username = $_SESSION['username'];
            $query = "Select B.BookId, B.BookImg, B.bookName, C.Quantity, B.Price * C.Quantity as SubTotal From cart as C Inner Join book as B on B.bookId = C.bookId Where UserId = '".$username."'";
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            $total = 0;
            
            while($row = mysqli_fetch_array($result)) {
                $total = $total + $row['SubTotal'];
                print "<div class=\"row1 whitebox1\">";
                print "<div class=\"column1 colA\">";
                print "    <img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" class=\"mt20\" style = \"max-height:180px; width:auto; max-width: 90%;\">";
                print "</div>";

                print "<div class=\"column1 colA\">";
                print "    <h4>".$row['bookName']."</h4>";
                print "    <br>";
                print "    <br>";
                print "    <br>";
                print "    <h4 style=\"color: deepskyblue;\">Quantity: ".$row['Quantity']."</h4>";
                print "</div>";

                print "<div class=\"column1 colA\">";
                print "    <h4 style=\"color: deepskyblue;\">Subtotal: $".$row['SubTotal']."</h4>";
                print "    <br>";
                print "    <br>";
                print "    <br>";
                print "    <input type = \"button\" class = \"btn1\" id = \"".$row['BookId']."\" onclick = \"deleteBook(this.id)\" value = \"Delete\">";
                print "</div>";
                print "</div>";
            }

            print "<div class=\"mgCart\">";
            print "<h1 style=\"color: deepskyblue;\">Total Price: $".$total."</h1>";
            print "</div>";
        }
    } else if ($_POST['show'] == 'del'){
        if(!isset($_SESSION['username'])){
            $cart = array();
            $book = $_POST['book'];

            if(isset($_SESSION['cart'])){
                $cart = $_SESSION['cart'];

                $rows = count($cart);
                for ($row = 0; $row < $rows; $row++) {
                    if($cart[$row][0] == $book){
                        unset($cart[$row]);
                    }
                }

                $_SESSION['cart'] = $cart;

                $total = 0;

                foreach ($cart as $key => $row) {
                    $total = $total + $row[4];
                    print "<div class=\"row1 whitebox1\">";
                    print "<div class=\"column1 colA\">";
                    print "    <img src=\"Assets/images/".$row[1]."\" alt=\"Book Image\" class=\"mt20\" style = \"max-height:180px; width:auto; max-width: 90%;\">";
                    print "</div>";

                    print "<div class=\"column1 colA\">";
                    print "    <h4>".$row[2]."</h4>";
                    print "    <br>";
                    print "    <br>";
                    print "    <br>";
                    print "    <h4 style=\"color: deepskyblue;\">Quantity: ".$row[3]."</h4>";
                    print "</div>";

                    print "<div class=\"column1 colA\">";
                    print "    <h4 style=\"color: deepskyblue;\">Subtotal: $".$row[4]."</h4>";
                    print "    <br>";
                    print "    <br>";
                    print "    <br>";
                    print "    <input type = \"button\" class = \"btn1\" id = \"".$row[0]."\" onclick = \"deleteBook(this.id)\" value = \"Delete\">";
                    print "</div>";
                    print "</div>";
                }

                print "<div class=\"mgCart\">";
                print "<h1 style=\"color: deepskyblue;\">Total Price: $".$total."</h1>";
                print "</div>";
            }
        } else {
            $username = $_SESSION['username'];
            $book = $_POST['book'];

            $query = "Delete From cart Where UserId = '".$username."' And BookId = ".$book;
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            $query = "Select B.BookId, B.BookImg, B.bookName, C.Quantity, B.Price * C.Quantity as SubTotal From cart as C Inner Join book as B on B.bookId = C.bookId Where UserId = '".$username."'";
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            $total = 0;
            
            while($row = mysqli_fetch_array($result)) {
                $total = $total + $row[SubTotal];
                print "<div class=\"row1 whitebox1\">";
                print "<div class=\"column1 colA\">";
                print "    <img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" class=\"mt20\" style = \"max-height:180px; width:auto; max-width: 90%;\">";
                print "</div>";

                print "<div class=\"column1 colA\">";
                print "    <h4>".$row['bookName']."</h4>";
                print "    <br>";
                print "    <br>";
                print "    <br>";
                print "    <h4 style=\"color: deepskyblue;\">Quantity: ".$row[Quantity]."</h4>";
                print "</div>";

                print "<div class=\"column1 colA\">";
                print "    <h4 style=\"color: deepskyblue;\">Subtotal: $".$row[SubTotal]."</h4>";
                print "    <br>";
                print "    <br>";
                print "    <br>";
                print "    <input type = \"button\" class = \"btn1\" id = \"".$row['BookId']."\" onclick = \"deleteBook(this.id)\" value = \"Delete\">";
                print "</div>";
                print "</div>";
            }

            print "<div class=\"mgCart\">";
            print "<h1 style=\"color: deepskyblue;\">Total Price: $".$total."</h1>";
            print "</div>";
        }
    } else if ($_POST['show'] == 'cVal'){
        if(isset($_SESSION['username'])){
            $query = "Select ifNull(Sum(Quantity), 0) as CartTot From cart Where UserId = '".$_SESSION['username']."'";
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
    
            while($row = mysqli_fetch_array($result)) {
                print "".$row['CartTot']."";
            }
        } else if (isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
            $total = 0;
    
            foreach ($cart as $key => $row) {
                $total = $total + $row[3];
            }
    
            print "".$total."";
        } else {
            print "0";
        }
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>