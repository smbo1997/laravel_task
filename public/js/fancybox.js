$(document).ready(function () {
    $('.fancybox').fancybox({
        fitToView: false,
        beforeShow: function () {
            $(".fancybox-image").css({
                "width": 600,
                "height": 500
            });
            this.width = 600;
            this.height = 500;
        }
    });
});