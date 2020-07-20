<!DOCTYPE html>
<html>
<div class="main-container">
    <head>
        <title>User register</title>
        <link rel="stylesheet" text = "text/css" href="../stylesheets/pagesheet.css"> 
    </head>
    <H1>
        social relief program
        <p>Fill in details</p>
    </H1>
        <body>  
                <form action="userDetails.php" method="POST">
                    
                    <div><input type="text" name="cellNumber" placeholder="cell number">
                    <span class="error">* <?php echo $celNumberEr;?></span><br><br>
                    
                    <input type="text" name="userlocation" placeholder="where do you stay?">
                    <span class="error">* <?php echo $userlocationEr;?></span><br><br>
                 
                    <input type="text" name="employerDetails" placeholder="Where do you work?">
                    <span class="error">* <?php echo $employerDetailsEr;?></span><br><br>
                    Do you share a toilet?
                    <input type="radio" name="sharedToilet" id="no" value="no">
                    <label for="no">no</label>
                    <input type="radio" name="sharedToilet" id="yes" value="yes">
                    <label for="yes">yes</label>
                    <span class="error">* <?php echo $shareToiletEr;?> </span><br><br>

                    <label for="salaryRange">salary range:</label>
                    <input type="number" id="salaryRange" name="salaryRange" min="0" max="100000" step="200" value="0"><br><br>
                    
                    <input type="hidden" name="submit" value="TRUE">
                    <input type="submit" value="submit"></div>
                </form>
        </body>
        <div>
            <footer id="footer">
            <a href="https://github.com/kayne103">Kayne103</a>
            </footer>
        </div>
    
</div><!-— /.main-container-->
<?php 


require "../config.php";
require "../user/signin.php";

$cellNumber = "";
$userLocation = "";
$employerDetails = "";
$shareToilet = "";

//
$cellNumberEr = "";
$userLocationEr = "";
$employerDetailsEr = "";
$shareToiletER = "";


if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //initialize variables and assign them data recieved from the html form.
    if (empty($_POST["cellNumber"])) {
        $cellNumberEr = "cell number is required";
    } else {
        $cellNumber = intval(extraction($_POST["cellNumber"]));
    }
    if (empty($_POST["userlocation"])) {
        $userLocationEr = "location is required";
    } else {
        $userLocation = extraction($_POST["userlocation"]);
    }
    if (empty($_POST["employerDetails"])) {
        $employerDetailsEr = "employer details is required";
    } else {
        $employerDetails = extraction($_POST["employerDetails"]);
    }
    if (empty($_POST["sharedToilet"])) {
        $shareToiletER = "required";
    } else {
        $shareToilet = extraction($_POST["sharedToilet"]);
    }
    $salaryRange = intval(extraction($_POST["salaryRange"]));

    //prepare sql statement and bind.
    $sqlStatement = $conn->prepare("INSERT INTO UserDetails (employeeDetails,userlocation,cellNumber,sharedToilet,salaryRange,userID) VALUES (?,?,?,?,?,?)");
    $sqlStatement->bind_param("ssisii", $UDs, $UL, $CN, $ST, $SR, $UD);

    $UDs = $employerDetails;
    $UL = $userLocation;
    $CN = $cellNumber;
    $ST = $shareToilet;
    $SR = $salaryRange;
    $UD = $_SESSION["userID"];


    if ($sqlStatement->execute()) {
                echo "1 record added";
    } else {
        die("error".mysqli_error($conn));
    }
    $sqlStatement->close();
    $conn->close();

    //header("refresh:1;url=userDetails.php");
}
?>
</html>
