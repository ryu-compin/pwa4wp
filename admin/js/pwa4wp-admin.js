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
        $('#add-forcecache').on('click', function () {
            $('#forcecache-list').append('<li class="pwa4wp_list pwa4wp_innerlist"><input name="forcecache[]" class="pwa4wp_longtext"></li>');
        });
        $('#add-forceonline').on('click', function () {
            $('#forceonline-list').append('<li class="pwa4wp_list pwa4wp_innerlist"><input name="forceonline[]" class="pwa4wp_longtext"></li>');
        });

        let themeColor = $("#themeColorPicker").val();
        console.info(themeColor);
        $('#themeColorPicker').wpColorPicker({
            defaultColor: themeColor
        });
        let bgColor = $("#bgColorPicker").val();
        console.info(bgColor);
        $('#bgColorPicker').wpColorPicker();

        $('#regexp_dotest').on('click', function(){
            pwa4wp_regexp_dotest(
            '#regexp_result',
            '#regextTestURL',
            '#exclusion-list',
            '#msg_RegExpHit');
        });
        $('#regexp_dotest_forcecache').on('click',  function(){
            pwa4wp_regexp_dotest(
                '#regexp_result_forcecache',
                '#regextTestURL_forcecache',
                '#forcecache-list',
                '#msg_RegExpHit_forcecache');
        });
        $('#regexp_dotest_forceonline').on('click',  function(){
            pwa4wp_regexp_dotest(
                '#regexp_result_forceonline',
                '#regextTestURL_forceonline',
                '#forceonline-list',
                '#msg_RegExpHit_forceonline');
        });

        function pwa4wp_regexp_dotest(resultField, TestURL, exclusionList,msgRegExpHit) {
            $(resultField).empty();
            let testText = $(TestURL).val();
            let appendText = "";
            let regTestResult = false;
            console.log("Test start for URL [" + testText + "]");
            appendText = appendText + "Test for URL [" + testText + "].<br>\n";
            if((typeof(testText) === 'undefined')||(testText =="")){
                appendText = "Test URL not set.<br>\n";
            }else{
                appendText = appendText + "<ul>\n";
                $(exclusionList).children('li').each(function (i, e) {
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
                    appendText = appendText + $(msgRegExpHit).text() + "<br>\n";
                }else{
                    appendText = appendText + $(msgRegExpHit).text() + "<br>\n";
                }
            }
            appendText = appendText + "Test end.<br>\n";
            $(resultField).append(appendText);
        }
        function EscVal(txt){
//            return txt.replace(/[ !"#$%&'()*+,.\/:;<=>?@\[\\\]^`{|}~]/g, '\\$&');
            return txt.replace(/[\/]/g, '\\$&');
        }

        $('#regexp_toggle').on('click', function(){
            openTestField(
                '#regexp_toggle',
                '#regextestform',
                '#pwa4wp_regexttestinner');
        });
        $('#regexp_toggle_forcecache').on('click', function(){
            openTestField(
                '#regexp_toggle_forcecache',
                '#regextestform_forcecache',
                '#pwa4wp_regexttestinner_forcecache');
        });
        $('#regexp_toggle_forceonline').on('click', function(){
            openTestField(
                '#regexp_toggle_forceonline',
                '#regextestform_forceonline',
                '#pwa4wp_regexttestinner_forceonline');
        });

        function openTestField(buttonID,targetTestField,formAreaID) {
            let btn_open_text = $('#btn_OpenRegexpTest').text();
            let btn_close_text = $('#btn_CloseRegexpTest').text();
            if($(buttonID).text() == btn_close_text){
                // Open now, Close test alea.
                $(targetTestField).animate(
                    {
                        height:"0",
                        opacity:0
                    },
                    400,
                    function(){
                        $(formAreaID).css('display','none');
                    }
                );
                $(buttonID).text(btn_open_text);
            }else{
                // Close now, Open test alea.
                $(formAreaID).css('display','block');
                $(targetTestField).animate(
                    {
                        height:"4em",
                        opacity:1
                    },
                    400,
                    function () {
                        $(targetTestField).css("height","auto");
                    }
                );
                $(buttonID).text(btn_close_text);
            }

        }
    });

})(jQuery);

