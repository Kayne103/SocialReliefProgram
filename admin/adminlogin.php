<!DOCTYPE html>

<head>
    <title>Admin login</title>
    <link rel="stylesheet" href="../stylesheets/pagesheet.css">
</head>

<body>
    <h1>social relief program</h1>

    <form action="adminlogin.php" method="POST">
        <h2>Mmaboi</h2>
        <p>Fill in admin username and password to login</p>
        <input type="text" name="adminUsername" placeholder="Mmaboi's username"><br><br>

        <input type="text" name="adminPassword" placeholder="Mmaboi's password"><br><br>

        <input type="hidden" name="submit" value="TRUE">
        <input type="submit" value="Login">

    </form>
    <?php
    require "../config.php";
    require "../func/func.php";
    $adminname = "";
    $adminpassword = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adminname = extraction($_POST["adminUsername"]);
        $adminpassword = extraction($_POST["adminPassword"]);
        if (empty($adminname) || empty($adminpassword)) {
            echo "empty username, password\n";
        } else {

            $sqlStatement = $conn->prepare("SELECT * FROM adminstrators WHERE adminID = ? AND adminPassword = ?");
            $sqlStatement->bind_param("ss", $AN, $AP);
            $AN = $adminname;
            $AP = $adminpassword;
            $result = mysqli_query($conn, $sqlStatement);
            $row = mysqli_fetch_array($result);

            if (mysqli_stmt_execute($sqlStatement)) {
                mysqli_stmt_store_result($sqlStatement);
                if (mysqli_stmt_num_rows($sqlStatement) == 1) {
                    header("location:adminDashboard.php");
                } else {
                    echo "wrong password";
                }
            }
        }
    }

    ?>
    <div>
        <footer id="footer">
            <a href="../index.php">home</a>
        </footer>
    </div>
</body>

</html>