<?php
//delete.php
$connect = mysqli_connect("localhost", "root", "", "application");
if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  $query = "DELETE FROM media WHERE mediaId = '".$id."'";
  mysqli_query($connect, $query);
 }
}
?>