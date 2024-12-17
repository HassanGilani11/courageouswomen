<?php
/**
 * Author: WpWax
 * Since: 1.0.0
 * Version: 1.0.0
 */

namespace AddonskitForElementor\Elements\SingleListingFields\Images;

use AddonskitForElementor\Utils\Helper;
use Directorist\Directorist_Single_Listing;
use Directorist\Helper as CoreHelper;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Images extends Widget_Base {
    public function get_name() {
        return 'directorist_single_listing_images';
    }

    public function get_title() {
        return __( 'Listing - Images', 'addonskit-for-elementor' );
    }

    public function get_icon() {
        return 'directorist-el-custom';
    }

    public function get_categories() {
        return ['theme-elements-single'];
    }

    public function get_keywords() {
        return ['images', 'social', 'info', 'facebook', 'twitter'];
    }

    public function show_in_panel() {
        return is_singular( ATBDP_POST_TYPE ) || is_singular( 'elementor_library' );
    }

    public function get_script_depends() {
        return ['directorist-listing-slider', 'directorist-swiper'];
    }

    protected function register_controls(): void {
        $this->register_contents();
    }

    protected function register_contents(): void {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Images', 'addonskit-for-elementor' ),
            ]
        );

        $this->add_control(
            'important_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw'  => __(
                    '<div id="elementor-panel-elements-notice-area">
								<div id="elementor-panel-notice-wrapper">
									<div class="elementor-panel-notice elementor-panel-alert elementor-panel-info-info">
										<strong>This widget will show the listing Images on a slider.</strong>
									</div>
								</div>
							</div>',
                    'addonskit-for-elementor'
                ),
            ]
        );

        $this->end_controls_section();
    }

    public function render(): void {

        if ( Helper::is_edit() ) {
            $this->get_script_depends();
        }

        $single_listing = Directorist_Single_Listing::instance( get_the_ID() );
        $args           = [
            'listing' => $single_listing,
            'data'    => $single_listing->get_slider_data(),
        ];

        CoreHelper::get_template( 'single/fields/image_upload', $args );
    }
}
