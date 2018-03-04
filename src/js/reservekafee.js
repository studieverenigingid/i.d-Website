function reserveKafeeForm() {

	var kafeeForm = document.getElementById('reserve-kafee-form');

	/*-------------------------------------*\
		Form communication with the back-end
	\*-------------------------------------*/

	function formDone(response, status, error) {
		$('.' + working).removeClass(working + '--working');

		// Throw the response to the fail function if we got no success
		if (!response['success']) {
			formFail(response, status, error);
			return;
		}

		// Otherwise tell it’s done...
		var noti = $(notification)
			.addClass('notification--success')
			.text(response['message'])
			.prependTo('.' + working);

		// ...and revert the form to read only or empty the password fields
		if (working === 'user__info') {
			formReadonly();
		} else if (working === 'user__password') {
			$('.' + working).children('input').each(function() {
				$(this).val('');
			});
		}
	}

	function formFail(response, status, error) {
		// Tell the user something failed
		if (response['message'] !== undefined) {
			userError = response['message'];
		} else if (response.readyState === 4) {
			userError = 'There has been an error, please try again later or send this to someone at Study association i.d: ' + error;
		} else if (response.readyState === 0) {
			userError = 'There has been a network error, are you still connected to the internet?';
		} else {
			userError = 'There has been an error we don’t even understand :/';
		}
		$(notification)
			.addClass('notification--failed')
			.text(userError)
			.prependTo('.' + working);
	}

	function ajaxKafeeForm(formClass) {
		$(document).on('submit' , 'form.' + formClass, function(e) {

			e.preventDefault();

			$('.notification').remove();
			$(this).addClass(formClass + '--working');
			working = formClass;

			var formData = new FormData($(this)[0]);

			$.ajax({
				url: wpjs_object.ajaxurl,
				type: 'POST',
				dataType: 'JSON',
				data: formData,
				processData: false,
				contentType: false
			})
			.done(formDone)
			.fail(formFail);
		});
	}

	ajaxKafeeForm('reserve-kafee__wrap');

	function validateKafeeForm() {
		dateFormfield.addEventListener('input',limitDates);
		starttimeFormfield.addEventListener('input',limitDates);
		endtimeFormfield.addEventListener('input',limitDates);

		function resetValidity() {
			dateFormfield.setCustomValidity('');
			starttimeFormfield.setCustomValidity('');
			endtimeFormfield.setCustomValidity('');
		}

		function limitDates(){

				var	day = new Date(dateFormfield.value).getUTCDay(),
						starttime =starttimeFormfield.value,
						endtime = endtimeFormfield.value;

				// Days in JS range from 0-6 where 0 is Sunday and 6 is Saturday

				if( day == 0 || day == 6 ){
					resetValidity();
					dateFormfield.setCustomValidity('Unfortunately, i.d-Kafee can\'t be booked in the weekends.');
				} else if (day == 3) {
					resetValidity();
					dateFormfield.setCustomValidity('i.d-Kafee is open for everyone on wednesdays, so it isn\'t possible to reserve a private event.');
				} else {
					// Check start and endtimes (also for specific limitations on days)
					if (starttime < '15:00') {
						resetValidity();
						starttimeFormfield.setCustomValidity('Your event can\'t start before 15:00');
					}	else if (starttime >= endtime) {
						resetValidity();
						endtimeFormfield.setCustomValidity('Your event should end after your start time.');
					} else if (day == 5 && endtime > '19:00') {
						resetValidity();
						endtimeFormfield.setCustomValidity('day is friday and too late');
					} else if (endtime > '21:00') {
						resetValidity();
						endtimeFormfield.setCustomValidity('entime is later than allowed')
					}
					else {
						resetValidity();
					}
				}
		}

	}

	if (kafeeForm != null) {
		var	dateFormfield = kafeeForm.elements['date'],
		starttimeFormfield = kafeeForm.elements['starttime'],
		endtimeFormfield = kafeeForm.elements['endtime'];

		//validateKafeeForm();
	}
}
