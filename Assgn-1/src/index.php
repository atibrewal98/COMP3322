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
            <input type = "button" class = "btn1" id = "cart" value = "Cart" onclick = "window.location.href = 'cart.php'">
            <?php include('cartNum.php') ?>
        </div>

        <hr>

        <div class="row">
            <div class="column left">
                <h1>Category</h1>
                <ul id = "cList">
                </ul>
            </div>

            <div class="column right">
                <div>
                    <a class = "hLink" href = "index.php">Home</a>
                    <span class = "txt1" id = "hSep" style="visibility: hidden;"> > </span> 
                    <a class = "hLink" id = "sLink" href = "javascript:void(0)" style="visibility: hidden;"></a>

                    <h1 id = "pHeading">All Books</h1>

                    <input type = "button" class = "btn1 aRight" id = "sLow" value = "Sort by Price (Lowest)">
                </div>

                <br>
                
                <div id = "entries" class = "mt20">
                </div>
            </div>
        </div>

        <hr>

        <script type = "text/javascript">
            window.onload = function() {
                showAll();
                showCategory();
            }
            

            //Logout
            function handleLogout(){
                window.location.href = "logout.php?logout='1'"
            }


            //Open Book Page
            function viewBook(elem){
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.open("POST", "main.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=bookD&book="+elem);

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        window.location.href = "productPage.php";
                    }
                }
            }

            // Show All Books
            function showAll(){
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("entries");
                        mesgs.innerHTML = xmlhttp.responseText;
                    }
			    }
                xmlhttp.open("POST", "main.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=all");
            }



            // Show All Distinct Category
            function showCategory(){
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("cList");
                        mesgs.innerHTML = xmlhttp.responseText;
                    }
			    }
                xmlhttp.open("POST", "main.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=allC");
            }
            

            //Search Button
            document.getElementById("sbtn").onclick = function () {
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("entries");
                        mesgs.innerHTML = xmlhttp.responseText;
                        document.getElementById("pHeading").innerHTML = "Searching Resuts";
                    }
			    }
                xmlhttp.open("POST", "main.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=search&keyword="+document.getElementById("sbar").value);
            }



            //Sort by Price Button
            document.getElementById("sLow").onclick = function () {
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("entries");
                        mesgs.innerHTML = xmlhttp.responseText;
                        document.getElementById("pHeading").innerHTML = "All Books (Sort by Price Lowest)";
                    }
			    }
                xmlhttp.open("POST", "main.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=sort");
            }



            //Filter Books By Category
            function filterC(elem) {
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("entries");
                        mesgs.innerHTML = xmlhttp.responseText;
                        document.getElementById("pHeading").innerHTML = "All " + elem.innerHTML;
                        document.getElementById("hSep").style.visibility = "visible";
                        document.getElementById("sLink").innerHTML = elem.innerHTML;
                        document.getElementById("sLink").style.visibility = "visible";
                    }
			    }
                xmlhttp.open("POST", "main.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=filterC&category="+elem.innerHTML);
            }
        </script>
    </body>
</html>