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
$cid = $_POST['cid'];

$query = "SELECT Name, Email FROM Candidates WHERE CID=$cid"; 
$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
$line = mysqli_fetch_array($result, MYSQL_ASSOC);
echo $line["Name"]."&#60;".$line["Email"]."&#62;";

mysqli_close($con);
?>

