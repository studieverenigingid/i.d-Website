function reserveKafeeForm() {

}

var kafeeForm = document.getElementById('reserve-kafee-form');

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

function initKafeeForm(){
	dateFormfield.addEventListener('input',limitDates);
	starttimeFormfield.addEventListener('input',limitDates);
	endtimeFormfield.addEventListener('input',limitDates);
}

if (kafeeForm != null) {
	var	dateFormfield = kafeeForm.elements['date'],
			starttimeFormfield = kafeeForm.elements['starttime'],
			endtimeFormfield = kafeeForm.elements['endtime'];

	initKafeeForm();
}
