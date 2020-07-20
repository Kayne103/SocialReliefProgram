<?php
/**
 * 
 */
session_start();
require "func/func.php";
require "config.php";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //initialize variables and assign them data recieved from the html form.
    $Idnumber = intval(extraction($_POST["IdNumber"]));
    $password = extraction($_POST["password"]);
    //prepare sql statement and bind.
    $sqlStatement = $conn->prepare("SELECT * FROM Users WHERE userID=? AND userPassword=?");
    $sqlStatement->bind_param("is", $I, $P);

    $I = $Idnumber;
    $P = $password;
    $result = $conn->query($sqlStatement);

    if ($result->num_rows>0) {
                echo "login successful";
                $_SESSION["userID"] = $I;
    } else {
        die("error".mysqli_error($conn));
    }
    $sqlStatement->close();
    $conn->close();

    header("refresh:1;url=../userDashboard.html");
}

?>
