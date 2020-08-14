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
                                echo "By:" . $row["username"] . "\nComment ID:" . $row["commentID"]. "\nLocation:" . $row["userlocation"];
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
            <form action="userComment.php" method="POST">
                <h2>Comment here</h2>
                <textarea name="status" rows="5" cols="30" placeholder="reply here"></textarea><br><br>
                <input type="text" name="userID" placeholder="user ID"><br><br>

                <input type="hidden" name="submit" value="TRUE">
                <input type="submit" value="Comment">
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
                    $sqlStatement = $conn->prepare("INSERT INTO comments (userID,userComment) VALUES (?,?)");
                    $sqlStatement->bind_param("is", $ID, $F);

                    $F = $status;
                    $ID = $userID;

                    if ($sqlStatement->execute()) {
                        echo "Reply sent.";
                        $sqlStatement->close();
                        $conn->close();
                    } else {
                        die("error" . mysqli_error($conn));
                    }
                }

            }

            ?>
        </div>

    </div>
</body>

<div class="footer">
<a href="../user/userLogin.php">logout</a>
    
</div>

</html>