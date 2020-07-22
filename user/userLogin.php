<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<div class="main-container">
    <head>
        <title>User login</title>
        <link rel="stylesheet" text = "text/css" href="../stylesheets/pagesheet.css"> 
    </head>
    <H1>
        social relief program
        
    </H1>
        <body>  
                <form action="userLogin.php" method="POST">
                <p>Fill in details to login</p>
                    <input type="text" name="IdNumber" placeholder="Omang Number">
                    <span class="error">*</span><br><br>
                    <input type="text" name="password" placeholder="password">
                    <span class="error">*</span><br><br>
                    <input type="hidden" name="submit" value="TRUE">
                    <input type="submit" value="login">
                    <p>Don't have an account?<a href="./userRegister.php">register</a></p>
                </form>
                
<?php
/**
 * 
 */
require "../func/func.php";
require "../config.php";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //initialize variables and assign them data recieved from the html form.
    $Idnumber = intval(extraction($_POST["IdNumber"]));
    $password = extraction($_POST["password"]);
    if (empty($Idnumber) || empty($password)) {
        echo "omang number and password required to login.";
    } else {
        //prepare sql statement and bind.
        $sqlStatement = $conn->prepare("SELECT * FROM Users WHERE userID=? AND userPassword=?");
        $sqlStatement->bind_param("is", $I, $P);

        $I = $Idnumber;
        $P = $password;
        $result = mysqli_query($conn, $sqlStatement);
        $row = mysqli_fetch_array($result);

        if (mysqli_stmt_execute($sqlStatement)) {
            mysqli_stmt_store_result($sqlStatement);
            if (mysqli_stmt_num_rows($sqlStatement) == 1) {
                header("location:userDashboard.php");
            } else {
                echo "wrong password";
            } 
            
        }  
        $sqlStatement->close();
        $conn->close();

    }
    
    // 
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
