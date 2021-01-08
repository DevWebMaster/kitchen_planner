/*global jQuery*/

var THEME_VERSION = '1.0.1';

jQuery(function ($) {
    var position;

});

function success_message(success_message)
{

	 $.growl(success_message, {
	      type: 'success',
	      delay: 7000,
	      animate: {
	          enter: 'animated bounceInDown',
	          exit: 'animated bounceOutUp'
	      }
	  });

		if (dialog_forms) {
			$('.go-to-edit-form').unbind('click');
			$('.go-to-edit-form').click(function(event){
                event.preventDefault();
				fnOpenReadFormMDB($(this));

				return false;
			});
		}
}

function error_message(error_message)
{

	 $.growl(error_message, {
	      type: 'error',
	      delay: 7000,
	      animate: {
	          enter: 'animated bounceInDown',
	          exit: 'animated bounceOutUp'
	      }
	  });
}

function form_success_message(success_message)
{
	$('#report-success').slideUp('fast');
	$('#report-success').html(success_message);
	$('#report-success').slideDown('normal');
	$('#report-error').slideUp('fast').html('');
}

function form_error_message(error_message)
{
	$('#report-error').slideUp('fast');
	$('#report-error').html(error_message);
	$('#report-error').slideDown('normal');
	$('#report-success').slideUp('fast').html('');
}

var fnOpenReadFormMDB = function (this_element) {

    var href_url = this_element.attr("href");

    //Close all
    $('.add-edit-modal').modal('hide');
    $('#add-edit-content').html('');

    $.ajax({
        url: href_url,
        data: {
            is_ajax: 'true'
        },
        type: 'post',
        dataType: 'json',
        beforeSend: function () {},
        complete: function () {},
        success: function (data) {
            if (typeof CKEDITOR !== 'undefined' && typeof CKEDITOR.instances !== 'undefined') {
                $.each(CKEDITOR.instances, function (index) {
                    delete CKEDITOR.instances[index];
                });
            }

            $('#add-edit-content').html('<div class="modal-body">' + data.output + '</div>');

	$.each(data.css_files,function(index,css_file){
		load_css_file(css_file);
	});

	setTimeout(function(){
		LazyLoad.loadOnce(data.js_lib_files);
		LazyLoad.load(data.js_config_files);
	}, 250);



            $('.add-edit-modal').modal('show');

        }
    });
};