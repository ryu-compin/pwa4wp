(function($) {
    $(function() {
        var custom_uploader = wp.media({
            title: 'Select Image ( Only "png" image file is available )',
            library: {
                type: 'image/png'
//                type: 'image'
            },
            button: {
                text: 'Select Image'
            },
            multiple: false
        });

        $("#media-upload").on("click", function(e) {
            e.preventDefault();
            custom_uploader.open();
        });
        custom_uploader.on("select", function () {
            var images = custom_uploader.state().get('selection');

            images.each(function(file) {
                if(file.toJSON().mime == "image/png"){
                    $("#image-error").html('');
                    $("#image-url").val(file.toJSON().url);
                    $("#image-view").attr("src", file.toJSON().url);
                }else{
                    $("#image-error").html('<br><span class="pwa4wp_redalert">*ERROR*&nbsp;This file is not "png" format image.</span><br>');
                }
            });
        });
    });
})(jQuery);