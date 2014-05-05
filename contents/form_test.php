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

// escape variables for security
$name = mysqli_real_escape_string($con, $_POST['nameInput']);
$email = mysqli_real_escape_string($con, $_POST['emailInput']);
$phone = mysqli_real_escape_string($con, $_POST['phoneInput']);

$sql="INSERT INTO Candidates (Name, Email, Phone)
VALUES ('$name', '$email', '$phone')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
echo "1 record added";

// Performing SQL query
$query = 'SELECT * FROM Candidates';
$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));


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


mysqli_close($con);
?> 
