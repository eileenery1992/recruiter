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
    <div id="titleBar">
      <div id="title"><img src="graphics/title3.png"/></div>
      <div id="toolBar">
        <div id="greeting">Hi, <span id="profile">Laura</span>!</div>
      </div>
    </div>
    <div id="content">
      <div id="controlPanel">
        <div class="tabControl" id="tabCandidate">  Candidates</div>
        <div class="tabControl" id="tabTask"><img src="graphics/dot1.png" id="notification"/>    My Tasks</div>
        <div class="tabControl" id="tabSchedule">  Schedule</div>
        <div class="tabControl" id="tabPosition">  Positions</div>
      </div>
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
        echo "<div id='pagePanel'>
          <div class='tabPage' id='tabProfilePage'>
            <table id='profileHeader'><tr valign='baseline'>
              <td id='profileTitle'>Application $id</td>
              <td id='editButtonContainer'><div id='editButton'>Edit</div></td>
            </tr>
          </table>
          <table id='profileInfo'>
            <tr>
              <td id='leftColumn'>
                <table id='infoTable'>
                  <tr>
                    <td id='nameLabel' class='myLabel'>Name:</td>
                    <td id='name'>$c_name</td>
                  </tr>
                  <tr>
                    <td id='emailLabel' class='myLabel'>Email:</td>
                    <td id='email'>$c_email</td>
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
              <td id='rightColumn'>
                <div id='statusButton' class='activeStatus'>Just Added</div>
              </td>
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
              <div id='activityList'>
              </div>
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
            <div id='tabInfoPage' class='inProfilePage'>This page is under construction.</div>
          </div>
        </div>
      </div>";
      mysqli_close($con);
      ?>
    </div>
  </body>
</html>