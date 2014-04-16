var d1 = new Date(2014, 4, 10);
var d2 = new Date(2014, 2, 3);
var d3 = new Date(2014, 3, 8);
var d4 = new Date(2014, 3, 10);
var d5 = new Date(2014, 1, 20);
var d6 = new Date(2014, 2, 28);

var apps={
      10086: {"name": "Ben Biddiddle", "tel": 6172531234, "email": "bitdiddle@mit.edu", "pos": "UI Designer", "status": "Just Added", "date": d1}, 
      10023: {"name": "Alex Armstrong", "tel": 6172535678, "email": "arms@mit.edu", "pos": "UI Designer", "status": "2nd Interview", "date": d2}, 
      11225: {"name": "Jack Wang", "tel": 6172535678, "email": "jwang@mit.edu", "pos": "QA", "status": "1st Interview", "date": d6}, 
      10001: {"name": "Edison Chen", "tel": 6172535678, "email": "echen@mit.edu", "pos": "Software Developer", "status": "Declined", "date": d4}, 
      11000: {"name": "Frank Andrews", "tel": 6172535678, "email": "andrews@mit.edu", "pos": "Software Developer", "status": "1st Interview", "date": d3}, 
      10661: {"name": "Kate Park", "tel": 6172535678, "email": "park@mit.edu", "pos": "UI Designer", "status": "Accepted", "date": d5},}

var IDs = [10023, 11225, 10001, 11000, 10661];

var writeBen = function() {
  var app = apps[10086];
  $("#candidatesTable tr:last").after("<tr><td>".concat(
  10086, "</td><td>",
  app["name"], "</td><td>",
  app["pos"], "</td><td>",
  app["status"], "</td><td>",
  app["date"].toDateString(), "</td></tr>"));
};

$(function(){


  $.each(IDs, function(index, value){
    var app = apps[value];
    $("#candidatesTable tr:last").after("<tr><td>".concat(
    value, "</td><td>",
    app["name"], "</td><td>",
    app["pos"], "</td><td>",
    app["status"], "</td><td>",
    app["date"].toDateString(), "</td></tr>"));
  });

  $("#toForm").click(function(event) {
    $("#newFromForm").modal("show");
  });

  $("#toResumeUpload").click(function(event) {
    $("#newFromResume").modal("show");
  });

  $("#createBtn").click(function(event) {
    writeBen();
    selected = "";
    updateTabs();
  });

  $("#createFromResumeBtn").click(function(event) {
    if ($("#filebutton").val()) {
      $("#newFromResume").modal("hide");
      writeBen();
      selected = "";
      updateTabs();
    }else {
      alert("Please upload a resume");
    }
  });

  $("#closeForm").click(function(event) {
    var ans = confirm("Are you sure you want to leave? Application is not saved.");
    if (ans){
      $("#newFromForm").modal("hide");
    }
  });

  var t = {"ID": 10086, "action": "Send Rejection"};
  var addTask = function(task) {
    var app = apps[task["ID"]];
    $("#taskTable tr:last").after("<tr><td>".concat(
    task["ID"], "</td><td>",
    app["name"], "</td><td>",
    app["pos"], "</td><td>",
    app["status"], "</td><td><button class='btn btn-default'>",
    task["action"], "</button></td></tr>"));
  }
  addTask(t);
  
  var t2 = {'ID':10023, 'action': 'Schedule Interview'};
  addTask(t2);

  var goToAction = function(action, id) {
    switch(action) {
      case "Send Rejection":
        selected = "";
        candidate = "Ben";
        if (rejected == 0) {
          addAction("mclean", "reject", "");
          rejected = 1;
        }
        $("#newEmail").modal("show");
        $("#rejectButton").click(function() {
          $("#newEmail").modal("show");
        });
        updateTabs();
        break;
      case "Interview Availability":
        break;
      case "Send Offer":
        break;
      case "Schedule Interview":
        $('#newInterview').modal('show');
		$('#candidateName').text(apps[id]['name']);
		$('#candidateID').text(id);
		
      case "Send Interview Time":
        break;
    }
  }

  $("#taskTable").on("click", "td", function(e) {
    var header = e.delegateTarget.tHead.rows[0].cells[this.cellIndex].innerHTML;
    if (header=="Action Required") {
      var id = parseInt(e.target.parentNode.parentNode.cells[0].innerHTML);
      var action = e.target.innerHTML;
      goToAction(action, id);
      
    }else {
      selected = "";
      var id = parseInt(e.target.parentNode.cells[0].innerHTML);
      if (id == 10086) {
        candidate = "Ben";
      } else if (id == 10023) {
        candidate = "Alex";
      }
      updateTabs();

      if (candidate == "Ben") {
        if (rejected == 0) {
          addAction("mclean", "reject", "");
          rejected = 1;
        }
        $("#rejectButton").click(function() {
          $("#newEmail").modal("show");
        });
      }

      
    }
  });
});
