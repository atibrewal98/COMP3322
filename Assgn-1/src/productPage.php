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

        <hr>

        <div class="row">
            <div class="column left1">
                <div>
                    <a class = "hLink" href = "main.html">Home</a>
                    <span class = "txt1" id = "hSep"> > </span> 
                    <a class = "hLink" id = "sLink" href = "javascript:void(0)">The Creature Choir</a>
                </div>
                <img src="Assets/images/book_1.jpeg" alt="Book Image" class="mt20">
            </div>

            <div class="column right1">
                <h1>The Creature Choir</h1>
                <h4>Author: </h4>
                <h4>Published: </h4>
                <h4>Publisher: </h4>
                <h4>Category: </h4>
                <h4>Language: </h4>
                <h4>Description: </h4>
                <h4>Price: </h4>
                <input type = "number" min="1" value="1" class = "cartInp" id = "cbar">
                <input type = "button" class = "btn1" id = "sbtn" value = "Add to Cart">
            </div>
        </div>
    </body>
</html>