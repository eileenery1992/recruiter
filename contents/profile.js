var selected = "tabCandidate";
var candidate = "Ben";
var rejected = 0;
var sent = 0;
var requested = 0;
var scheduled = 0;
var interviewers = ['Mike Mclean (mclean)']
var reviewers = ['Mike McLean (mclean)']
var token = 0;
var tokens = [];



var rejectTitle = "Thank you for your interest";
var rejectMessage = "Hello,\n\nThank you for your interest in Geekle! Sorry but we are not able to move on with your application. Please consider reapplying next year!";
var offerTitle = "Congratulations";
var offerMessage = "We would love to extend you an offer, and hope you will join us at Geekle!";

function updateTabs() {
  $(".tabControl").css("background-color", "#e9eaed").css("z-index", 1);
  if (selected.length != 0) {
    $("#" + selected).css("background-color", "white").css("z-index", 3);
  }  
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function loadEmail(id, name, email, template) {
  $("#recipient").html(name.concat("&#60;").concat(email).concat("&#62;"));
  if (template == "empty") {
    $("#titleInput").val("");
    $("#messageInput").val("");
  } else if (template == "offer") {
    $("#titleInput").val(offerTitle);
    $("#messageInput").val(offerMessage);
  } else if (template == "reject") {
    $("#titleInput").val(rejectTitle);
    $("#messageInput").val(rejectMessage);
  }
}

function confirmEnable() {
  $("#confirmButton").css("backgroundColor", "#388ac1").css("cursor", "pointer");
}

function confirmDisable() {
  $("#confirmButton").css("backgroundColor", "gray").css("cursor", "default");
}

function addReviewer() {
  $('#reviewerInput').val('');   // clears input field 
  $("#reviewerToken").css("display", "inline-block");
  $("#confirmButton").css("background-color", "#388ac1").css("cursor", "pointer");
  token = 1;
}

var switchToInterview = function() {
    $(".profileTab2.selected").removeClass("selected").addClass("unselected");
    $("#tabInterview2").removeClass("unselected").addClass("selected");
    $("#tabInterview2Page2").removeClass("unselected").addClass("selected");
    $(".inProfilePage2").css("display", "none");
    $("#tabInterview2Page2").css("display", "block");
}

var addAction = function(actor, type, content) {
  var activity = document.createElement("div");
  var profileLink = document.createElement("span");
  profileLink.innerHTML = actor;
  profileLink.className = "profileLink";
  var timeStamp = document.createElement("span");
  timeStamp.innerHTML = new Date().toLocaleString();
  timeStamp.className = "timeStamp";
  var comment = document.createElement("span");
  var activityClass = "";
  if (type == "create") {
    comment.innerHTML = " created application: 10086";
    activityClass = "statusChange";
  } else if (type == "review") {
    comment.innerHTML = " added reviewer: ";
    var reviewer = document.createElement("span");
    reviewer.innerHTML = content;
    reviewer.className = "profileLink";
    comment.appendChild(reviewer);
    activityClass = "regular";
  } else if (type == "comment") {
    comment.innerHTML = " commented: " + content;
    activityClass = "comment";
  } else if (type == "reject") {
    comment.innerHTML = " rejected this candidate: " + content;
    activityClass = "regular";
  } else if (type == "send") {
    comment.innerHTML = " sent rejection letter to the candidate."
    activityClass = "reject";
  }
  activity.className = "activity " + activityClass;
  activity.appendChild(profileLink);
  activity.appendChild(comment);
  if (type == "reject") {
    var rejectButton = document.createElement("button");
    rejectButton.innerHTML = "Send Rejection";
    rejectButton.type = "button";
    rejectButton.className = "btn btn-danger btn-xs";
    rejectButton.id = "rejectButton";
    activity.appendChild(rejectButton);
  }
  activity.appendChild(timeStamp);
  $("#activityList").append(activity);
}

var addAction2 = function(actor, type, content) {
  var activity = document.createElement("div");
  var profileLink = document.createElement("span");
  profileLink.innerHTML = actor;
  profileLink.className = "profileLink";
  var timeStamp = document.createElement("span");
  timeStamp.innerHTML = new Date().toLocaleString();
  timeStamp.className = "timeStamp";
  var comment = document.createElement("span");
  var activityClass = "";
  if (type == "create") {
    comment.innerHTML = " created application: 10023";
    activityClass = "statusChange";
  } else if (type == "review") {
    comment.innerHTML = " added reviewer: ";
    var reviewer = document.createElement("span");
    reviewer.innerHTML = content;
    reviewer.className = "profileLink";
    comment.appendChild(reviewer);
    activityClass = "regular";
  } else if (type == "comment") {
    comment.innerHTML = " commented: " + content;
    activityClass = "comment";
  } else if (type == "interview") {
    comment.innerHTML = " requested an interview.  ";
    activityClass = "regular";
  } else if (type == "schedule") {
    comment.innerHTML = " scheduled an ";
    var interview = document.createElement("span");
    interview.innerHTML = "interview."
    interview.className = "profileLink";
    interview.id = "interviewLink";
    comment.appendChild(interview);
    activityClass = "regular";
  }
  activity.className = "activity " + activityClass;
  activity.appendChild(profileLink);
  activity.appendChild(comment);
  if (type == "interview") {
    var interviewButton = document.createElement("button");
    interviewButton.innerHTML = "Schedule Interview";
    interviewButton.type = "button";
    interviewButton.className = "btn btn-warning btn-xs";
    interviewButton.id = "interviewButton";
    activity.appendChild(interviewButton);
  }
  activity.appendChild(timeStamp);
  $("#activityList2").append(activity);
}


var benLoaded = 0;

var loadBen = function() {

  updateTabs();

  $(".clickableRow").click(function() {
    window.document.location = $(this).attr("href");
  });

  $(".tabControl").click(function() {
    if ($(this).attr("href") && $(this).attr("href").length > 0) {
      window.document.location = $(this).attr("href");
    }   
  });

  if (benLoaded == 0) {
    benLoaded = 1;
  }


  $("#actionInput").keyup(function() {
    if ($(this).val().length != 0) {
      $("#confirmButton").css("backgroundColor", "#388ac1").css("cursor", "pointer");
    } else {
      $("#confirmButton").css("backgroundColor", "gray").css("cursor", "default");
    }
  });

  $("#confirmButton").click(function() {
    var cid = $("#profileID").html();
    var option = $("#mySelect").find(":selected").text();
    if (option == "Add Comment") {
      var comment = $("#actionInput").val();
      $("#actionInput").val("");
      if (comment.length != 0) {
        var time = new Date().toLocaleString();
        $.post('post_action.php', {'action':3, 'CID':cid, 'content':comment, 'sender':'laura', 'time':time}, function(r){console.log('comment');});
        // addAction("laura", "comment", comment);
      }
    } else {
      if (tokens.length > 0) {
        // addAction("laura", "review", "mclean");
        var revs = "";
        for (var i=0; i < tokens.length; i++) {
          revs = revs + tokens[i].id;
        }
        $("#notification").css("display", "inline-block");
        var time = new Date().toLocaleString();
        $.post('post_action.php', {'action':2, 'CID':cid, 'sender':'laura', 'receiver':'mclean', 'time': time}, function(r){console.log('review');});
        $.post('add_reviewer.php', {'reviewer':'mclean', 'CID':cid}, function(r){console.log('review');});
        generate_response(1, cid);
      }
    }
    location.reload();
  });

  $(".profileTab.unselected, .profileTab.selected").hover(function() {
    $(this).addClass("hovering");
  }, function(){
    $(this).removeClass("hovering");
  }).click(function() {
    $(".profileTab.selected").removeClass("selected").addClass("unselected");
    this.className = "profileTab selected";
    $(".inProfilePage").css("display", "none");
    $("#" + this.id + "Page").css("display", "block");
  });

  $("#profile").hover(function() {
    this.style.textDecoration = "underline";
  }, function() {
    this.style.textDecoration = "none";
  });

  $('.default-value').each(function() {
    var default_value = this.value;
    $(this).focus(function(){
      if(this.value == default_value) {
      this.value = '';}
    });
    $(this).blur(function(){
      if(this.value == '') {
      this.value = default_value;}
    });});
  
  $("#editButton").hover(function() {
    this.style.textDecoration = "underline";
  }, function() {
    this.style.textDecoration = "none";
  });

  $("#email").hover(function() {
    this.style.textDecoration = "underline";
  }, function() {
    this.style.textDecoration = "none";
  }).click(function() {
    loadEmail($("#profileID").html(), $("#profileName").html(), $("#profileEmail").html(), "empty");
  });

  $("#cancelEmailButton").click(function() {
    $("#newEmail").modal("hide");
  });

  $("#sendEmailButton").click(function() {
    $("#newEmail").modal("hide");
    $("#emailSendConfirmation").modal("show");
  });

  $("#confirmSend").click(function() {
    var cid = $("#profileID").html();
    var message = $("#messageInput").val();
    var time = new Date().toLocaleString();
    if (message.indexOf("Sorry") > -1) {
      $.post('update_status.php', {'status': 8, 'cid':cid}, function(r){});
      $.post('post_action.php', {'action':3, 'CID':cid, 'sender':'laura', 'time':time}, function(r){console.log('rejected');});
    } else if (message.indexOf("offer") > -1) {
      console.log("OFFER");
      $.post('update_status.php', {'status': 5, 'cid':cid}, function(r){});
      $.post('post_action.php', {'action':4, 'CID':cid, 'sender':'laura', 'time':time}, function(r){});
    }
    
    $("#emailSendConfirmation").modal("hide");
    $("#emailSent").modal("show");
    $("#rejectButton").css("display", "none");
    if (sent == 0) {
      // addAction("laura", "send", "");
      sent = 1;
    } 
    $("#statusButton").text("Rejected").removeClass("activeStatus").addClass("inactiveStatus");
  });

  $("#cancelSend").click(function() {
    $("#emailSendConfirmation").modal("hide");
    $("#newEmail").modal("show");
  });

  $("#deleteToken").click(function() {
    $("#reviewerToken").css("display", "none");
    $("#confirmButton").css("background-color", "gray").css("cursor", "default");
    token = 0;
  });

  $("#closeAlert").click(function() {
    $("#emailSent").modal("hide");
    $("#notification").css("display", "inline-block");
    $("#t10086").css("display", "none");
    addTask(t2);
    apps[10086]["status"] = "Rejected";
    $("#c10086").find("td").eq(3).html("Rejected");
    apps[10023]["status"] = "1st Interview";
    $("#c10023").find("td").eq(3).html("1st Interview");
    $("#c10023").find("td").eq(4).html(d1.toDateString());
    
  });

  $("#mySelect").click(function() {
    if (this.selectedIndex == 0) {
      $("#actionInputContainer").css("display", "block");
      $("#reviewerInputContainer").css("display", "none");
    } else {
      $("#actionInputContainer").css("display", "none");
      $("#reviewerInputContainer").css("display", "inline-block");
    }
  });
  
};

var loadAlex = function() {

  var reviewerLink2 = document.createElement("span");
  reviewerLink2.innerHTML = "mclean";
  reviewerLink2.className = "profileLink";
  $("#rev2").append(reviewerLink2);


  $(".profileTab2.unselected, .profileTab2.selected").hover(function() {
    $(this).addClass("hovering");
  }, function(){
    $(this).removeClass("hovering");
  }).click(function() {
    $(".profileTab2.selected").removeClass("selected").addClass("unselected");
    this.className = "profileTab2 selected";
  });

  $('.default-value').each(function() {
    var default_value = this.value;
    $(this).focus(function(){
      if(this.value == default_value) {
      this.value = '';}
    });
    $(this).blur(function(){
      if(this.value == '') {
      this.value = default_value;}
    });});
  
  $("#editButton2").hover(function() {
    this.style.textDecoration = "underline";
  }, function() {
    this.style.textDecoration = "none";
  });

  $(".profileTab2.unselected, .profileTab2.selected").hover(function() {
    $(this).addClass("hovering");
  }, function(){
    $(this).removeClass("hovering");
  }).click(function() {
    $(".profileTab2.selected").removeClass("selected").addClass("unselected");
    this.className = "profileTab2 selected";
    $(".inProfilePage2").css("display", "none");
    $("#" + this.id + "Page2").css("display", "block");
  });

  $("#mySelect2").click(function() {
    if (this.selectedIndex == 0) {
      $("#actionInputContainer2").css("display", "block");
      $("#reviewerInputContainer2").css("display", "none");
    } else {
      $("#actionInputContainer2").css("display", "none");
      $("#reviewerInputContainer2").css("display", "inline-block");
    }
  });

  $("#newInterviewButton2").click(function() {
    $('#newInterview').modal('show');
  });

  $("#interviewButton").click(function() {
    window.document.location = $(this).attr("href");
  });

  $("#rejectButton").click(function() {
    window.document.location = $(this).attr("href");
  });


  $("#availability").click(function() {
    $('#newInterview').modal('show');
  });

  $("#deleteInterview").click(function() {
    $("#interviewDeleted").modal("show");
  });

  $("#cancelDeletion").click(function() {
    $("#interviewDeleted").modal("hide");
  });

  $("#confirmDeletion").click(function() {
    $("#interviewCard").css("display", "none");
    $("#emptyTag").css("display", "block");
    scheduled = 0;
    $("#interviewDeleted").modal("hide");
  });
};

$(document).ready(function() {
  if (document.getElementById("reviewerInput")) {
    $("#reviewerInput").tokenInput("/recruiter/contents/auto_complete.php", {
      tokenLimit: 1,
      onAdd: function (item) {
        confirmEnable();
        tokens = this.tokenInput("get");
      },
      onDelete: function (item) {
        tokens = this.tokenInput("get");
        if (this.tokenInput("get").length == 0) {
          confirmDisable();
        }
      }
    });
  }
  

  if (showEmail = getParameterByName('showEmail')) {
    loadEmail($("#profileID").html(), $("#profileName").html(), $("#profileEmail").html(), showEmail);
    $("#newEmail").modal("show");
  } 

  if (showInterview = getParameterByName('showInterview')) {
    $('#candidateName').text($("#profileName").html());
    $('#candidateID').text($("#profileID").html());    
    $("#newInterview").modal("show");
  } 

  $.get('interviews.php', {'cid': $('#profileID')[0].innerHTML},function(r){ 
    $("#interviewList")[0].innerHTML = r;
   console.log('interviews loaded', r);    
  });

  $(".tabControl").hover(function() {
    if (this.id != selected) {
      this.style.backgroundColor = "#f6f7f8";
    }
  }, function() {
    if (this.id != selected) {
      this.style.backgroundColor = "#e9eaed";
    }
  }).click(function() {
    selected = this.id;
    updateTabs();
  });
  if (document.URL.indexOf("candidate") > -1) {
    selected = "";
  } else if (document.URL.indexOf("tasks") > -1) {
    selected = "tabTask";
  } else if (document.URL.indexOf("directory") > -1) {
    selected = "tabDirectory";
  }

  $(".buttonReviewer").click(function() {
    window.document.location = $(this).attr("href");
    $("#mySelect").val("Add Reviewer");
    $("#actionInputContainer").css("display", "none");
    $("#reviewerInputContainer").css("display", "inline-block");
    return false;
  });

  $("#profileEmail").click(function() {
    window.document.location = $(this).attr("href");
  });

  $(".buttonSchedule").click(function() {
    window.document.location = $(this).attr("href");
    return false;
  });

  $(".buttonRejection").click(function() {
    window.document.location = $(this).attr("href");
    return false;
  });

  $(".buttonOffer").click(function() {
    window.document.location = $(this).attr("href");
    return false;
  });
  
  loadBen();
  loadAlex();
});
