<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>
    <body>

        <div class = "whitebox" id = "cForm">
            <h1 class = "heading">Customer Invoice</h1>

            <div id = "iEntries">

            </div>

            <br>

            <div id = "cEntries">
                
            </div>

            <hr>

            <h1 style = "color: deepskyblue;" class = "heading">Thanks for ordering. Your books will be delivered within 7 working days.</h1>

            <input type = "button" id = "lConf" class = "btn" value = "Ok" onclick = "handleDel()">
        </div>


        <script type = "text/javascript">
            window.onload = function() {
                showAll();
                showInv();
            }

            function showInv(){
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("iEntries");
                        mesgs.innerHTML = xmlhttp.responseText;
                    }
			    }
                xmlhttp.open("POST", "invoiceHandler.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=invoiceAll");
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
                xmlhttp.send("show=allChk");
            }

            function handleDel(){
                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        window.location.href = 'index.php';
                    }
			    }
                xmlhttp.open("POST", "invoiceHandler.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=delCart");
            }
        </script>
    </body>
</html>