(function() {
    $.fn.allowClear = function () {
        var dropDown = $(this);

        var resetButton = $('<i class="trash icon"></i>')
            .css({
                cursor: 'pointer'
            })
            .on('click', function () {
                dropDown.dropdown('clear');
            });

        $(this).after(resetButton);
    };

    $.fn.monthSelector = function (callback) {
        var monthButtons =  $('#month-selector .month');
        var monthField = $('input[data-month="true"]');
        var yearField = $('input[data-year="true"]');

        if (monthButtons.length < 3 || monthField.length === 0 || yearField.length === 0) {
            console.log('Unable to initialize month selector');
            return;
        }

        if (callback !== undefined) {
            console.log(monthField.val(), yearField.val());
            callback(monthField.val(), yearField.val());
        }

        monthButtons.on('click', function () {
            var currentYear = $(this).attr('data-year');
            var currentMonth = $(this).attr('data-month');

            if (currentMonth === undefined || currentYear === undefined) {
                console.log('Unable to retrieve current month and year');
                return;
            }

            monthField.val(currentMonth);
            yearField.val(currentYear);
            monthButtons.removeClass('active');
            $(this).addClass('active');

            if (callback !== undefined) {
                callback(currentMonth, currentYear);
            }
        });
    };

    $.fn.budgetSelector = function (endpoint) {
        var DropDown = $(this);

        function updateBudgets(month, year) {
            var categorySelector = $('#category-selector');

            // clear dropdown
            DropDown.find('.menu').empty();
            DropDown.dropdown('clear');

            // add loading classes
            DropDown.addClass('loading').addClass('disabled');

            $.ajax({
                url: endpoint,
                data: 'month=' + month + '&year=' + year,
                success: function (data) {
                    var selected = null;

                    data.forEach(function (element) {
                        // create dropdown item
                        var item = $('<div class="item" data-value="' + element.id + '" data-default-category="' + element.default_category_id + '">' + element.title + '</div>');

                        // check if we can preselect the dropdown as it was previously or with one from the same account budget
                        if (parseInt(DropDown.attr('data-budget-id')) == element.id || parseInt(DropDown.attr('data-account-budget-id')) == element.account_budget_id) {
                            selected = element.id;
                        }

                        // append option to dropdown items
                        DropDown.find('.menu').append(item);
                    });

                    // redraw dropdown and remove loading classes
                    DropDown.dropdown('refresh');
                    DropDown.dropdown({
                        onChange: function (value, text, el) {
                            // preselect default category id if exists
                            if (typeof el !== 'undefined' && el.attr('data-default-category')) {
                                categorySelector.dropdown('set selected', el.attr('data-default-category'));
                            }
                        }
                    });

                    // preselect budget if needed
                    if (selected) {
                        DropDown.dropdown('set selected', selected);
                    }

                    // remove loading classes
                    DropDown.removeClass('loading').removeClass('disabled');
                }
            });
        }

        $(this).monthSelector(updateBudgets);
    };

    $.fn.categorySelector = function () {
        var dropDown = $(this).dropdown({
            allowCategorySelection: true
        });
        dropDown.allowClear();
    };

    $.fn.accountBudgetSelector = function () {
        var dropDown = $(this).dropdown();
        dropDown.allowClear();
    };
})();
