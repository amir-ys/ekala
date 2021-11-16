function deleteItem(event, route) {
    event.preventDefault();
    if (confirm('آیا از حذف این آیتم اطمینان دارید؟')) {
        $.post(route, {_method: 'delete', _token: $('meta[name="token"]').attr('content')})
            .done(function () {
                $(event.target).closest('tr').remove()
            })
            .fail(function () {

            })
    }

}
