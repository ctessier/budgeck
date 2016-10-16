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
    $('body').on('submit', 'form[data-ajax-form=true]', function (e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serializeArray();

        if (form.parents('.modal').length === 0) {
            var submitButton = form.find('[type="submit"]');
        } else {
            var submitButton = form.parents('.modal').find('.actions .ok');
        }

        removeValidations();
        submitButton.addClass('loading');

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(data)
            {
                if (typeof data.success !== 'undefined')
                {
                    showSuccessMessage(form, data.success);
                }
                else if (typeof data.redirect !== 'undefined')
                {
                    redirect(data.redirect);
                }
                else if (typeof data.errors !== 'undefined')
                {
                    //TODO: handle error for whole form
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                if (jqXHR.status === 422)
                {
                    showValidations(form, jqXHR.responseJSON);
                }
                else
                {
                    showValidations(form, {'form':errorThrown + '<br />'
                    + jqXHR.responseText});
                }
            },
            complete: function(jqXHR)
            {
                if (!jqXHR.responseJSON || typeof jqXHR.responseJSON.redirect === 'undefined')
                {
                    submitButton.removeClass('loading');
                }
            }
        });

        /*
         * Remove validations messages and classes from the form
         */
        function removeValidations()
        {
            form.find('.validation-error-message').remove();
            form.find('.validation-error').removeClass('validation-error');
        }

        function showSuccessMessage(form, successMessage, csstag)
        {
            var successElement = form.find('.validation-success-message');
            if (successElement.length === 0) {
                successElement = $('<div class="validation-success-message ' + csstag + '">' + successMessage + '</div>').hide();

                //add at top of form
                form.prepend(successElement.fadeIn());
            } else {
                successElement.fadeOut();
                successElement.html(successMessage).fadeIn();
            }

            setTimeout(function(){
                successElement.fadeOut();
            }, 5000);
        }

        /*
         * Show validations messages within the form
         */
        function showValidations(form, validations, csstag)
        {
            if (typeof (csstag) === 'undefined') {
                csstag = '';
            }

            for (var property in validations) {
                var validationElement = $('<div class="validation-error-message ' + csstag + '"></div>').hide();

                validations[property].forEach(function(msg) {
                    validationElement.append(msg + '<br />');
                });

                //==== Validation for entire form ====
                if (property === 'form') {
                    var positions = form.find('.form-validation-message');
                    if (positions.length === 0) {
                        //add at top of form
                        form.prepend(validationElement.fadeIn());
                    } else {
                        for (var i = 0; i < positions.length; i++) {
                            $(positions).append(validationElement.fadeIn());
                        }
                    }
                    continue;
                }

                //==== Validation for header ====
                // Any property starting with 'validation-header' will be used.
                if (property.indexOf('validation-header') === 0) {
                    var name = property.substr(18);
                    var positions = form.find('*[data-formvalidation-header=' + name + ']');
                    if (positions.length > 0) {
                        for (var i = 0; i < positions.length; i++) {
                            $(positions).append(validationElement.fadeIn());
                        }
                    }
                    continue;
                }

                //==== Validation for individual input ====
                property = formEscapeName(property);
                var input = form.find('input[name=' + property + '], textarea[name=' + property + '], select[name=' + property + ']');
                if (input.length === 0) { //no input found
                    continue;
                }

                //add validation message
                if (input.attr('type') === 'checkbox') {
                    input.before(validationElement.fadeIn());
                } else {
                    input.after(validationElement.fadeIn());
                }

                input.addClass('validation-error');
                input.addClass(csstag);
            }

            // bounce to first error
            var firstError = $('.validation-error-message').first();
            var offset = firstError.offset().top - 90; /* add height of header */
            $('html body').animate({
                scrollTop: offset
            }, 1000);
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
