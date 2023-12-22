jQuery(window).load(function () {
	jQuery('.flexslider img').css({
		display: "block"
	});
	jQuery('.flexslider').flexslider({
		animation     : sliderVariabili.sliderAnimation,
		slideshowSpeed: parseInt(sliderVariabili.sliderTime),
		prevText      : "",
		nextText      : "",
		start         : function (slider) {
			jQuery('body').removeClass('loading');
		}
	});
});
jQuery(window).load(function () {
    jQuery('.flexslider-intro img').css({
        display: "block"
    });
    jQuery('.flexslider-intro').flexslider({
        animation     : sliderVariabili.sliderAnimationIntro,
        slideshowSpeed: parseInt(sliderVariabili.sliderTimeIntro),
        prevText      : "",
        nextText      : "",
        start         : function (slider) {
            jQuery('body').removeClass('loading');
        }
    });
});