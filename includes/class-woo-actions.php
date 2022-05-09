<?php

class Woo_Actions{
    public function __construct()
    {
        add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'send_woocommerce_updated_fragments' ), 10, 1 );
    }

    public function send_woocommerce_updated_fragments( $fragments ) {
        return $fragments;   
    }
}

new Woo_Actions();