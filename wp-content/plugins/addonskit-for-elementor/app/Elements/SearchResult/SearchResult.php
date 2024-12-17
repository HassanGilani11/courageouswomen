<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Elements\SearchResult;

use AddonskitForElementor\Elements\UserDashboard\Styles as DashboardStyles;
use AddonskitForElementor\Elements\SearchListing\Styles as SearchStyles;
use AddonskitForElementor\Elements\Common\DirectoryTypeStyles;
use AddonskitForElementor\Elements\Common\TextControls;
use AddonskitForElementor\Elements\AllListings\Styles;
use AddonskitForElementor\Elements\Common\Container;
use AddonskitForElementor\Utils\DirectoristHelper;
use AddonskitForElementor\Utils\Helper;
use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SearchResult extends Widget_Base {

    use DirectoryTypeStyles;
    use DashboardStyles;
    use TextControls;
    use SearchStyles;
    use Container;
    use Styles;

    public function get_name() {
        return 'directorist_search_result';
    }

    public function get_title() {
        return __( 'Search Result', 'addonskit-for-elementor' );
    }

    public function get_icon() {
        return 'directorist-el-custom';
    }

    public function get_categories() {
        return ['directorist-widgets'];
    }

    public function get_keywords() {
        return [
            'search', 'search-result', 'result', 'search-listings',
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
			'header',
			[
				'label'     => __( 'Header?', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'addonskit-for-elementor' ),
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'filter',
			[
				'label'     => __( 'Filter Button?', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'addonskit-for-elementor' ),
				'default'   => 'no',
				'condition' => ['header' => 'yes'],
			]
		);

		$this->add_control(
			'header_title',
			[
				'label'     => __( 'Listings Found Title', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Listings Found', 'addonskit-for-elementor' ),
				'condition' => ['header' => 'yes'],
			]
		);

		$this->add_control(
			'view',
			[
				'label'     => __( 'View As', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'grid' => __( 'Grid', 'addonskit-for-elementor' ),
					'list' => __( 'List', 'addonskit-for-elementor' ),
					'map'  => __( 'Map', 'addonskit-for-elementor' ),
				],
				'default'   => 'grid',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'map_height',
			[
				'label'     => __( 'Map Height', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 300,
				'max'       => 1980,
				'default'   => 500,
				'condition' => ['view' => ['map']],
			]
		);

		$this->add_control(
			'columns',
			[
				'label'     => __( 'Listings Per Row', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'label_on'  => esc_html__( 'Show', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'addonskit-for-elementor' ),
				'options'   => [
					'6' => __( '6 Items / Row', 'addonskit-for-elementor' ),
					'4' => __( '4 Items / Row', 'addonskit-for-elementor' ),
					'3' => __( '3 Items / Row', 'addonskit-for-elementor' ),
					'2' => __( '2 Items / Row', 'addonskit-for-elementor' ),
				],
				'default'   => '3',
				'condition' => ['view' => 'grid'],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'listing_number',
			[
				'label'     => __( 'Number of Listings to Show', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'default'   => 6,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'preview',
			[
				'label'     => __( 'Preview Image?', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'addonskit-for-elementor' ),
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'type_align',
			[
				'label'     => esc_html__( 'Alignment', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .directorist-type-nav .directorist-type-nav__list' => 'justify-content: {{VALUE}};',
				],
                'condition' => DirectoristHelper::directorist_multi_directory() ? '' : ['nocondition' => true],
			]
		);
		
		$this->add_responsive_control(
			'type_display',
			[
				'label'     => esc_html__( 'Display', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'top' => [
						'title' => esc_html__( 'Default', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-arrow-up',
					],
					'column-reverse' => [
						'title' => esc_html__( 'Column Reverse', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-arrow-down',
					],
					'row'  => [
						'title' => esc_html__( 'Row', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-arrow-left',
					],
					'row-reverse' => [
						'title' => esc_html__( 'Row Reverse', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-arrow-right',
					],
				],
				'default'   => 'top',
				'selectors' => [
					'{{WRAPPER}} .directorist-type-nav .directorist-type-nav__link' => 'flex-direction: {{VALUE}};',
					'{{WRAPPER}} .directorist-type-nav .directorist-type-nav__list .directorist-icon-mask' => 'margin-bottom: 0px;',
				],
                'condition' => DirectoristHelper::directorist_multi_directory() ? '' : ['nocondition' => true],
			]
		);

		$this->add_control(
			'featured_only',
			[
				'label'     => __( 'Featured Only?', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'No', 'addonskit-for-elementor' ),
				'default'   => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'popular_only',
			[
				'label'     => __( 'Popular Only?', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'No', 'addonskit-for-elementor' ),
				'default'   => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'user',
			[
				'label'     => __( 'Only For Logged In User?', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'No', 'addonskit-for-elementor' ),
				'default'   => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'order_by',
			[
				'label'     => __( 'Order by', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'title' => __( 'Title', 'addonskit-for-elementor' ),
					'date'  => __( 'Date', 'addonskit-for-elementor' ),
					'price' => __( 'Price', 'addonskit-for-elementor' ),
				],
				'default'   => 'date',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'order_list',
			[
				'label'     => __( 'Listings Order', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'asc'  => __( ' ASC', 'addonskit-for-elementor' ),
					'desc' => __( ' DESC', 'addonskit-for-elementor' ),
				],
				'default'   => 'desc',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label'     => __( 'Pagination?', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'addonskit-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'addonskit-for-elementor' ),
				'default'   => 'no',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'pagination_align',
			[
				'label'     => esc_html__( 'Alignment', 'addonskit-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'addonskit-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .directorist-pagination' => 'justify-content: {{VALUE}};',
				],
				'condition' => ['show_pagination' => 'yes'],
			]
		);

		$this->end_controls_section();
	}

    protected function register_styles(): void {
        //Directory type
		$this->register_container_style_controls( __( 'Directory Type: Container', 'addonskit-for-elementor' ), 'all_listing_directory_type_container', '.directorist-type-nav__list', DirectoristHelper::directorist_multi_directory() ? '' : ['nocondition' => true] );

		$this->register_directory_type_style_controls( '.directorist-type-nav__list .directorist-type-nav__link', [], '.directorist-type-nav__list__current .directorist-type-nav__link' );

		//Top search
		$this->register_form_container_style_controls( __( 'Top Search: Container', 'addonskit-for-elementor' ), 'top-search-form-container', '.directorist-basic-search .directorist-search-form__box' );

		$this->register_all_listings_form_fields_controls(  __( 'Top Search: Fields', 'addonskit-for-elementor' ), 'top-search-form-fields', '.directorist-basic-search .directorist-search-field__label' );

		$this->register_button_2_style_controls(  __( 'Top Search: Button', 'addonskit-for-elementor' ), 'top-search-button', '.directorist-btn-search' );

		// Header
		$this->register_filters_button( ['header' => 'yes', 'filter' => 'yes'] );

		$this->register_text_controls( __( 'Listing Header: Items Found', 'addonskit-for-elementor' ), 'listings_found', '.directorist-listings-header__left .directorist-header-found-title', [ 'header' => 'yes' ] );

		$this->register_view_as_sort_by();

		//Sidebar
		$this->register_form_container_style_controls( __( 'Sidebar: Container', 'addonskit-for-elementor' ), 'sidebar-container', '.listing-with-sidebar__sidebar .directorist-search-form__box' );

		$this->register_all_listings_form_fields_controls(  __( 'Sidebar: Title', 'addonskit-for-elementor' ), 'sidebar-form-title', '.directorist-advanced-filter__title' );

		$this->register_all_listings_form_fields_controls(  __( 'Sidebar: Fields', 'addonskit-for-elementor' ), 'sidebar-form-fields', '.listing-with-sidebar__sidebar .directorist-search-field__label' );

		$this->register_button_2_style_controls(  __( 'Sidebar: Apply Button', 'addonskit-for-elementor' ), 'sidebar-apply-button', '.directorist-btn-submit' );

		$this->register_button_2_style_controls(  __( 'Sidebar: Reset Button', 'addonskit-for-elementor' ), 'sidebar-reset-button', '.directorist-btn-reset-js' );

		//Listing Car
		$this->register_listing_card_info();
		$this->register_listing_footer();

		//Pagination
		$this->register_container_style_controls( __( 'Pagination Container', 'addonskit-for-elementor' ), 'all_listing_pagination_container', '.directorist-pagination', ['show_pagination' => 'yes'] );

		$this->register_all_listing_pagination( ['show_pagination' => 'yes'] );
    }

    protected function render(): void {
        $settings = $this->get_settings();

        $atts = [
            'header'                => $settings['header'] ?? 'no',
            'header_title'          => $settings['header_title'],
            'view'                  => $settings['view'],
            'map_height'            => $settings['map_height'],
            'columns'               => $settings['columns'],
            'listings_per_page'     => $settings['listing_number'],
            'show_pagination'       => $settings['show_pagination'] ?? 'no',
            'orderby'               => $settings['order_by'],
            'order'                 => $settings['order_list'],
            'featured_only'         => $settings['featured_only'] ?? 'no',
            'popular_only'          => $settings['popular_only'] ?? 'no',
            'logged_in_user_only'   => $settings['user'] ?? 'no',
            'display_preview_image' => $settings['preview'] ?? 'no',
        ];

        /**
         * Filters the Elementor Search Result atts to modify or extend it
         *
         * @since 1.0.0
         *
         * @param array     $atts       Available atts in the widgets
         * @param array     $settings   All the settings of the widget
         */
        $atts = apply_filters( 'directorist_search_result_elementor_widget_atts', $atts, $settings );

        Helper::run_shortcode( 'directorist_search_result', $atts );
    }
}
