<?
session_start();
?>
<!DOCTYPE html>
<html>
<div class="grid-container">
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" text = "text/css" href="../stylesheets/dashboard.css"> 
</head>
<body>

  <div class="grid-item"><?php echo $_SESSION["userID"];?></div>
  <div class="grid-item">2</div>
  <div class="grid-item">3</div>
  <div class="grid-item">4</div>
  <div class="grid-item">5</div>
  <div class="grid-item">6</div>
  <div class="grid-item">7</div>
  <div class="grid-item">8</div>
  <div class="grid-item">9</div>

</body>
</div>
</html>
