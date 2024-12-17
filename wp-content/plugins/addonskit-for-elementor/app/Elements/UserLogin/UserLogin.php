<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Elements\UserLogin;

use AddonskitForElementor\Elements\UserRegistration\Styles as RegStyle;
use AddonskitForElementor\Elements\Common\TextControls;
use Directorist\Helper as DirectoristHelper;
use AddonskitForElementor\Elements\Common\Container;
use Elementor\Controls_Manager;
use AddonskitForElementor\Utils\Helper;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class UserLogin extends Widget_Base {

    use Styles;
    use RegStyle;
    use Container;
    use TextControls;

    public function get_name() {
        return 'directorist_user_login';
    }

    public function get_title() {
        return __( 'User Login', 'addonskit-for-elementor' );
    }

    public function get_icon() {
        return 'directorist-el-custom';
    }

    public function get_categories() {
        return ['directorist-widgets'];
    }

    public function get_keywords() {
        return [
            'user-login', 'login', 'sign-in',
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
            'sec_heading',
            [
                'label'     => __( 'This widget works only in Login page. It has no additional elementor settings.', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_styles(): void {

        $this->register_container_style_controls(
            __( 'Form Container', 'addonskit-for-elementor' ),
            'directorist_login',
            '.directorist-author__form',
        );

        $this->register_text_controls( __( 'Label', 'addonskit-for-elementor' ), 'login_form_label', '.directorist-form-group label' );

        $this->register_text_controls( __( 'Placeholder', 'addonskit-for-elementor' ), 'login_form_placeholder', '.directorist-form-group input::placeholder' );

        $this->register_form_fields_separator_controls( __( 'Fields Separator', 'addonskit-for-elementor' ), 'login_form_fields_separator', '.directorist-form-element' );

        $this->register_text_controls( __( 'Remember Me', 'addonskit-for-elementor' ), 'login_form_remember', '.directorist-checkbox__label' );

        $this->register_text_controls( __( 'Recover Password', 'addonskit-for-elementor' ), 'login_form_password_recovery', '.atbdp_recovery_pass' );

        $this->register_button_2_style_controls( __( 'Login Button', 'addonskit-for-elementor' ), 'login_button', 'button.directorist-author__form__btn' );

        $this->register_text_controls( __( "Don't have an account", 'addonskit-for-elementor' ), 'login_form_account', '.directorist-author__form__toggle-area' );

        $this->register_text_controls( __( "Sign Up", 'addonskit-for-elementor' ), 'login_form_signup', '.directorist-author__form__toggle-area a' );
    }

    protected function render(): void {
        if ( is_user_logged_in() && Helper::is_edit() ) {
            DirectoristHelper::get_template( 'account/login-registration-form', ['new_user_registration' => true] );
        } else {
            Helper::run_shortcode( 'directorist_user_login' );
        }
    }
}
