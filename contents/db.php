<?php
$username = "mzhan";
$password = "wxz6813";
$hostname = "sql.mit.edu"; 
$database = "mzhan+recruiter";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password, $database) 
  or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

mysql_select_db($database) or die('Could not select database');

// Performing SQL query
$query = 'SELECT * FROM Candidates';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());


// Printing results in HTML
echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

/*
// Create table
$sql="CREATE TABLE Persons2(FirstName CHAR(30),LastName CHAR(30),Age INT)";
mysql_query($sql)
  or die("Error creating table: " . mysql_error($dbhandle));
echo "Created table";
*/
mysql_close();
?>
