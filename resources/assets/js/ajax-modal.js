(function() {
    var modal = $('<div />', {
        class: 'ui modal'
    });

    function openModal(e) {
        var linkElement = $(this);
        var url = linkElement.attr('href');

        if (typeof e !== 'undefined' && e !== null) {
            e.preventDefault();
        }

        $('body').append(modal);
        linkElement.addClass('loading');

        modal.load(url, function() {
            if (modal.find('form').length !== 0) {
                modal.modal({
                    onApprove: function () {
                        modal.find('form').submit();
                        return false; // prevent from closing the modal
                    }
                });
            }

            modal.modal('show');
            linkElement.removeClass('loading');
        });
    }

    $(function() {
        $('body').on('click', 'a[data-use-modal=true]', openModal);
    });

})();
