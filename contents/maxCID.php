<?php
$username = "mzhan";
$password = "wxz6813";
$hostname = "sql.mit.edu";
$database = "mzhan+recruiter";

$mysqli = new mysqli($hostname, $username, $password);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

mysqli_select_db($mysqli, $database) or die('Could not select database');

// Performing SQL query
//$query = 'SELECT * FROM Persons';
$query = "SELECT MAX(CID) AS maxID FROM Candidates;";
$result = mysqli_query($mysqli,$query) or die('Query failed: ' . mysqli_error($mysqli));

$r = mysqli_fetch_row($result)[0];
echo json_encode($r);

mysqli_close($mysqli);

?>
