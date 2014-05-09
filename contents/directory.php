<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>The Recruiter</title>
    <link type="text/css" href="jquery/css/ui-lightness/jquery-ui-1.10.0.custom.css" rel="stylesheet" />
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
<!-- bootstrap widget theme -->
<link rel="stylesheet" href="jquery/js/theme.bootstrap.css">
<!-- tablesorter plugin -->
<script src="jquery/js/jquery.tablesorter.js"></script>
<!-- tablesorter widget file - loaded after the plugin -->
<script src="jquery/js/jquery.tablesorter.widgets.js"></script>
    <link type="text/css" href="index.css" rel="stylesheet" />
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
        <div class="tabControl" id="tabCandidate" href="/recruiter/contents/index.php">  Candidates</div>
        <div class="tabControl" id="tabTask" href='/recruiter/contents/tasks.php'><span class='mewBadge' id='notification'>
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
            $query = 'SELECT * FROM Tasks';
            $result = mysqli_query($con, $query) or die('Query failed: ' . mysqli_error($con));
            $count = 0;
            while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
                $count = $count + 1;
            }

            echo $count;
            mysqli_close($con);
          ?>
        </span>    My Tasks</div>
        <div class="tabControl" id="tabDirectory">  Directory</div>
      </div>

      <div id="pagePanel">
        <div class="tabPage" id="tabDirectoryPage">
        <div class="pageTitle">Company Directory</div>
          <div id="interviewCard2">
                  <div id="cardTitle">
                    Mike Mclean (mclean)
                  </div>
                  <table id="interviewTable">
                    <tr>
                      <td>Position:</td>
                      <td>Hiring Manager/Interviewer</td>
                    </tr>
                    <tr>
                      <td>Department:</td>
                      <td>UI Design</td>
                    </tr>
                    <tr>
                      <td>Email:</td>
                      <td><span class="profileLink">mclean@geekle.com</span></td>
                    </tr>
                  </table>
                </div>
        </div>
      </div>
    </div>
  </body>
</html>
