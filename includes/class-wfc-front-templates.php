<?php

class WFC_FRONT_TEMPLATES {

	public function __construct() {
		add_action( 'wp_footer', array( $this, 'wfc_show_cart_template' ), 10 );
	}

	public function wfc_show_cart_template() {
		if ( ! is_admin() ) {
			wfc_load_template( 'wfc-cart-template.php', array( '' ), 'woocommerce-fast-checkout/templates/main-template', WFC_TEMPLATES . 'main-template/' );
		}
	}

}

new WFC_FRONT_TEMPLATES();
