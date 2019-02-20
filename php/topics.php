<?php
include('config.php');

//Generates topic list
$sql = "SELECT id,name FROM topics";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option>" . $row["name"] . "</option>" . "<br>";
    }
}

$conn->close();
?>