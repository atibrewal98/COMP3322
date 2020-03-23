<?php include('create.php') ?>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>

    <body>
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
            document.getElementById("lsub").addEventListener('click', submitLogin);
            document.getElementById("lcr").onclick = function () {
                window.location.href = "index.html";
            }

            window.onload = function() {
                console.log("Loaded");
                let hg = document.getElementById("msg");
                if(hg){
                    setTimeout(() => {
                        console.log("0");
                        <?php
                            setcookie("Test", "Account already existed", time() - (3600), "/");
                        ?>
                        console.log("1");
                        window.location.href = "createAcc.php";
                    }, 3000);
                }
            }

            // function submitLogin(){
            //     let sname = document.getElementById("lname");
            //     if (sname.validity.valueMissing || sname.value.trim() == '') {
            //         alert("Please do not leave the fields empty");
            //         sname.focus();
            //         return;
            //     }

            //     let spwd = document.getElementById("lpwd");
            //     if (spwd.validity.valueMissing || spwd.value.trim() == '') {
            //         alert("Please do not leave the fields empty");
            //         spwd.focus();
            //         return;
            //     }

            //     var xmlhttp;
            //     if (window.XMLHttpRequest) {
            //         xmlhttp = new XMLHttpRequest();
            //     } else {
            //         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            //     }

            //     xmlhttp.open("POST", "create.php", true);
            //     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            //     xmlhttp.send("username="+sname.value+"&password="+spwd.value);

            //     xmlhttp.onreadystatechange = function () {
            //         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //             document.getElementById("lname").value = "";
            //             document.getElementById("lpwd").value = "";
            //         }
			//     }
            // }
        </script>
    </body>
</html>