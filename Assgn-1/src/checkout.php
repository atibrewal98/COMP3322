<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Store</title>
        <link rel= "stylesheet" type= "text/css"  href= "Assets/styles.css">
    </head>
    <body>
        <?php session_start(); if (!isset($_SESSION['username'])) : ?>
            <div class = "row" style="display: flex;">
                <div class = "column whitebox" style="flex-basis: 400px;">
                    <h3>New Customer</h3>
                    <input type = "button" id = "lBack" class = "btn" value = "Fast Checkout" onclick=" document.getElementById('cForm').style.visibility = 'visible';">
                </div>

                <div class = "column whitebox" style="flex-basis: 400px;">
                    <h3>Existing Customer</h3>
                    <input type = "button" id = "lBack" class = "btn" value = "Sign In" onclick="window.location.href = 'login.php'">
                </div>
            </div>

            <br>

            <div class = "whitebox" id = "cForm" style="visibility: hidden;">
        

                <h1 class = "heading">ANKIT'S BOOKSTORE - CREATE ACCOUNT</h1>

                <div id = "accErr">

                </div>

                <div class = "row">
                    <div class = "column leftF">
                        <label for="username" class = "mr10">Username</label>
                    </div>
                    <div class = "column rightF">
                        <input type = "text" id = "lname" class = "inp2" name = "username" placeholder = "Desired Username"> <br>
                    </div>  
                </div>

                <div class = "row">
                    <div class = "column leftF">
                        <label for="password" class = "mr10">Password</label>
                    </div>
                    <div class = "column rightF">
                        <input type = "password" id = "lpwd" class = "inp2" name = "password" placeholder = "Desired Password"> <br>
                    </div>  
                </div>


                <br>
            
            <?php  endif ?>

            <?php session_start(); if (isset($_SESSION['username'])) : ?>

                <div class = "whitebox" id = "cForm">

            <?php  endif ?>

            <h1 class = "heading">Delivery Address</h1>

            <div class = "row">
                <div class = "column leftF">
                    <label for="fName" class = "mr10">Full Name</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "fname" class = "inp2" name = "username" placeholder = "Required"> <br>
                </div>  
            </div>

            <div class = "row">
                <div class = "column leftF">
                    <label for="cName" class = "mr10">Company Name</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "cname" class = "inp2" name = "password"> <br>
                </div>  
            </div>

            <div class = "row">
                <div class = "column leftF">
                    <label for="addr1" class = "mr10">Address Line 1</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "addrL1" class = "inp2" name = "address1" placeholder = "Required"> <br>
                </div>  
            </div>
            
            <div class = "row">
                <div class = "column leftF">
                    <label for="addr2" class = "mr10">Address Line 2</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "addrL2" class = "inp2" name = "address2"> <br>
                </div>  
            </div>

            <div class = "row">
                <div class = "column leftF">
                    <label for="city" class = "mr10">City</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "lCity" class = "inp2" name = "city" placeholder = "Required"> <br>
                </div>  
            </div>

            <div class = "row">
                <div class = "column leftF">
                    <label for="reg" class = "mr10">Region/State/District</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "lReg" class = "inp2" name = "region"> <br>
                </div>  
            </div>

            <div class = "row">
                <div class = "column leftF">
                    <label for="country" class = "mr10">Country</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "lCountry" class = "inp2" name = "country" placeholder = "Required"> <br>
                </div>  
            </div>
            
            <div class = "row">
                <div class = "column leftF">
                    <label for="zip" class = "mr10">Postcode/ Zip Code</label>
                </div>
                <div class = "column rightF">
                    <input type = "text" id = "lZip" class = "inp2" name = "zipcode" placeholder = "Required"> <br>
                </div>  
            </div>

            <br>
            <hr>

            <h4 style = "text-align: left;">Your Order (<a href = "cart.php">Change</a>)</h4>
            <h4 style = "text-align: left; color: deepskyblue;">Free Standard Shipping</h4>

            <div id = "cEntries">
                
            </div>

            <?php session_start(); if (isset($_SESSION['username'])) : ?>

                <input type = "button" id = "lConf" class = "btn" value = "Confirm" onclick = "genInvoice()">

            <?php  endif ?>

            <?php session_start(); if (!isset($_SESSION['username'])) : ?>

                <input type = "button" id = "lConf" class = "btn" value = "Confirm" onclick = "genInvoiceFull()">

            <?php  endif ?>
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
                xmlhttp.send("show=allChk");
            }

            //Generate Invoice - Logged In User
            function genInvoice(){
                let sname = document.getElementById("fname");
                if (sname.validity.valueMissing || sname.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    sname.focus();
                    return;
                }

                let scname = document.getElementById("cname");
                if (scname.validity.valueMissing || scname.value.trim() == '') {
                    scname = 'NA';
                } else {
                    scname = scname.value;
                }

                let saddress1 = document.getElementById("addrL1");
                if (saddress1.validity.valueMissing || saddress1.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    saddress1.focus();
                    return;
                }

                let saddress2 = document.getElementById("addrL2");
                if (saddress2.validity.valueMissing || saddress2.value.trim() == '') {
                    saddress2 = 'NA';
                } else {
                    saddress2 = saddress2.value;
                }

                let scity = document.getElementById("lCity");
                if (scity.validity.valueMissing || scity.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    scity.focus();
                    return;
                }

                let sregion = document.getElementById("lReg");
                if (sregion.validity.valueMissing || sregion.value.trim() == '') {
                    sregion = 'NA';
                } else {
                    sregion = sregion.value;
                }

                let scountry = document.getElementById("lCountry");
                if (scountry.validity.valueMissing || scountry.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    scountry.focus();
                    return;
                }

                let szip = document.getElementById("lZip");
                if (szip.validity.valueMissing || szip.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    szip.focus();
                    return;
                }

                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
            
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        window.location.href = 'invoice.php';
                    }
			    }
                xmlhttp.open("POST", "invoiceHandler.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("show=invoice&name="+sname.value+"&comp="+scname+"&add1="+saddress1.value+"&add2="+saddress2+"&city="+scity.value+"&reg="+sregion+"&cntry="+scountry.value+"&zip="+szip.value);
            }

            //Generate Invoice - Fastrack Checkout
            function genInvoiceFull(){
                let suname = document.getElementById("lname");
                if (suname.validity.valueMissing || suname.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    suname.focus();
                    return;
                }

                let spwd = document.getElementById("lpwd");
                if (spwd.validity.valueMissing || spwd.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    spwd.focus();
                    return;
                }

                let sname = document.getElementById("fname");
                if (sname.validity.valueMissing || sname.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    sname.focus();
                    return;
                }

                let scname = document.getElementById("cname");
                if (scname.validity.valueMissing || scname.value.trim() == '') {
                    scname = 'NA';
                } else {
                    scname = scname.value;
                }

                let saddress1 = document.getElementById("addrL1");
                if (saddress1.validity.valueMissing || saddress1.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    saddress1.focus();
                    return;
                }

                let saddress2 = document.getElementById("addrL2");
                if (saddress2.validity.valueMissing || saddress2.value.trim() == '') {
                    saddress2 = 'NA';
                } else {
                    saddress2 = saddress2.value;
                }

                let scity = document.getElementById("lCity");
                if (scity.validity.valueMissing || scity.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    scity.focus();
                    return;
                }

                let sregion = document.getElementById("lReg");
                if (sregion.validity.valueMissing || sregion.value.trim() == '') {
                    sregion = 'NA';
                } else {
                    sregion = sregion.value;
                }

                let scountry = document.getElementById("lCountry");
                if (scountry.validity.valueMissing || scountry.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    scountry.focus();
                    return;
                }

                let szip = document.getElementById("lZip");
                if (szip.validity.valueMissing || szip.value.trim() == '') {
                    alert("Please do not leave the fields empty");
                    szip.focus();
                    return;
                }

                var xmlhttp;
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();
                } else {
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var mesgs = document.getElementById("accErr");
                        mesgs.innerHTML = xmlhttp.responseText;
                        if(xmlhttp.responseText != ''){
                            document.getElementById("lname").value = "";
                            suname.focus();
                        } else{
                            genInvoice();
                        }
                    }
			    }
            
                xmlhttp.open("POST", "checkDetails.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("register=type&username="+suname.value+"&password="+spwd.value);
            }
        </script>
    </body>
</html>