<?PhP
    $dbhost = 'localhost';
    $dbuser = 'phpmyadmin';
    $dbpass = 'KillSwitch[103]';
    $dbname = 'SocialReliefProgram';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass) 
    or die('Error connecting to mysql');
    mysqli_select_db($conn, $dbname) or die("Could not open database");
    
// close the mysql connection
    //mysqli_close($conn);
?>
