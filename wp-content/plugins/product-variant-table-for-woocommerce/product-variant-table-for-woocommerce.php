<?php
/*
Plugin Name: PVT - Product Variation Table for WooCommerce
Plugin URI: https://wpxtension.com/product/product-variation-table-for-woocommerce/
Description: Display WooCommerce product variations in a nicely formatted and customizable table on the single product page. 
Author: WPXtension
Author URI: https://wpxtension.com/
Text Domain: product-variant-table-for-woocommerce
Domain Path: /languages
Version: 1.6.1
Requires at least: 4.7.0
Requires PHP: 5.6.20
WC requires at least: 3.0.0
WC tested up to: 9.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/**
*====================================================
* Exit if accessed directly
*====================================================
**/
if (!defined('ABSPATH')) {
    exit;
}

/**
 * ====================================================
 * Define Constants
 * ====================================================
 */

define("PVTFW_VARIANT_TABLE_VERSION", '1.6.1');
define("PVTFW_REQUIRED_PRO_VERSION", '1.6.0');
define("PVTFW_DIR", plugin_dir_path(__FILE__) );
define("PVTFW_FILE", plugin_basename(__FILE__));

if ( ! defined( 'PVTFW_MAYBE_PRO_PLUGIN_FILE' ) ) {
	$pvtfw_maybe_pro_plugin_file = sprintf('%s/product-variant-table-for-woocommerce-pro/product-variant-table-for-woocommerce-pro.php', wp_normalize_path( WP_PLUGIN_DIR ));
	define( 'PVTFW_MAYBE_PRO_PLUGIN_FILE', $pvtfw_maybe_pro_plugin_file );
}

/**
 * ====================================================
 * Includes Necessary File
 * ====================================================
 */

