; (function (window, $) {
    var document = window.document;
    $(document).ready(function () {
        // フッタ固定ナビ、スクロールすると表示
        var fixedNav = $('.nav_fix');
        $(window).on('load scroll', function () {
            if ($(this).scrollTop() > 100) {
                fixedNav.addClass('u-active');
            } else {
                fixedNav.removeClass('u-active');
            }
        })
    });
})(this, jQuery);


