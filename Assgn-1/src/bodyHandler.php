<?php  if (count($errors) >= 0 && count($same) == 0 && count($confirm) == 0 && count($pass) == 0) : ?>
    <body>
<?php  endif ?>
<?php  if (count($confirm) > 0) : ?>
    <body onload = "callLogin()">
<?php  endif ?>
<?php  if (count($same) > 0) : ?>
    <body onload = "callCreate()">
<?php  endif ?>
<?php  if (count($pass) > 0) : ?>
    <body onload = "callMain()">
<?php  endif ?>