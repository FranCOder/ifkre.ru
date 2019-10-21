// placeholder
$(document).ready(function () {
    $('.connect_accordion h3').click(function(){
       $(this).next('.ca_block').slideToggle(500);
    });
    
    var readyBlock = {};
    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();
    $('.hi_search').submit(function(){return false;});
    $('.hi_search input[name="search"]').keyup(function () {
        var val = $(this).val();
        delay(function(){
            $val = val.toLowerCase();
//            if ($val.length < 2) return;
            $('#graph_list').load('/fl/exp/to-vdgo/grafik?search=' + $val);
//            $items = $('.gc_list').find('.gc_list_item');
//            $.each($items, function (i, item) {
//                if (readyBlock[$(item).attr('data-litera')] === undefined)
//                    readyBlock[$(item).attr('data-litera')] = false;
//                if ($(item).attr('data-name').toLowerCase().indexOf($val, 0) == -1 && $(item).attr('data-name') !== "") {
//                    $(item).hide(0);
//                } else {
//                    readyBlock[$(item).attr('data-litera')] = true;
//                    $(item).show(0);
//                }
//            });
//            $litera = $('.gc_list').find('.gc_litera');
//            $.each($litera, function (i, block) {
//                if (readyBlock[$(block).attr('data-litera')] === true ) {
//                    $(block).show(0);
//                } else {
//                    $(block).hide(0);
//                }
//                readyBlock[$(block).attr('data-litera')] = false;
//            });
        }, 700 );
    });
    //$("input, textarea").on("focus", function(){
    $("body").on("focus", "input, textarea", function () {
        if ($(this).attr("data") != '') {
            if ($(this).val() == $(this).attr("data"))
                $(this).val("");
        }
    });
    //$("input, textarea").on("blur", function(){
    $("body").on("blur", "input, textarea", function () {
        if ($(this).attr("data") != '') {
            if ($(this).val() == "")
                $(this).val($(this).attr("data"));
        }
    });

    $('.f_map').fancybox({'type': 'iframe'});
    $('.show_buttons').click(function (e) {
        e.preventDefault();
        $('#'+$(this).data('buttons')).slideToggle(300);
    });
});

// fixed_nav
$(function () {
    $(window).scroll(function () {
        var top = $(document).scrollTop();
        var height1 = $(document).height() - $(window).height() - 100;
        var result = $(document).scrollTop();
        if (top < 660)
        {
            $(".nav_scroll").removeClass("nav_scroll_act");
        } else
        {
            $(".nav_scroll").addClass("nav_scroll_act");
        }
    });
});

// mask
$(document).ready(function () {
    $("body").on("click", ".in_phone", function () {
        $(this).inputmask("9(999)9999999");
    });
});


// popup_open
$(document).ready(function () {

    $("#btn_popup_tu, #pu_calc .closeform").click(function () {
        $(".popup_rgba").fadeToggle(400);
        $("#pu_calc").slideToggle(700);
        $("body").toggleClass("overflow");
        return false;
    });

    $(".oyt_kol_num_calc, #pu_oplata_calc .closeform").click(function () {
        $(".popup_rgba").fadeToggle(400);
        $("#pu_oplata_calc").slideToggle(700);
        $("body").toggleClass("overflow");
        return false;
    });

    // nav mobile
    $(".nav_mobile_ico").click(function () {
        $(this).toggleClass("nav_mobile_ico_act");
        $(".mobile_menu_plashka").slideToggle(300);
        return false;
    });

    $(".nm_open").click(function () {
        if ($(this).hasClass('act') !== false) {
            window.location.href = $(this).attr('href');
            return false;
        }
        $(".nm_inner").css('display', 'none');
        id = $(this).data('id');
        $(id).css('display', 'block');
        $(".mm_list a.act").removeClass("act");
        $(this).addClass("act");
        return false;
    });
    
    $('.zpl_file').on('click', '.zpl_file_del', function () {
        $(this).parent(".zpl_file input").val("");
        $(this).parent(".zpl_file").find("input").trigger('refresh');
    });




    // connect
    $('.open_accord').click(function () {
        $(".accordion").accordion({
            autoHeight: false,
            collapsible: true,
            active: true,
            heightStyle: "content"
        });
    });

    $(".scrollTo").on('click', function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        $('html, body').animate({
            scrollTop: ($(target).offset().top)
        }, 500);
    });
    $(".accordion").accordion({
        autoHeight: false,
        collapsible: true,
        active: false,
        animate: 100,
        heightStyle: "content"
    });
    if ($('#send_form').length) {
        $('#send_form').former();
    }
    $('input, select').styler({
        fileBrowse: 'Выбрать',
    });
});