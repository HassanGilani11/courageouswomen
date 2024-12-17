<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Elements\UserDashboard;

use AddonskitForElementor\Elements\Common\TextControls;
use AddonskitForElementor\Elements\Common\Container;
use Elementor\Controls_Manager;
use AddonskitForElementor\Utils\Helper;
use Directorist\Helper as DirectoristHelper;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UserDashboard extends Widget_Base {

    use TextControls;
    use Container;
    use Styles;

    public function get_name() {
        return 'directorist_user_dashboard';
    }

    public function get_title() {
        return __( 'Dashboard', 'addonskit-for-elementor' );
    }

    public function get_icon() {
        return 'directorist-el-custom';
    }

    public function get_categories() {
        return [ 'directorist-widgets' ];
    }

    public function get_keywords() {
        return [
            'dashboard', 'user-dashboard', 'my-listings',
        ];
    }

    protected function register_controls(): void {
        $this->register_contents();
        $this->register_styles();
    }

    protected function register_contents(): void {
        $this->start_controls_section(
            'sec_general',
            [
                'label' => __( 'General', 'addonskit-for-elementor' ),
            ]
        );

        $this->add_control(
			'content_type',
			[
				'label'     => __( 'Select Content Type', 'addonskit-for-elementor' ),
				'description'     => __( 'This option is only for elementor edit mode. ', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'multiple'  => false,
				'options'   => [
                    'dashboard' => 'Dashboard View',
                    'login'     => 'Login & Registration View',
                ],
				'default' => 'dashboard',
			]
		);

        $this->end_controls_section();
    }

    protected function register_styles(): void {
        $this->register_container_style_controls( __( 'Sidebar: Container', 'addonskit-for-elementor' ), 'dashboard_sidebar_container', '.directorist-user-dashboard__nav', ['content_type' => 'dashboard'] );

        $this->register_dashboard_sidebar( ['content_type' => 'dashboard'] );

        $this->register_container_style_controls( __( 'My Listings Top: Container', 'addonskit-for-elementor' ), 'my_listing_top_container', '.directorist-user-dashboard-tab__nav', ['content_type' => 'dashboard'] );

        $this->register_my_listing_top_menu_items( ['content_type' => 'dashboard'] );

        $this->register_my_listing_top_search( ['content_type' => 'dashboard'] );

        $this->register_my_listing_content_area( ['content_type' => 'dashboard'] );

        $this->register_text_controls( __( 'My Listing Content: Label', 'addonskit-for-elementor' ), 'my_listing_label', '.directorist-table thead tr th', ['content_type' => 'dashboard'] );

        $this->register_text_controls( __( 'My Listing Content: Listing Title', 'addonskit-for-elementor' ), 'my_listing_title', '.directorist-dashboard-listings-tbody .directorist-title a', ['content_type' => 'dashboard'] );

        $this->register_my_listing_content_info( ['content_type' => 'dashboard'] );
        
        $this->register_dashboard_pagination( ['content_type' => 'dashboard'] );

        // Login & Registration

        $this->register_container_style_controls( __( 'Form Container', 'addonskit-for-elementor' ), 'directorist_login', '.directorist-authentication__form', [ 'content_type' => 'login' ] );

        $this->register_text_controls( __( 'Label', 'addonskit-for-elementor' ), 'login_form_label', '.directorist-form-group label', [ 'content_type' => 'login' ] );

        $this->register_form_fields_separator_controls( __( 'Fields Separator', 'addonskit-for-elementor' ), 'login_form_fields_separator', '.directorist-form-element', [ 'content_type' => 'login' ] );

        $this->register_text_controls( __( 'Remember Me', 'addonskit-for-elementor' ), 'login_form_remember', '.directorist-checkbox__label', [ 'content_type' => 'login' ] );

        $this->register_text_controls( __( 'Recover Password', 'addonskit-for-elementor' ), 'login_form_password_recovery', '.atbdp_recovery_pass', [ 'content_type' => 'login' ] );

        $this->register_button_2_style_controls( __( 'Login Button', 'addonskit-for-elementor' ), 'login_button', 'button.directorist-authentication__form__btn', [ 'content_type' => 'login' ] );

        $this->register_text_controls( __( "Don't have an account", 'addonskit-for-elementor' ), 'login_form_account', '.directorist-authentication__form__toggle-area', [ 'content_type' => 'login' ] );

        $this->register_text_controls( __( "Sign Up", 'addonskit-for-elementor' ), 'login_form_signup', '.directorist-authentication__btn', [ 'content_type' => 'login' ] );
    }

    protected function render(): void {
        $settings = $this->get_settings();
        $form     = $settings['content_type'] === 'login' ? true : false;

        if ( $form && Helper::is_edit() ) {
            DirectoristHelper::get_template( 'account/login-registration-form', ['new_user_registration' => true] );
        } else {
            Helper::run_shortcode( 'directorist_user_dashboard' );
        }
    }
}