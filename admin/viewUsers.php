<?php
require "../func/func.php";
require "../config.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../stylesheets/dashboard.css">
    <title>User</title>
</head>

<body>

    <h1> </h1>
    <div class="grid-container">
        <div class="left">
            <?php
            $result = mysqli_query($conn, "SELECT U.username,U.usersurname,UD.*,FB.feedback FROM Users AS U LEFT JOIN UserDetails AS UD ON U.userID=UD.userID RIGHT JOIN feedback AS FB ON U.userID=FB.userID");
            if (mysqli_num_rows($result) > 0) {
            ?>
                <table>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["username"] . "\n" . $row["usersurname"] . "\n" . $row["userID"];
                                echo "<br>";
                                echo "Cell number:\n" . $row["cellNumber"];
                                echo "<br>";
                                echo "Location:\n" . $row["userlocation"];
                                echo "<br>";
                                echo "Employer:\n" . $row["employerDetails"];
                                echo "<br>";
                                echo "Salary:\n" . $row["salaryRange"];
                                echo "<br>";
                                echo "Number of family members:\n" . $row["numberOfFamilyMembers"];
                                echo "<br>";
                                echo "Shared Toilet:\n" . $row["sharedToilet"];
                                echo "<br>";
                                echo "Admin feedback:\n" . $row["feedback"];
                                ?>
                            </td>
                        </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </table>
            <?php
            } else {
                echo "No Comments found";
            }
            ?>
        </div>

        <div class="right">
            <form action="viewUsers.php" method="POST">
                <h2>Give users feedback</h2>
                <textarea name="status" rows="5" cols="30" placeholder="reply here"></textarea><br><br>
                <input type="text" name="userID" placeholder="user ID"><br><br>

                <input type="hidden" name="submit" value="TRUE">
                <input type="submit" value="reply">
            </form>
            <?php
            /**
             * 
             */
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //initialize variables and assign them data recieved from the html form.
                $userID = intval(extraction($_POST["userID"]));
                $status = extraction($_POST["status"]);

                if (empty($userID) || empty($status)) {
                    echo "Can't submit empty form.";
                } else {
                    //prepare sql statement and bind.
                    $sqlStatement = $conn->prepare("INSERT INTO feedback (userID,feedback) VALUES (?,?)");
                    $sqlStatement->bind_param("is", $ID, $F);

                    $F = $status;
                    $ID = $userID;

                    if ($sqlStatement->execute()) {
                        echo "Reply sent.";
                    } else {
                        die("error" . mysqli_error($conn));
                    }
                }
                $sqlStatement->close();
                $conn->close();
            }

            ?>
        </div>

    </div>
</body>

<div class="footer">
    <a href="../admin/adminDashboard.php">Back to dashboard</a>
    <a href="../admin/comments.php">View user comments</a>
</div>

</html>