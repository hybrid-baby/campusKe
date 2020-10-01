$('#bouncy').mouseenter(function() {
    if (!$(this).data('animating')) {
       $(this).data('animating', true);
        $(this).effect('bounce',500, function () {
            $(this).data('animating', false); });
    }
});

$('#bouncy').mouseleave(function() {
});
