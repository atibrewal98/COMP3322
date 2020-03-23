<?php include('create.php') ?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>

    <?php include('bodyHandler.php') ?>
        <div class = "whitebox">
            <h1 class = "heading">ANKIT'S BOOKSTORE - CREATE ACCOUNT</h1>
            <?php include('errorDisplay.php') ?>
            <form action = "createAcc.php" method = "POST">
                <input type = "text" id = "lname" class = "inp1" name = "username" placeholder = "Desired Username"> <br>
                <input type = "password" id = "lpwd" class = "inp1" name = "password" placeholder = "Desired Password"> <br>
                <input type = "submit" id = "lsub" name = "register" class = "btn" value = "CONFIRM">
                <input type = "button" id = "lcr" class = "btn" value = "BACK">
            </form>
        </div>


        <script type = "text/javascript">
            document.getElementById("lcr").onclick = function () {
                window.location.href = "login.php";
            }

            function callLogin(){
                setTimeout(() => {
                    window.location.href = "login.php";
                }, 3000);
            }

            function callCreate(){
                setTimeout(() => {
                    window.location.href = "createAcc.php";
                }, 3000);
            }
        </script>
    </body>
</html>