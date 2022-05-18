<?php

class Woo_Actions {

	public function __construct() {
		add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'send_woocommerce_updated_fragments' ), 10, 1 );
	}

	public function send_woocommerce_updated_fragments( $fragments ) {

		global $product_remove_notice;

		$woocommerce_cart = WC()->cart;

		$cart_check = $woocommerce_cart->is_empty();

		$cart_products = $woocommerce_cart->get_cart();

		if ( $cart_check ) {

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

			$fragments['div.shopping_cart_table'] = ob_get_clean();

		} else {

			ob_start();

			wfc_load_template(
				'wfc-cart-headers.php',
				array(
					'cart_products' => $cart_products,
					'cart_status'   => $cart_check,
				),
				'woocommerce-fast-checkout/templates/cart',
				WFC_TEMPLATES . 'cart/'
			);

			$fragments['thead.wfc-headers'] = ob_get_clean();

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

			$fragments['tbody.wfc-products-main'] = ob_get_clean();

			ob_start();

			wfc_load_template(
				'wfc-cart-others.php',
				array(
					'cart_products' => $cart_products,
					'cart_status'   => $cart_check,
				),
				'woocommerce-fast-checkout/templates/cart',
				WFC_TEMPLATES . 'cart/'
			);

			$fragments['div.wfc-continue-update'] = ob_get_clean();

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

			$fragments['div.wfc-coupon'] = ob_get_clean();

			ob_start();

			wfc_load_template(
				'wfc-cart-total.php',
				array(
					'cart_products' => $cart_products,
					'cart_status'   => $cart_check,
				),
				'woocommerce-fast-checkout/templates/cart',
				WFC_TEMPLATES . 'cart/'
			);

			$fragments['div.wfc-total-subtotal'] = ob_get_clean();
		}

		return $fragments;
	}
}

new Woo_Actions();
