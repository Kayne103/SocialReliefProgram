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
    <form action="comments.php" method="POST">
            <input type="text" name="userID" placeholder="Search user by ID">
            <input type="hidden" name="submit" value="TRUE">
            <input type="submit" value="Search">
        </form>   
    </h1>
    

<div class="grid-container">
<div class="left">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM comments");
    if (mysqli_num_rows($result) > 0) {
    ?>
    <table>
    <tr> 
        <td>User ID</td>
        <td>CommentID</td>
        <td>Comment</td>
    </tr>
    <?php
        $i=0;
        while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $row["userID"]; ?></td>
        <td><?php echo $row["commentID"]; ?></td>
        <td><?php echo $row["usercomment"]; ?></td>
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
    </div>
    
<?php
/**
 * 
 */
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    //initialize variables and assign them data recieved from the html form.
    $userID = intval(extraction($_POST["userID"]));
    $commentID = intval(extraction($_POST["commentID"]));
    $reply = extraction($_POST["reply"]);
    //echo $firstname." ".$surname." ".$Idnumber." ".$password;
    
    //prepare sql statement and bind.
    $sqlStatement = $conn->prepare("UPDATE comments SET adminReply = ? WHERE commentID = ?");
    $sqlStatement->bind_param("si", $AR, $ID);

    $AR = $reply;
    $ID = $commentID;
    
    if ($sqlStatement->execute()) {
                //echo "Replied";
                //header("location:userDetails.php");
    } else {
        die("error".mysqli_error($conn));
    }
    $sqlStatement->close();
    $conn->close();

    
}

?>
</div>
</body>

<div class="footer">
<a href="../admin/adminDashboard.php">Back to dashboard</a>
</div>

</html>
