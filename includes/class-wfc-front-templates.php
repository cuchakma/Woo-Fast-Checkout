<?php

class WFC_FRONT_TEMPLATES{

    public function __construct() {
        add_filter( 'woocommerce_get_cart_url', array( $this, 'wfc_add_url_parms' ), 10, 1);
        add_filter( 'template_include', array( $this, 'wfc_template_redirect'), 10, 1);    
        add_action( 'wp_footer', array( $this, 'wfc_show_cart_template'), 10 );
    }

    public function wfc_template_redirect( $template ) {
        if( isset($_REQUEST['wfc-cart'])) {
			return WFC_TEMPLATES . '/wfc-cart-body.php';	
		}
		return $template;
    }

    public function wfc_show_cart_template() {
        wfc_locate_template('main-template/wfc-cart-template.php');
    }

    public function wfc_add_url_parms( $url ) {
        return $url;
    }
}

new WFC_FRONT_TEMPLATES();