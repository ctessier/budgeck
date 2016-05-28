(function($, window, document) {
    $(function() {
        initAjaxForms();
        initAjaxLightbox();
        initTabs();
        initConfirmBox();
        $('form').attr('novalidate', 'novalidate');
    });
}(window.jQuery, window, document));

function initAjaxForms()
{
    $('body').on('click', 'a[data-form-submit=true]', function (e) {
        console.log('ok');
        var link = $(this);
        link.closest('form').submit();
    });

    $('body').on('submit', 'form[data-ajax-form=true]', function (e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serializeArray();
        var submitButton = form.find('a[data-form-submit=true]');

        removeValidations();
        submitButton.addClass('loading');

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
            complete: function(jqXHR, textStatus)
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
    $('ul.tabs li[data-tab-id] a, ul.tabs-horizontal li[data-tab-id] a').on('click', function(e){
        e.preventDefault();

        // Get data-tab-id to enable
        var data_tab_id = $(this).parent('li').attr('data-tab-id');

        // Inactive tab and active new tab
        $('ul.tabs li.active, ul.tabs-horizontal li.active').removeClass('active');
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
    var container = $('#container-lightbox');
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
        var linkElement = $(this);

        if (typeof e !== 'undefined' && e !== null) {
            e.preventDefault();
        }

        if (typeof url === 'undefined') {
            var url = $(this).attr('href');
        }

        linkElement.addClass('loading');

        container.load(url, function() {
            container.show();
            window.scrollTo(0, 0);
            linkElement.removeClass('loading');
            opened = true;

            // Initialize DOM dynamics
            initDateFields();
            initMonthSelector();
        });
    }

    var dismiss = function() {
        container.hide(function(){
            container.empty();
            opened = false;
        });
    };

    //Click handlers to dismiss lightbox
    container.on('click', '*[data-lightbox-dismiss=true]', dismiss);
}

function initDateFields() {
    $(".datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
}

function initConfirmBox() {
    $('body').on('submit', 'form[data-use-confirm=true]', function(e)
    {
        var form = $(this);
        var message = form.attr('data-confirm-message');
        return confirm(message);
    });
}

function initMonthSelector() {
    var selected = $('.month-selector a.selected');
    var inputMonth = $('input[type="hidden"][data-month="true"]');
    var inputYear = $('input[type="hidden"][data-year="true"]');
    var currentMonth = inputMonth.val();
    var currentYear = inputYear.val();

    updateBudgets(currentMonth, currentYear);

    $('.month-selector a').on('click', function (e) {

        e.preventDefault();

        if (!$(this).is(selected))
        {
            // Update DOM with new selected
            selected.removeClass('selected');
            selected = $(this);
            selected.addClass('selected');

            // Set new values
            currentMonth = selected.attr('data-month');
            currentYear = selected.attr('data-year');

            // Update hidden fields values
            inputMonth.val(currentMonth);
            inputYear.val(currentYear);

            // Update budgets drop down
            updateBudgets(currentMonth, currentYear);
        }
    });

    function updateBudgets(month, year) {
        var budgetsDropDown = $('select[data-budgets-list="true"]');
        budgetsDropDown.addClass('loading');

        $.ajax({
            url: 'api/budgets',
            data: 'month=' + month + '&year=' + year,
            success: function (data) {
                budgetsDropDown.html('<option value="">Sélectionner un budget</option>');
                data.forEach(function (element) {
                    var option = $('<option value="' + element.id + '">' + element.title + '</option>');
                    if (parseInt(budgetsDropDown.attr('data-budget-id')) === element.id) {
                        option.attr('selected', 'selected');
                    }
                    budgetsDropDown.append(option);
                });

                budgetsDropDown.removeClass('loading');
            }
        });
    }
}
