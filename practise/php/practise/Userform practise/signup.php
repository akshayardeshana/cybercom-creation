
<?php
// Include config file
require_once "config.php";
if (isset($_POST)) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $email1 = $_POST['email'];
    $phone1 = $_POST['mno'];
    $pwd = $_POST['pwd'];
    $sql = "INSERT INTO user_info (fname, lname, dob,gender,country,phone,pwd,email)
        VALUES('$fname','$lname','$dob','$gender','$country','$phone1','$pwd','$email1')";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("record inserted successfully Now click on ok to retrieve data")</script>';
        $retrieve = "SELECT id, fname, lname FROM user_info";
        $result = $conn->query($retrieve);
        
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"]. " - Name: " . $row["fname"]. " " . $row["lname"]. "<br>";
          }
        } else {
          echo "0 results";
        }
        
     } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
mysqli_close($conn);

?>