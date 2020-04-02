<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>
    <body>
        <div class = "center">
            <input type = "text" class = "searchbox" id = "sbar" placeholder = "Keyword(s)">
            <input type = "button" class = "btn1" id = "sbtn" value = "Search">
        </div>

        <div class = "btns">
            <?php
                session_start();

                if(!isset($_SESSION['username'])){
                    echo "<span class = \"txt\" id = \"sgn_in\" onclick= \"window.location.href = 'login.php'\">Sign In</span>";
                    echo "<span class = \"txt\" id = \"rgstr\" onclick= \"window.location.href = 'createAcc.php'\">Register</span>";
                } else {
                    echo "<span class = \"txt\" id = \"logout\" onclick= \"handleLogout()\">Logout</span>";
                }
            ?>
                <input type = "button" class = "btn1" id = "cart" value = "Cart">
            <sup class = "cVal" id = "cartVal">0</sup>
        </div>

        <hr>

        <div class="row">
            <div class="column left1">
                <div>
                    <a class = "hLink" href = "index.php">Home</a>
                    <span class = "txt1" id = "hSep"> > </span>
                    <?php
                        if(isset($_COOKIE['Book_Details'])){
                            echo "<a class = \"hLink\" id = \"sLink\" href = \"javascript:void(0)\">".$_COOKIE['Book_Details']."</a>";
                        }
                    ?>
                </div>

                <?php
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
                    header('Access-Control-Allow-Headers: token, Content-Type');
                    header('Access-Control-Max-Age: 1728000');
                
                    $conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));
                    if(isset($_COOKIE['Book_Details'])){
                        $query = 'select * from book Where BookName Like \''.$_COOKIE['Book_Details'].'%\'';
                        $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));
                    }

                    while($row = mysqli_fetch_array($result)){
                        echo "<img src=\"Assets/images/".$row['BookImg']."\" alt=\"Book Image\" class=\"mt20\" style = \"max-width: 90%;\">";
                        echo "</div>";
                        echo "<div class=\"column right1\">";
                        echo "<h1>".$row['BookName']."</h1>";
                        echo "<h4>Author: ".$row['Author']."</h4>";
                        echo "<h4>Published: ".$row['Published']."</h4>";
                        echo "<h4>Publisher: ".$row['Publisher']."</h4>";
                        echo "<h4>Category: ".$row['Category']."</h4>";
                        echo "<h4>Language: ".$row['Lang']."</h4>";
                        echo "<h4>Description: ".$row['Description']."</h4>";
                        echo "<h4>Price: $".$row['Price']."</h4>";
                        echo "<p id = \"bName\" style = \"visibility: hidden;\">".$row['BookId']."</p>";
                    }

                    mysqli_free_result($result);
	                mysqli_close($conn);
                ?>
                
                <input type = "number" min="1" value="1" class = "cartInp" id = "cbar">
                <input type = "button" class = "btn1" id = "cbtn" value = "Add to Cart">
            </div>
        </div>

        <script type = "text/javascript">
            function handleLogout(){
                window.location.href = "logout.php?logout='1'"
            }

            document.getElementById("cbtn").onclick = function () {
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.open("POST", "addCart.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=add&book="+document.getElementById("bName").innerHTML+"&quantity="+document.getElementById("cbar").value);

                console.log(document.getElementById("bName").innerHTML)

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("cbar").value = 1;
                        window.location.href = "cart.php";
                    }
                }
            }
        </script>
    </body>
</html>