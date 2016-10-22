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

        modal.load(url, function(response, status, xhr) {
            if (status === 'error') {
                showErrorModal(response);
                return;
            }

            // Bind approve action with form submit is a form is found in the modal
            if (modal.find('form').length !== 0) {
                modal.modal({
                    onApprove: function () {
                        modal.find('form').submit();
                        return false; // prevent from closing the modal
                    },
                    onHidden: function () {
                        modal.empty();
                    }
                });
            }

            modal.modal('show');
            linkElement.removeClass('loading');
        });
    }

    function showErrorModal(content) {
        modal.append(content);
        modal.modal({
            closable: false,
            onHidden: function () {
                modal.empty();
            }
        }).modal('show');
    }

    $(function() {
        $('body').on('click', 'a[data-use-modal=true]', openModal);
    });

})();
