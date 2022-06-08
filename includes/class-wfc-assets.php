<?php
class WFC_ASSETS {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'wfc_register_styles_scripts' ), 5 );
		add_action( 'wp_enqueue_scripts', array( $this, 'wfc_enqueue_styles_scripts' ), 10 );
	}

	public function wfc_register_styles_scripts() {

		foreach ( $this->wfc_styles() as $style ) {
			wp_register_style( $style['handle'], $style['src'], $style['deps'], $style['ver'] );
		}

		foreach ( $this->wfc_scripts() as $script ) {
			wp_register_script( $script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer'] );
		}

		wp_localize_script(
			'wfc-js',
			'wfc_datas',
			array(
				'wfc_url'      => WFC_PLUGIN_URL,
				'wfc_ajax_url' => admin_url( 'admin-ajax.php' ),
				'wfc_cart_url' => site_url() . '/cart/',
				'wc_ajax_url'  => WC_AJAX::get_endpoint( '%%endpoint%%' ),
			)
		);
	}

	public function wfc_enqueue_styles_scripts() {
		foreach ( $this->wfc_styles() as $style ) {
			wp_enqueue_style( $style['handle'] );
		}

		foreach ( $this->wfc_scripts() as $script ) {
			wp_enqueue_script( $script['handle'] );
		}
	}

	public function wfc_styles() {
		return array(
			array(
				'handle' => 'wfc-fontawsome',
				'src'    => WFC_ASSETS_URL . '/css/fontawsome/all.css',
				'deps'   => '',
				'ver'    => rand(),
			),
			array(
				'handle' => 'wfc-bootstrap',
				'src'    => WFC_ASSETS_URL . '/css/bootstrap.css',
				'deps'   => '',
				'ver'    => rand(),
			),
			array(
				'handle' => 'wfc-css',
				'src'    => WFC_ASSETS_URL . '/css/custom.css',
				'deps'   => array( 'wfc-fontawsome', 'wfc-bootstrap' ),
				'ver'    => rand(),
			),
		);
	}

	public function wfc_scripts() {
		return array(
			array(
				'handle'    => 'wfc-bootstrap',
				'src'       => WFC_ASSETS_URL . '/js/bootstrap.min.js',
				'deps'      => array( 'jquery' ),
				'ver'       => rand(),
				'in_footer' => true,
			),
			array(
				'handle'    => 'wfc-js',
				'src'       => WFC_ASSETS_URL . '/js/frontend.js',
				'deps'      => array( 'jquery' ),
				'ver'       => rand(),
				'in_footer' => true,
			),
		);
	}
}

new WFC_ASSETS();
