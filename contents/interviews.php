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
$CID = $_GET['cid'];
$CID = 10011;

$sql = "SELECT Start, End, Interviewer FROM Interviews WHERE CID=$CID";
$result = mysqli_query($con,$sql) or die('Error: ' . mysqli_error($con));

echo "<table>\n";
while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    echo $line['Start'].' - '.$line['End'].'   Interviewer(s): '.$line['Interviewer'];
    echo '<br>';
}
echo "</table>\n";




?>

