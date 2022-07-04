 <?php
include "Connection.php";


$sql = "DELETE FROM drivers WHERE driver_id = ".$_GET['driverid'] . ";";
$result=mysqli_query($conn,$sql);
$sql = "DELETE FROM users WHERE user_id=".$_GET['userid'].";";
mysqli_query($conn,$sql);
if($result)
{
   header("Location:admin.php");  
}
 ?>