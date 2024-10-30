jQuery(document).ready(function(){
  var option = jQuery('.multiple-items').data('slick');
    jQuery('.multiple-items').slick({
        infinite: true,
        slidesToShow: option.slidesToShow,
        slidesToScroll: parseInt(option.slidesToScroll),
        autoplay: Boolean(parseInt(option.autoplay)),
        autoplaySpeed: 0,
        speed: option.speed,
        arrows: Boolean(parseInt(option.arrows))
    });
    
    if(jQuery("#slick-container").length == 0) {
        jQuery('.add-banner').css('margin-top', '20px');
    } else {
        jQuery('#slick-container').show();
    }
});
