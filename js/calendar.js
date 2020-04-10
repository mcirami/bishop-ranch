jQuery(document).ready(function($){
	
	$('.event_filters .filter input[type="checkbox"]').live('click', function(e) {
		var categories = new Array();
		
		$('.event_filters .filter input[type="checkbox"]').each(function(e) {
			if($(this).is(':checked')) {
				categories.push($(this).attr('id'));
			}
		});
		
		$('.tribe-events-calendar .day_content .tribe_events').removeClass('filter_hidden_event');
		
		$('.tribe-events-calendar .day_content .tribe_events').each(function(e) {
			var hasCategory = false;
			
			if(categories.length == 0) {
				hasCategory = true;
			}
			
			for(var i = 0; i < categories.length; i++) {
				var category = categories[i];
				if($(this).hasClass('tribe-events-category-'+category)) {
					hasCategory = true;
				}
			}
			
			if(!hasCategory) {
				$(this).addClass('filter_hidden_event');
			}
		});
	});
	
	$('.clear_event_filters').live('click', function(e) {
		e.preventDefault();
		
		$('.event_filters .filter input[type="checkbox"]').attr('checked', false);
		$('.tribe-events-calendar .day_content .tribe_events').removeClass('filter_hidden_event');
	});
	
	$('.tribe-events-calendar td.tribe-events-has-events .day_content').live('click', function(e) {
		$('.tribe-events-calendar td.tribe-events-has-events .day_content').removeClass('active');
		$(this).addClass('active');
		
		day_id = $(this).parent().attr('data-day');
		showDaysEvents($(this));
	});
	
	function showDaysEvents($day) {
		var yearString = $('#tribe-events-header').attr('data-date').split('-')[0];
		var dateString = $day.parent().attr('data-date-name');
		
		var day = $day.parent().index();
		var days = new Array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
		var dayWeek = days[day];
		
		var eventData = dayWeek+' Events: '+dateString+', '+yearString;
		$('.events_detail h2').text(eventData);
		
		events = new Array();
		
		$day.children('.tribe_events').each(function(e) {
			var jsonString = $(this).attr('data-tribejson');
			var jsonArray = $.parseJSON(jsonString);
			//console.log(jsonArray);
			//console.log(jsonArray.eventId);
			
			events.push(jsonArray.eventId);
		});
		
		$('.events_container').empty();
		
		load_events();
	}
	
	// Ajax for loading in data to Events container
	var events = new Array();
	var $events_container = $(".events_container");
	var load_events = function() {
		$.ajax({
			type		: "GET",
			data		: {events: events},
			dataType	: "html",
			url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/events-loop-handler.php",
			beforeSend	: function() {
				
			},
			success		: function(data) {
				$data = $(data);
				if($data.length){  
					$data.hide();  
					$events_container.empty();
					$events_container.append($data);  
					$data.fadeIn(500, function(){  
						//$("#temp_load").remove();  
						loading = false;
					});
				}
			},
			error		: function(jqXHR, textStatus, errorThrown) {
				//$("#temp_load").remove();  
				alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
	};
	
	
	// Bookings Calendar
	$('.bookings_calendar_container .day_content').live('click', function(e) {
		if($(this).hasClass('available_bookings') && !$(this).hasClass('hide_availability')) {
			date = $(this).attr('data-date');
		
			load_bookings();
		}
	});
	
	// Ajax for loading in available bookings
	var date;
	var $bookings_container = $("#available_bookings_container");
	var selectedRoom = '';
	var selectedCapactiy = '';
	var load_bookings = function() {
		$.ajax({
			type		: "GET",
			data		: {date: date, room: selectedRoom, capacity: selectedCapactiy},
			dataType	: "html",
			url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/bookings-loop-handler.php",
			beforeSend	: function() {
				$bookings_container.empty();
			},
			success		: function(data) {
				$data = $(data);
				if($data.length){  
					$data.hide();  
					$bookings_container.empty();
					$bookings_container.append($data);  
					$data.fadeIn(500, function(){  
						//$("#temp_load").remove();  
						loading = false;  
						
						$('html, body').animate({
							scrollTop: $("#available_bookings_container").offset().top
    					}, 400);
					});
				}
			},
			error		: function(jqXHR, textStatus, errorThrown) {
				//$("#temp_load").remove();  
				alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			}
		});
	};
	
	var conferenceUpdate = false;
	$('#conference_room').ddslick({
		onSelected: function(data) {
			var conferenceRoom = $('#conference_room .dd-selected-value').val();
			if(conferenceRoom != 'none') {
				var conferenceRoomCapacity = conferenceRoom.split('_')[1];
				
				var i = 0;
				if(conferenceRoomCapacity >= 200) {
					i = 5;
				} else if(conferenceRoomCapacity >= 100) {
					i = 4;
				} else if(conferenceRoomCapacity >= 50) {
					i = 3;
				} else if(conferenceRoomCapacity >= 20) {
					i = 2;
				} else if(conferenceRoomCapacity >= 0) {
					i = 1;
				}
				
				conferenceUpdate = true;
				$('#room_capacity').ddslick('select', {index: i });
				
				selectedRoom = conferenceRoom;
				selectedCapactiy = null;
			}
		}	
	});
	
	$('#room_capacity').ddslick({
		onSelected: function(data) {
			if(!conferenceUpdate) {
				var i = 0;
				$('#conference_room').ddslick('select', {index: i });
				
				selectedRoom = null;
				selectedCapactiy = $('#room_capacity .dd-selected-value').val();;
			} else {
				conferenceUpdate = false;
			}
		}	
	});
	
	$('.bookings_filter button').click(function(e) {
		var conferenceRoom = $('#conference_room .dd-selected-value').val();
		var roomCapacity = $('#room_capacity .dd-selected-value').val();
		
		$bookings_container.empty();
		
		$('.wc_bookings_calendar tbody tr td > div').removeClass('hide_availability');
		
		if(conferenceRoom != 'none') {
			var conferenceRoomName = conferenceRoom.split('_')[0];
			
			$('.wc_bookings_calendar tbody tr td').each(function(e) {
				if(!$(this).hasClass(conferenceRoomName)) {
					$(this).children('div').addClass('hide_availability');
				}
			});
		} else if(roomCapacity != 'none') {
			var capacityArray = roomCapacity.split('-');
			var bottomCapacity = parseInt(capacityArray[0]);
			var topCapacity = parseInt(capacityArray[1]);
			
			$('.wc_bookings_calendar tbody tr td').each(function(e) {
				var capacities = $(this).attr('data-capacity').split(' ');	
				var hasCapacity = false;
				for(i = 0; i < capacities.length; i++) {
					var capacity = capacities[i];
					if($.isNumeric(capacity)) {
						capacity = parseInt(capacity);
						if(topCapacity == 1000) {
							if(capacity >= bottomCapacity) {
								hasCapacity = true;
							}
						} else {
							if(capacity >= bottomCapacity && capacity < topCapacity) {
								console.log(bottomCapacity+' '+topCapacity+' '+capacity);
								hasCapacity = true;
							}
						}
					}
				}
				
				if(!hasCapacity) {
					$(this).children('div').addClass('hide_availability');
				}
			});
		}
	});
});