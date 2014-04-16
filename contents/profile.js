var selected = "tabCandidate";
var candidate = "Ben";
var rejected = 0;

function updateTabs(){
  $(".tabControl").css("background-color", "#e9eaed").css("z-index", 1);
  $(".tabPage").css("display", "none").css("z-index", 1);
  if (selected.length != 0) {
    $("#" + selected).css("background-color", "white").css("z-index", 3);
    $("#" + selected + "Page").css("display", "block").css("z-index", 2);
  } else {
    if (candidate == "Ben") {
      $("#tabProfilePage").css("display", "block").css("z-index", 2);
      $("#tabProfilePage2").css("display", "none").css("z-index", 2);
    } else {
      $("#tabProfilePage2").css("display", "block").css("z-index", 2);
      $("#tabProfilePage").css("display", "none").css("z-index", 2);
    }
  }   
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
  }
  activity.className = "activity " + activityClass;
  activity.appendChild(profileLink);
  activity.appendChild(comment);
  activity.appendChild(timeStamp);
  $("#activityList2").append(activity);
}


var benLoaded = 0;

var loadBen = function() {

  updateTabs();

  if (benLoaded == 0) {
    addAction("laura", "create", "");
    addAction2("laura", "create", "");
    benLoaded = 1;
  }

  $("#actionInput").keyup(function() {
    if ($(this).val().length != 0) {
      $("#confirmButton").css("backgroundColor", "#388ac1");
    } else {
      $("#confirmButton").css("backgroundColor", "gay");
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
      var reviewer = $("#reviewerInput").val();
      if (reviewer == "mclean") {
        addAction("laura", "review", reviewer);
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
  });

  $("#profile").hover(function() {
    this.style.textDecoration = "underline";
  }, function() {
    this.style.textDecoration = "none";
  }).click(function() {
    selected = "";
    updateTabs();
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
    candidate = "Alex";
    updateTabs();
    loadAlex();
  });

  $("#cancelEmailButton").click(function() {
    $("#newEmail").modal("hide");
  });

  $("#sendEmailButton").click(function() {
    $("#newEmail").modal("hide");
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

  $(".profileTab.unselected, .profileTab.selected").hover(function() {
    $(this).addClass("hovering");
  }, function(){
    $(this).removeClass("hovering");
  }).click(function() {
    $(".profileTab.selected").removeClass("selected").addClass("unselected");
    this.className = "profileTab selected";
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

  $("#email2").hover(function() {
    this.style.textDecoration = "underline";
  }, function() {
    this.style.textDecoration = "none";
  }).click(function() {
    $("#newEmail").modal("show");
  });

  $("#cancelEmailButton2").click(function() {
    $("#newEmail").modal("hide");
  });

  $("#sendEmailButton2").click(function() {
    $("#newEmail").modal("hide");
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
    updateTabs();
  });
  loadBen();
});