if( !class_exists('PVTFW_TABLE' )):

	final class PVTFW_TABLE{

		protected static $_instance = null;

		public function __construct() {

			/**
			 * { Only `is_plugin_active_for_network` function is not exists }
			 * @since 1.4.19 Free
			 */

			if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
			    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
			}

			// Only load functionality if WooCommerce active

			if ($this->is_WooActive() == true){

				$this->includes();

				$this->hooks();

			}
			else{
				add_action( 'admin_notices', array( $this, 'error_notice' ) );
			}
		}

		/**
		 * ====================================================
		 * Creating self instance of class
		 * ====================================================
		 */
		public static function instance() {
			if( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
	
			return self::$_instance;
		}

		/**
		 * ====================================================
		 * Error Notice
		 * ====================================================
		 */
		function error_notice(){
			/* translators: %1$s is starting of <a>tag & %2$s is end of <a>tag */
			echo wp_kses_post( '<div class="error"><p><strong>' . __('Product Variation Table For Woocommerce - PVT', 'product-variant-table-for-woocommerce') . '</strong> ' . sprintf(__('requires %1$sWooCommerce%2$s to be installed & activated!', 'product-variant-table-for-woocommerce'), '<a href="http://wordpress.org/extend/plugins/woocommerce/">', '</a>') . '</p></div>' );
		}

		/**
		* ====================================================
		* Load Text Domain Folder
		* ====================================================
		**/
		function load_textdomain() {
			load_plugin_textdomain( "product-variant-table-for-woocommerce", false, basename( dirname( __FILE__ ) )."/languages" );
		}


		/**
		* ====================================================
		* Includes
		* ====================================================
		**/
		public function includes() {

			// WPXtension Menu
			require_once PVTFW_DIR.'inc/wpxtension/wpx-menu.php';
			require_once PVTFW_DIR.'inc/wpxtension/wpx-sidebar.php';
			WPXtension_Menu::instance();
			// WPXtension Menu

			require_once PVTFW_DIR.'inc/class_pvtfw_common.php';
			require_once PVTFW_DIR.'inc/admin/class_pvtfw_form.php';
			require_once PVTFW_DIR.'inc/admin/class_pvtfw_settings.php';
			require_once PVTFW_DIR.'inc/admin/class_pvtfw_advance.php';

			require_once PVTFW_DIR.'inc/frontend/class_pvtfw_print_table.php';
			require_once PVTFW_DIR.'inc/frontend/class_pvtfw_available_btn.php';
			require_once PVTFW_DIR.'inc/frontend/class_pvtfw_cart.php';

			// Theme Support File
			require_once PVTFW_DIR.'inc/compatibility.php';

			// Styling File
			require_once PVTFW_DIR.'inc/style.php';

			// Table render (hooks inside these files)
			require_once PVTFW_DIR.'inc/table-parts/content-thead.php';
			require_once PVTFW_DIR.'inc/table-parts/content-tbody.php';
		}


		/** 
		 * ====================================================
		 * Add relevant hooks
		 * ====================================================
		 */
		public function hooks() {
			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
			add_action( 'admin_init', array( $this, 'register_settings' ) );

			// Plugin Action links
			add_filter( 'plugin_action_links_'.PVTFW_FILE, array( $this, 'settings_link' ) );

			// Plugin row meta link
			add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 4 );

			// Admin Enqueue Scripts
			add_action('admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			

			// Frontend Hooks
			add_action('template_redirect', array( $this, 'remove_add_to_cart'), 29 );
			add_action('wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

			// Body Class
			add_action( 'body_class', array( $this, 'pvt_body_class' ) );
		}

		/**
		* ====================================================
		* Adding a class to the single product page <body>
		* ====================================================
		**/

		public function pvt_body_class( $classes ){
			if ( is_single() ) {
		        $classes[] = 'pvt_loaded';
		    }
			return $classes;
		}

		/**
		 * ====================================================
		 * Check if WooCommerce exists
		 * ====================================================
		 */
		private function is_WooActive(){

			/**
			 * { Checking multi site also }
			 * 
			 * @revised in 1.4.20
			 */
			if ( 
				in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) 
			){
				return true;
			}
			elseif( 
				is_multisite() 
				&& is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) 
			){
				return true;
			}
			else{
				return false;
			}
			

		}


		/**
		 * ====================================================
		 * Check if PVTFW Active
		 * ====================================================
		 */
		public static function is_pvtfw_pro_Active(){

			/**
			 * { Checking multi site also }
			 * 
			 * @revised in 1.4.20
			 */
			if ( 
				in_array( 'product-variant-table-for-woocommerce-pro/product-variant-table-for-woocommerce-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) 
			){
				return true;
			}
			elseif( 
				is_multisite() 
				&& is_plugin_active_for_network( 'product-variant-table-for-woocommerce-pro/product-variant-table-for-woocommerce-pro.php' ) 
			){
				return true;
			}
			else{
				return false;
			}

		}

		/**
		 * ====================================================
		 * Register Setings
		 * ====================================================
		 */
		public function register_settings(){
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_place' ); 
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_columns');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_show_available_options_btn');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_available_options_btn_text');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_show_available_options_text');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_cart_btn_text');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_show_table_header');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_qty_layout');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_sub_total');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_scroll_to_top');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_cart_notice');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_full_table');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_scrollable_x');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_min_width');
			register_setting('pvtfw_variant_table_settings', 'pvtfw_variant_table_tab');
		}
		 


		/**
		* ====================================================
		* Remove default variable product add to cart
		* ====================================================
		**/
		public function remove_add_to_cart() {
			// Default is `false` to apply table markup and feature
            if( apply_filters( 'disable_pvt_to_apply', false ) || apply_filters( 'disable_pvt_to_remove_add_to_cart', false ) ){
                return;
            }
			remove_action('woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30);
		}


		/**
		* ====================================================
		* Enqueue scripts and styles for Admin
		* ====================================================
		**/
		public function admin_scripts() {
			$screen = get_current_screen(); 
			if ($screen->id === 'wpxtension_page_pvtfw_variant_table') {

				$curTab = PVTFW_COMMON::pvtfw_get_options()->curTab;
				$scrollableTableX = PVTFW_COMMON::pvtfw_get_options()->scrollableTableX;

				wp_enqueue_script('jquery-ui-sortable');
				wp_enqueue_script('pvtfw-admin-scripts', plugins_url('admin/js/pvtfw_backend.js', __FILE__), array('jquery'), PVTFW_VARIANT_TABLE_VERSION, true);
				wp_localize_script( 'pvtfw-admin-scripts', 'table_object',
					array( 
						'tab_active' => $curTab,
						'scroll_table_x' => $scrollableTableX,
					)
				);
				wp_enqueue_style('pvtfw-admin-style', plugins_url('admin/css/pvtfw_backend.css', __FILE__), array(), PVTFW_VARIANT_TABLE_VERSION);
			}
		}

		/**
		* ====================================================
		* Enqueue scripts and styles for frontend
		* ====================================================
		**/
		public function frontend_scripts() {

			$fullTable = PVTFW_COMMON::pvtfw_get_options()->fullTable;
			$showSubTotal = PVTFW_COMMON::pvtfw_get_options()->showSubTotal;
			$pre_installed = PVTFW_TABLE::is_pvtfw_pro_Active();

			if( $pre_installed && 
				PVTFW_PRO_COMMON::pvtfw_pro_get_options()->showSearch !== "on" &&
				PVTFW_PRO_COMMON::pvtfw_pro_get_options()->showPagination !== "on"
				// Checking companion active but search and pagination is not on
			){
				$pre_installed = false;
			}

			if (is_product()) {
				wp_enqueue_script('pvtfw-frontend-scripts', plugins_url('public/js/pvtfw_frontend.js', __FILE__), array('woocommerce'), PVTFW_VARIANT_TABLE_VERSION, true);
				wp_enqueue_style('pvtfw-frontend-style', plugins_url('public/css/pvtfw_frontend.css', __FILE__), array(), PVTFW_VARIANT_TABLE_VERSION);
				wp_enqueue_style('fontello-style', plugins_url('public/font/fontello.css', __FILE__), array(), PVTFW_VARIANT_TABLE_VERSION);

				$get_woo_curr = get_woocommerce_currency_symbol();
				$get_woo_thousand_sep = get_option('woocommerce_price_thousand_sep');
				$get_woo_decimal_sep = get_option('woocommerce_price_decimal_sep');

				wp_localize_script( 'pvtfw-frontend-scripts', 'pre_info',
					array( 
						'pre_installed' => false, // Checking its companion plugin is active or not 
						// note: false mean companinaion is not exist. (for future use)
						'woo_curr' => $get_woo_curr,
						'thousand_sep' => $get_woo_thousand_sep,
						'decimal_sep' => $get_woo_decimal_sep
					)
				);

				if($fullTable == ''){
					wp_enqueue_style('prodcut-variant-table-small-screen-style', plugins_url('public/css/pvtfw_table_breakdown.css', __FILE__), array(), PVTFW_VARIANT_TABLE_VERSION);
				}
				
				if( $showSubTotal != '' ){

					$get_woo_num_of_decimal = get_option('woocommerce_price_num_decimals');

					wp_enqueue_script('pvtfw-subtotal-calc-scripts', plugins_url('public/js/pvtfw_subtotal_calc.js', __FILE__), array('woocommerce','jquery', 'pvtfw-frontend-scripts'), PVTFW_VARIANT_TABLE_VERSION, true);
					wp_localize_script( 'pvtfw-subtotal-calc-scripts', 'subtotal_object',
						array( 
							'currency_symbol' => get_woocommerce_currency_symbol(),
							'thousand_sep' => $get_woo_thousand_sep,
							'decimal_sep' => $get_woo_decimal_sep,
							// @note: use maximum `2` here. otherwise, it will add extra separator. 
							'number_of_decimals' => apply_filters( 'pvtfw_num_of_decimal', 2, $get_woo_num_of_decimal ), 
						)
					);

				}

			}
		}

		/**
		* ====================================================
		* Settings link for plugin listing page
		* ====================================================
		**/
		public function settings_link($links) { 
			// Build and escape the URL.
			$url = esc_url( add_query_arg(
				'page',
				'pvtfw_variant_table',
				get_admin_url() . 'admin.php'
			) );
			// Create the link.
			$settings_link = "<a href='$url'>" . __( 'Settings', 'product-variant-table-for-woocommerce' ) . '</a>';
			
			// Adds the link to the begining of the array.
			array_unshift( $links, $settings_link ); 

			if( !self::is_pvtfw_pro_Active() ){
				$pro_link = "<a style='font-weight: bold; color: #8012f9;' href='https://wpxtension.com/product/product-variation-table-for-woocommerce/' target='_blank'>" . __( 'Go Premium', 'product-variant-table-for-woocommerce' ) . '</a>';
				array_push( $links, $pro_link );
			}

			return $links; 
		}


		/**
		* ====================================================
		* Plugin row link for plugin listing page
		* ====================================================
		**/

		public function plugin_row_meta( $plugin_meta, $plugin_file, $plugin_data, $status ) {
 
			if ( strpos( $plugin_file, 'product-variant-table-for-woocommerce.php' ) !== false ) {

				$new_links = array(
					'ticket' => '<a href="https://wpxtension.com/submit-a-ticket/" target="_blank" style="font-weight: bold; color: #8012f9;">'. __( 'Help & Support', 'product-variant-table-for-woocommerce' ) .'</a>',
					'doc' => '<a href="https://wpxtension.com/doc-category/product-variation-table-for-woocommerce/" target="_blank">'. __( 'Documentation', 'product-variant-table-for-woocommerce' ) .'</a>'
				);
				 
				$plugin_meta = array_merge( $plugin_meta, $new_links );

			}
			 
			return $plugin_meta;
		}

	}

	$pvtfw_table = PVTFW_TABLE::instance();


