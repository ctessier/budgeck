(function() {
    $.fn.budgetSelector = function (endpoint) {
        var dropdown = $(this);
        var currentYear, currentMonth;
        var monthSelector =  $('.month-selector');
        var monthField = $('input[data-month="true"]');
        var yearField = $('input[data-year="true"]');

        if (monthSelector.length < 2 || monthField.length === 0 || yearField.length === 0) {
            console.log('Unable to initialize budgets selector');
            return;
        }

        updateBudgets(monthField.val(), yearField.val());

        monthSelector.on('click', function () {
            currentYear = $(this).attr('data-year');
            currentMonth = $(this).attr('data-month');

            if (currentMonth === undefined || currentYear === undefined) {
                console.log('Unable to retrieve current month and year');
                return;
            }

            monthField.val(currentMonth);
            yearField.val(currentYear);
            monthSelector.removeClass('active');
            $(this).addClass('active');

            updateBudgets(currentMonth, currentYear);
        });

        function updateBudgets(month, year) {
            // clear dropdown
            dropdown.find('.menu').empty();
            dropdown.dropdown('clear');

            // add loading classes
            dropdown.addClass('loading').addClass('disabled');

            $.ajax({
                url: endpoint,
                data: 'month=' + month + '&year=' + year,
                success: function (data) {
                    var selected = null;

                    data.forEach(function (element) {
                        // create dropdown item
                        var item = $('<div class="item" data-value="' + element.id + '">' + element.title + '</div>');

                        // check if we can preselect the dropdown as it was previously or with one from the same account budget
                        if (parseInt(dropdown.attr('data-budget-id')) === element.id || parseInt(dropdown.attr('data-account-budget-id')) === element.account_budget_id) {
                            selected = element.title;
                        }

                        // append option to dropdown items
                        dropdown.find('.menu').append(item);
                    });

                    // redraw dropdown and remove loading classes
                    dropdown.dropdown('refresh').dropdown('set selected', selected);
                    dropdown.removeClass('loading').removeClass('disabled');
                }
            });
        }
    };
})();
