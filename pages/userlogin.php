<!DOCTYPE html>
<head>
    <title>Admin login</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
</head>
<body>
        
        <p>Fill in id number & password to login</p>
        <form action="userlogin.php" method="post">
                <label>id number</label>
                <input type="text" name="IDnumber"><br>
            
                <label>password</label>
                <input type="text" name="password"><br>
                <input type="hidden" name="submit" value="TRUE">
                <input type="submit" value="Login">
           
        </form>   
        <?php 
            require_once "config.php";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty(trim($_POST["IDnumber"])) || empty(trim($_POST["password"]))) {
                        echo "empty username, password\n";
                    } else {
                        echo "username : ".$_POST["IDnumber"];
                        echo "password : ".$_POST["password"];
                        //$sql = "SELECT adminName,password FROM Admin";
                       // $result = $conn->query($sql);

                        //if ($result->num_rows > 0) {
                           // session_start();
                           // echo "username : ".$_POST["IDnumber"];
                            //echo "password : ".$_POST["password"];
                            //$_SESSION["adminName"] = $adminName;
                            //header("Location: adminDashboard.php"); // redirects
                       // }  
                    }
 
                }
                                
            
        ?> 
</body>
</html>