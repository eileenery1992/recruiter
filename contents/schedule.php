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

$interviewer='mclean';
$CID = $_POST['cid'];
//$CID = 10011;
$t=time()+(7 * 24 * 60 * 60)+rand(3600, 36000);
$start = $t-($t%1800);
$end = $start+3600;
$s=gmdate("Y-m-d H:i:s", $start);
$e=gmdate("Y-m-d H:i:s", $end);
echo $t,' ',t%1800,' ',$start,' ', $end, ' ',$s, ' ', $e;

$sql="INSERT INTO Interviews (CID, Start, End, Interviewer)
VALUES ('$CID','$s', '$e', 'blah')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}




?>
