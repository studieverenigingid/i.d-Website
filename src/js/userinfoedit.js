function userInfoEdit() {

	$('.user__info__edit--edit').on('click', function () {
		$('.user__info__input--editable').attr('readonly', false).each(function () {
			var $this = $(this);
			$this.attr('data-before', $this.val());
		});
		$('.user__info__edit--edit, .user__info__edit--save, .user__info__edit--cancel').toggleClass('hidden');
	});

	$('.user__info__edit--cancel').on('click', function () {
		$('.user__info__input--editable').each(function () {
			var $this = $(this);
			$this.val($this.attr('data-before')).removeClass('invalid');
		});

		formReadonly();
	});

	function formReadonly() {
		$('.user__info__input--editable').attr('readonly', true);
		$('.user__info__edit--edit, .user__info__edit--save, .user__info__edit--cancel').toggleClass('hidden');
		$('.user__info').removeClass('user__info--working');
	}

	function formDone(response, status, error) {
		if (!response['success']) {
			formFail(response, status, error);
			return;
		}

		formReadonly();

		$('.user__info__column--right').prepend('<h4 class="notification notification--success">' + response['message'] + '</h4>');
	}

	function formFail(response, status, error) {
		$('.user__info__column--right').prepend('<h4 class="notification notification--failed">' + response['message'] + '</h4>');

		$('.user__info').removeClass('user__info--working');

		console.log(error);
		console.log(error === 'net::ERR_INTERNET_DISCONNECTED');
	}

	$(document).on('submit' , 'form.user__info', function(e) {

		e.preventDefault();

		$('.notification').remove();
		$(this).addClass('user__info--working');

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
