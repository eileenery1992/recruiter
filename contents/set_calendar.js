$(document).ready(function() {
   var $calendar = $('#calendar');
   var id = 10;

   $calendar.weekCalendar({
      timeslotsPerHour : 4,
      allowCalEventOverlap : true,
      overlapEventsSeparate: true,
      businessHours :{start: 8, end: 18, limitDisplay: true },
      daysToShow : 5,
      height : function($calendar) {
         return $(window).height() ;
      },
	  width : function($calendar) {
         return $(window).width() ;
      },
      events: toEvents(),
      eventRender : function(calEvent, $event) {
         if (calEvent.end.getTime() < new Date().getTime()) {
            $event.css("backgroundColor", "#aaa");
            $event.children(".wc-time").css({
               "backgroundColor" : "#999",
               "border" : "1px solid #888"
            });
         };
		 $event.children(".wc-title").css({
               "display" : "none"
			   });
      },
      draggable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      eventNew : function(calEvent, $event) {
      },
      eventDrop : function(calEvent, $event) {
      },
      eventResize : function(calEvent, calEventOld, $event) {
      },
      eventClick : function(calEvent, $event) {
      },
      eventMouseover : function(calEvent, $event) {
      },
      eventMouseout : function(calEvent, $event) {
      },
      noEvents : function() {
      }
   });


});

function toEvents(){
  var events = [];
  var json = $.getJSON("list_availability.php", function(r){
    alert(r);
    $.each(r, function(i, obj){
    console.log(obj);
    events.push({'id':obj.TID, 'start':obj.Start, 'end':obj.End, 'title':''});
    });
  });
  return events;
}
