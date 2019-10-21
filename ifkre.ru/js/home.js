$(document).ready(function(){
    $('.header_slider').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: false,
        variableWidth: false,
        arrows: true,
        fade: false,
        autoplay: true,
        autoplaySpeed: 2000,
    });
    $('.logo_slider').slick({
        dots: false,
        infinite: true,
        speed: 900,
        slidesToShow: 5,
        slidesToScroll: 5,
        adaptiveHeight: false,
        variableWidth: false,
        arrows: true,
        fade: false,
        responsive: [
        {
          breakpoint: 950,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
          }
        },
        {
          breakpoint: 790,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
          }
        },
        {
          breakpoint: 610,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          }
        },
        {
          breakpoint: 440,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            variableWidth: true,
            dots: true,
          }
        },
      ]
    });
    $(function() {
        $( ".tabs" ).tabs();
    });
});