;
(function($) {

	woo_add_to_cart();
	woo_update_cart();

	function woo_add_to_cart() {
		$('body').on('added_to_cart', function(event, fragments, cart_hash, button) {
			console.log(fragments);
			console.log(cart_hash);
			console.log(button);
		});
	}

	function woo_update_cart() {
		$('.sc_btn_update button').on('click', function(e) {
			$('svg.wfc-loader').css('display', 'block');
			$('section.wfc_shopping_cart_content').addClass('wfc_meta');
			setTimeout(function(e) {
				$('svg.wfc-loader').css('display', 'none');
				$('section.wfc_shopping_cart_content').removeClass('wfc_meta');
			}, 1000);
		});
	}
}(jQuery));