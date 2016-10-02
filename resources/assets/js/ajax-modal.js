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
                var r = $(response);
                showErrorModal(xhr.statusText, r.find('.exception_message')[0].innerHTML);
                return;
            }

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

    function showErrorModal(error, message) {
        modal.append('<div class="header">' + error + '</div>');
        modal.append('<div class="content"><p>' + message + '</p></div>');
        modal.append('<div class="actions"><div class="ui negative button">Fermer</div></div>');
        modal.modal({
            closable: false,
            onDeny: function() {
                $(this).empty();
            }
        }).modal('show');
    }

    $(function() {
        $('body').on('click', 'a[data-use-modal=true]', openModal);
    });

})();
