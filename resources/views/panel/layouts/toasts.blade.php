<script>
    @if(session()->has('feedbacks'))
        @foreach(session()->get('feedbacks') as $session)
    $.toast({
        heading: '{{ $session['title'] }}' , // Text that is to be shown in the toast
        text: '{{ $session['body'] }}' , // Optional heading to be shown on the toast
        icon: '{{ $session['type'] }}', // Type of toast icon
        showHideTransition: 'slide', // fade, slide or plain
        allowToastClose: false, // Boolean value true or false
        hideAfter: 5000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
        // textAlign: 'right',  // Text alignment i.e. left, right or center
        loader: true,  // Whether to show loader or not. True by default
        loaderBg: '#9EC600',  // Background color of the toast loader
    });
    @endforeach
    @endif
</script>
