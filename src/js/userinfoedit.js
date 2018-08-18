var notification = '<h4 class="notification"></h4>',
	working;

function userInfoEdit() {

	/*-------------------------------------*\
		Visual form actions
	\*-------------------------------------*/

	// Switch between the edit button and the save + cancel buttons
	function toggleFormButtons() {
		$('.user__info__edit--edit, .user__info__edit--save, .user__info__edit--cancel')
			.toggleClass('hidden');
	}

	// Make the form editable
	function formEditable() {
		toggleFormButtons();
		$('.user__info__input--editable')
			.attr('readonly', false)
			.each(function () {
				var $this = $(this);
				$this.attr('data-before', $this.val());
			});
	}

	// Cancel the form editing
	function formCanceled() {
		$('.user__info__input--editable').each(function () {
			var $this = $(this);
			$this.val($this.attr('data-before')).removeClass('invalid');
		});

		formReadonly();
	}

	// Make the form read only
	function formReadonly() {
		$('.user__info')
			.removeClass('user__info--working')
			.find('.user__info__input--editable')
				.attr('readonly', true);
		toggleFormButtons();
	}

	// Apply defined functions to events (a.k.a. make the buttons work)
	$('.user__info__edit--edit').on('click', formEditable);
	$('.user__info__edit--cancel').on('click', formCanceled);





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
			userError = 'There has been an error, please try again later or send this to someone at ID: ' + error;
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

	function listenToForm(formClass) {
		$(document).on('submit' , 'form.' + formClass, function(e) {

			e.preventDefault();

			$('.notification').remove();
			$(this).addClass(formClass + '--working');
			working = formClass;

			var formData = new FormData($(this)[0]);

			$.ajax({
				url: ajaxurl,
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

	listenToForm('user__info');
	listenToForm('user__password');

}
