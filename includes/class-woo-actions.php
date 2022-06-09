<?php

class Woo_Actions {

	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'send_woocommerce_updated_fragments' ), 10, 1 );
	}

	public function send_woocommerce_updated_fragments( $fragments ) {

		$woocommerce_cart = WC()->cart;

		$cart_check = $woocommerce_cart->is_empty();

		$cart_products = $woocommerce_cart->get_cart();

		ob_start();

		wfc_load_template(
			'wfc-product-list.php',
			array(
				'cart_products' => $cart_products,
				'cart_status'   => $cart_check,
			),
			'woocommerce-fast-checkout/templates/cart',
			WFC_TEMPLATES . 'cart/'
		);

		$fragments['div.wfc_list_wrap'] = ob_get_clean();

		return $fragments;
	}
}

new Woo_Actions();
