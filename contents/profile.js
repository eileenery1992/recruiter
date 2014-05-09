var selected = "tabCandidate";
var candidate = "Ben";
var rejected = 0;
var sent = 0;
var requested = 0;
var scheduled = 0;
var interviewers = ['Mike Mclean (mclean)']
var reviewers = ['Mike McLean (mclean)']
var token = 0;
var rejecting = 0;



var rejectTitle = "Thank you for your interest";
var rejectMessage = "Hello,\n\nThank you for your interest in Geekle! Unfortunately we are not able to move on with your application. Please consider reapplying next year!";
var offerTitle = "Congratulations";
var offerMessage = "We would love you to join us at Geekle!";

function updateTabs() {
  $(".tabControl").css("background-color", "#e9eaed").css("z-index", 1);
  if (selected.length != 0) {
    $("#" + selected).css("background-color", "white").css("z-index", 3);
  }  
}

function popEmail(recipient, template) {
  $("#recipient").html(recipient);
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
  
  $("#newEmail").modal("show"); 
}


function addReviewer() {
  $('#reviewerInput').val('');   // clears input field 
  $("#reviewerToken").css("display", "inline-block");
  $("#confirmButton").css("background-color", "#388ac1");
  token = 1;
}

function setAutocompRev(inputElem, source){
  // Turn on autocompletion
  inputElem.autocomplete({ 
    source: source, 
    select:function(event, ui){
      if (event.which==1 || event.which == 13){    // 1 for clicking, 13 for entering
        // Do stuff
        addReviewer();
      }
      return false; 
    }
  });
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
    if ($(this).attr("href").length > 0) {
      window.document.location = $(this).attr("href");
    }   
  });

  if (benLoaded == 0) {
    addAction2("mclean", "interview", "");
    benLoaded = 1;
  }


  $("#actionInput").keyup(function() {
    if ($(this).val().length != 0) {
      $("#confirmButton").css("backgroundColor", "#388ac1");
    } else {
      $("#confirmButton").css("backgroundColor", "gray");
    }
  });

  $("#confirmButton").click(function() {
    var option = $("#mySelect").find(":selected").text();
    if (option == "Add Comment") {
      var comment = $("#actionInput").val();
      $("#actionInput").val("");
      if (comment.length != 0) {
        addAction("laura", "comment", comment);
      }
    } else {
      if (token == 1) {
        addAction("laura", "review", "mclean");
        var reviewerLink = document.createElement("span");
        reviewerLink.innerHTML = "mclean";
        reviewerLink.className = "profileLink";
        $("#rev").append(reviewerLink);
        $("#notification").css("display", "inline-block");
        addTask(t);
      }
    }
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
    popEmail($("#profileName").html().concat("&#60;").concat($("#profileEmail").html()).concat("&#62;"), "empty");
  });

  $("#cancelEmailButton").click(function() {
    $("#newEmail").modal("hide");
  });

  $("#sendEmailButton").click(function() {
    $("#newEmail").modal("hide");
    $("#emailSendConfirmation").modal("show");
  });

  $("#confirmSend").click(function() {
    $("#emailSendConfirmation").modal("hide");
    $("#emailSent").modal("show");
    $("#rejectButton").css("background-color", "gray").css("border-color", "gray");
    if (sent == 0) {
      addAction("laura", "send", "");
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
    $("#confirmButton").css("background-color", "gray");
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

  setAutocompRev($('#reviewerInput'), reviewers);
  
};

var loadAlex = function() {

  var reviewerLink2 = document.createElement("span");
  reviewerLink2.innerHTML = "mclean";
  reviewerLink2.className = "profileLink";
  $("#rev2").append(reviewerLink2);

  $("#actionInput2").keyup(function() {
    if ($(this).val().length != 0) {
      $("#confirmButton2").css("backgroundColor", "#388ac1");
    } else {
      $("#confirmButton2").css("backgroundColor", "gray");
    }
  });

  $("#confirmButton2").click(function() {
    var option = $("#mySelect2").find(":selected").text();
    if (option == "Add Comment") {
      var comment = $("#actionInput2").val();
      $("#actionInput2").val("");
      if (comment.length != 0) {
        addAction2("laura", "comment", comment);
      }
    } else {
      var reviewer = $("#reviewerInput2").val();
      if (reviewer == "mclean") {
        addAction2("laura", "review", reviewer);
      }
    }
  });

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
    $('#newInterview').modal('show');
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
    if (this.id == "tabTask") {
      $("#notification").css("display", "none");
    }
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
    return false;
  });

  $(".buttonSchedule").click(function() {
    
$("#newInterview").modal("show");
    var l = this.parentNode.parentNode.childNodes;
    var name = l[1].innerText;
    var id = l[0].innerText;
    $('#candidateName').text(name);
    $('#candidateID').text(id);    
    return false;
  });

  $(".buttonRejection").click(function() {
    var cid = this.parentNode.parentNode.childNodes[0].innerText;
    $.post('query_email.php', {cid: cid}, function(data) {
      popEmail(data, "reject");
    });
    return false;
  });

  $(".buttonOffer").click(function() {
    var cid = this.parentNode.parentNode.childNodes[0].innerText;
    $.post('query_email.php', {cid: cid}, function(data) {
      popEmail(data, "offer");
    });
    return false;
  });



  loadBen();
  loadAlex();
});
