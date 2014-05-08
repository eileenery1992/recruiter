<?php
$username = "mzhan"; 
$password = "wxz6813"; 
$hostname = "sql.mit.edu";  
$database = "mzhan+recruiter"; 

$mysqli = new mysqli($hostname, $username, $password);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
echo $mysqli->host_info . "\n";

mysqli_select_db($mysqli, $database) or die('Could not select database');

// Performing SQL query
//$query = 'SELECT * FROM Persons';
$query = "SELECT Name, Position, Status, Last_Updated FROM Candidates;";
$result = mysqli_query($mysqli,$query) or die('Query failed: ' . mysqli_error($mysqli));

/*
mysqli_query($mysqli,"INSERT INTO Candidates (ID, Name, Position)
VALUES (10000, 'Glenn','aaa')") or die ('Insertion failed: '. mysqli_error($mysqli));
*/

// Printing results in HTML
echo "<table>\n";
while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Create table
$sql="CREATE TABLE Persons3(FirstName CHAR(30),LastName CHAR(30),Age INT)";
mysqli_query($mysqli,$sql)
  or die("Error creating table: " . mysqli_error($mysqli));
echo "Created table";

mysqli_close($mysqli);


?>
