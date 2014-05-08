<?php
$username = "mzhan";
$password = "wxz6813";
$hostname = "sql.mit.edu";
$database = "mzhan+recruiter";

$con=mysqli_connect($hostname, $username, $password, $database);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// escape variables for security
$name = mysqli_real_escape_string($con, $_POST['nameInput']);
$email = mysqli_real_escape_string($con, $_POST['emailInput']);
$phone = mysqli_real_escape_string($con, $_POST['phoneInput']);
$school = mysqli_real_escape_string($con, $_POST['schoolInput']);
$education= mysqli_real_escape_string($con, $_POST['educationInput']);
$major= mysqli_real_escape_string($con, $_POST['majorInput']);
$position= mysqli_real_escape_string($con, $_POST['positionInput']);

$sql="INSERT INTO Candidates (Name, Email, Phone,School, Education, Major, Position, Status, Last_Updated)
VALUES ('$name', '$email', '$phone', '$school','$education','$major','$position', 1, now())";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

mysqli_close($con);
?> 
