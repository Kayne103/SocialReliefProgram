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
    
    <h1>
    
    </h1>
    

<div class="grid-container">
<div class="left">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM comments");
    if (mysqli_num_rows($result) > 0) {
    ?>
    <table>
    <?php
        $i=0;
        while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $row["usercomment"];
        echo "<br>";
        echo "By:". $row["userID"]." comment ID:".$row["commentID"]; ?></td>
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
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
            //initialize variables and assign them data recieved from the html form.
            $commentID = intval(extraction($_POST["commentID"]));
            $reply = extraction($_POST["reply"]);
            
            if (empty($commentID)|| empty($reply)) {
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
                    die("error".mysqli_error($conn));
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
