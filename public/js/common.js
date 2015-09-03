(function($, window, document) {
    $(function() {
        initAjaxForms();
        initAjaxLightbox();
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
        var submitButton = form.find('input[type=submit]');
        var previousSubmitLabel = submitButton.attr('value');
        
        removeValidations();
        submitButton.attr('value', 'Patientez...');

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
                submitButton.attr('value', previousSubmitLabel);
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
            if (typeof (csstag) === 'undefined') {
                csstag = '';
            }

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
            if (window.location.href.indexOf('clientes/importer') > -1)
            {
                var customerIndexToBounce = firstError.closest('.customer-import-form').attr('id');
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

/**
 * Initialize tabs behaviour
 */
function initTabs()
{
    $('ul.tabs li[data-tab-id] a').on('click', function(e){
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

/**
 * Initialize lightbox behaviour
 */
function initAjaxLightbox() {
    var lightbox = $('#ajax-lightbox');
    var background = $('#ajax-lightbox-background');
    var defaultWidth = lightbox.css('width');
    var defaultLeft = lightbox.css('left');
    var opened = false;

    this.open = function(url) {
        openLightbox(null, url);
    };

    $('body').on('click', 'a[data-use-lightbox=true]', openLightbox);
        
    // close lightbox on escape
    $(document).keyup(function(e) { 
        if (e.keyCode === 27) { // esc keycode
            dismiss();
        }
    });

    function openLightbox(e, url) {
        if (typeof e !== 'undefined' && e !== null) {
            e.preventDefault();
        }

        if (typeof url === 'undefined') {
            var url = $(this).attr('href');
        }

        background.fadeIn();        
        window.scrollTo(0, 0);

        lightbox.load(url, function() {
            //resize to fit content
            var widthDiv = lightbox.find('div[data-window-width]');
            if (widthDiv.length === 1) {
                var width = widthDiv.attr('data-window-width');

                //resize width smaller if the width does not fit on screen.
                if (width > $(window).width()) {
                    width = $(window).width() * 0.95;
                }

                lightbox.css('width', width + 'px');
                lightbox.css('left', '50%');
                lightbox.css('margin-left', -width / 2 + 'px');
            } else {
                lightbox.css('width', defaultWidth);
                lightbox.css('left', defaultLeft);
            }
            
            lightbox.fadeIn();            
            opened = true;
        });
    }

    var dismiss = function() {
        var disable = lightbox.find('div[data-window-disable-cancel=true]');
        if (disable.length > 0 || ! opened) {
            return; // don't dismiss if disabled.
        }
        background.fadeOut();
        lightbox.fadeOut(400, function(){
            lightbox.empty();
            opened = false;    
        });        
    };        

    //Click handlers to dismiss lightbox
    background.on('click', dismiss);
    lightbox.on('click', '*[data-lightbox-dismiss=true]', dismiss);

}
