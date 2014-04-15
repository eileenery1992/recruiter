var selected = "tabCandidate";

var updateTabs = function() {
  $(".tabControl").css("background-color", "#e9eaed").css("z-index", 1);
  $(".tabPage").css("display", "none").css("z-index", 1);
  if (selected.length != 0) {
    $("#" + selected).css("background-color", "white").css("z-index", 3);
    $("#" + selected + "Page").css("display", "block").css("z-index", 2);
  } else {
    $("#tabProfilePage").css("display", "block").css("z-index", 2);
  }
}

$(document).ready(function() {

  updateTabs();

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
  });

});