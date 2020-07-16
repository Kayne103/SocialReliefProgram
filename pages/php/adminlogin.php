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
            //require_once "config.php";
            //require_once "func/func.php";
            $adminname = "";
            $adminpassword = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $adminname = extraction($_POST["adminUsername"]);
                    $adminpassword = extraction($_POST["adminPassword"]);
                    if (empty($adminname) || empty($adminpassword)) {
                        echo "empty username, password\n";
                    } else {
                        //echo "username : ".$_POST["adminUsername"];
                        //echo "password : ".$_POST["adminPassword"];
                        $dbhost = 'localhost';
                        $dbuser = 'phpmyadmin';
                        $dbpass = 'KillSwitch[103]';
                        $dbname = 'SocialReliefProgram';
                        $conn = mysqli_connect($dbhost, $dbuser, $dbpass) 
                        or die('Error connecting to mysql');
                        mysqli_select_db($conn, $dbname) or die("Could not open database");

                        $sql = "SELECT * FROM Admin WHERE adminName = $adminname AND adminPassword = $adminpassword";
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

                function extraction($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                                
            
        ?> 
</body>
</html>