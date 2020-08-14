<?php
require "../func/func.php";
require "../config.php";
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../stylesheets/dashboard.css">
    <title>Comments</title>
</head>

<body>

    <div class="grid-container">
        <div class="left">
            <?php
                $result = mysqli_query($conn, "SELECT U.username,U.userID,C.usercomment,C.commentID,C.adminReply,UD.userlocation,F.feedback FROM Users AS U RIGHT JOIN comments AS C ON U.userID=C.userID LEFT JOIN UserDetails AS UD ON U.userID=UD.userID LEFT JOIN feedback AS F ON U.userID=F.userID");
            
            if (mysqli_num_rows($result) > 0) {
            ?>
                <table>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["usercomment"];
                                echo "<br><br>";
                                echo "By:" . $row["username"] . "\nID:" . $row["userID"] . "\nComment ID:" . $row["commentID"]. "\nLocation:" . $row["userlocation"];
                                echo "<br><br>";
                                echo "Reply:\n" . $row["adminReply"]."\nStatus:\n" . $row["feedback"];
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
            <form action="comments.php" method="POST">
                <h2>Give users feedback</h2>
                <textarea name="reply" rows="8" cols="44" placeholder="reply here"></textarea><br>

                Comment ID<br>
                <input type="number" name="commentID" min="0" step="1" value="0"><br><br>

                <input type="hidden" name="submit" value="TRUE">
                <input type="submit" value="reply">
            </form>
            <?php
            /**
             * 
             */
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                //initialize variables and assign them data recieved from the html form.
                $commentID = intval(extraction($_POST["commentID"]));
                $reply = extraction($_POST["reply"]);

                if (empty($commentID) || empty($reply)) {
                    echo "Can't submit empty form.";
                } else {
                    //prepare sql statement and bind.
                    $sqlStatement = $conn->prepare("UPDATE comments SET adminReply = ? WHERE commentID = ?");
                    $sqlStatement->bind_param("si", $AR, $ID);

                    $AR = $reply;
                    $ID = $commentID;

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
    <a href="../admin/viewUsers.php">View users</a>
</div>

</html>