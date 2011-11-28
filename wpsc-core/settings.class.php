<?php
class WPSC_Settings
{
	private $settings = array();
	private $default_settings = array();

	public function __construct() {
		$this->default_settings = array(
			'catalog_slug'                      => 'shop',
			'product_base_slug'                 => 'product',
			'category_base_slug'                => 'category',
			'hierarchical_product_category_url' => 0,
			'cart_page_slug'                    => 'cart',
			'transaction_result_page_slug'      => 'transaction-result',
			'customer_account_page_slug'        => 'account',
		);
	}

	public function setup() {
		foreach ( $this->default_settings as $name => $value ) {
			add_option( 'wpsc_' . $name, $value );
		}
	}

	public function get( $setting ) {
		$default = array_key_exists( $setting, $this->default_settings ) ? $this->default_settings[$setting] : null;
		return get_option( 'wpsc_' . $setting, $default );
	}

	public function set( $setting, $value ) {
		return update_option( 'wpsc_' . $setting, $value );
	}
}

function wpsc_get_option( $option_name ) {
	global $wpsc_settings;
	return $wpsc_settings->get( $option_name );
}

function wpsc_update_option( $option_name, $value ) {
	global $wpsc_settings;
	return $wpsc_settings->set( $option_name, $value );
}

$GLOBALS['wpsc_settings'] = new WPSC_Settings();
add_action( 'wpsc_activate', array( $GLOBALS['wpsc_settings'], 'setup' ) );