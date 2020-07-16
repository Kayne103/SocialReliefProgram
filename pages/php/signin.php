<?php
/**
 * 
 */
require "func/func.php";
require "config.php";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //initialize variables and assign them data recieved from the html form.
    $Idnumber = intval(extraction($_POST["IdNumber"]));
    $firstname = extraction($_POST["fname"]);
    $surname = extraction($_POST["Sname"]);
    $password = extraction($_POST["password"]);
    //echo $firstname." ".$surname." ".$Idnumber." ".$password;
    
    //prepare sql statement and bind.
    $sqlStatement = $conn->prepare("INSERT INTO Users (username,usersurname,userID,userPassword) VALUES (?,?,?,?)");
    $sqlStatement->bind_param("ssis", $F, $S, $I, $P);

    $F = $firstname;
    $S = $surname;
    $I = $Idnumber;
    $P = $password;


    if ($sqlStatement->execute()) {
                echo "1 record added";
    } else {
        die("error".mysqli_error($conn));
    }
    $sqlStatement->close();
    $conn->close();

    header("refresh:1;url=userDashboard.html");
}

?>
