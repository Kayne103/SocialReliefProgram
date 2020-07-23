<?php
require "../func/func.php";
require "../config.php";
?>
<!DOCTYPE html>
<html>
<div class="parent">

    <head>
        <link rel="stylesheet" href="../stylesheets/adminDashboard.css">
        <title>MmaBoi Dashboard</title>
    </head>
    <H1>
        <form action="adminDashboard.php" method="POST">
            <input type="text" name="userID" placeholder="Search user by ID">
            <input type="hidden" name="submit" value="TRUE">
            <input type="submit" value="Search">
        </form>
    </H1>

    <body>
        <div class="div1">
            <h2>
                <p>total number of users</p>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM Users");
                $row = mysqli_num_rows($result);
                echo $row;
                ?>
            </h2>
        </div>

        <div class="div2">
            <?php
            /**
             * 
             */
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //initialize variables and assign them data recieved from the html form.
                $userID = intval(extraction($_POST["userID"]));

                if (empty($userID)) {
                    echo "input user ID.";
                } else {
                    //prepare sql statement and bind.
                    $sqlStatement = $conn->prepare("SELECT * FROM Users WHERE userID=?");
                    $sqlStatement->bind_param("i", $ID);

                    $ID = $userID;

                    $result = mysqli_query($conn, $sqlStatement);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_array($result);
                        echo $row["usersurname"];
                    }
                }
                $sqlStatement->close();
                $conn->close();
            }

            ?>
        </div>

        <div class="div3">
            <p>view users and assess them</p><br><br>
            <a href="../admin/viewUsers.php">View users</a>
        </div>

        <div class="div4">
            <p>see what users have to say about the feedback</p><br><br>
            <a href="../admin/comments.php">View user comments</a>
        </div>
    </body>

    <div>
        <footer id="footer">
            <a href="../admin/adminlogin.php">logout</a>
        </footer>
    </div>

</div>

</html>