<!DOCTYPE html>
<html>
<div class=”main-container”>
    <head>
    <link rel="stylesheet" href="../stylesheets/adminDashboard.css">
    <title>Home</title>
    </head>
    <body>
        <H1>
        <form action="comments.php" method="POST">
            <input type="text" name="userID" placeholder="Search user by ID">
            <input type="hidden" name="submit" value="TRUE">
            <input type="submit" value="Search">
        </form>   
        </H1>
        <h2>
        <a href="../admin/viewUsers.php">View users</a>
        <a href="../admin/comments.php">View user comments</a>
        </h2>
    </body>
    <div>
        <footer id="footer">
        <a href="../user/userLogin.php">logout</a>
        </footer>
        </div>
</div> <!-— /.main-container-->
</html>