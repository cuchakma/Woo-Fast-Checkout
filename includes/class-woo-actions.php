<?php

class Woo_Actions {
	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'send_woocommerce_updated_fragments' ), 999, 1 );
	}

	public function send_woocommerce_updated_fragments( $fragments ) {
		$cart_object = WC()->cart->get_cart();

		ob_start();

		echo '<tbody class="wfc-products-main">' . WFC_FRONT_TEMPLATES::wfc_construct_products_markup( $cart_object ) . '</tbody>';

		$fragments['tbody.wfc-products-main'] = ob_get_clean();

		return $fragments;
	}
}

new Woo_Actions();
