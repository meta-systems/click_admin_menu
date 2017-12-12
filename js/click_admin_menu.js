(function ($) {

  "use strict";

  Drupal.behaviors.click_admin_menu = {
    attach: function (context, settings) {
		
		$('.adminMenuOpen').click(function(event) {
			$('.adminMenuP').toggleClass('adminMenuVisible');
			return false;
		});
		$(document).click(function (event) {
			if ($(event.target).closest('.adminMenuP').length == 0) {
				$('.adminMenuP').removeClass('adminMenuVisible');
			}
		});
		
		
		
		
    }
  };

})(jQuery, drupalSettings);
