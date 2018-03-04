function reserveKafeeForm() {

}

var	dateFormfield = document.getElementById('reserve-kafee-form').elements['date'],
		starttimeFormfield = document.getElementById('reserve-kafee-form').elements['starttime'],
		endtimeFormfield = document.getElementById('reserve-kafee-form').elements['endtime'];

function limitDates(){

    var	day = new Date( dateFormfield.value ).getUTCDay(),
				starttime =starttimeFormfield.value,
				endtime = endtimeFormfield.value;

    // Days in JS range from 0-6 where 0 is Sunday and 6 is Saturday

    if( day == 0 || day == 6 ){
        dateFormfield.setCustomValidity('Unfortunately, i.d-Kafee can\'t be booked in the weekends.');
    } else if (day == 3) {
    	dateFormfield.setCustomValidity('i.d-Kafee is open for everyone on wednesdays, so it isn\'t possible to reserve a private event.');
    } else {
			// Check start and endtimes (also for specific limitations on days)
			if (starttime < '15:00') {
				starttimeFormfield.setCustomValidity('Your event can\'t start before 15:00');
			}
			else if (starttime >= endtime) {
				endtimeFormfield.setCustomValidity('Your event should end after your start time.');
			} else if (day == 5 && endtime > '19:00') {
				endtimeFormfield.setCustomValidity('day is friday and too late');
			} else if (endtime > '21:00') {
				endtimeFormfield.setCustomValidity('entime is later than allowed')
			}
			else {
				dateFormfield.setCustomValidity('');
				starttimeFormfield.setCustomValidity('');
				endtimeFormfield.setCustomValidity('');
			}
    }
}

dateFormfield.addEventListener('input',limitDates);
starttimeFormfield.addEventListener('input',limitDates);
endtimeFormfield.addEventListener('input',limitDates);
