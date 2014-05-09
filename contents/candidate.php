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
    <?php
        $username = "mzhan";
        $password = "wxz6813";
        $hostname = "sql.mit.edu";
        $database = "mzhan+recruiter";
        parse_str($_SERVER['QUERY_STRING']);
        $con=mysqli_connect($hostname, $username, $password, $database);
        if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $query = 'SELECT * FROM Candidates WHERE CID='.$id;
        $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
        $line = mysqli_fetch_array($result, MYSQL_ASSOC);
        $c_name = $line["Name"];
        $c_email = $line["Email"];
        $c_phone = $line["Phone"];
        $c_position = $line["Position"];
        $c_reviewers = $line["Reviewers"];
        $c_status = $line["Status"];
        $c_school = $line["School"];
        $c_education = $line["Education"];
        $c_major = $line["Major"];
    echo "<!--new app from email Modal -->
    <div class='modal fade' id='newEmail' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content' id='emailContent'>
          <div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            <h4 class='modal-title' id='myModalLabel'>Send Email to Candidate</h4>
          </div>
          <div class='modal-body'>
            <table id='emailTable'>
              <tr>
                <td class='emailLabel'>To:</td>
                <td><span id='recipient'></span></td>
              </tr>
              <tr>
                <td class='emailLabel'>Subject:</td>
                <td><input id='titleInput'></input></td>
              </tr>
              <tr>
                <td class='emailLabel'>Message:</td>
                <td><textarea rows='8' id='messageInput'></textarea></td>
              </tr>
            </table>
          </div>
          <div class='modal-footer'>
            <button id='cancelEmailButton' type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            <button id='sendEmailButton' type='button' class='btn btn-primary'>Send</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Email Sent Alert -->
    <div id='emailSent' class='modal fade'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <!-- dialog body -->
          <div class='modal-body'>
            <button type='button' class='close' data-dismiss='modal'>&times;</button>
            Email successfully sent!
          </div>
          <!-- dialog buttons -->
          <div class='modal-footer'><button type='button' class='btn btn-primary' id='closeAlert'>OK</button></div>
        </div>
      </div>
    </div>

    <!-- Email Send Confirmation -->
    <div id='emailSendConfirmation' class='modal fade'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <!-- dialog body -->
          <div class='modal-body'>
            <button type='button' class='close' data-dismiss='modal'>&times;</button>
            Are you sure to send this email to the candidate?
          </div>
          <!-- dialog buttons -->
          <div class='modal-footer'>
            <button type='button' class='btn btn-default' id='cancelSend'>Cancel</button>
            <button type='button' class='btn btn-primary' id='confirmSend'>Send</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Interview request -->
  <div class='modal fade' id='newInterview' tabindex='-1' role='dialog' aria-labelledby='myModelLabel' aria-hidden='true'>
      <div class='modal-dialog'>
        <div class='modal-content'>
          <div class='modal-header'>
      <button type='button' class='close' id='closeIntReq' aria-hidden='true' onclick='$('#newInterview').modal('hide');'>×</button>
      <div class='pageTitle'> Interview Request for <a id='candidateName'> </a> ID: <a id='candidateID'></a> </div>
          </div>
      <div class='modal-body'>
       <div id='avail' class='horizontalPanel'>
      <div id='calControls'>
      <label> Candidate Availability </label>
      <button id='clearBtn' onclick='$('#calendar').weekCalendar('clear');' class='btn btn-default btn-mini'>Clear</button>
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

      <textarea rows=5 id='commentInputArea'></textarea>
      </div>
      </form>
            <button id='intCancelBtn' type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            <button id='intSendBtn' type='button' class='btn btn-primary' data-dismiss='modal'>Send Interview Request</button>
       </div>
       </div>
      </div>
    </div>
  </div>
 
    <div id='titleBar'>
      <div id='title'><img src='graphics/title3.png'/></div>
      <div id='toolBar'>
        <div id='greeting'>Hi, <span id='profile'>Laura</span>!</div>
      </div>
    </div>
    <div id='content'>
      <div id='controlPanel'>
        <div class='tabControl' id='tabCandidate' href='/recruiter/contents/index.php'>  Candidates</div>
        <div class='tabControl' id='tabTask' href='/recruiter/contents/tasks.php'><img src='graphics/dot1.png' id='notification'/>    My Tasks</div>
        <div class='tabControl' id='tabDirectory' href='/recruiter/contents/directory.php'>  Directory</div>
      </div>";
      
        
        $query = 'SELECT * FROM Actions WHERE CID='. $id;
        $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
        $c_actions = array();
        while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
          array_push($c_actions, $line);
        }
        echo "<div id='pagePanel'>
          <div class='tabPage' id='tabProfilePage'>
            <table id='profileHeader'><tr valign='baseline'>
              <td id='profileTitle'><span id='profileName'>$c_name</span></td>
              <td id='editButtonContainer'><div id='editButton'>Edit</div></td>
            </tr>
          </table>
          <table id='profileInfo'>
            <tr>
              <td id='leftColumn'>
                <table id='infoTable'>
                  <tr>
                    <td id='idLabel' class='myLabel'>ID:</td>
                    <td id='id'><span id='profileID'>$id</span></td>
                  </tr>
                  <tr>
                    <td id='emailLabel' class='myLabel'>Email:</td>
                    <td id='email'><span id='profileEmail'>$c_email</span></td>
                  </tr>
                  <tr>
                    <td id='telLabel' class='myLabel'>Telephone:</td>
                    <td id='tel'>$c_phone</td>
                  </tr>
                  <tr>
                    <td id='posLabel' class='myLabel'>Position:</td>
                    <td id='pos'>$c_position</td>
                  </tr>
                  <tr>
                    <td id='revLabel' class='myLabel'>Reviewers:</td>
                    <td id='rev'>$c_reviewers</td>
                  </tr>
                </table>
              </td>
              <td id='rightColumn'>";

              if ($c_status == 1) {
                echo "<div id='statusButton' class='pendingStatus'>Just Added</div>";
              } elseif ($c_status == 2) {
                echo "<div id='statusButton' class='pendingStatus'>1st Interview</div>";
              } elseif ($c_status == 3) {
                echo "<div id='statusButton' class='pendingStatus'>2nd Interview</div>";
              } elseif ($c_status == 4) {
                echo "<div id='statusButton' class='pendingStatus'>3rd Interview</div>";
              } elseif ($c_status == 5) {
                echo "<div id='statusButton' class='pendingStatus'>Offer Pending</div>";
              } elseif ($c_status == 6) {
                echo "<div id='statusButton' class='activeStatus'>Offer Accepted</div>";
              } elseif ($c_status == 7) {
                echo "<div id='statusButton' class='inactiveStatus'>Offer Declined</div>";
              } elseif ($c_status == 8) {
                echo "<div id='statusButton' class='inactiveStatus'>Rejected</div>";
              } else {
                echo "<div id='statusButton' class='noStatus'>No Status</div>";
              }
        echo "</td>
            </tr>
          </table>
          <table id='profileControlPanel'>
            <tr>
              <td id='leftSpace' class='profileTab'/>
              <td id='tabActivity' class='profileTab selected'>Activity</td>
              <td class='profileTab spaceBetween'/>
              <td id='tabInterview' class='profileTab unselected'>Interviews</td>
              <td class='profileTab spaceBetween'/>
              <td id='tabInfo' class='profileTab unselected'>Information</td>
              <td id='rightSpace' class='profileTab'/>
            </tr>
          </table>
          <div id='profilePagePanel'>
            <div id='tabActivityPage' class='inProfilePage'>
              <div id='activityList'>";

        foreach ($c_actions as $c_action) {
          $a_cid = $c_action["CID"];
          $a_sender = $c_action["Sender"];
          $a_receiver = $c_action["Receiver"];
          $a_type = $c_action["Type"];
          $a_content = $c_action["Content"];
          $a_time = $c_action["Time"];
          if ($a_type == 1) {
            //create
            $innerStr = " created application: ";
            echo "<div class='activity statusChange'><span class='profileLink'>$a_sender</span><span>$innerStr".$id."</span><span class='timeStamp'>$a_time</span></div>";
          } elseif ($a_type == 2) {
            //add reviewer
            $innerStr = " added reviewer: ";
            echo "<div class='activity regular'><span class='profileLink'>$a_sender</span><span>$innerStr</span><span class='profileLink'>$a_receiver</span><span class='timeStamp'>$a_time</span></div>";
          } elseif ($a_type == 3) {
            //comment
            $innerStr = " commented: ";
            echo "<div class='activity comment'><span class='profileLink'>$a_sender</span><span>$innerStr</span><span>$content</span><span class='timeStamp'>$a_time</span></div>";
          } elseif ($a_type == 4) {
            //reject
            $innerStr = "rejected this candidate.  ";
            echo "<div class='activity regular'><span class='profileLink'>$a_sender</span><span>$innerStr</span><button class='btn btn-danger btn-xs' type='button' id='rejectButton' href='/recruiter/contents/candidate.php?id=".$id."&showEmail=reject'>Send Rejection</button><span class='timeStamp'>$a_time</span></div>";
          } elseif ($a_type == 5) {
            //send reject
            $innerStr = " sent a rejection letter to the candidate.";
            echo "<div class='activity statusChange'><span class='profileLink'>$a_sender</span><span>$innerStr</span><span class='timeStamp'>$a_time</span></div>";
          } elseif ($a_type == 6) {
            //send reject
            $innerStr = " requested an interview with the candidate.  ";
            echo "<div class='activity regular'><span class='profileLink'>$a_sender</span><span>$innerStr</span><button class='btn btn-warning btn-xs' type='button' id='interviewButton' href='/recruiter/contents/candidate.php?id=".$id."&showInterview=true'>Schedule Interview</button><span class='timeStamp'>$a_time</span></div>";
          }
        }

        echo "</div>
              <div id='actionControl'>
                <span id='actionSelector'>
                  <select id='mySelect'>
                    <option selected='true' id='selectComment'>Add Comment</option>
                    <option id='selectReview'>Add Reviewer</option>
                  </select>
                </span>
                <span id='reviewerInputContainer'><input id='reviewerInput'/></span>
                <span id='reviewerToken'>mclean  <button type='button' class='close' id='deleteToken'>&times;</button></span>
              </div>
              <div id='actionInputContainer'>
                <textarea id='actionInput' rows='5'></textarea>
              </div>
              <div id='confirmButton'>
                Post Action
              </div>
            </div>
            <div id='tabInterviewPage' class='inProfilePage'>
              <div id='interviewList'>
                No interviews yet.
              </div>
              <button id='newInterviewButton' class='btn btn-primary btn-lg'>
                New Interview
              </button>
            </div>
            <div id='tabInfoPage' class='inProfilePage'>";
            
        echo "<table id='moreInfoTable'>
                  <tr>
                    <td id='schoolLabel' class='myLabel'>School:</td>
                    <td id='school'>$c_school</td>
                  </tr>
                  <tr>
                    <td id='educationLabel' class='myLabel'>Education:</td>
                    <td id='education'>$c_education</td>
                  </tr>
                  <tr>
                    <td id='majorLabel' class='myLabel'>Major:</td>
                    <td id='major'>$c_major</td>
                  </tr>
                  <tr class='lastRow'>
                    <td id='resumeLabel' class='myLabel'>Resume:</td>
                    <td id='resume'><input id='infoFileButton' name='infoFileButton1' class='input-file' type='file'></td>
                  </tr>
                </table>";


        echo "</div>
          </div>
        </div>
      </div>";
      mysqli_close($con);
      ?>
    </div>
  </body>
</html>