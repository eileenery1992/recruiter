$(document).ready(function() {
   var $calendar = $('#calendar');
   var id = 0;

   $calendar.weekCalendar({
      timeslotsPerHour : 4,
      allowCalEventOverlap : false,
      overlapEventsSeparate: true,
	  useShortDayNames: true,
	  timeSeparator: '-',
	  buttonText: {today : 'today', lastWeek : '<', nextWeek : '>'},
      businessHours :{start: 8, end: 18, limitDisplay: true },
      daysToShow : 5,
      height : function($calendar) {
         return 450;
      },
	  newEventText: '',
      eventRender : function(calEvent, $event) {
		var btn = document.createElement('button');
		btn.textContent='delete';
		btn.addEventListener('click', function() {
			$("#calendar").weekCalendar("removeEvent", calEvent.id);
			console.log(calEvent.id);
		});
		$event.append(btn);
		console.log(calEvent)
         if (calEvent.end.getTime() < new Date().getTime()) {
            $event.css("backgroundColor", "#aaa");
            $event.children(".wc-time").css({
               "backgroundColor" : "#999",
               "border" : "1px solid #888"
            });
         };

      },
	  eventNew: function(calEvent, element, dayFreeBusyManager, 
                                                    calendar, mouseupEvent) {
		calEvent.id = id;
		id+=1;
        },
      draggable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
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
   
   var timeSelected = {};
   var interviewType = '';
   var interviewers = '';
   


});

function addInterviewer(name){
	var intrElem = document.createElement('li');
	intrElem.textContent = name;
	var delBtn = document.createElement('button');
	
	$('#intrList').appendChild()
	}