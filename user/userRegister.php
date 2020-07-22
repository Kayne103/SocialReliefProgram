<?php 
require "../func/func.php";
require "../config.php";
?>
<!DOCTYPE html>
<html>
<div class="main-container">
    <head>
        <title>User register</title>
        <link rel="stylesheet" text = "text/css" href="../stylesheets/pagesheet.css"> 
    </head>
    <H1>
        social relief program
    </H1>
        <body>  
                <form action="userRegister.php" method="POST">
                <p>Fill in details to register</p>
                <p>* required</p>
                    <input type="text" name="IdNumber" placeholder="Omang number"><span class="error">*</span><br><br>
                    
                    <input type="text" name="fname" placeholder="first name"><span class="error">*</span><br><br>
                    
                    <input type="text" name="Sname" placeholder="surname"><span class="error">*</span><br><br>
                    
                    <input type="text" name="password" placeholder="password"><span class="error">*</span><br><br>
        
                    <input type="hidden" name="submit" value="TRUE">
                    <input type="submit" value="Register">
                    <p>Already have an account?<a href="./userLogin.php">login</a></p>
                </form>
<?php
/**
 * 
 */
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //initialize variables and assign them data recieved from the html form.
    $Idnumber = intval(extraction($_POST["IdNumber"]));
    $firstname = extraction($_POST["fname"]);
    $surname = extraction($_POST["Sname"]);
    $password = extraction($_POST["password"]);
    
    if (empty($Idnumber) || empty($password)) {
        echo "fill in all spaces";
    } else {
        //prepare sql statement and bind.
        $sqlStatement = $conn->prepare("INSERT INTO Users (username,usersurname,userID,userPassword) VALUES (?,?,?,?)");
        $sqlStatement->bind_param("ssis", $F, $S, $I, $P);

        $F = $firstname;
        $S = $surname;
        $I = $Idnumber;
        $P = $password;

        if ($sqlStatement->execute()) {
            echo "1 record added";
            header("location:userDetails.php");
        } else {
            die("error".mysqli_error($conn));
        }
        $sqlStatement->close();
        $conn->close();
    }

    
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

