<?php

class Woo_Actions {

	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'send_woocommerce_updated_fragments' ), 10, 1 );
	}

	public function send_woocommerce_updated_fragments( $fragments ) {

		$woocommerce_cart = WC()->cart;

		$cart_check = $woocommerce_cart->is_empty();

		$cart_products = $woocommerce_cart->get_cart();

		$cart_count = $woocommerce_cart->get_cart_contents_count();

		$cart_total = $woocommerce_cart->get_cart_contents_total();

		ob_start();

		wfc_load_template(
			'wfc-cart-headers.php',
			array(
				'cart_count'  => $cart_count,
				'cart_status' => $cart_check,
			),
			'woocommerce-fast-checkout/templates/cart',
			WFC_TEMPLATES . 'cart/'
		);

		$fragments['div.wfc_title'] = ob_get_clean();

		ob_start();

		echo '<ul class="wfc_list wfc_list_item">';

		wfc_load_template(
			'wfc-product-list.php',
			array(
				'cart_products' => $cart_products,
				'cart_status'   => $cart_check,
			),
			'woocommerce-fast-checkout/templates/cart',
			WFC_TEMPLATES . 'cart/'
		);

		echo '</ul>';

		$fragments['ul.wfc_list'] = ob_get_clean();

		ob_start();

		wfc_load_template(
			'wfc-cart-coupon.php',
			array(
				'cart_products' => $cart_products,
				'cart_status'   => $cart_check,
			),
			'woocommerce-fast-checkout/templates/cart',
			WFC_TEMPLATES . 'cart/'
		);

		$fragments['div.wfc_cart_footer_top_left'] = ob_get_clean();

		ob_start();

		wfc_load_template(
			'wfc-cart-total.php',
			array(
				'cart_products' => $cart_products,
				'cart_status'   => $cart_check,
				'cart_total'    => $cart_total,
			),
			'woocommerce-fast-checkout/templates/cart',
			WFC_TEMPLATES . 'cart/'
		);

		$fragments['div.wfc_cart_footer_top_right'] = ob_get_clean();

		ob_start();

		wfc_load_template(
			'wfc-footer.php',
			array(
				'cart_status' => $cart_check,
			),
			'woocommerce-fast-checkout/templates/cart',
			WFC_TEMPLATES . 'cart/'
		);

		$fragments['div.wfc_cart_footer_bottom'] = ob_get_clean();

		return $fragments;
	}
}

new Woo_Actions();
