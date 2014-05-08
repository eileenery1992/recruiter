<?php
//TODO:take from url or post data
$cid = 10000; 

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
$query = "SELECT Availabilities.TID, Availabilities.Start, Availabilities.End
FROM Availabilities 
INNER JOIN Candidates 
ON Candidates.CID=Availabilities.CID
WHERE Candidates.CID=$cid;";
$result = mysqli_query($mysqli,$query) or die('Query failed: ' . mysqli_error($mysqli));


$rows = array();
while($r = mysqli_fetch_array($result,MYSQL_ASSOC)) {
    $rows[] = $r;
}
echo json_encode($rows);

/*
// Create table
$sql="CREATE TABLE Persons3(FirstName CHAR(30),LastName CHAR(30),Age INT)";
mysqli_query($mysqli,$sql)
  or die("Error creating table: " . mysqli_error($mysqli));
echo "Created table";
*/
mysqli_close($mysqli);


?>
