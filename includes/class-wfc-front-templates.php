<?php

class WFC_FRONT_TEMPLATES{

    public function __construct() {
        add_action( 'wp_footer', array( $this, 'wfc_show_cart_template'), 10 );
    }

    public function wfc_show_cart_template() {
        wfc_load_template('wfc-cart-template.php', array(), 'woocommerce-fast-checkout/templates/main-template', WFC_TEMPLATES . 'main-template/');
    }

    public static function wfc_render_products_markup( $woocommerce_cart ) {

    }
}

new WFC_FRONT_TEMPLATES();