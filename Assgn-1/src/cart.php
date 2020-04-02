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
                    echo "<span class = \"txt\" id = \"sgn_in\" onclick= \"window.location.href = 'login.php?type=\'cart\''\">Sign In</span>";
                    echo "<span class = \"txt\" id = \"rgstr\" onclick= \"window.location.href = 'createAcc.php'\">Register</span>";
                } else {
                    echo "<span class = \"txt\" id = \"logout\" onclick= \"handleLogout()\">Logout</span>";
                }
            ?>
                <input type = "button" class = "btn1" id = "cart" value = "Cart">
            <sup class = "cVal" id = "cartVal">0</sup>
        </div>

        <hr>

        <h1 class = "heading">My Shopping Cart</h1>
        <div id = "cEntries">
            
        </div>

        <div class = "mgCart">
            <input type = "button" id = "lBack" class = "btn" value = "Back">
            <input type = "button" id = "lCheck" class = "btn" value = "Checkout">
        </div>

        <script type = "text/javascript">
        window.onload = function() {
                showAll();
            }

            // Show All Cart Items
            function showAll(){
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("cEntries");
                        mesgs.innerHTML = xmlhttp.responseText;
                    }
			    }
                xmlhttp.open("POST", "addCart.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=all");
            }

            //Delete Cart Item
            function deleteBook(elem){
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.open("POST", "addCart.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=del&book="+elem);

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("cEntries");
                        mesgs.innerHTML = xmlhttp.responseText;
                    }
                }
            }

            // Go Back to Main Page
            document.getElementById("lBack").onclick = function () {
                window.location.href = "index.php";
            }

            //Handle User Logout
            function handleLogout(){
                window.location.href = "logout.php?logout='1'"
            }
        </script>
    </body>
</html>