<?php

class WFC_AJAX {

	public function __construct() {
		self::wfc_ajax_actions();
	}

	public static function wfc_ajax_actions() {
		$ajax_woocommerce_nopriv_wfc_events = array(
			'wfc_apply_coupon',
			'wfc_remove_product',
		);

		foreach ( $ajax_woocommerce_nopriv_wfc_events as $ajax_events ) {
			add_action( 'wc_ajax_' . $ajax_events, array( __CLASS__, $ajax_events ), 10 );
		}
	}

	public static function wfc_apply_coupon() {
		if ( ! wp_verify_nonce( $_POST['wfc_coupon_nonce'], 'wfc-coupon-trigger' ) ) {
			wp_send_json_error(
				array(
					'message' => 'Coupon Verification Failed !',
				)
			);
		}

		$wc_coupon_code = wc_format_coupon_code( wp_unslash( $_POST['wfc_coupon_code'] ) );

		if ( ! empty( $_POST['coupon_code'] ) ) {
			WC()->cart->add_discount( $wc_coupon_code );
		} else {
			wc_add_notice( WC_Coupon::get_generic_coupon_error( WC_Coupon::E_WC_COUPON_PLEASE_ENTER ), 'error' );
		}

	}

	public static function wfc_remove_product() {

		global $product_remove_notice;

		$cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( $_POST['cart_item_key'] ) : '';

		$cart_product = WC()->cart->get_cart_item( $cart_item_key );

		$product_object = wc_get_product( $cart_product['product_id'] );

		if ( WC()->cart->remove_cart_item( $cart_item_key ) ) {

			if ( $product_object && $product_object->is_in_stock() && $product_object->has_enough_stock( $cart_product['quantity'] ) ) {

				$product_remove_notice = sprintf( '<div class="mbh-information mbh-notification-box">%s Removed. ', esc_attr( $product_object->get_name() ) );

				$product_remove_notice .= '<a href="' . esc_url( wc_get_cart_undo_url( $cart_item_key ) ) . '" class="restore-item">Undo?</a></div>';

			} else {

				$product_remove_notice = sprintf( '<div class="mbh-information mbh-notification-box">%s Removed. </div>', esc_attr( $product_object->get_name() ) );

			}

			WC_AJAX::get_refreshed_fragments();

		} else {

			wp_send_json_error();

			die();
		}
	}
}

new WFC_AJAX();
