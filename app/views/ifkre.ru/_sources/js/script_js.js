// placeholder
$(document).ready(function(){
	//$("input, textarea").on("focus", function(){
	$("body").on("focus","input, textarea",function(){
		if($(this).attr("data") != ''){
			if($(this).val() == $(this).attr("data"))
				$(this).val("");
		}
	});
	//$("input, textarea").on("blur", function(){
	$("body").on("blur","input, textarea",function(){
		if($(this).attr("data") != ''){
			if($(this).val() == "")
				$(this).val($(this).attr("data"));
		}
	});
});

// fixed_nav
$(function(){
    $(window).scroll(function() {
        var top = $(document).scrollTop();
        var height1 = $(document).height()-$(window).height()-100;   
        var result =  $(document).scrollTop();
        if (top < 660)
        {
        	$(".nav_scroll").removeClass("nav_scroll_act");
        }
        else
        {
        	$(".nav_scroll").addClass("nav_scroll_act");
        }
    });
});

// mask
$(document).ready(function(){
	$("body").on("click",".in_phone",function(){$(this).inputmask("9(999)9999999");});
});


// popup_open
$(document).ready(function(){

	$("#btn_popup_tu, #pu_calc .closeform").click(function(){
		$(".popup_rgba").fadeToggle(400);
		$("#pu_calc").slideToggle(700);
		$("body").toggleClass("overflow");
		return false;
	});

	$(".oyt_kol_num_calc, #pu_oplata_calc .closeform").click(function(){
		$(".popup_rgba").fadeToggle(400);
		$("#pu_oplata_calc").slideToggle(700);
		$("body").toggleClass("overflow");
		return false;
	});

	// nav mobile
	$(".nav_mobile_ico").click(function(){
		$(this).toggleClass("nav_mobile_ico_act");
		$(".mobile_menu_plashka").slideToggle(300);
		return false;
	});

	$(".nm_open").click(function(){
		$(".nm_inner").css('display', 'none');
		id = $(this).data('id');
		$(id).css('display', 'block');
		$(".mm_list a.act").removeClass("act");
		$(this).addClass("act");
		console.log(id);
		return false;
	});

	$('.zpl_file_del').click(function() {
		$(this).parent(".zpl_file input").val("");
		$(this).parent(".zpl_file").find("input").trigger('refresh');
	});


	

	// connect
	$('.open_accord').click(function() {
	   $( ".accordion" ).accordion({
			autoHeight:false,
			collapsible:true,
			active: true,
			heightStyle: "content",
			active: 0
		});
	});

	  $(".scrollTo").on('click', function(e) {
	     e.preventDefault();
	     var target = $(this).attr('href');
	     $('html, body').animate({
	       scrollTop: ($(target).offset().top)
	     }, 500);
	  });

});