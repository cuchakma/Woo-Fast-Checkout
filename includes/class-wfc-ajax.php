<?php

class WFC_AJAX {

	public function __construct() {
		self::wfc_ajax_actions();
	}

	public static function wfc_ajax_actions() {
		$ajax_wfc_events = array(
			'wfc_apply_coupon',
		);

		foreach ( $ajax_wfc_events as $ajax_events ) {
			add_action( 'wp_ajax_nopriv_' . $ajax_events, array( __CLASS__, $ajax_events ) );
		}
	}

	public static function wfc_apply_coupon() {
		if ( ! wp_verify_nonce( $_POST['wfc_coupon_nonce'], 'wfc-coupon-trigger' ) ) {
			wp_send_json_error(
				array(
					'message' => 'Nonce Verification Failed !',
				)
			);
		}

		$wc_coupon_code = wc_format_coupon_code( wp_unslash( $_POST['wfc_coupon_code'] ) );

        if ( ! empty( $_POST['coupon_code'] ) ) {
			WC()->cart->add_discount( $wc_coupon_code ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		} else {
			wc_add_notice( WC_Coupon::get_generic_coupon_error( WC_Coupon::E_WC_COUPON_PLEASE_ENTER ), 'error' );
		}

	}
}

new WFC_AJAX();
