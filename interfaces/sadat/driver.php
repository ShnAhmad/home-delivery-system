<?php 
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="index _style.css">
  <!-- CSS only -->
  <title>Driver</title>
</head>

<body>
  <!-- Header -->
  <header id="header">
    <div class="nav-bar">
      <div class="brand">
        <img src="img/logo.png" alt="">
      </div>
       <div class="nav-list">
        <ul>
          <li><a href="#home" data-after="Home">Home</a></li>
          <li><a href="#projects" data-after="Profile">Profile</a></li>
          <li><form action="" method="POST">
                        <input type="hidden" value="t">
                        <input type="submit" name="logout" value="Logout">
                        </form>
                  </li>
        </ul>
      </div>
    </div>
  </header>
  <!-- End Header -->
  <!-- home Section  -->
  <section id="home">

  <?php
 if(isset($_POST['logout'])) {
  session_destroy();
 echo "<script>window.location = '../index.php'</script>";
}
?>

    <h1 class="heading">Welcome to Food For You</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
      voluptatibus numquam id dolorem maxime, dolores similique
      quae ducimus non nisi!</p>

  </section>
  <!-- End home Section  -->
  <!-- start driver  -->
  <br>

  <h1>Hi <?php echo $_SESSION['driver_id'] ?></h1>

<form action="" method="POST">
  <input type="submit" value="view yours assigned values" name="submit" class="btn btn-primary">
  <input type="submit" value="view total orders" name="submitt" class="btn btn-primary">
</form>

<?php

if(isset($_POST["submit"])) {

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ds";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //
  $sql = "SELECT * FROM `orders`where  `driver_id`= " . $_SESSION['driver_id'] . " and `status`='no' ";
  $result = $conn->query($sql);
  print '<table class="table table-borderless">';
  print"<tr><td>order_id</td><td>food_id</td><td>customer_id</td><td>driver_id</td><td>quantity</td><td>status</td><td></td></tr>";

    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["order_id"]. "<t/d><td>" . $row["food_id"]. "</td><td>" . $row["customer_id"]. "</td><td>" . $row["driver_id"]. "</td><td>". $row["quantity"]."</td><td>". $row["status"]."</td><td><a href='status.php?order_id=" . $row['order_id'] . "' class='btn btn-danger'>Delivered</a></td></tr><br>";
    }
print "</table>";
  $conn->close();

}
if(isset($_POST["submitt"])) {

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ds";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //
  $sql = "SELECT * FROM `orders` where  `status`='no' and `driver_id` IS null ";
  $result = $conn->query($sql);
  print '<table class="table table-borderless">';
  print"<tr><td>order_id</td><td>food_id</td><td>customer_id</td><td>driver_id</td><td>quantity</td><td>status</td><td></td></tr>";
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["order_id"]. "<t/d>
      <td>" . $row["food_id"]. "</td>
      <td>" . $row["customer_id"]. "</td>
      <td>" . $row["driver_id"]. "</td>
      <td>". $row["quantity"]."</td>
      <td>". $row["driver_id"]."</td>
      <td><a href='pickorder.php?order_id=" . $row['order_id'] . "' class='btn btn-danger'>pick order from the list</a></td>
      </tr><br>";
    }
  } else {
    echo "0 results";
  }print "</table>";
  $conn->close();

}

?>


  <br>
  <!-- End driver  -->
  <!-- Footer -->

  <footer id="footer">
    <div class="footer-div">
      <h2>Social Medial Account</h2>
      <div class="social-icon">
        <a href="#"><img src="img/facebook.png" /></a>
        <a href="#"><img src="img/instagram.png" /></a>
        <a href="#"><img src="img/twitter.png" /></a>
      </div>
    </div>
  </footer>

</body>

</html>