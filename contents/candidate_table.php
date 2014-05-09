<?php
$username = "mzhan";
$password = "wxz6813";
$hostname = "sql.mit.edu";
$database = "mzhan+recruiter";
$statii = array("Just Added", "1st Interview", "2nd Interview", "3rd Interview", "Offer Pending", "Offer Accepted", "Offer Declined", "Rejected"); 

$con=mysqli_connect($hostname, $username, $password, $database);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Performing SQL query
$query = 'SELECT CID, Name, Position, Status, Last_Updated FROM Candidates ORDER BY Last_Updated DESC';
$result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));


// Printing results in HTML
while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    $count = 0;
    echo "<tr class='clickableRow' href='/recruiter/contents/candidate.php?id=".$line["CID"]."'>";;
    foreach ($line as $col_value) {
      $count = $count + 1;
      if ($count == 4) {
        if ($col_value) {
          echo "<td>".$statii[$col_value-1]."</td>";
        } else {
          echo "<td>$col_value</td>";
        }
      } else {
        echo "<td>$col_value</td>";
    }}

    echo "</tr>";
}

mysqli_close($con);
?> 
