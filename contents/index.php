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
      <div id="pagePanel">
        <div class="tabPage" id="tabCandidatePage">
          <!-- Button trigger modal -->
          <button id="newAppBtn" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#newFromResume">
            New Application
          </button>

          <div class="pageTitle">Search Candidates</div>
          <div class="input-group marginTop" id="searchBar">
            <input type="text" class="default-value form-control" value="ID/name/email">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
            </span>
          </div><!-- /searchBar -->
          <div id="filters" class="marginTop">
            <input type="checkbox" class="marginTop">Active Only
            <div class="marginTop" id="statusFilters">
              <div class="input-group">
                <input type="checkbox">Just Added 
                <input type="checkbox">1st Interview 
                <input type="checkbox">2nd Interview 
                <input type="checkbox">Accepted 
                <input type="checkbox">Offer Pending 
                <input type="checkbox">Declined 
                <input type="checkbox">Rejected 
              </div><!-- /input-group -->
            </div><!-- /statusFilters -->
            <div class="marginTop" id="positionFilters">
              <div class="input-group">
                <input type="checkbox">QA 
                <input type="checkbox">Product Manager 
                <input type="checkbox">Software Developer
                <input type="checkbox">UI Designer 
              </div><!-- /input-group -->
            </div><!-- /positionFilters -->
            <!--<button type="button" class="btn btn-danger" data-toggle="collapse" data-target="#advancedFilters">
              Advanced Filters
            </button>
            <div id="advancedFilters" class="collapse in">
            </div>-->
          </div><!-- /filters -->
          <table class="table-hover table" id="candidatesTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Status</th>
                <th>Last Updated</th>
              </tr>
              <?php include "candidate_table.php"; ?>
            </thead>
            <tbody>
              <tr></tr>
            </tbody>
          </table><!--candidatesTable -->
        </div>
      </div>
    </div>
  </body>
</html>
