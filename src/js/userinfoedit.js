function userInfoEdit() {

	$('.user__info__edit--edit').on('click', function () {
	    $('.user__info__input--editable').attr('readonly', false).each(function () {
	        var $this = $(this);
	        $this.attr('data-before', $this.val());
	    });
	    $('.user__info__edit--edit, .user__info__edit--save, .user__info__edit--cancel').toggleClass('hidden');
	});

  $('.user__info__edit--save').on('click', function () {
  	formReadonly();
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
	}

	$(document).on('submit' , 'form.user__info', function(e) {

		e.preventDefault();

		var formData = new FormData($(this)[0]);

		var xhr = new XMLHttpRequest;
		xhr.open('POST', '/', true);
		xhr.send(formData);

		/*
		$.ajax({
			url: wpjs_object.ajaxurl,
			type: 'POST',
			dataType: 'json',
			data: data,
		}).done(function(data) {
			console.log(data);
		}); */

	})
}
