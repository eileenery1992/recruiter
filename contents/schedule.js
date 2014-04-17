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
		});
		$event.append(btn);
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

   $('#intSendBtn').click(function(){
      if (scheduled == 0) {
         addAction2("laura", "schedule", "");
         $("#interviewLink").click(function() {
            switchToInterview();
         });
      }
      scheduled = 1;
		confirmSend($('#candidateName').text(), timeSelected(), $('#intrName').val(), $('#type').find(':selected').text());
      $("#emptyTag").css("display", "none");
      $("#interviewCard").css("display", "block");
      $("#intSendBtn").text("Save Changes & Exit");
      $("#t10023").css("display", "none");
	});

	// Autocomplete
	setAutocomp($('#intrName'), interviewers);
	$('#intrName').keydown(function(e){
		if(e.keyCode==13){	
			addInterviewer($(this).val());
			return false;
			}
		}
		);
});

function addInterviewer(name){
	if (name!='mclean'){return;}
	$('#intrName').val(''); 	// clears input field 
	var intrElem = document.createElement('li');
	intrElem.innerHTML = "Mike McLean (<a>mclean</a>)";
//	intrElem.innerHTML = '<span id="reviewerToken">mclean  <button type="button" class="close" id="deleteToken">&times;</button></span>'
	var delBtn = document.createElement('button');
	delBtn.textContent = 'x';
	delBtn.onClick = function(){ console.log(this.parentNode.parentNode); return false;};
	intrElem.appendChild(delBtn);
	$('#intrList').append(intrElem);
}
	
function setAutocomp(inputElem, source){
	// Turn on autocompletion
    inputElem.autocomplete({ 
	source: source, 
	select:function(event, ui){
 		if (event.which==1){		// 1 for clicking, 13 for entering
			// Do stuff
			addInterviewer(ui.item.value);
			} 
		return false;	
		}
	});
  }
  
function timeSelected(){
	var t = [];
    $('#calendar').find('.wc-cal-event').each(function() {
            t.push([$(this).data('calEvent').start,
				$(this).data('calEvent').end]);
          });
	return t;
}

function confirmSend(candidate, times, interviewer, type)
{var x;
var text = "Send "+candidate+"'s availabitilty to "+interviewer+" (type: "+type+")"
var r=confirm(text);
if (r)
  {
// TODO: Redirect to candidate profile tab
  }
else
  {
// Back to task tab
  }
}
