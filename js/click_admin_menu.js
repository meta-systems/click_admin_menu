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
		$('.click_admin_menu_add_btn').click(function () {
			var title = $('h1').text();
			var url = '/click_admin_menu/add?title=';
			window.location.href = url + title;
        });

		
    }
  };

})(jQuery, drupalSettings);
