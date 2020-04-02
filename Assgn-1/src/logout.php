<?php 
    session_start(); 

    if (isset($_GET['logout'])) {
        unset($_SESSION['username']);
    }
?>
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
            <span class = "txt" id = "sgn_in" onclick= "window.location.href = 'login.php'">Sign In</span>
            <span class = "txt" id = "rgstr" onclick= "window.location.href = 'createAcc.php'">Register</span>
            <input type = "button" class = "btn1" id = "cart" value = "Cart">
            <sup class = "cVal" id = "cartVal">0</sup>
        </div>

        <div class = "whitebox">
            <h1 class = "hg">Logging out</h1>
        </div>


        <script type = "text/javascript">
            window.onload = function(){
                setTimeout(() => {
                    window.location.href = "index.php";
                }, 3000);
            }
        </script>
    </body>
</html>