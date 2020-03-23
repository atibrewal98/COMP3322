<?php include('verifyLogin.php') ?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>

    <?php include('bodyHandler.php') ?>
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

            function callMain(){
                window.location.href = "main.php";
            }

            function callLogin(){
                setTimeout(() => {
                    window.location.href = "login.php";
                }, 3000);
            }
        </script>
    </body>
</html>