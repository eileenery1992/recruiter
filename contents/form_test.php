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

// TODO: Add action and task
$query = "SELECT MAX(CID) AS maxID FROM Candidates;";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error($con));

$r = mysqli_fetch_row($result)[0] ;
echo $r;

$s = "INSERT INTO Tasks (CID, Action) VALUES ('$r', 1)";
mysqli_query($con, $s);

mysqli_close($con);
?> 
