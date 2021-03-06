<?php include('verifyLogin.php') ?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>

    <?php include('bodyHandler.php') ?>

        <div class = "center">
            <input type = "text" class = "searchbox" id = "sbar" placeholder = "Keyword(s)">
            <input type = "button" class = "btn1" id = "sbtn" value = "Search" onclick = "window.location.href = 'main.php?show=s&search='+document.getElementById('sbar').value">
        </div>
        
        <div class = "btns">
            <span class = "txt" id = "sgn_in" onclick= "window.location.href = 'login.php'">Sign In</span>
            <span class = "txt" id = "rgstr" onclick= "window.location.href = 'createAcc.php'">Register</span>
            <input type = "button" class = "btn1" id = "cart" value = "Cart" onclick = "window.location.href = 'cart.php'">
            <?php include('cartNum.php') ?>
        </div>

        <div class = "whitebox">
            <h1 class = "heading">ANKIT'S BOOKSTORE - LOGIN</h1>
            <?php include('errorDisplay.php') ?>
            <form action = "login.php" method = "POST">
                <input type = "text" id = "lname" class = "inp1" name = "username" placeholder = "Username"> <br>
                <input type = "password" id = "lpwd" class = "inp1" name = "password" placeholder = "Password"> <br>
                <input type = "submit" id = "lsub" name = "login" class = "btn" value = "SUBMIT">
                <input type = "button" id = "lcr" class = "btn" value = "CREATE">
            </form>
        </div>


        <script type = "text/javascript">
            document.getElementById("lcr").onclick = function () {
                window.location.href = "createAcc.php";
            }

            function callLogin(){
                setTimeout(() => {
                    window.location.href = "login.php";
                }, 3000);
            }

            
        </script>
    </body>
</html>