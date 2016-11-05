/**
 * Created by clementtessier on 07/09/2016.
 */

(function($) {
    $(function() {
        initAjaxForms();
        initConfirmModals();
    });
}(window.jQuery));

function initAjaxForms()
{
    var formSuccessClass = ".success.message";
    var formErrorClass = ".error.message";
    var inputErrorClass = ".red.label.error";

    $('body').on('submit', 'form[data-ajax-form=true]', function (e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serializeArray();

        var submitButton
        if (form.parents('.modal').length === 0) {
            submitButton = form.find('[type="submit"]');
        } else {
            submitButton = form.parents('.modal').find('.actions .ok');
        }

        removeValidations();
        submitButton.addClass('loading');
        submitButton.addClass('disabled');

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(data) {
                if (typeof data.success !== 'undefined') {
                    showSuccessMessage(form, data.success);
                } else if (typeof data.redirect !== 'undefined') {
                    redirect(data.redirect);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 422) {
                    showValidations(form, jqXHR.responseJSON);
                } else {
                    showValidations(form, {'form':errorThrown + '<br />'
                    + jqXHR.responseText});
                }
            },
            complete: function(jqXHR) {
                if (!jqXHR.responseJSON || typeof jqXHR.responseJSON.redirect === 'undefined') {
                    submitButton.removeClass('loading');
                    submitButton.removeClass('disabled');
                }
            }
        });

        /*
         * Remove validations messages
         */
        function removeValidations()
        {
            form.find(formSuccessClass).fadeOut();
            form.find(formErrorClass).fadeOut();
            form.find(inputErrorClass).remove();
            form.find('.field').removeClass('error');
        }

        function showSuccessMessage(form, successMessage)
        {
            var successElement = form.find('.success.message');
            if (successElement.length === 0) {
                successElement = $('<div class="ui success message">' + successMessage + '</div>').hide();
                form.prepend(successElement);
                successElement.fadeIn();
            } else {
                successElement.fadeOut();
                successElement.html(successMessage).fadeIn();
            }

            setTimeout(function() {
                successElement.fadeOut();
            }, 5000);
        }

        /*
         * Show validations messages within the form
         */
        function showValidations(form, validations)
        {
            for (var property in validations) {
                // Validation for entire form
                if (property === 'form') {
                    var errorElement = form.find('.error.message');
                    if (errorElement.length === 0) {
                        errorElement = $('<div class="ui error message">' + validations[property] + '</div>').hide();
                        form.prepend(errorElement);
                        errorElement.fadeIn();
                    } else {
                        errorElement.fadeOut();
                        errorElement.html(validations[property]).fadeIn();
                    }

                    continue;
                }

                // Validation for individual input
                property = formEscapeName(property);
                var input = form.find('input[name=' + property + '], textarea[name=' + property + '], select[name=' + property + ']');
                if (input.length === 0) { // No input found
                    continue;
                }
                var validationElement = $('<div class="ui red label left pointing basic error">' + validations[property] + '</div>').hide();
                input.closest('.column').after(validationElement);
                input.closest('.field').addClass('error');
                validationElement.fadeIn();
            }
        }

        function redirect(url)
        {
            window.location.href = url;
        }
    });
}

function initConfirmModals() {
    $('form[data-use-confirm="true"] *[type="submit"]').click(function(e) {

        e.preventDefault();

        var form = $(this).parent('form');
        var modal = $('<div class="ui small modal"><div class="header">' + form.attr('data-confirm-modal-title') + '</div><div class="content"><p>' + form.attr('data-confirm-modal-message') + '</p></div><div class="actions"><div class="ui negative button">Non</div><div class="ui positive button">Oui</div></div></div>');

        $('body').prepend(modal);
        modal.modal({
            closable: false,
            onApprove: function () {
                form.submit();
            }
        }).modal('show');
    });
}

function formEscapeName(string)
{
    return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}
