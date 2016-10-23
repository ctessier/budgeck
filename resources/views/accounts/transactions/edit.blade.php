<div class="header">
    @if ($transaction->isExpense())
    Modifier la dépense {{ $transaction->title }}
    @else
    Modifier le revenu {{ $transaction->title }}
    @endif
</div>
<div class="content">
    {!! Form::model($transaction, ['method' => 'put', 'route' => ['accounts.transactions.update', $current_account->id, $transaction->id], 'class' => 'ui form', 'data-ajax-form' => 'true']) !!}
    {{--*/ $categoryFieldName = "category_id" /*--}}
    @if (isset($income))
        @include('accounts.transactions.form-income')
    @else
        @include('accounts.transactions.form-expense')
    @endif
    {!! Form::close() !!}
</div>
<div class="actions">
    <div class="ui cancel button">Annuler</div>
    <div class="ui ok blue button">Sauvegarder</div>
</div>

<script>
    $('#datepicker-transaction-date').fdatepicker({
        initialDate: '',
        format: 'yyyy-mm-dd',
        disableDblClickSelection: true
    });
    $('#datepicker-value-date').fdatepicker({
        initialDate: '',
        format: 'yyyy-mm-dd',
        disableDblClickSelection: true
    });
</script>
