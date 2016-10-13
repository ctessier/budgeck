{!! Form::select('budget_id', [], null, ['class' => 'ui selection dropdown', 'data-budgets-list' => 'true', 'data-account-budget-id' => isset($transaction) ? $transaction->budget_id : null, 'data-budget-id' => isset($transaction) ? $transaction->budget_id : null]) !!}

<script>
    $(function() {
        updateBudgets(monthField.val(), yearField.val());
        $(document).on('month-selector-has-changed', function (e, month, year) {
            updateBudgets(month, year);
        });

        function updateBudgets(month, year) {
            var budgetsDropDown = $('select[data-budgets-list="true"]');
            budgetsDropDown.parent().addClass('loading');

            $.ajax({
                url: '{{ route('api.budgets') }}',
                data: 'month=' + month + '&year=' + year,
                success: function (data) {
                    budgetsDropDown.html('<option value="">Sélectionner un budget</option>');
                    data.forEach(function (element) {
                        var option = $('<option value="' + element.id + '">' + element.title + '</option>');
                        if (parseInt(budgetsDropDown.attr('data-budget-id')) === element.id || parseInt(budgetsDropDown.attr('data-account-budget-id')) === element.account_budget_id) {
                            option.attr('selected', 'selected');
                        }
                        budgetsDropDown.append(option);
                    });
                    budgetsDropDown.dropdown();
                    budgetsDropDown.parent().removeClass('loading');
                }
            });
        }
    });
</script>
