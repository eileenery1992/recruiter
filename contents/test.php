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


$query = "SELECT MAX(CID) AS maxID FROM Candidates;";
$result = mysqli_query($con,$query) or die('Query failed: ' . mysqli_error($mysqli));
$new = mysqli_fetch_row($result);
echo $new[0];
$s = "INSERT INTO Tasks (CID, Action) VALUES ('$new', 1)";
mysqli_query($con, $s);

mysqli_close($con);
?>

