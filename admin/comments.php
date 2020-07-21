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
    <div class="header">
    <h1>Header</h1>
    </div>

<div class="grid-container">
<div class="left">
    <?php
    if (mysqli_num_rows($result) > 0) {
    ?>
    <table>
    <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>City</td>
        <td>Email id</td>
    </tr>
    <?php
        $i=0;
        while ($row = mysqli_fetch_array($result)) {
    ?>
    <tr>
        <td><?php echo $row["first_name"]; ?></td>
        <td><?php echo $row["last_name"]; ?></td>
        <td><?php echo $row["city_name"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
    </tr>
    <?php
        $i++;
    }
    ?>
    </table>
    <?php
    } else {
        echo "No result found";
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
                echo "Replied";
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
  <p>Footer</p>
</div>

</html>
