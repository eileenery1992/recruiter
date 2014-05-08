<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>The Recruiter</title>
    <link type="text/css" href="jquery/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
    <link type="text/css" href="index.css" rel="stylesheet" />
	<link rel='stylesheet' type='text/css' href='plugins/week-calendar/libs/css/smoothness/jquery-ui-1.8.11.custom.css' />
	<link rel='stylesheet' type='text/css' href='plugins/week-calendar/jquery.weekcalendar.css' />
    <link type="text/css" href="bootstrap/css/bootstrap.css" rel="stylesheet" />

	<!-- Requird by calendar
    <script type="text/javascript" src="plugins/week-calendar/libs/jquery-1.4.4.min.js"></script>
	-->
    <script type="text/javascript" src="jquery/js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="jquery/js/jquery-ui-1.10.0.custom.min.js"></script>

    <script type="text/javascript" src="profile.js"></script>

    <script type="text/javascript" src="jquery/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="apps.js"></script>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="plugins/week-calendar/libs/date.js"></script>
  <script type='text/javascript' src='plugins/week-calendar/jquery.weekcalendar.js'></script>
  <script type='text/javascript' src='schedule.js'></script>

  </head>
  <body id="myBody">

  
		<!-- Interview request -->
	<div class='modal fade' id='newInterview' tabindex='-1' role='dialog' aria-labelledby='myModelLabel' aria-hidden='true'>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
			<button type="button" class="close" id="closeIntReq" aria-hidden="true" onclick="$('#newInterview').modal('hide');">×</button>
			<div class='pageTitle'> Interview Request for <a id='candidateName'> </a> ID: <a id='candidateID'></a> </div>
          </div>
		  <div class="modal-body">
		   <div id='avail' class='horizontalPanel'>
			<div id='calControls'>
			<label> Candidate Availability </label>
			<button id='clearBtn' onclick="$('#calendar').weekCalendar('clear');" class="btn btn-default btn-mini">Clear</button>
			</div>
		    <div id='calendar'></div>
		   </div>	
		   <div id='spec' class='horizontalPanel'>
			<form> 
			<div id='iType' class = 'verticalPanel'>
			<label>Interview Type: </label>
			<select id='type'> 
				<option>Phone</option>
				<option>Onsite</option>
			</select>
			</div>
			
			<div id='intrs' class = 'verticalPanel'>
			<label>Interviewers:</label>
			<input id='intrName' type='text'> 
			<ul id='intrList'>
			</ul>
			</div>
			  
			<div id='iComment'>
			<label>Comments:</label><br>

			<textarea rows=5 id="commentInputArea"></textarea>
			</div>
			</form>
            <button id="intCancelBtn" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button id="intSendBtn" type="button" class="btn btn-primary" data-dismiss="modal">Send Interview Request</button>
		   </div>
		   </div>
		  </div>
		</div>
	</div>

    <div id="titleBar">
      <div id="title"><img src="graphics/title3.png"/></div>
      <div id="toolBar">
        <div id="greeting">Hi, <span id="profile">Laura</span>!</div>
        <div id="exitButton"><img src="graphics/icon2.png"/></div>
      </div>
    </div>
    <div id="content">
      <div id="controlPanel">
        <div class="tabControl" id="tabCandidate">  Candidates</div>
        <div class="tabControl" id="tabTask"><img src="graphics/dot1.png" id="notification"/>    My Tasks</div>
        <div class="tabControl" id="tabSchedule">  Schedule</div>
        <div class="tabControl" id="tabPosition">  Positions</div>
      </div>
      <div id="pagePanel">
        

   
    <!-- Interview Deletion Confirmation -->
    <div id="interviewDeleted" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- dialog body -->
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Are you sure to delete this interview?
          </div>
          <!-- dialog buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="cancelDeletion">Cancel</button>
            <button type="button" class="btn btn-primary" id="confirmDeletion">OK</button>
          </div>
        </div>
      </div>
    </div>

   
		<div class="tabPage" id="tabTaskPage">
      <div class="pageTitle">Upcoming Tasks</div>
      <table class="table-hover table" id="taskTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Status</th>
            <th>Action Required</th>
          </tr>
        </thead>
        <tbody>
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

            // Performing SQL query
            $query = 'SELECT Candidates.CID, Candidates.Name, Candidates.Position, Candidates.Status, Tasks.Action FROM Candidates INNER JOIN Tasks ON Candidates.CID=Tasks.CID';
            $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
            $statii = array("Just Added", "1st Interview", "2nd Interview", "3rd Interview", "Offer Pending", "Offer Accepted", "Offer Declined", "Rejected"); 

            // Printing results in HTML
            while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                echo "<tr class='clickableRow' href='/recruiter/contents/candidate.php?id=".$line["CID"]."'>";
                $count = 0;
                foreach ($line as $col_value) {
                  $count = $count + 1;
                  if ($count == 5) {
                    if ($col_value == 1) {
                      echo "<td><button class='btn btn-default'>Add Reviewer</button></td></tr>";
                    } elseif ($col_value == 2) {
                      echo "<td><button class='btn btn-warning'>Schedule Interview</button></td></tr>";
                    } elseif ($col_value == 3) {
                      echo "<td><button class='btn btn-danger'>Send Rejection</button></td></tr>";
                    } elseif ($col_value == 4) {
                      echo "<td><button class='btn btn-success'>Send Offer</button></td></tr>";
                    } else {
                      echo "<td>$col_value</td>";
                    }
                  } elseif ($count == 4) {
                    echo "<td>".$statii[$col_value]."</td>";
                  } else {
                    echo "<td>$col_value</td>";
                  }  
                }
                echo "</tr>";
            }

            mysqli_close($con);
          ?>
          <tr></tr>
        </tbody>
      </table><!--taskTable -->
    </div><!-- tabTAskPage -->

  </body>
</html>
