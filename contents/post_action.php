<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
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
$sender = $_POST['sender'];
$receiver = $_POST['receiver'];
$content = $_POST['content'];
$time = $_POST['time'];

$s = "INSERT INTO Actions (CID, Type, Sender, Receiver, Content, Time) VALUES ('$CID', '$action', '$sender', '$receiver', '$content', '$time')";
mysqli_query($con, $s) or die(mysqli_error($con));

mysqli_close($con);
?>

