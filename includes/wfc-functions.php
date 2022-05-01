<?php

function wfc_load_template( $template_name, $args, $template_path, $default_path ) {
  if( function_exists('wc_get_template') ) {
      wc_get_template($template_name, $args, $template_path, $default_path);
  }
}