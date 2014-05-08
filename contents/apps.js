var d1 = new Date();
var d2 = new Date(2014, 2, 3);
var d3 = new Date(2014, 3, 8);
var d4 = new Date(2014, 3, 10);
var d5 = new Date(2014, 1, 20);
var d6 = new Date(2014, 2, 28);

var apps={
      10086: {"name": "Ben Biddiddle", "tel": 6172531234, "email": "bitdiddle@mit.edu", "pos": "UI Designer", "status": "Just Added", "date": d1}, 
      10023: {"name": "Alex Armstrong", "tel": 6172535678, "email": "arms@mit.edu", "pos": "UI Designer", "status": "Just Added", "date": d2}, 
      11225: {"name": "Jack Wang", "tel": 6172535678, "email": "jwang@mit.edu", "pos": "QA", "status": "1st Interview", "date": d6}, 
      10001: {"name": "Edison Chen", "tel": 6172535678, "email": "echen@mit.edu", "pos": "Software Developer", "status": "Declined", "date": d4}, 
      11000: {"name": "Frank Andrews", "tel": 6172535678, "email": "andrews@mit.edu", "pos": "Software Developer", "status": "1st Interview", "date": d3}, 
      10661: {"name": "Kate Park", "tel": 6172535678, "email": "park@mit.edu", "pos": "UI Designer", "status": "Accepted", "date": d5},}

var IDs = [10023, 11225, 10001, 11000, 10661];
var outstandingTasks = [];

var add_task = function(action, id) {
  switch(action) {
    case "interview":
    break;
    case "reject":
    break;
    case "offer":
    break;
  }
};

var generate_response = function(status, cid) {
  var new_status = 0; 
  if (status<=4) {
    var ran = Math.random();
    if (ran<.5) {
      new_status = 8;
    } else{
      new_status = status + 1;
    }
  } else if(status==5) {
    var ran = Math.random();
    if (ran<.5) {
      new_status = 6;
    } else{
      new_status = 7;
    }}
  $.post('update_status.php', {'status':new_status, 'cid':cid}, function(r){console.log('updated');})
  if (new_status <= 4) {
    add_task("interview", cid);
  } else if (new_status == 8) {
    add_task("reject", cid);
  } else if (new_status==6 || new_status==7) {
    add_task("offer", cid);
  }
};

var writeBen = function() {
  var idx = IDs.indexOf(10086);
  if (idx == -1) {
    IDs.push(10086);
    var app = apps[10086];
    $("#candidatesTable tr:last").after("<tr id='c10086'><td>".concat(
    10086, "</td><td>",
    app["name"], "</td><td>",
    app["pos"], "</td><td>",
    app["status"], "</td><td>",
    app["date"].toDateString(), "</td></tr>"));
    $("#c10086").click(function(event) {
      selected = "";
      candidate = "Ben";
      updateTabs();
    });
  }
};

  var t = {"ID": 10086, "action": "Send Rejection"};
  var addTask = function(task) {
    var app = apps[task["ID"]];
    $("#taskTable tr:last").after("<tr id='t".concat(
    task["ID"], "'><td>",
    task["ID"], "</td><td>",
    app["name"], "</td><td>",
    app["pos"], "</td><td>",
    app["status"], "</td><td><button class='btn btn-default'>",
    task["action"], "</button></td></tr>"));
  }  
  var t2 = {'ID':10023, 'action': 'Schedule Interview'};

