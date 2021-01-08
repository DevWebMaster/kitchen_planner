jQuery(function () {

    var save_and_close = false;

	setTimeout(function(){
		$('.datetime-input-clear').addClass('btn btn-sm btn-primary');
		$('.datetime-input-clear').removeClass('ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only ui-state-hover');
	}, 400);

    $('#save-and-go-back-button').click(function(){
        save_and_close = true;

        $('#crudForm').trigger('submit');
    });

    $('#crudForm').submit(function(){
        var my_crud_form = $(this);

        $(this).ajaxSubmit({
            url: validation_url,
            dataType: 'json',
            cache: 'false',
            beforeSend: function () {
                $("#FormLoading").show();
            },
            success: function(data){
                $("#FormLoading").hide();
                if(data.success)
                {
                    $('#crudForm').ajaxSubmit({
                        dataType: 'text',
                        cache: 'false',
                        beforeSend: function () {
                            $("#FormLoading").show();
                        },
                        success: function(result){
                            $("#FormLoading").fadeOut("slow");
                            data = $.parseJSON( result );
                            if(data.success)
                            {
                                var data_unique_hash = my_crud_form.closest(".crud-form").attr("data-unique-hash");

                                //$('.crud-form[data-unique-hash='+data_unique_hash+']').find('.ajax_refresh_and_loading').trigger('click');

                                if(save_and_close)
                                {
                                    if ($('#save-and-go-back-button').closest('.modal').length === 0) {
                                        window.location = data.success_list_url;
                                    } else {
                                        $(".add-edit-modal").modal("hide");
                                        success_message(data.success_message);

							            setTimeout(function () {
							                $('.gc-refresh').trigger('click');
							            }, 200);

                                    }

                                    return true;
                                }
                                $('.field_error').each(function(){
                                    $(this).removeClass('field_error');
                                });
                                clearForm();
                                form_success_message(data.success_message);
                            }
                            else
                            {
                                form_error_message(message_insert_error );
                            }
                        },
                        error: function(){
                            form_error_message( message_insert_error );
                            $("#FormLoading").hide();
                        }
                    });
                }
                else
                {
                    $('.has-error').removeClass('has-error');
                    $('#report-error').slideUp('fast');
                    form_error_message(data.error_message);
                    $.each(data.error_fields, function(index,value){
                        $('input[name='+index+']').closest('.form-group').addClass('has-error');
                    });

					$('#report-error').slideDown('normal');
					$('#report-success').slideUp('fast').html('');

                }
            },
            error: function(){
                error_message (message_insert_error);
                $("#FormLoading").hide();
            }
        });
        return false;
    });

    if( $('#cancel-button').closest('.modal').length === 0 ) {

        $('#cancel-button').click(function (){
            window.location = list_url;

            return false;
        });

    } else {

        $('#cancel-button').click(function (){
    		$('.add-edit-modal').modal('hide');
        	$('#add-edit-content').html('');

            return false;
        });

    }
});

function clearForm()
{
    $('#crudForm').find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });

    /* Clear upload inputs  */
    $('.open-file,.gc-file-upload,.hidden-upload-input').each(function(){
        $(this).val('');
    });

    $('.upload-success-url').hide();
    $('.fileinput-button').fadeIn("normal");
    /* -------------------- */

    $('.remove-all').each(function(){
        $(this).trigger('click');
    });

    $('.chosen-multiple-select, .chosen-select, .ajax-chosen-select').each(function(){
        $(this).trigger("liszt:updated");
    });
}