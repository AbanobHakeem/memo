$('.btn-destroy').click(function(e) {
    e.preventDefault();
    $('#delete-recored').modal('toggle')
    $('#delete-recored form').attr('action', $(this).attr('href'))
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('.lang-status').change(function(e) {
    e.preventDefault();
    let status = $(this).is(':checked') ? 1 : 0;
    let url = `/dashboard/languages/${$(this).data('id')}/toggle`
    $.ajax({
        type: "POST",
        url: url,
        data: {
            'status': status
        },
        dataType: "json",
        success: function(response) {}
    });
});
$('.btn-editTrans').click(function(e) {
    e.preventDefault();
    let row = $(this).parents('tr');
    let tds = row.find('td');

    tds.each(function() {
        let value = $(this).text();
        $(`#editTrans #${$(this).data('name')}`).val(value);
    });
});
$('.btn-destroy-trans').click(function(e) {
    e.preventDefault();
    let key = $(this).data('key');
    $('#delete-trans-form [name=key]').val(key)
    $('#delete-trans-form').submit();
});