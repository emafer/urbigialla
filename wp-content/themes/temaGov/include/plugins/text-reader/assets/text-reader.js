jQuery(document).ready(function() {
    jQuery("#play").click(function () {
        if (!responsiveVoice.isPlaying()) {
            responsiveVoice.speak(jQuery("#testoDaLeggere").text(), "Italian Female");
        }
    });
    jQuery("#pause").click(function () {
        if (responsiveVoice.isPlaying()) {
            responsiveVoice.pause();
        }
    });
})