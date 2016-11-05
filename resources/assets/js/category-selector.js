(function() {
    $.fn.categorySelector = function () {
        var dropdown = $(this).dropdown({
            allowCategorySelection: true
        });

        var resetButton = $('<i class="trash icon"></i>')
            .css({
                cursor: 'pointer'
            })
            .on('click', function () {
                dropdown.dropdown('clear');
            });

        $(this).after(resetButton);
    };
})();
