<html>
    <head>
        <meta charset="utf-8"/>
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>

    <body>
        <div class = "whitebox">
            <?php
                if(isset($_SESSION["error"])){
                    $error = $_SESSION["error"];
                    echo "<h1>$error</h1>";
                }
            ?>  
        </div>


        <script type = "text/javascript">
            window.onload = function() {
			    setTimeout(() => {
                    window.location.href = "createAcc.html";
                }, 3000);
		    }
        </script>
    </body>
</html>