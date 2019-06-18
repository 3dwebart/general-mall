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
	function gnb_3on(ul) {
		var subOn = 0;
		jQuery(document).on('mouseenter', ul, function() {
			subOn = 1;
			return subOn;
		});
	}
	jQuery(document).on('mouseenter', '.gnb_2dli.sub-menus', function() {
		var thisLi = jQuery(this).parent().find('ul');
		if(gnb_3on(thisLi) == 1) {
			jQuery(thisLi).addClass('on');
		} else {
			jQuery(thisLi).removeClass('on');
		}
	});
})(jQuery);