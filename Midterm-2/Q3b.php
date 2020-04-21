<?php 
    $conn = mysqli_connect('sophia.cs.hku.hk', 'c1111a', 'sudoku', 'c1111a') or  http_response_code(405);;

    $query = 'select stdName, stdNumber, ifnull(assign1, 0) * 0.15 + ifnull(assign2, 0) * 0.15 + ifnull(midterm, 0) * 0.2 + ifnull(exam, 0) * 0.5 as [Final Score] from gradebook';
    $result = mysqli_query($conn, $query) or http_response_code(405);
    echo "<table border=1 width=600 align='center'>";
    echo "<tr>";
    echo "<th>stdName</th>";
    echo "<th>stdNumber</th>";
    echo "<th>Final Score</th>";
    echo "</tr>";
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$row['stdName']."</td>";
        echo "<td>".$row['stdNumber']."</td>";
        echo "<td>".$row['Final Score']."</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
 ?>