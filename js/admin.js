jQuery(document).ready(function(){
    jQuery('#thumbnail-settings').submit(function(event) {
        var sliderImages = [];
        jQuery('#mediaImages input:checked').each(function () {
           if (this.checked) {
                sliderImages.push(jQuery(this).val()); 
           }
        });
        jQuery('#slider_images').val(sliderImages.toString());
        //event.preventDefault();
    });
});
