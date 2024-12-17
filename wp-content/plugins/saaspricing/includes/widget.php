<?php
namespace Saas_Pricing_Table;

final class Saas_Pricing {
	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */

	const VERSION = '1.1.3';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */

	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Saas_Pricing_Table\Saas_Pricing The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Saas_Pricing_Table\Saas_Pricing  An instance of the class.
	 */

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	 
	public function is_compatible() {

		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'saaspricing' ),
			'<strong>' . esc_html__( 'Saaspricing', 'saaspricing' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'saaspricing' ) . '</strong>'

		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saaspricing' ),
			'<strong>' . esc_html__( 'Saaspricing', 'saaspricing' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'saaspricing' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION

		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'saaspricing' ),
			'<strong>' . esc_html__( 'Saaspricing', 'saaspricing' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'saaspricing' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
			 
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	
	public function init() {

		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'saasp_frontend_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'saasp_frontend_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'saasp_editor_styles' ] );
		add_action( 'elementor/widgets/register', [ $this, 'saasp_register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [$this,'saasp_add_categories']);
		if( !in_array( 'saaspricing-pro/saaspricing-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			add_filter( 'plugin_action_links_saaspricing/saaspricing.php', [$this,'saasp_action_link']);
		}
	}

	public function saasp_frontend_styles() {

		wp_register_style( 'saasp-bootstrap-css', SAASP_PRICING_ASSETS_URL . 'css/bootstrap.min.css' );
	    wp_register_style( 'saasp-popup-css', SAASP_PRICING_ASSETS_URL . 'css/popup.css' );
		wp_register_style( 'saasp-vendor-css', SAASP_PRICING_ASSETS_URL . 'css/vendor.css' );
		wp_register_style( 'saasp-pricelist-css', SAASP_PRICING_ASSETS_URL . 'css/pricelist.css' );
		wp_register_style( 'saasp-style-css', SAASP_PRICING_ASSETS_URL . 'css/style.css' );
	  
		wp_enqueue_style( 'saasp-bootstrap-css' );
		wp_enqueue_style( 'saasp-popup-css' );
		wp_enqueue_style( 'saasp-vendor-css' );
		if( !in_array( 'saaspricing-pro/saaspricing-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			wp_enqueue_style( 'saasp-pricelist-css' );
		}
		wp_enqueue_style( 'saasp-style-css' );

	}

	public function saasp_frontend_scripts(){ 
		wp_register_script( 'saasp-bootstrap-js', SAASP_PRICING_ASSETS_URL  . 'js/bootstrap.bundle.min.js' , [ 'jquery' ] , null , true );
		wp_register_script( 'saasp-popup-js', SAASP_PRICING_ASSETS_URL . 'js/popup.js' , [ 'jquery' ] , null , true );
		wp_register_script( 'saasp-vertical-js', SAASP_PRICING_ASSETS_URL . 'js/saaspricing-vertical.js' , [ 'jquery' ] , self::VERSION , true );
		wp_register_script( 'saasp-horizontal-js', SAASP_PRICING_ASSETS_URL . 'js/saaspricing-horizontal.js' , [ 'jquery' ] , self::VERSION , true );
		wp_register_script( 'saasp-comparison-js', SAASP_PRICING_ASSETS_URL . 'js/saaspricing-comparison.js' , [ 'jquery' ] , self::VERSION , true );
		wp_register_script( 'saasp-main-js', SAASP_PRICING_ASSETS_URL . 'js/main.js' , [ 'jquery' ] , self::VERSION , true );
		
		wp_enqueue_script('saasp-bootstrap-js');
		wp_enqueue_script('saasp-popup-js');
		wp_enqueue_script('saasp-vertical-js');
		wp_enqueue_script('saasp-horizontal-js');
		if( !in_array( 'saaspricing-pro/saaspricing-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			wp_enqueue_script('saasp-comparison-js');
		}
		wp_enqueue_script('saasp-main-js');

	}

	public function saasp_editor_styles(){

		wp_register_style( 'saasp-editor-css', SAASP_PRICING_ASSETS_URL . 'css/editor.css' );
		wp_enqueue_style( 'saasp-editor-css' );

	}
	
	function saasp_register_widgets( $widgets_manager ) {
		require_once(  __DIR__ . '/widgets/saaspricing-vertical-table.php' );
		require_once(  __DIR__ . '/widgets/saaspricing-horizontal-table.php' );
		require_once(  __DIR__ . '/widgets/saaspricing-comparison-table.php' );
		require_once(  __DIR__ . '/widgets/saaspricing-pricelist.php' );
		$widgets_manager->register( new \Saaspricing_Pricelist() );
		$widgets_manager->register( new \Saasp_Horizontal() );
		$widgets_manager->register( new \Saasp_Vertical() );
		$widgets_manager->register( new \Saasp_Comparison() );

	}

	function saasp_add_categories( $elements_manager ) {

		$elements_manager->add_category(
			'saas_pricing_category',
			[
				'title' => esc_html__( 'SaasPricing', 'saaspricing' ),
				'icon' => 'fa fa-plug',
			]
		);
	
	}

	function saasp_action_link($actions) {
		
		$actions[] = '<a href="https://www.templatemonster.com/wordpress-plugins/saaspricing-pro-all-in-one-pricing-table-plugin-for-wordpress-366508.html" class="elementor-plugins-gopro" target="_blank">Get Pro</a>';
		return $actions;
	}

}