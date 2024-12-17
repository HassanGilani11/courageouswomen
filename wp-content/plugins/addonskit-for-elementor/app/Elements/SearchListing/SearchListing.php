<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Elements\SearchListing;

use AddonskitForElementor\Elements\Common\DirectoryTypeStyles;
use AddonskitForElementor\Elements\Common\TextControls;
use AddonskitForElementor\Utils\DirectoristTaxonomies;
use AddonskitForElementor\Utils\DirectoristHelper;
use Elementor\Controls_Manager;
use AddonskitForElementor\Utils\Helper;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SearchListing extends Widget_Base {

    use Styles;
    use TextControls;
    use DirectoryTypeStyles;

    public function get_name() {
        return 'directorist_search_listing';
    }

    public function get_title() {
        return __( 'Directorist Search Form', 'addonskit-for-elementor' );
    }

    public function get_icon() {
        return 'directorist-el-custom';
    }

    public function get_categories() {
        return [ 'directorist-widgets' ];
    }
    
    public function get_keywords() {
        return [
            'search', 'search-form', 'form', 'directorist-search',
        ];
    }

    protected function register_controls(): void {
        $this->register_contents();
        $this->register_styles();
    }

    protected function register_contents() {

        $this->start_controls_section(
            'sec_general',
            [
                'label' => __( 'General', 'addonskit-for-elementor' ),
            ]
        );

        $this->add_control(
            'show_subtitle',
            [
                'label'     => __( 'Title & Subtitle?', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'addonskit-for-elementor' ),
                'label_off' => __( 'Hide', 'addonskit-for-elementor' ),
                'default'   => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'     => __( 'Title', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => __( 'Search here', 'addonskit-for-elementor' ),
                'condition' => [ 'show_subtitle' => [ 'yes' ] ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'     => __( 'Subtitle', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => __( 'Find the best match of your interest', 'addonskit-for-elementor' ),
                'condition' => [ 'show_subtitle' => [ 'yes' ] ],
            ]
        );

        $this->add_control(
            'title_subtitle_alignment',
            [
                'label'     => __( 'Content Alignment', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'addonskit-for-elementor' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'addonskit-for-elementor' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'addonskit-for-elementor' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .directorist-search-top__title'        => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .directorist-search-top__subtitle'     => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} ul.directorist-listing-type-selection' => 'justify-content: {{VALUE}}',
                    '{{WRAPPER}} .directorist-listing-category-top ul'  => 'justify-content: {{VALUE}}',
                ],
                'condition' => [ 'show_subtitle' => [ 'yes' ] ],
            ]
        );

        $this->add_control(
            'type',
            [
                'label'     => __( 'Directory Types', 'addonskit-for-elementor' ),
                'description'     => __( 'Leave it empty for showing all directory types', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => DirectoristTaxonomies::directory_types(),
                'condition' => DirectoristHelper::directorist_multi_directory() ? '' : [ 'nocondition' => true ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'default_type',
            [
                'label'     => __( 'Active Directory', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'multiple'  => true,
                'options'   => DirectoristTaxonomies::directory_types(),
                'condition' => DirectoristHelper::directorist_multi_directory() ? '' : [ 'nocondition' => true ],
            ]
        );

        $this->add_control(
            'search_btn_text',
            [
                'label'     => __( 'Search Button Label', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Search Listing', 'addonskit-for-elementor' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_more_filter_btn',
            [
                'label'     => __( 'More Search Fields?', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'addonskit-for-elementor' ),
                'label_off' => __( 'Hide', 'addonskit-for-elementor' ),
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'more_filter_btn_text',
            [
                'label'     => __( 'Button Label', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'More Filters', 'addonskit-for-elementor' ),
                'condition' => [ 'show_more_filter_btn' => [ 'yes' ] ],
            ]
        );

        $this->add_control(
            'more_filter_reset_btn',
            [
                'label'     => __( 'Reset Filters?', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'addonskit-for-elementor' ),
                'label_off' => __( 'Hide', 'addonskit-for-elementor' ),
                'default'   => 'yes',
                'condition' => [ 'show_more_filter_btn' => [ 'yes' ] ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'more_filter_reset_btn_text',
            [
                'label'     => __( 'Button Label', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Reset Filters', 'addonskit-for-elementor' ),
                'condition' => [
                    'more_filter_reset_btn' => 'yes',
                    'show_more_filter_btn'  => 'yes',
                ],
            ]
        );

        $this->add_control(
            'more_filter_search_btn',
            [
                'label'     => __( 'Apply Filters?', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Show', 'addonskit-for-elementor' ),
                'label_off' => __( 'Hide', 'addonskit-for-elementor' ),
                'default'   => 'yes',
                'condition' => [ 'show_more_filter_btn' => [ 'yes' ] ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'more_filter_search_btn_text',
            [
                'label'     => __( 'Button Label', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Apply Filters', 'addonskit-for-elementor' ),
                'condition' => [
                    'more_filter_search_btn' => 'yes',
                    'show_more_filter_btn'   => 'yes',
                ],
            ]
        );

        $this->add_control(
            'more_filter',
            [
                'label'     => __( 'Open Filter Fields', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'overlapping' => __( 'Overlapping', 'addonskit-for-elementor' ),
                    'sliding'     => __( 'Sliding', 'addonskit-for-elementor' ),
                    'always_open' => __( 'Always Open', 'addonskit-for-elementor' ),
                ],
                'default'   => 'overlapping',
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'show_popular_category',
            [
                'label'     => __( 'Show Popular Categories', 'addonskit-for-elementor' ),
                'description'     => __( 'Number of popular categories to show: ', 'addonskit-for-elementor' ) . "<a target='_blank' href=" . admin_url('edit.php?post_type=at_biz_dir&page=atbdp-settings#search_settings__search_form') . ">click here</a>",
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Yes', 'addonskit-for-elementor' ),
                'label_off' => __( 'No', 'addonskit-for-elementor' ),
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'user',
            [
                'label'     => __( 'Show only for logged in user?', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __( 'Yes', 'addonskit-for-elementor' ),
                'label_off' => __( 'No', 'addonskit-for-elementor' ),
                'default'   => 'no',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function register_styles(): void {
        $this->register_text_controls( __( 'Title', 'addonskit-for-elementor' ), 'title', '.directorist-search-top__title' );
        $this->register_text_controls( __( 'Subtitle', 'addonskit-for-elementor' ), 'subtitle', '.directorist-search-top__subtitle' );
        $this->register_directory_type_style_controls( '.directorist-listing-type-selection__item a', [], '.directorist-listing-type-selection__item a.directorist-listing-type-selection__link--current' );
        $this->register_form_container_style_controls( __( 'Form Container', 'addonskit-for-elementor' ), 'search-form-container', '.directorist-search-form__box' );
        $this->register_form_fields_controls();
        $this->register_form_button_style_controls();

        $this->register_cat_icon_controls( __( 'Popular Category', 'addonskit-for-elementor' ), 'popular_category', '.directorist-listing-category-top li a' );
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $type     = empty( $settings['type'] ) ? [] : $settings['type'];
        $atts = [
            'show_title_subtitle'  => $settings['show_subtitle'],
            'search_bar_title'     => $settings['title'],
            'search_bar_sub_title' => $settings['subtitle'],
            'search_button_text'   => $settings['search_btn_text'],
            'more_filters_button'  => $settings['show_more_filter_btn'],
            'more_filters_text'    => $settings['more_filter_btn_text'],
            'reset_filters_button' => $settings['more_filter_reset_btn'],
            'apply_filters_button' => $settings['more_filter_search_btn'],
            'reset_filters_text'   => $settings['more_filter_reset_btn_text'],
            'apply_filters_text'   => $settings['more_filter_search_btn_text'],
            'more_filters_display' => $settings['more_filter'],
            'show_popular_category' => $settings['show_popular_category'],
            'logged_in_user_only'  => $settings['user'] ?? 'no',
        ];

        if ( DirectoristHelper::directorist_multi_directory() ) {
            if ( is_array( $type ) ) {
                $atts['directory_type'] = implode( ',', $type );
            }
            if ( $settings['default_type'] ) {
                $atts['default_directory_type'] = $settings['default_type'];
            }
        }

        /**
         * Filters the Elementor Search Listing atts to modify or extend it
         *
         * @since 1.0.0
         *
         * @param array     $atts       Available atts in the widgets
         * @param array     $settings   All the settings of the widget
         */
        $atts = apply_filters( 'directorist_search_listing_elementor_widget_atts', $atts, $settings );

        Helper::run_shortcode( 'directorist_search_listing', $atts );
    }
}
