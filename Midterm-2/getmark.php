<?php 
    $conn = mysqli_connect('sophia.cs.hku.hk', 'c1111a', 'sudoku', 'c1111a') or  http_response_code(405);;

    $query = 'select stdName, stdNumber, assign1, assign2, midterm, exam from gradebook';
    $result = mysqli_query($conn, $query) or http_response_code(405);

    if (mysqli_num_rows($result) > 0) { 
        $records = array();

        while($row = mysqli_fetch_array($result)) {
            $records[] = array("stdName" => $row['stdName'], "stdNumber" => $row['stdNumber'], "assign1" => $row['assign1'], "assign2" => $row['assign2'], "midterm" => $row['midterm'], "exam" => $row['exam']);
        }

        echo json_encode($records);
    }
 ?>