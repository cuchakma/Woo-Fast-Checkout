<?php

function wfc_locate_template( $template_name, $template_path = '', $root_path = '', $args = array() ) {
    
    if( $args && is_array( $args ) ) {
        extract($args);
    }

    if( empty( $root_path ) ) {
        $root_path = WFC_PLUGIN_DIR;
    }
    
    if( empty( $template_path ) ) {
        $template_path = 'templates/';
    }

    if( empty( $template_name ) ) {
        $template_name = 'main-template/wfc-cart-template.php';
    }

    $fullpath =  $root_path . '' . $template_path . '' .$template_name; 
    
    include $fullpath;
}