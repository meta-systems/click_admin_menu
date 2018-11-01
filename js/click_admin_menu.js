(function ($) {

  "use strict";

  Drupal.behaviors.click_admin_menu = {
    attach: function (context, settings) {
		
		$('.cam_open').click(function(event) {
			$('.camP').toggleClass('adminMenuVisible');
			return false;
		});
		$(document).click(function (event) {
			if ($(event.target).closest('.camP').length == 0) {
				$('.camP').removeClass('adminMenuVisible');
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
