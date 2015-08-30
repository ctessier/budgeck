(function($, window, document) {
    $(function() {
        initAjaxForms();
        initTabs();
        $('form').attr('novalidate', 'novalidate');
    });
}(window.jQuery, window, document));

function initAjaxForms()
{
    $('body').on('submit', 'form[data-ajax-form=true]', function(e)
    {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serializeArray();
        var overlay = $('#overlay');

        removeValidations();
        overlay.show();

        $.ajax({
            url: url,
            type: method,
            data: data,
            success: function(data, textStatus, jqXHR)
            {
                if (typeof data.success !== 'undefined')
                {
                    showSuccessMessage(form, data.success);
                }
                else if (typeof data.errors !== 'undefined')
                {
                    showValidations(form, data.errors);
                }
                else if (typeof data.redirect !== 'undefined')
                {
                    redirect(data.redirect);
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                showValidations(form, {'form':errorThrown + '<br />'
                    + jqXHR.responseText});
            },
            complete: function(jqXHR, textStatus)
            {
                overlay.hide();
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
            var successElement = $('<div class="validation-success-message ' + csstag + '">' + successMessage + '</div>').hide();

            form.prepend(successElement.fadeIn());

            setTimeout(function(){
                successElement.fadeOut();
            }, 5000);
        }

        /*
         * Show validations messages within the form
         */
        function showValidations(form, validations, csstag)
        {
            console.log("showing validations");
            if (typeof (csstag) === 'undefined') {
                csstag = '';
            }

            console.log(validations);

            for (var property in validations) {
                var validationElement = $('<div class="validation-error-message ' + csstag + '">' + validations[property] + '</div>').hide();

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
                    console.log("no input found name:" + property);
                    continue;
                }

                //add validation message
                console.log('adding validation to input ' + property);
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
            if (window.location.href.indexOf('clientes/importer') > -1)
            {
                var customerIndexToBounce = firstError.closest('.customer-import-form').attr('id');
                console.log(customerIndexToBounce);
                customerIndexToBounce = customerIndexToBounce.substring(9, customerIndexToBounce.length);
                goToCustomer(Number(customerIndexToBounce));
            }
        }

        function redirect(url)
        {
            window.location.href = url;
        }
    });
}

function formEscapeName(string)
{
    return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

/*
 * Initialize tabs behaviour
 */
function initTabs()
{
    $('ul.tabs li a').on('click', function(e){
        e.preventDefault();

        // Get data-tab-id to enable
        var data_tab_id = $(this).parent('li').attr('data-tab-id');

        // Inactive tab and active new tab
        $('ul.tabs li.active').removeClass('active');
        $(this).parent('li').addClass('active');

        // Inactive tab content and active new tab content
        $('.tab-content.active').removeClass('active');
        $('.tab-content[data-tab-id=' + data_tab_id + ']').addClass('active');
    });
}
