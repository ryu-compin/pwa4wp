(function ($) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    $(function() {
        $('#add-initial-caches').on('click', function () {
            $('#initial-cache-list').append('<li class="pwa4wp_list pwa4wp_innerlist"><input name="initial-caches[]" class="pwa4wp_longtext"></li>');
        });
        $('#add-exclusions').on('click', function () {
            $('#exclusion-list').append('<li class="pwa4wp_list pwa4wp_innerlist"><input name="exclusions[]" class="pwa4wp_longtext"></li>');
        });
        let themeColor = $("#themeColorPicker").val();
        console.info(themeColor);
        $('#themeColorPicker').wpColorPicker({
            defaultColor: themeColor
        });
        let bgColor = $("#bgColorPicker").val();
        console.info(bgColor);
        $('#bgColorPicker').wpColorPicker();

        $('#regexp_dotest').on('click', function () {
            $('#regexp_result').empty();
            let testText = $('#regextTestURL').val();
            let appendText = "";
            let regTestResult = false;
            console.log("Test start for URL [" + testText + "]");
            appendText = appendText + "Test for URL [" + testText + "].<br>\n";
            if((typeof(testText) === 'undefined')||(testText =="")){
                appendText = "Test URL not set.<br>\n";
            }else{
                appendText = appendText + "<ul>\n";
                $('#exclusion-list').children('li').each(function (i, e) {
                        let regtext;
                        regtext = EscVal($('input',this).val());
                        if((typeof(regtext) !== 'undefined')&&(regtext != "")){
                            appendText = appendText + "<li class=\"pwa4wp_list\">\n";
                            appendText = appendText + "Test for [" + regtext + "]\n";
                            if((new RegExp(regtext)).test(testText)){
                                appendText = appendText + "&nbsp;:&nbsp;<span class=\"pwa4wp_red\">Hit</span>"
                                regTestResult = true;
                            }else{
                                appendText = appendText + "&nbsp;:&nbsp;None"
                            }
                            appendText = appendText + "</li>\n";
                        }
                    }
                );
                appendText = appendText + "</ul>\n";
                if(regTestResult){
                    appendText = appendText + $('#msg_RegExpHit').text() + "<br>\n";
                }else{
                    appendText = appendText + $('#msg_RegExpNone').text() + "<br>\n";
                }
            }
            appendText = appendText + "Test end.<br>\n";
            $('#regexp_result').append(appendText);
        });
        function EscVal(txt){
//            return txt.replace(/[ !"#$%&'()*+,.\/:;<=>?@\[\\\]^`{|}~]/g, '\\$&');
            return txt.replace(/[\/]/g, '\\$&');
        }
        $('#regexp_toggle').on('click', function () {
            let btn_open_text = $('#btn_OpenRegexpTest').text();
            let btn_close_text = $('#btn_CloseRegexpTest').text();
            if($('#regexp_toggle').text() == btn_close_text){
                // Open now, Close test alea.
                $('#regextestform').animate(
                    {
                        height:"0",
                        opacity:0
                    },
                    400
                );
                $('#regexp_toggle').text(btn_open_text);
            }else{
                // Close now, Open test alea.
                $('#regextestform').animate(
                    {
                        height:"4em",
                        opacity:1
                    },
                    400,
                    function () {
                        $('#regextestform').css("height","auto");
                    }
                );
                $('#regexp_toggle').text(btn_close_text);
            }

        });
    });

})(jQuery);