endif;

// HPOS compatibility for PVT - Product Variation Table for WooCommerce
function pvtfw_hpos_compatibility() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
    }
}

add_action( 'before_woocommerce_init', 'pvtfw_hpos_compatibility' );

// Plugin check
function pvtfw_version_check_companion(){
	return defined( 'PVTFW_PRO' ) && ( version_compare( PVTFW_PRO, PVTFW_REQUIRED_PRO_VERSION ) >= 0 );
}

function pvtfw_deactivate_companion(){
	if ( pvtfw_version_check_companion() ) {
		return;
	}

	if ( ! function_exists( 'is_plugin_active' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	if ( is_plugin_active( 'product-variant-table-for-woocommerce-pro/product-variant-table-for-woocommerce-pro.php' ) ) {
		
		unset($_GET['activate']);

		add_action( 'admin_notices', 'pvtfw_companion_error_msg' );
		
		// Deactivate the plugin silently, Prevent deactivation hooks from running.
		deactivate_plugins( 'product-variant-table-for-woocommerce-pro/product-variant-table-for-woocommerce-pro.php', true );
	}
}
add_action( 'plugins_loaded',  'pvtfw_deactivate_companion');

function pvtfw_companion_error_msg(){
	/* translators: %1$s: Main wrapper start, %2$s: Main wrapper end, %3$s: Bold wrapper start, %4$s: Bold wrapper end, %5$s: Pro Plugin Version */
	printf(esc_html__('%1$sYou are running an older version of %3$s"PVT - Product Variation Table for WooCommerce - Pro"%4$s. Please upgrade to %3$s %5$s %4$s or higher.%2$s', 'product-variant-table-for-woocommerce'), 
		'<div class="error notice"><p>',
		'</p></div>',
		'<b>',
		'</b>',
		esc_html(constant( 'PVTFW_REQUIRED_PRO_VERSION' )) 
	);
}

// Meta notice
add_action( 'after_plugin_row_meta', 'pvtfw_companion_meta_notice', 10, 2 );
function pvtfw_companion_meta_notice( string $plugin_file, array $plugin_data) {
	if ( plugin_basename( PVTFW_MAYBE_PRO_PLUGIN_FILE ) === $plugin_file ) {
		$current_version = $plugin_data['Version'];
		if (  version_compare( $current_version, constant( 'PVTFW_REQUIRED_PRO_VERSION' ), '<' )  ) {
			/* translators: %s: Pro Plugin Version */
			$notice_text = 	 sprintf(esc_html__('You are running an older version of "PVT - Product Variation Table for WooCommerce - Pro". Please upgrade to %s or higher.', 'product-variant-table-for-woocommerce'), esc_html(constant( 'PVTFW_REQUIRED_PRO_VERSION' )));

			printf( '<p style="color: darkred"><span class="dashicons dashicons-warning"></span> <strong>%s</strong></p>', esc_html($notice_text) );
		}
	}
}

