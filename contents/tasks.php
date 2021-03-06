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

    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="plugins/week-calendar/libs/date.js"></script>
  <script type='text/javascript' src='plugins/week-calendar/jquery.weekcalendar.js'></script>
  <script type='text/javascript' src='schedule.js'></script>
    <script type="text/javascript" src="jquery/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="apps.js"></script>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	

  </head>
  <body id="myBody">

<!--new app from email Modal -->
    <div class="modal fade" id="newEmail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" id="emailContent">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Send Email to Candidate</h4>
          </div>
          <div class="modal-body">
            <table id="emailTable">
              <tr>
                <td class="emailLabel">To:</td>
                <td><span id="recipient">Ben Bitdiddle&#60;bitdiddle@mit.edu&#62;</span></td>
              </tr>
              <tr>
                <td class="emailLabel">Title:</td>
                <td><input id="titleInput"></input></td>
              </tr>
              <tr>
                <td class="emailLabel">Message:</td>
                <td><textarea rows="8" id="messageInput"></textarea></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button id="cancelEmailButton" type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button id="sendEmailButton" type="button" class="btn btn-primary">Send</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Email Sent Alert -->
    <div id="emailSent" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- dialog body -->
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Email successfully sent!
          </div>
          <!-- dialog buttons -->
          <div class="modal-footer"><button type="button" class="btn btn-primary" id="closeAlert">OK</button></div>
        </div>
      </div>
    </div>

    <!-- Email Send Confirmation -->
    <div id="emailSendConfirmation" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- dialog body -->
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Are you sure to send this email to the candidate?
          </div>
          <!-- dialog buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" id="cancelSend">Cancel</button>
            <button type="button" class="btn btn-primary" id="confirmSend">Send</button>
          </div>
        </div>
      </div>
    </div>
  
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
      </div>
    </div>
    <div id="content">
      <div id="controlPanel">
        <div class="tabControl" id="tabCandidate" href="/recruiter/contents/index.php">  Candidates</div>
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
            $query = 'SELECT * FROM Tasks ORDER BY TaskID ASC';
            $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
            $count = 0;
            while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                $count = $count + 1;
            }

            $extraClass = '';

            if ($count == 0) {
              $extraClass=' zeroBadge';
            }
            echo "<div class='tabControl' id='tabTask'><span class='mewBadge".$extraClass."' id='notification'>";
            echo $count;
            mysqli_close($con);
          ?>
        </span>    My Tasks</div>
        <div class="tabControl" id="tabDirectory" href="/recruiter/contents/directory.php">  Directory</div>
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
            $query = 'SELECT Candidates.CID, Candidates.Name, Candidates.Position, Candidates.Status, Tasks.Action FROM Candidates INNER JOIN Tasks ON Candidates.CID=Tasks.CID ORDER BY TaskID DESC';
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
                      echo "<td><button class='btn btn-default buttonReviewer' href='/recruiter/contents/candidate.php?id=".$line["CID"]."#profilePagePanel'>Add Reviewer</button></td></tr>";
                    } elseif ($col_value == 2) {
                      echo "<td><button class='btn btn-warning buttonSchedule'  href='/recruiter/contents/candidate.php?id=".$line["CID"]."&showInterview=true'>Schedule Interview</button></td></tr>";
                    } elseif ($col_value == 3) {
                      echo "<td><button class='btn btn-danger buttonRejection' href='/recruiter/contents/candidate.php?id=".$line["CID"]."&showEmail=reject'>Send Rejection</button></td></tr>";
                    } elseif ($col_value == 4) {
                      echo "<td><button class='btn btn-success buttonOffer' href='/recruiter/contents/candidate.php?id=".$line["CID"]."&showEmail=offer'>Send Offer</button></td></tr>";
                    } else {
                      echo "<td>$col_value</td>";
                    }
                  } elseif ($count == 4) {
                    echo "<td>".$statii[$col_value - 1]."</td>";
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
