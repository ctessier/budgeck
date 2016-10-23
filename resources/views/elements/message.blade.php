@if (session('message'))
    <div class="ui {{ session('message')['type'] }} message">
        <i class="icon close"></i>
        @if (session('message')['header'])
            <div class="header">
                {{ session('message')['header'] }}
            </div>
        @endif
        @if (session('message')['content'])
            {{ session('message')['content'] }}
        @endif
    </div>
    <script>
        $('.message .close').on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade');
        });
    </script>
@endif
