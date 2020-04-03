<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');

    $username = "";
    $conn = mysqli_connect('sophia.cs.hku.hk', 'tibrewal', 'KLIipPTB', 'tibrewal') or die ('Error! '.mysqli_connect_error($conn));
    $flag = TRUE;

    if (isset($_POST['register'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Please do not leave the fields empty");
        } else if (empty($password)){
            array_push($errors, "Please do not leave the fields empty");
        } else {
            $query = 'Select * From login Where UserId = \''.$_POST['username'].'\'';
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            if(mysqli_num_rows($result) > 0){
                mysqli_free_result($result);
                echo "<h1 class = \"hg\">Username Duplicated!</h1>";
                $flag = FALSE;
            }
        }

        if($flag == TRUE) {
            $query = 'Insert Into login (UserId, Pwd) Values (\''.$_POST['username'].'\', \''.$_POST['password'].'\')';
            $result = mysqli_query($conn, $query) or die ('Failed to query '.mysqli_error($conn));

            mysqli_free_result($result);
        }
    }
    
    mysqli_close($conn);
?>