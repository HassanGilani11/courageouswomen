<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Elements\AddListing;

use AddonskitForElementor\Elements\Common\Container;
use AddonskitForElementor\Elements\Common\TextControls;
use AddonskitForElementor\Utils\DirectoristHelper;
use AddonskitForElementor\Utils\DirectoristTaxonomies;
use AddonskitForElementor\Utils\Helper;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AddListing extends Widget_Base {

	use Styles;
	use Container;
	use TextControls;

	public function get_name() {
		return 'directorist_add_listing';
	}

	public function get_title() {
		return __( 'Add Listing Form', 'addonskit-for-elementor' );
	}

	public function get_icon() {
		return 'directorist-el-custom';
	}

	public function get_categories() {
		return ['directorist-widgets'];
	}

	public function get_keywords() {
		return [
			'add listing form', 'add-listing-form', 'form', 'add listing', 'submit listing',
		];
	}

	public function get_script_depends() {
		return ['directorist-select2-script', 'directorist-add-listing'];
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
			'type',
			[
				'label'       => __( 'Directory Types', 'addonskit-for-elementor' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => DirectoristTaxonomies::directory_types(),
				'condition'   => DirectoristHelper::directorist_multi_directory() ? '' : ['nocondition' => true],
				'description' => __( 'Leave it empty for showing all directory types', 'addonskit-for-elementor' ),
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();
	}

	protected function register_styles(): void {

		$this->register_container_style_controls( __( 'Directory Type: Container', 'addonskit-for-elementor' ), 'add_listing_directory_type_container', '.directorist-w-100', DirectoristHelper::directorist_multi_directory() ? '' : ['nocondition' => true], );
		$this->register_add_listing_directory_controls();
		$this->register_enable_multi_dir();
		$this->register_add_listing_form_container_controls();
		$this->register_add_listing_steps_controls();
		$this->register_section_name_controls( __( 'Form: Section Name', 'addonskit-for-elementor' ), 'form_title', '.directorist-content-module__title h2' );
		$this->register_add_listing_form_fields( __( 'Form: Fields', 'addonskit-for-elementor' ), 'form_fields', '.directorist-form-label' );
		//$this->register_add_listing_form_progressbar_controls();
		$this->register_add_listing_form_buttons_controls();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$type     = empty( $settings['type'] ) ? [] : $settings['type'];
		$atts     = [];
		$term     = get_term_by( 'id', directorist_default_directory(), ATBDP_TYPE );

		if ( DirectoristHelper::directorist_multi_directory() ) {

			if ( is_user_logged_in() && Helper::is_edit() ) {

				$this->get_script_depends();

				if ( 'yes' === $settings['disable_multi_directory'] ) {
					$atts['directory_type'] = $term->slug;
				} else {
					$atts['directory_type'] = implode( ',', $type );
				}

			} else {
				if ( is_array( $type ) ) {
					$atts['directory_type'] = implode( ',', $type );
				}
			}
		}

		/**
		 * Filters the Elementor Add Listing atts to modify or extend it
		 *
		 * @since 1.0.0
		 *
		 * @param array     $atts       Available atts in the widgets
		 * @param array     $settings   All the settings of the widget
		 */
		$atts = apply_filters( 'directorist_add_listing_elementor_widget_atts', $atts, $settings );

		Helper::run_shortcode( 'directorist_add_listing', $atts );
	}
}