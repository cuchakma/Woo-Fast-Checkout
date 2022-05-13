<?php

class WFC_FRONT_TEMPLATES {

	public function __construct() {
		add_action( 'wp_footer', array( $this, 'wfc_show_cart_template' ), 10 );
	}

	public function wfc_show_cart_template() {
		if ( ! is_admin() ) {
			wfc_load_template( 'wfc-cart-template.php', array(), 'woocommerce-fast-checkout/templates/main-template', WFC_TEMPLATES . 'main-template/' );
		}
	}

	public static function wfc_construct_products_markup( $woocommerce_cart ) {
		$product_markup       = '';
		$full_products_markup = array();
		foreach ( $woocommerce_cart as $cart_key => $cart_item ) {

			$product_id = $cart_item['product_id'];

			$product_data = $cart_item['data'];

			if ( empty( $product_data ) || ! $product_data->exists() || $cart_item['quantity'] < 0 ) {
				continue;
			}

			$product_permalink = get_permalink( $product_id );

			$product_name = $product_data->get_name();

			$product_price = $product_data->get_price();

			$product_qty = $cart_item['quantity'];

			$product_thumbnail = $product_data->get_image();

			$product_subtotal = WC()->cart->get_product_subtotal( $product_data, $product_qty );

			$product_markup  = '<tr>';
			$product_markup .= '<td><a href="' . esc_url( wc_get_cart_remove_url( $cart_key ) ) . '" class="sc_remove_icon btn btn-dange" data-product-id="' . filter_var( $product_id, FILTER_SANITIZE_NUMBER_INT ) . '" data-product-sku="' . filter_var( $product_qty, FILTER_SANITIZE_NUMBER_INT ) . '"><i class="fa-solid fa-trash"></i>Remove</a></td>';
			$product_markup .= '<td>' . wp_kses_post( $product_thumbnail ) . '</td>';
			$product_markup .= '<td><h5 class="sc_product_title">' . wp_kses_post( $product_name ) . '</h5></td>';
			$product_markup .= '<td><p class="sc_product_price">' . wp_kses_post( $product_price ) . '</p></td>';
			$product_markup .= '<td><input type="number" class="sc_product_quantity" value=' . wp_kses_post( $product_qty ) . '></td>';
			$product_markup .= '<td><p class="sc_total">' . wp_kses_post( $product_subtotal ) . '</p></td>';
			$product_markup .= '</tr>';

			$full_products_markup[] = $product_markup;
		}
		return implode( '\n', $full_products_markup );
	}

}

new WFC_FRONT_TEMPLATES();
