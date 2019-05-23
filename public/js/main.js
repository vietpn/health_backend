function ajaxLoader (el, options) {
    // Becomes this.options
    var defaults = {
        bgColor         : '#fff',
        duration        : 800,
        opacity         : 0.7,
        classOveride    : false,
    }
    this.options    = jQuery.extend(defaults, options);
    this.container  = $(el);

    this.init = function() {
        var container = this.container;
        // Delete any other loaders
        this.remove();
        // Create the overlay
        var overlay = $('<div></div>').css({
            'background-color': this.options.bgColor,
            'opacity':this.options.opacity,
            'width':'100%',
            'height':'100%',
            'position':'fixed',
            'top':'0%',
            'left':'0%',
            'z-index':99999
        }).addClass('ajax_overlay');
        // add an overiding class name to set new loader style
        if (this.options.classOveride) {
            overlay.addClass(this.options.classOveride);
        }

        // insert overlay and loader into DOM
        container.append(
            overlay.append(
                $('<div></div>').addClass('ajax_loader')
            ).fadeIn(this.options.duration)
        );
    };

    this.remove = function(){
        var overlay = this.container.children(".ajax_overlay");
        if (overlay.length) {
            overlay.fadeOut(this.options.classOveride, function() {
                overlay.remove();
            });
        }
    }

    this.init();
}
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
$('#lagueges').change(function(){
    var id=$(this).val();
    $.post('/site/language',{'lang':id},function(data){
        location.reload();
        //alert(data);
    })
});
function formatPrice(x) {
    if (isNaN(x))return "";

    n = x.toString().split('.');
    return n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".") + (n.length > 1 ? "." + n[1] : "");
}
!function ($) {
    $(function () {
        $('select').change(function () {
            var id = $(this).attr('id');
            $('.'+id).html("");
        });
        $('input[type=text]').keyup(function () {
            var id = $(this).attr('id');
            $('.'+id).html("");
            $('#'+id).css('border','1px solid #E5E5E5');
        })

    });
}(window.jQuery);