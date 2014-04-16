var selected = "tabCandidate";
var candidate = "Ben";

function updateTabs(){
  console.log("mewww"); 
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

function mew() {
  console.log("mew");
}

var addAction = function(actor, type, content) {
  var activity = document.createElement("div");
  var profileLink = document.createElement("span");
  profileLink.innerHTML = "laura";
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
  }
  activity.className = "activity " + activityClass;
  activity.appendChild(profileLink);
  activity.appendChild(comment);
  activity.appendChild(timeStamp);
  $("#activityList").append(activity);
}

$(document).ready(function() {

  updateTabs();
  mew();

  addAction("laura", "create", "");

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
    console.log("before");
    updateTabs();
    console.log("after");
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

});