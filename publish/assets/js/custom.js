/* Custom JS */
(function($) {
	function topButton() {
		var topPos = jQuery(document).scrollTop();
		if(topPos < 200) {
			return jQuery('#top_btn').removeClass('on');
		} else {
			return jQuery('#top_btn').addClass('on');
		}
	}
	topButton();
	jQuery(window).scroll(function() {
		topButton();
	});
	/********** BIGIN :: Header control **********/
	/***** BIGIN :: Header custom menu *****/
	// Cart menu
	//
	/***** END :: Header custom menu *****/
	/********** END :: Header control **********/
})(jQuery);