function deleteItem(event, route) {
    event.preventDefault();
    if (confirm('آیا از حذف این آیتم اطمینان دارید؟')) {
        $.post(route, {_method: 'delete', _token: $('meta[name="token"]').attr('content')})
            .done(function (response) {
                $(event.target).closest('tr').remove()
                var message = 'آیتم با موفقیت حذف شد.' ;
                $.toast({
                    heading: 'عملیات موفق', // Text that is to be shown in the toast
                    text: response.message ? response.message : message , // Optional heading to be shown on the toast
                    icon: 'success', // Type of toast icon
                    showHideTransition: 'slide', // fade, slide or plain
                    allowToastClose: false, // Boolean value true or false
                    hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    // textAlign: 'right',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });
            })
            .fail(function (response) {
                var message = 'مشگلی در فرایند حذف پیش آمده است.' ;
                $.toast({
                    heading: 'عملیات ناموفق', // Text that is to be shown in the toast
                    text: response.message ? response.message : message, // Optional heading to be shown on the toast
                    icon: 'error', // Type of toast icon
                    showHideTransition: 'slide', // fade, slide or plain
                    allowToastClose: false, // Boolean value true or false
                    hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                    stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                    position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                    // textAlign: 'right',  // Text alignment i.e. left, right or center
                    loader: true,  // Whether to show loader or not. True by default
                    loaderBg: '#9EC600',  // Background color of the toast loader
                });
            })
    }

}
