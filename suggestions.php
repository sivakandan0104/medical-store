<?php
include("mysqlconn.php");

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $sql = "SELECT name FROM medicine WHERE name LIKE '%$query%'";
    $result = $conn->query($sql);

    $counter = 0; // Initialize counter

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($counter < 7) { 
                echo "<p class='suggestion'>" . $row['name'] . "</p>";
                $counter++; 
            } else {
                break; 
            }
        }
    } else {
        echo "<p class='no-suggestions'>No medicine found</p>";
    }
    exit; 
}
?>
