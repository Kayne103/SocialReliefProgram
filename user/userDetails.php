<?php 
require "../func/func.php";
require "../config.php";
//require "userRegister.php";
?>
<!DOCTYPE html>
<html>
<div class="main-container">
    <head>
        <title>User Details</title>
        <link rel="stylesheet" text = "text/css" href="../stylesheets/pagesheet.css">  
    </head>
    <H1>
        social relief program 
    </H1>
        <body>  
                <form action="userDetails.php" method="POST">
                <p>Fill in details to register</p>
                    <input type="text" name="userID" placeholder="Omang number"><br><br>
                    <input type="text" name="employerDetails" placeholder="Employer e.g. government ,private, self, unemployed"><br><br>
                    
                    <input type="text" name="userlocation" placeholder="where do you stay?"><br><br>
                    
                    <input type="text" name="cellnumber" placeholder="cell number"><br><br>

                    <input type="text" name="sharedToilet" placeholder="Do you share a toilet? yes/no"><br><br>

                    Number of family members<br>
                    <input type="number" name="numberOfFamilyMembers" min="0" step="1" value="0"><br><br>
                    
                    salary<br>
                    <input type="number" name="salaryRange" min="0" step="200" value="0"><br><br>

                    <input type="hidden" name="submit" value="TRUE">
                    <input type="submit" value="Register">
                </form>
<?php
/**
 * 
 */
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //initialize variables and assign them data recieved from the html form.
    $Idnumber = intval(extraction($_POST["userID"]));
    $cellnumber = intval(extraction($_POST["cellnumber"]));
    $numberOfFamilyMembers = intval(extraction($_POST["numberOfFamilyMembers"]));
    $salaryRange = intval(extraction($_POST["salaryRange"]));
    $employerDetails = extraction($_POST["employerDetails"]);
    $userlocation = extraction($_POST["userlocation"]);
    $sharedToilet = extraction($_POST["sharedToilet"]); 
    
    //prepare sql statement and bind.
    $sqlStatement = $conn->prepare("INSERT INTO UserDetails (employerDetails,userLocation,cellNumber,sharedToilet,salaryRange,numberOfFamilyMembers,userID) VALUES (?,?,?,?,?,?,?)");
    $sqlStatement->bind_param("ssisiii", $ED, $UL, $CN, $ST, $SR, $NM, $UI);

    $ED = $employerDetails;
    $UL = $userlocation;
    $CN = $cellnumber;
    $ST = $sharedToilet;
    $SR = $salaryRange;
    $NM = $numberOfFamilyMembers;
    $UI = $Idnumber;

    if ($sqlStatement->execute()) {//returns true if the statement was executed.
        echo "1 record added";
        header("location:userDashboard.php");        
    } else {
        die("error".mysqli_error($conn));
    }
    $sqlStatement->close();
    $conn->close();

    
}

?>
        </body>
        <div>
            <footer id="footer">
            <a href="../index.php">home</a>
            </footer>
        </div>
    
</div><!-— /.main-container-->
</html>

