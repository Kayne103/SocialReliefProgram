<!DOCTYPE html>
<head>
    <title>Admin login</title>
    <link rel="stylesheet" href="stylesheets/stylesheet.css">
</head>
<body>
        <h1>Dumela Mmaboi</h1>
        <h2>
              
        </h2>
        <p>Fill in adminName & adminPassword to login</p>
        <form action="adminlogin.php" method="post">
                <label>admin username</label>
                <input type="text" name="adminUsername"><br>
            
                <label>adminPassword</label>
                <input type="text" name="adminPassword"><br>
                <input type="hidden" name="submit" value="TRUE">
                <input type="submit" value="Login">
           
        </form>   
        <?php 
            require_once "config.php";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty(trim($_POST["adminUsername"])) || empty(trim($_POST["adminPassword"]))) {
                        echo "empty username, password\n";
                    } else {
                        echo "username : ".$_POST["adminUsername"];
                        echo "password : ".$_POST["adminPassword"];
                        $sql = "SELECT adminName,adminPassword FROM Admin";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            session_start();
                            echo "username : ".$_POST["adminUsername"];
                            echo "password : ".$_POST["adminPassword"];
                            //$_SESSION["adminName"] = $adminName;
                            //header("Location: adminDashboard.php"); // redirects
                        }  
                    }
 
                }
                                
            
        ?> 
</body>
</html>