<?php

require "config.php";
require "userlogin.php";

$sqlStatement = $conn->prepare("SELECT UFname, surname,age,Idnumber FROM UserFamily WHERE userID = ?");
$sqlStatement->bind_param("i", $I);

$I = $_SESSION["userID"];
$result = $conn->query($sqlStatement);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>