$(function(){


  $("#toForm").click(function(event) {
    $.getJSON("maxCID.php", function(data){
      $('#newCID').text(parseInt(data)+1);
      $("#newFromResume").modal("hide");
    });
  });

  $("#toResumeUpload").click(function(event) {
    $("#newFromResume").modal("show");
  });

  $("#createBtn").click(function(event) {
    writeBen();
    selected = "";
    candidate = "Ben";
    updateTabs();
  });

  $("#createFromResumeBtn").click(function(event) {
    if ($("#filebutton").val()) {
      $("#newFromResume").modal("hide");
      writeBen();
      selected = "";
      candidate = "Ben";
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



  var goToAction = function(action, id) {
    switch(action) {
      case "Send Rejection":
        selected = "";
        candidate = "Ben";
        if (rejected == 0) {
          addAction("mclean", "reject", "");
          rejected = 1;
        }
        $("#titleInput").val(rejectTitle);
        $("#messageInput").val(rejectMessage);
        $("#newEmail").modal("show");
        $("#rejectButton").click(function() {
          if (sent == 0) {
            $("#titleInput").val(rejectTitle);
            $("#messageInput").val(rejectMessage);
            $("#newEmail").modal("show");
          }
        });
        updateTabs();
        break;
      case "Interview Availability":
        break;
      case "Send Offer":
        break;
      case "Schedule Interview":
        selected = "";
        candidate = "Alex";
        switchToInterview();
        if (requested == 0) {
          addAction("mclean", "interview", "");
          requested = 1;
        }
        updateTabs();

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
          if (sent == 0) {
            $("#titleInput").val(rejectTitle);
            $("#messageInput").val(rejectMessage);
            $("#newEmail").modal("show");
          }
        });
      }

      
    }
  });


// variable to hold request
var request;
// bind to the submit event of our form
$("#form_candidate").submit(function(event){
    console.log('SUBMIT FORM');
    // abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);
    // let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");
    // serialize the data in the form
    var serializedData = $form.serialize();

    // let's disable the inputs for the duration of the ajax request
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // fire off the request to /form.php
    request = $.ajax({
        url: "form_test.php",
        type: "post",
        data: serializedData
    });

    // callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // log a message to the console
        var cid = response;
        console.log("New ID:", response);
        $('#newFromForm').modal('hide');
        generate_response(1, cid);
        window.document.location = "/recruiter/contents/candidate.php?id="+cid;
    });

    // callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // log the error to the console
        console.error(
            "The following error occured: "+
            textStatus, errorThrown
        );
    });

    // callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // reenable the inputs
        $inputs.prop("disabled", false);
    });

    // prevent default posting of form
    event.preventDefault();
});

  $.extend($.tablesorter.themes.bootstrap, {
    // these classes are added to the table. To see other table classes available,
    // look here: http://twitter.github.com/bootstrap/base-css.html#tables
    table      : 'table table-bordered',
    caption    : 'caption',
    header     : 'bootstrap-header', // give the header a gradient background
    footerRow  : '',
    footerCells: '',
    icons      : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
    sortNone   : 'bootstrap-icon-unsorted',
    sortAsc    : 'icon-chevron-up glyphicon glyphicon-chevron-up',     // includes classes for Bootstrap v2 & v3
    sortDesc   : 'icon-chevron-down glyphicon glyphicon-chevron-down', // includes classes for Bootstrap v2 & v3
    active     : '', // applied when column is sorted
    hover      : '', // use custom css here - bootstrap class may not override it
    filterRow  : '', // filter row class
    even       : '', // odd row zebra striping
    odd        : ''  // even row zebra striping
  });

  // call the tablesorter plugin and apply the uitheme widget
  $("table").tablesorter({
    // this will apply the bootstrap theme if "uitheme" widget is included
    // the widgetOptions.uitheme is no longer required to be set
    theme : "bootstrap",

    widthFixed: true,

    headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!

    // widget code contained in the jquery.tablesorter.widgets.js file
    // use the zebra stripe widget if you plan on hiding any rows (filter widget)
    widgets : [ "uitheme", "filter", "zebra" ],

    widgetOptions : {
      // using the default zebra striping class name, so it actually isn't included in the theme variable above
      // this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
      zebra : ["even", "odd"],

      // reset filters button
      filter_reset : ".reset"

      // set the uitheme widget to use the bootstrap theme class names
      // this is no longer required, if theme is set
      // ,uitheme : "bootstrap"

    }
  });

});
