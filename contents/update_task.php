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
$CID = $_POST['CID'];
$action = $_POST['action'];
$delete = $_POST['delete'];
echo $delete;
if ($delete){
  $s = "DELETE FROM Tasks WHERE TaskID=$taskID ";
} else{
$s = "UPDATE Tasks
SET action=$action
WHERE CID=$CID";}
mysqli_query($con, $s) or die(mysqli_error($con));

mysqli_close($con);
?>

