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
    <!--new app from resume Modal -->
    <div class="modal fade" id="newFromResume" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">New Application</h4>
          </div>
          <div class="modal-body">
            <p>Create new application from resume?</p>
            <input id="filebutton1" name="filebutton1" class="input-file" type="file">
          </div>
          <div class="modal-footer">
            <button id="toForm" type="button" class="btn btn-default" data-dismiss="modal">No, take me to the form</button>
            <button id="createFromResumeBtn" type="button" class="btn btn-primary">Create</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- new app from form Modal -->
	
    <div class="modal fade" id="newFromForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" id="closeForm" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">New Application     ID: <span id='newCID'></span></h4>
          </div>
          <div class="modal-body">
            <form id='form_candidate' class="form-horizontal">
              <fieldset>
              <!-- Text input-->
              <div class="control-group">
                <label class="control-label" id="controlLabel1" for="nameInput">Name *</label>
                <span class="controls">
                  <input id="nameInput" name="nameInput" type="text" placeholder="" class="input-xlarge" required="">   
                </span>
              </div>

              <!-- Text input-->
              <div class="control-group">
                <label class="control-label" id="controlLabel2" for="emailInput">Email *</label>
                <span class="controls">
                  <input id="emailInput" name="emailInput" type="text" placeholder="" class="input-xlarge" required="">    
                </span>
              </div>

              <!-- Text input-->
              <div class="control-group">
                <label class="control-label" id="controlLabel3" for="phoneInput">Phone *</label>
                <span class="controls">
                  <input id="phoneInput" name="phoneInput" type="text" placeholder="" class="input-xlarge" required="">    
                </span>
              </div>

              <!-- Text input-->
              <div class="control-group">
                <label class="control-label" id="controlLabel4" for="schoolInput">School</label>
                <span class="controls">
                  <input id="schoolInput" name="schoolInput" type="text" placeholder="" class="input-xlarge">    
                </span>
              </div>

              <!-- Select Basic -->
              <div class="control-group">
                <label class="control-label" id="controlLabel5" for="educationInput">Education Degree</label>
                <span class="controls">
                  <input id="educationInput" name="educationInput" type="text" placeholder="" class="input-xlarge">    
                </span>
              </div>

              <!-- Text input-->
              <div class="control-group">
                <label class="control-label" id="controlLabel6" for="majorInput">Major</label>
                <span class="controls">
                  <input id="majorInput" name="majorInput" type="text" placeholder="" class="input-xlarge">   
                </span>
              </div>

              <!-- Select Multiple -->
              <div class="control-group">
                <label class="control-label" id="controlLabel7" for="positionInput">Position *</label>
                <span class="controls">
                  <select id="positionInput" name="positionInput" class="input-xlarge" multiple="multiple" required="">
                    <option>Product Manager</option>
                    <option>QA</option>
                    <option>Software Developer</option>
                    <option>UI Designer</option>
                  </select>
                </span>
              </div>

              <!-- File Button --> 
              <div class="control-group">
                <label class="control-label" id="controlLabel8" for="filebutton2">Resume</label>
                <span class="controls">
                  <input id="filebutton2" name="filebutton2" class="input-file" type="file">
                </span>
              </div>

          </div><!--modal-body -->
          <div class="modal-footer">
            <button id="toResumeUpload" type="button" class="btn btn-default" data-dismiss="modal">Back</button>
            <input id="createBtn" type="submit" value="Create" class="btn btn-primary" >
          </div>
              </fieldset>
              </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div id="titleBar">
      <div id="title"><img src="graphics/title3.png"/></div>
      <div id="toolBar">
        <div id="greeting">Hi, <span id="profile">Laura</span>!</div>
      </div>
    </div>
    <div id="content">
      <div id="controlPanel">
        <div class="tabControl" id="tabCandidate">  Candidates</div>
        
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

            $extraClass = '';

            if ($count == 0) {
              $extraClass=' zeroBadge';
            }
            echo "<div class='tabControl' id='tabTask' href='/recruiter/contents/tasks.php'><span class='mewBadge".$extraClass."' id='notification'>";
            echo $count;
            mysqli_close($con);
          ?>
        </span>    My Tasks</div>
        <div class="tabControl" id="tabDirectory" href="/recruiter/contents/directory.php">  Directory</div>
      </div>
      <div id="pagePanel">
        <div class="tabPage" id="tabCandidatePage">
          <!-- Button trigger modal -->
          <button id="newAppBtn" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newFromResume">
            New Application
          </button>

          <div class="pageTitle">Search Candidates</div>
          <!--
          <div class="input-group marginTop" id="searchBar">
            <input type="text" class="default-value form-control" value="ID/name/email">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
            </span>
          </div>-->
          <table class="table-hover table" id="candidatesTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th class="filter-select" data-placeholder="Select a position">Position</th>
                <th class="filter-select" data-placeholder="Select a status">Status</th>
                <th>Last Updated</th>
              </tr>
            </thead>
            <tbody>
              <?php include"candidate_table.php"; ?>
            </tbody>
          </table><!--candidatesTable -->
        </div>
      </div>
    </div>
  </body>
</html>
