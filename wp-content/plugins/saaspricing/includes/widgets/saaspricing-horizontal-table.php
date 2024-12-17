<?php
 // Elementor Classes

 use Elementor\Controls_Manager;
 use Elementor\Group_Control_Typography;
 use Elementor\Group_Control_Box_Shadow;
 use \Elementor\Group_Control_Border;
 use \Elementor\Icons_Manager;
 use \Elementor\Widget_Base;
 use \Elementor\Repeater;
 
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Saasp_Horizontal
 */

class Saasp_Horizontal extends Widget_Base {

public function get_name() {
    return 'saasp-horizontal';
}

public function get_title() {
    return esc_html__( 'Horizontal Pricing Table', 'saaspricing' );
}

public function get_icon() {
    return 'saasp-icon eicon-device-tablet';
}

public function get_categories() {
    return ['saas_pricing_category'];
}

public function get_keywords() {
    return [ 'pricing', 'tables' , 'saaspricing', 'horizontal'];
}

public function saasp_allowed_tags(){
    
    $saasp_allowed_html_tags = array(
		'a' => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'abbr' => array(
			'title' => array(),
		),
		'b' => array(),
		'blockquote' => array(
			'cite'  => array(),
		),
		'cite' => array(
			'title' => array(),
		),
		'code' => array(),
		'del' => array(
			'datetime' => array(),
			'title' => array(),
		),
		'dd' => array(),
		'div' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'i' => array(),
		'img' => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li' => array(
			'class' => array(),
		),
		'ol' => array(
			'class' => array(),
		),
		'p' => array(
			'class' => array(),
		),
		'q' => array(
			'cite' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'strike' => array(),
		'strong' => array(),
		'ul' => array(
			'class' => array(),
		),
	);
	
	return $saasp_allowed_html_tags;
}

protected function register_controls() {

    $this->start_controls_section(
        'saasp_horizontal_content_header',
        [
            'label' => esc_html__( 'Header', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_title',
        [
            'label' => esc_html__( 'Title', 'saaspricing' ),
            'type' =>  Controls_Manager::TEXT,
            'default' => esc_html__( 'Enter Your Title', 'saaspricing' ),
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_description',
        [
            'label' => esc_html__( 'Description', 'saaspricing' ),
            'type' =>  Controls_Manager::TEXT,
            'default' => esc_html__( 'Enter Your Description', 'saaspricing' ),
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_title_tag',
        [
            'label' => esc_html__( 'Title HTML Tag', 'saaspricing' ),
            'type' =>  Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => [
                'h2' => esc_html__( 'H2', 'saaspricing' ),
                'h3' => esc_html__( 'H3', 'saaspricing' ),
                'h4'  => esc_html__( 'H4', 'saaspricing' ),
                'h5' => esc_html__( 'H5', 'saaspricing' ),
                'h6' => esc_html__( 'H6', 'saaspricing' ),
                'span' => esc_html__( 'Span', 'saaspricing' ),
                'p' => esc_html__( 'P', 'saaspricing' ),
            ],
        ]
    );

    $this->add_control(
        'sassp_horizontal_ribbon_alignment',
        [
            'label' => esc_html__( 'Alignment', 'saaspricing' ),
            'type' =>  Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__( 'Left', 'saaspricing' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'saaspricing' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__( 'Right', 'saaspricing' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left', 
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-title' => 'text-align: {{VALUE}};',
                '{{WRAPPER}} .saaspricing-horizontal-description' => 'text-align: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_show_divider',
        [
            'label' => esc_html__( 'Divider', 'saaspricing' ),
            'type' =>  Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'saaspricing' ),
            'label_off' => esc_html__( 'Hide', 'saaspricing' ),
            'return_value' => 'yes',
            'default' => 'yes',
            'separator' => 'before'
        ]
    );
    
    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_features_tab',
        [
            'label' => esc_html__( 'Features', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'saasp_horizontal_features_title',
        [
            'label' => esc_html__( 'Feature Title', 'saaspricing' ),
            'type' =>  Controls_Manager::TEXT,
            'default' => esc_html__( 'Enter Feature Title', 'saaspricing' ),
        ]
    );

    $saasp_horizontal_features = new Repeater();

        $saasp_horizontal_features->add_control(
            'saasp_horizontal_features_icon',
            [
                'label' => esc_html__( 'Icon', 'saaspricing' ),
                'type' =>  Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-check',
                    'library' => 'fa-solid',
                ],
                'exclude_inline_options' => [ 'svg' ],
            ]
        );

		$saasp_horizontal_features->add_control(
			'saasp_horizontal_features_text',
			[
				'label' => esc_html__( 'Text', 'saaspricing' ),
				'type' =>  Controls_Manager::TEXT,
				'default' => esc_html__( 'Feature Text' , 'saaspricing' ),
				'label_block' => true,
			]
        );

        $saasp_horizontal_features->add_control(
            'saasp_horizontal_features_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'saaspricing' ),
                'type' =>  Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'saasp_horizontal_features',
			[
				'label' => esc_html__( 'Features', 'saaspricing' ),
				'type' =>  Controls_Manager::REPEATER,
				'fields' => $saasp_horizontal_features->get_controls(),
				'default' => [
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 1', 'saaspricing' ),
					],
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 2', 'saaspricing' ),
					],
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 3', 'saaspricing' ),
					],
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 4', 'saaspricing' ),
					],
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 5', 'saaspricing' ),
					],
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 6', 'saaspricing' ),
					],
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 7', 'saaspricing' ),
					],
					[
						'saasp_horizontal_features_text' => esc_html__( 'Feature 8', 'saaspricing' ),
					]
				],
				'title_field' => '{{{ saasp_horizontal_features_text }}}',
			]
		);

        $this->add_responsive_control(
			'saasp_horizontal_features_column',
			[
				'label' => esc_html__( 'Column', 'saaspricing' ),
				'type' =>  Controls_Manager::SELECT,
				'options' => [
					'100%' => esc_html__( '1', 'saaspricing' ),
					'50%'  => esc_html__( '2', 'saaspricing' ),
					'33.3%' => esc_html__( '3', 'saaspricing' ),
					'25%' => esc_html__( '4', 'saaspricing' ),
                ],
                'default' => '25%',
                'selectors' => [
					'{{WRAPPER}} .saasp-columns' => 'width: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'sassp_horizontal_features_alignment',
            [
                'label' => esc_html__( 'Alignment', 'saaspricing' ),
                'type' =>  Controls_Manager::CHOOSE,
                'separator' => 'before',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'saaspricing' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'saaspricing' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'saaspricing' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left', 
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .saaspricing-horizontal-feature-list' => 'text-align: {{VALUE}};',
                ],
            ]
        );

    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_cta',
        [
            'label' => esc_html__( 'Pricing', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'saasp_horizontal_cta_row_reverse',
        [
            'label' => esc_html__( 'Reverse Column', 'saaspricing' ),
            'type' =>  Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'saaspricing' ),
            'label_off' => esc_html__( 'Hide', 'saaspricing' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    );

    $this->add_control(
        'saasp_horizontal_cta_slogan_text',
        [
            'label' => esc_html__( 'Slogan Text', 'saaspricing' ),
            'type' =>  Controls_Manager::TEXT,
            'default' => esc_html__( 'Enter Slogan Title', 'saaspricing' ),
        ]
    );

    $this->add_control(
        'saasp_horizontal_body_pricing_heading',
            [
                'label' => esc_html__( 'Pricing', 'saaspricing' ),
                'type' =>  Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_currency_symbol',
            [
                'label' => esc_html__( 'Currency Symbol', 'saaspricing'  ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'None', 'saaspricing'  ),
                    'dollar' => '&#36; ' . esc_html__( 'Dollar', 'Currency', 'saaspricing'  ),
                    'euro' => '&#128; ' . esc_html__( 'Euro', 'Currency', 'saaspricing'  ),
                    'baht' => '&#3647; ' . esc_html__( 'Baht', 'Currency', 'saaspricing'  ),
                    'franc' => '&#8355; ' . esc_html__( 'Franc', 'Currency', 'saaspricing'  ),
                    'guilder' => '&fnof; ' . esc_html__( 'Guilder', 'Currency', 'saaspricing'  ),
                    'krona' => 'kr' . esc_html__( 'Krona', 'Currency', 'saaspricing'  ),
                    'lira' => '&#8356; ' . esc_html__( 'Lira', 'Currency', 'saaspricing'  ),
                    'peseta' => '&#8359;' . esc_html__( 'Peseta', 'Currency', 'saaspricing'  ),
                    'peso' => '&#8369; ' . esc_html__( 'Peso', 'Currency', 'saaspricing'  ),
                    'pound' => '&#163; ' . esc_html__( 'Pound Sterling', 'Currency', 'saaspricing'  ),
                    'real' => 'R$ ' . esc_html__( 'Real', 'Currency', 'saaspricing'  ),
                    'ruble' => '&#8381; ' . esc_html__( 'Ruble', 'Currency', 'saaspricing'  ),
                    'rupee' => '&#8360; ' . esc_html__( 'Rupee', 'Currency', 'saaspricing'  ),
                    'indian_rupee' => '&#8377; ' . esc_html__( 'Rupee (Indian)', 'Currency', 'saaspricing'  ),
                    'shekel' => '&#8362; ' . esc_html__( 'Shekel', 'Currency', 'saaspricing'  ),
                    'yen' => '&#165; ' . esc_html__( 'Yen/Yuan', 'Currency', 'saaspricing'  ),
                    'won' => '&#8361; ' . esc_html__( 'Won', 'Currency', 'saaspricing'  ),
                    'custom' => esc_html__( 'Custom', 'saaspricing'  ),
                ],
                'default' => 'dollar',
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_currency_symbol_custom',
            [
                'label' => esc_html__( 'Custom Symbol', 'saaspricing'  ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'saasp_horizontal_currency_symbol' => 'custom',
                ],
            ]
        );
    
        $this->add_control(
            'sassp_horizontal_price',
            [
                'label' => esc_html__( 'Price', 'saaspricing' ),
                'type' => Controls_Manager::TEXT,
                'default' => '39.99',
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_currency_format',
            [
                'label' => esc_html__( 'Currency Format', 'saaspricing' ),
                'type' => Controls_Manager::SELECT,
                'default' => ',',
                'options' => [
                    ',' => '1.234,56 (Default)',
                    '' => '1,234.56',
                ],
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_sale',
            [
                'label' => esc_html__( 'Sale', 'saaspricing' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'saaspricing' ),
                'label_off' => esc_html__( 'Off', 'saaspricing' ),
                'default' => 'no',
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_original_price',
            [
                'label' => esc_html__( 'Original Price', 'saaspricing' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '59',
                'condition' => [
                    'saasp_horizontal_sale' => 'yes',
                ],
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_period',
            [
                'label' => esc_html__( 'Period', 'saaspricing' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '/mo', 'saaspricing' ),
            ]
        );

        $this->add_control(
            'saasp_horizontal_show_ribbon',
            [
                'label' => esc_html__( 'Ribbon', 'saaspricing' ),
                'type' =>  Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'saaspricing' ),
                'label_off' => esc_html__( 'Hide', 'saaspricing' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_ribbon_title',
            [
                'label' => esc_html__( 'Title', 'saaspricing' ),
                'type' =>  Controls_Manager::TEXT,
                'default' => esc_html__( '20%', 'saaspricing' ),
                'condition' => [
                    'saasp_horizontal_show_ribbon' => 'yes',
                ],
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_ribbon_position',
            [
                'label' => esc_html__( 'Position', 'saaspricing' ),
                'type' =>  Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'saaspricing' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'saaspricing' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'right',
                'toggle' => true,
                'condition' => [
                    'saasp_horizontal_show_ribbon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'saasp_horizontal_show_countdown',
            [
                'label' => esc_html__( 'Countdown', 'saaspricing' ),
                'type' =>  Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'saaspricing' ),
                'label_off' => esc_html__( 'Hide', 'saaspricing' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_expire_date',
            [
                'label' => esc_html__( 'Expire Date', 'saaspricing' ),
                'type' =>  Controls_Manager::DATE_TIME,
                'label_block' => false,
                'default'=> gmdate( 'Y-m-d H:i', strtotime("+1 month") ),
                'condition' => [
                    'saasp_horizontal_show_countdown' => 'yes',
                ],
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_show_rating',
            [
                'label' => esc_html__( 'Show Rating', 'saaspricing' ),
                'type' =>  Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'saaspricing' ),
                'label_off' => esc_html__( 'Hide', 'saaspricing' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' =>'before',
            ]
        );
    
        $this->add_control(
            'saasp_horizontal_rating_num',
            [
                'label' => esc_html__( 'Rating', 'saaspricing' ),
                'type' =>  Controls_Manager::NUMBER,
                'min' => 0,
                'max' =>  5,
                'step' => .5,
                'default' => 5,
                'condition' => [
                    'saasp_horizontal_show_rating' => 'yes',
                ],
            ]
        );
        
        $this->add_control(
            'saasp_horizontal_rating_counter',
            [
                'label' => esc_html__( 'Rating Counter', 'saaspricing' ),
                'type' =>  Controls_Manager::TEXT,
                'default' => esc_html__( '3k', 'saaspricing' ),
                'condition' => [
                    'saasp_horizontal_show_rating' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'saasp_horizontal_cta_alignment',
            [
                'label' => esc_html__( 'Alignment', 'saaspricing' ),
                'type' =>  Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'saaspricing' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'saaspricing' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'saaspricing' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'saaspricing' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'separator' => 'before',
            ]
        );

    $this->end_controls_section();
    
    $this->start_controls_section(
        'saasp_horizontal_buttons',
        [
            'label' => esc_html__( 'Buttons', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_switch',
        [
            'label' => esc_html__( 'Primary', 'saaspricing' ),
            'type' =>  Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'saaspricing' ),
            'label_off' => esc_html__( 'Hide', 'saaspricing' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_text',
        [
            'label' => esc_html__( 'Text', 'saaspricing' ),
            'type' =>  Controls_Manager::TEXT,
            'default' => esc_html__( 'Get Started', 'saaspricing' ),
            'condition' =>[
                'saasp_horizontal_primary_cta_switch' => 'yes',
            ]
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_url',
        [
            'label' => esc_html__( 'Link', 'saaspricing' ),
            'type' =>  Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'saaspricing' ),
            'options' => [ 'url', 'is_external', 'nofollow', 'custom_attributes' ],
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
                'custom_attributes' => '',
            ],
            'label_block' => true,
            'condition' =>[
                'saasp_horizontal_primary_cta_switch' => 'yes',
            ],
            'dynamic' => [
                'active' => true
            ]
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_size',
        [
            'label' => esc_html__( 'Size', 'saaspricing' ),
            'type' =>  Controls_Manager::SELECT,
            'default' => 'small',
            'options' => [
                'extra-small' => esc_html__( 'Extra Small', 'saaspricing' ),
                'small'  => esc_html__( 'Small', 'saaspricing' ),
                'medium' => esc_html__( 'Medium', 'saaspricing' ),
                'large' => esc_html__( 'Large', 'saaspricing' ),
                'extra-large' => esc_html__( 'Extra Large', 'saaspricing' ),
            ],
            'condition' =>[
                'saasp_horizontal_primary_cta_switch' => 'yes',
            ]
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_icon',
        [
            'label' => esc_html__( 'Icon', 'saaspricing' ),
            'type' =>  Controls_Manager::ICONS,
            'skin' => 'inline',
            'default' => [
                'value' => 'fas fa-arrow-right',
                'library' => 'fa-solid',
            ],
            'exclude_inline_options' => [ 'svg' ],
            'condition' =>[
                'saasp_horizontal_primary_cta_switch' => 'yes',
            ]
        ]
    );
    
    $this->add_responsive_control(
        'saasp_horizontal_primary_cta_icon_spacing',
        [
            'label' => esc_html__( 'Icon Spacing', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 8,
            ],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-primary-spacing' => 'padding-left: {{SIZE}}{{UNIT}};',
            ],
            'condition' =>[
                'saasp_horizontal_primary_cta_switch' => 'yes',
            ]
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_switch',
        [
            'label' => esc_html__( 'Secondary', 'saaspricing' ),
            'type' =>  Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Show', 'saaspricing' ),
            'label_off' => esc_html__( 'Hide', 'saaspricing' ),
            'return_value' => 'yes',
            'default' => 'no',
            'separator'=>'before',
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_text',
        [
            'label' => esc_html__( 'Text', 'saaspricing' ),
            'type' =>  Controls_Manager::TEXT,
            'default' => esc_html__( 'Learn More', 'saaspricing' ),
            'condition' =>[
                'saasp_horizontal_secondary_cta_switch' => 'yes',
            ]
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_url',
        [
            'label' => esc_html__( 'Link', 'saaspricing' ),
            'type' =>  Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'saaspricing' ),
            'options' => [ 'url', 'is_external', 'nofollow', 'custom_attributes' ],
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
                'custom_attributes' => '',
            ],
            'label_block' => true,
            'dynamic' => [
                'active' => true
            ],
            'condition' =>[
                'saasp_horizontal_secondary_cta_switch' => 'yes',
            ]
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_size',
        [
            'label' => esc_html__( 'Size', 'saaspricing' ),
            'type' =>  Controls_Manager::SELECT,
            'default' => 'small',
            'options' => [
                'extra-small' => esc_html__( 'Extra Small', 'saaspricing' ),
                'small'  => esc_html__( 'Small', 'saaspricing' ),
                'medium' => esc_html__( 'Medium', 'saaspricing' ),
                'large' => esc_html__( 'Large', 'saaspricing' ),
                'extra-large' => esc_html__( 'Extra Large', 'saaspricing' ),
            ],
            'condition' =>[
                'saasp_horizontal_secondary_cta_switch' => 'yes',
            ]
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_icon',
        [
            'label' => esc_html__( 'Icon', 'saaspricing' ),
            'type' =>  Controls_Manager::ICONS,
            'skin' => 'inline',
            'exclude_inline_options' => [ 'svg' ],
            'condition' =>[
                'saasp_horizontal_secondary_cta_switch' => 'yes',
            ]
        ]
    );

    
    $this->add_responsive_control(
        'saasp_horizontal_secondary_cta_icon_spacing',
        [
            'label' => esc_html__( 'Icon Spacing', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => [ 'px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 5,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-secondary-spacing' => 'padding-left: {{SIZE}}{{UNIT}};',
            ],
            'condition' =>[
                'saasp_horizontal_secondary_cta_switch' => 'yes',
            ]
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_style_header',
        [
            'label' => esc_html__( 'Header', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_title_heading',
        [
            'label' => esc_html__( 'Title', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator'=>'before'
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_header_title_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-title',
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_title_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-title' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_title_distance',
        [
            'label' => esc_html__( 'Distance', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 10,
            ],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_description_heading',
        [
            'label' => esc_html__( 'Description', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator'=>'before'
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_header_description_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-description',
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_description_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-description' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_header_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'separator' => 'before',
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    
    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_style_divider',
        [
            'label' => esc_html__( 'Divider', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_divider_weight',
        [
            'label' => esc_html__( 'Weight', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 1,
            ],
            'selectors' => [
                '{{WRAPPER}} .saasp-horizontal-divider hr' => 'border-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_divider_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saasp-horizontal-divider hr' => 'border-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_divider_border_style',
        [
            'label' => esc_html__( 'Style', 'saaspricing' ),
            'type' =>  Controls_Manager::SELECT,
            'default' => 'solid',
            'options' => [
                'solid'  => esc_html__( 'Solid', 'saaspricing' ),
                'dashed' => esc_html__( 'Dashed', 'saaspricing' ),
                'dotted' => esc_html__( 'Dotted', 'saaspricing' ),
                'double' => esc_html__( 'Double', 'saaspricing' ),
                'groove' => esc_html__( 'Groove', 'saaspricing' ),
            ],
            'selectors' => [
                '{{WRAPPER}} .saasp-horizontal-divider hr' => 'border-style: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_divider_width',
        [
            'label' => esc_html__( 'Width', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['%'],
            'range' => [
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 90,
            ],
            'selectors' => [
                '{{WRAPPER}} .saasp-horizontal-divider hr' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_divider_alignment',
        [
            'label' => esc_html__( 'Alignment', 'saasprcing' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                '0 0 0 0' => [
                    'title' => esc_html__( 'Left', 'saasprcing' ),
                    'icon' => 'eicon-text-align-left',
                ],
                '0 auto 0 auto' => [
                    'title' => esc_html__( 'Center', 'saasprcing' ),
                    'icon' => 'eicon-text-align-center',
                ],
                '0 0 0 auto' => [
                    'title' => esc_html__( 'Right', 'saasprcing' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => '0 auto 0 auto',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .saasp-horizontal-divider hr' => 'margin: {{VALUE}};',
            ],
        ]
    );


    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_features_tab_style',
        [
            'label' => esc_html__( 'Features', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'saasp_horizontal_features_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .sasspricing-horizontal-left' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_features_global_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-feature-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_features_gap',
        [
            'label' => esc_html__( 'Gap', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 20,
            ],
            'selectors' => [
                '{{WRAPPER}} .row' => 'row-gap: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_features_title_heading',
        [
            'label' => esc_html__( 'Title', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator'=>'before'
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_features_title_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-feature-title',
        ]
    );

    $this->add_control(
        'saasp_horizontal_features_title_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-feature-title' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_features_title_gap',
        [
            'label' => esc_html__( 'Gap', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 20,
            ],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal .saaspricing-horizontal-feature-title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_features_text_heading',
        [
            'label' => esc_html__( 'Feature Text', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator'=>'before'
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_features_text_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-feature-text',
        ]
    );

    $this->add_control(
        'saasp_horizontal_features_text_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-feature-text' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_features_icon_heading',
        [
            'label' => esc_html__( 'Icon', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator'=>'before'
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_features_icon_size',
        [
            'label' => esc_html__( 'Size', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 14,
            ],
            'selectors' => [
                '{{WRAPPER}} .saasp-horizontal-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .saasp-horizontal-icon-wrapper svg' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_features_icon_spacing',
        [
            'label' => esc_html__( 'Spacing', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 50,
                    'step' => 1,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 5,
            ],
            'selectors' => [
                '{{WRAPPER}} .saasp-horizontal-icon-wrapper i' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .saasp-horizontal-icon-wrapper svg' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_cta_style_section',
        [
            'label' => esc_html__( 'CTA', 'saaspricing' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'saasp_horizontal_cta_background',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-sidebar' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_cta_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-sidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_slogan_title_heading',
        [
            'label' => esc_html__( 'Slogan', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_slogan_title_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-slogan-title',
        ]
    );

    $this->add_control(
        'saasp_horizontal_slogan_title_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-slogan-title' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_ribbon_style_section',
        [
            'label' => esc_html__( 'Ribbon', 'saaspricing' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_ribbon_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-ribbon',
        ]
    );

    $this->add_control(
        'saasp_horizontal_ribbon_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-ribbon' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_ribbon_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-ribbon' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_ribbon_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-ribbon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'saasp_horizontal_ribbon_border',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-ribbon',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_ribbon_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'saaspricing' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-ribbon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'saasp_horizontal_ribbon_box_shadow',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-ribbon',
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_pricing_style_tab',
        [
            'label' => esc_html__( 'Pricing', 'saaspricing' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
         [
             'name' => 'saasp_horizontal_pricing_text_typography',
             'selector' => '{{WRAPPER}} .saaspricing-horizontal-price-text',
         ]
     );
 
     $this->add_control(
         'saasp_horizontal_price_text_color',
         [
             'label' => esc_html__( 'Color', 'saaspricing' ),
             'type' => Controls_Manager::COLOR,
             'selectors' => [
                 '{{WRAPPER}} .saaspricing-horizontal-price-text' => 'color: {{VALUE}}',
                 '{{WRAPPER}} .saaspricing-fraction-price' => 'color: {{VALUE}}',
             ],
         ]
     );

    $this->add_control(
        'saasp_horizontal_pricing_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saasprcing-horizontal-pricing' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_pricing_padding',
        [
            'label' => esc_html__( 'Paddding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saasprcing-horizontal-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_pricing_margin',
        [
            'label' => esc_html__( 'Margin', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saasprcing-horizontal-pricing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'saasp_horizontal_pricing_border_control',
            'selector' => '{{WRAPPER}} .saasprcing-horizontal-pricing',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_pricing_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saasprcing-horizontal-pricing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
       [
           'name' => 'saasp_horizontal_pricing_section_box_shadow',
           'selector' => '{{WRAPPER}} .saasprcing-horizontal-pricing',
       ]
    );

    $this->add_control(
        'saasp_horizontal_pricing_currency_symbol',
        [
            'label' => esc_html__( 'Currency Symbol', 'saaspricing' ),
            'type' => Controls_Manager::HEADING,
            'separator'=>'before'
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_pricing_symbol_size',
        [
            'label' => esc_html__( 'Size', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 42,
            ],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-symbol' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_pricing_symbol_position',
        [
            'label' => esc_html__( 'Postion', 'saaspricing' ),
            'type' =>  Controls_Manager::CHOOSE,
            'options' => [
                'before' => [
                    'title' => esc_html__( 'Before', 'saaspricing' ),
                    'icon' => 'eicon-h-align-left',
                ],
                'after' => [
                    'title' => esc_html__( 'After', 'saaspricing' ),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'default' => 'before',
            'toggle' => true,
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_pricing_symbol_vertical_position',
        [
            'label' => esc_html__( 'Verticle Position', 'saaspricing' ),
            'type' =>  Controls_Manager::CHOOSE,
            'options' => [
                'self-start' => [
                    'title' => esc_html__( 'Top', 'saaspricing' ),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__( 'Middle', 'saaspricing' ),
                    'icon' => 'eicon-v-align-middle',
                ],
                'self-end' => [
                    'title' => esc_html__( 'Bottom', 'saaspricing' ),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'default' => 'top',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-symbol' => 'align-self: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_pricing_fractional_part',
        [
            'label' => esc_html__( 'Decimal Part', 'saaspricing' ),
            'type' => Controls_Manager::HEADING,
            'separator'=>'before'
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_header_fractional_part_size',
        [
            'label' => esc_html__( 'Size', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 16,
            ],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-fraction-price' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_fractional_part_vertical_position',
        [
            'label' => esc_html__( 'Verticle Position', 'saaspricing' ),
            'type' =>  Controls_Manager::CHOOSE,
            'options' => [
                'self-start' => [
                    'title' => esc_html__( 'Top', 'saaspricing' ),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__( 'Middle', 'saaspricing' ),
                    'icon' => 'eicon-v-align-middle',
                ],
                'self-end' => [
                    'title' => esc_html__( 'Bottom', 'saaspricing' ),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'default' => 'top',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-fraction-price' => 'align-self: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_original_price_style',
        [
            'label' => esc_html__( 'Original Price', 'saaspricing' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_original_price_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-original',
        ]
    );

    $this->add_control(
        'saasp_horizontal_original_price_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-original' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_original_price_vertical_position',
        [
            'label' => esc_html__( 'Vertical Position', 'saaspricing'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'self-start' => [
                    'title' => esc_html__( 'Top', 'saaspricing' ),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__( 'Middle', 'saaspricing' ),
                    'icon' => 'eicon-v-align-middle',
                ],
                'self-end' => [
                    'title' => esc_html__( 'Bottom', 'saaspricing' ),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'default' => 'bottom',
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-original' => 'align-self: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_pricing_period_style',
        [
            'label' => esc_html__( 'Period', 'saaspricing' ),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_header_period_typography',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-period',
        ]
    );

    $this->add_control(
        'saasp_horizontal_header_period_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-period' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_period_position',
        [
            'label' => esc_html__( 'Position', 'saaspricing' ),
            'type' => Controls_Manager::SELECT,
            'label_block' => false,
            'options' => [
                'below' => esc_html__( 'Below', 'saaspricing' ),
                'beside' => esc_html__( 'Beside', 'saaspricing' ),
            ],
            'default' => 'beside',
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_countdown_style_tab',
        [
            'label' => esc_html__( 'Countdown', 'saaspricing' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'saasp_horizontal_countdown_text_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-countdown' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_countdown_text_typography',
            'selector' => '{{WRAPPER}} .saaspricing-countdown',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_countdown_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_countdown_margin',
        [
            'label' => esc_html__( 'Margin', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-countdown' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_countdown_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-countdown' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'saasp_horizontal_countdown_border',
            'selector' => '{{WRAPPER}} .saaspricing-countdown',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_countdown_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'saasp_horizontal_countdown_box_shadow',
            'selector' => '{{WRAPPER}} .saaspricing-countdown',
        ]
    );

    $this->end_controls_section();


    $this->start_controls_section(
        'saasp_horizontal_review_section',
        [
            'label' => esc_html__( 'Review', 'saaspricing' ),
            'tab' =>Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'saasp_horizontal_review_satar_heading',
        [
            'label' => esc_html__( 'Stars', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_review_spacing',
        [
            'label' => esc_html__( 'Spacing', 'saaspricing' ),
            'type' =>  Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-ratings span:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    
    $this->add_control(
        'saasp_horizontal_review_star_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-icons i::after' => 'color: {{VALUE}}',
                '{{WRAPPER}} .saaspricing-icons-half i::after' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_review_unmark_star_color',
        [
            'label' => esc_html__( 'Unmark Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-icons-none i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .saaspricing-icons-half i' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_review_text_heading',
        [
            'label' => esc_html__( 'Text', 'saaspricing' ), 
            'type' =>  Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'saasp_horizontal_review_text_typography',
            'selector' => '{{WRAPPER}} .saaspricing-review-text',
        ]
    );

    $this->add_control(
        'saasp_horizontal_review_text_color',
        [
            'label' => esc_html__( 'Text Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-review-text' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_review_global_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'separator' => 'before',
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal .saaspricing-star-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
        'saasp_horizontal_cta_tab_style',
        [
            'label' => esc_html__( 'Buttons', 'saaspricing' ),
            'tab' =>  Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_section',
        [
            'label' => esc_html__( 'Primary Button', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
       [
           'name' => 'saasp_horizontal_primary_cta_typography',
           'selector' => '{{WRAPPER}} .saaspricing-horizontal-primary',
       ]
    );

    $this->start_controls_tabs(
        'saasp_horizontal_primary_cta_hover_normal_text_color'
    );

    $this->start_controls_tab(
        'saasp_horizontal_primary_cta_normal_text',
        [
            'label' => esc_html__( 'Normal', 'saaspricing' ),
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_normal_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_normal_text_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary' => 'color: {{VALUE}}',
                '{{WRAPPER}} .saaspricing-horizontal-primary span svg' => 'fill: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'saasp_horizontal_primary_cta_border',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-primary',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_primary_cta_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
         Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'saasp_horizontal_primary_cta_box_shadow',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-primary',
        ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
        'saasp_horizontal_primary_cta_hover_text',
        [
            'label' => esc_html__( 'Hover', 'saaspricing' ),
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_hover_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary:hover' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_primary_cta_hover_text_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .saaspricing-horizontal-primary:hover span svg' => 'fill: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'saasp_horizontal_primary_cta_border_hover',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-primary:hover',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_primary_cta_border_radius_hover',
        [
            'label' => esc_html__( 'Border Radius', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
         Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'saasp_horizontal_primary_cta_box_shadow_hover',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-primary:hover',
        ]
    );


    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->add_control(
        'saasp_horizontal_primary_separator',
        [
            'label' => esc_html__( '', 'saaspricing' ),
            'type' =>  Controls_Manager::RAW_HTML,
            'raw' => esc_html__( '', 'saaspricing' ),
            'separator'=> 'after',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_primary_cta_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_primary_cta_margin',
        [
            'label' => esc_html__( 'Margin', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_section',
        [
            'label' => esc_html__( 'Secondary Button', 'saaspricing' ),
            'type' =>  Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
       [
           'name' => 'saasp_horizontal_secondary_cta_typography',
           'selector' => '{{WRAPPER}} .saaspricing-horizontal-secondary',
       ],
    );

    $this->start_controls_tabs(
        'saasp_horizontal_secondary_cta_hover_normal_text_color'
    );

    $this->start_controls_tab(
        'saasp_horizontal_secondary_cta_normal_text',
        [
            'label' => esc_html__( 'Normal', 'saaspricing' ),
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_normal_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-secondary' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_normal_text_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-secondary' => 'color: {{VALUE}}',
                '{{WRAPPER}} .saaspricing-horizontal-secondary span svg' => 'fill: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'saasp_horizontal_secondary_cta_border',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-secondary',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_secondary_cta_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-secondary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
         Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'saasp_horizontal_secondary_cta_box_shadow',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-secondary',
        ]
    );

    $this->end_controls_tab();

    $this->start_controls_tab(
        'saasp_horizontal_secondary_cta_hover_text',
        [
            'label' => esc_html__( 'Hover', 'saaspricing' ),
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_hover_background_color',
        [
            'label' => esc_html__( 'Background Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-secondary:hover' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'saasp_horizontal_secondary_cta_hover_text_color',
        [
            'label' => esc_html__( 'Color', 'saaspricing' ),
            'type' =>  Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-secondary:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .saaspricing-horizontal-secondary:hover span svg' => 'fill: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'saasp_horizontal_secondary_cta_border_hover',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-secondary:hover',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_secondary_cta_border_radius_hover',
        [
            'label' => esc_html__( 'Border Radius', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-secondary:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
         Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'saasp_horizontal_secondary_cta_box_shadow_hover',
            'selector' => '{{WRAPPER}} .saaspricing-horizontal-secondary:hover',
        ]
    );

    $this->end_controls_tab();

    $this->end_controls_tabs();

    $this->add_control(
        'saasp_horizontal_secondary_separator',
        [
            'label' => esc_html__( '', 'saaspricing' ),
            'type' =>  Controls_Manager::RAW_HTML,
            'raw' => esc_html__( '', 'saaspricing' ),
            'separator'=> 'after',
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_secondary_cta_padding',
        [
            'label' => esc_html__( 'Padding', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricing-horizontal-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'saasp_horizontal_secondary_cta_margin',
        [
            'label' => esc_html__( 'Margin', 'saaspricing' ),
            'type' =>  Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .saaspricng-horizontal-secondary-main' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
}

private function get_currency_symbol( $saasp_symbol_name ) {
    $saasp_symbols = [
        'dollar' => '&#36;',
        'euro' => '&#128;',
        'franc' => '&#8355;',
        'pound' => '&#163;',
        'ruble' => '&#8381;',
        'shekel' => '&#8362;',
        'baht' => '&#3647;',
        'yen' => '&#165;',
        'won' => '&#8361;',
        'guilder' => '&fnof;',
        'peso' => '&#8369;',
        'peseta' => '&#8359;',
        'lira' => '&#8356;',
        'rupee' => '&#8360;',
        'indian_rupee' => '&#8377;',
        'real' => 'R$',
        'krona' => 'kr',
    ];
    return isset( $saasp_symbols[ $saasp_symbol_name ] ) ? $saasp_symbols[ $saasp_symbol_name ] : '';
}

protected function render() {
 $settings = $this->get_settings_for_display();
?>
<div class="saaspricing-horizontal">
    <div class="row gx-0 saaspricing-horizontal-wrapper <?php if ('yes' === $settings['saasp_horizontal_cta_row_reverse']) { echo esc_attr('saaspricing-row-reverse'); } ?>">
        <div class="col-lg-8">
            <div class="sasspricing-horizontal-left d-flex flex-column justify-content-center position-relative h-100">
                <!-- Table header -->
                <div class="saaspricing-horizontal-header">
                    <?php if ('' !== $settings['saasp_horizontal_header_title']) {
                        printf('<%1$s class="saaspricing-horizontal-title">%2$s</%1$s>', $settings['saasp_horizontal_header_title_tag'], $settings['saasp_horizontal_header_title']);
                    } ?>
                    <?php if ('' !== $settings['saasp_horizontal_header_description']) { ?>
                        <p class="saaspricing-horizontal-description">
                            <?php echo esc_html($settings['saasp_horizontal_header_description']); ?>
                        </p>
                    <?php } ?>
                </div>
                
                <?php if ('yes' === ($settings['saasp_horizontal_show_divider'])) { ?>
                    <div class="saasp-horizontal-divider">
                        <hr>
                    </div>
                <?php } ?>

                <!-- Table features -->
                <div class="saaspricing-horizontal-feature-list">
                    <?php if ('' !== $settings['saasp_horizontal_features_title']) { ?>
                        <p class="saaspricing-horizontal-feature-title">
                            <?php echo esc_html($settings['saasp_horizontal_features_title']); ?>
                        </p>
                    <?php } ?>
                    <div class="row">
                        <?php if ($settings['saasp_horizontal_features']) {
                            foreach ($settings['saasp_horizontal_features'] as $saasp_horizontal_features) { ?>
                                <div class="saasp-columns">
                                    <div class="saasp-horizontal-icon-wrapper elementor-repeater-item-<?php echo esc_attr($saasp_horizontal_features['_id']); ?>">
                                        <?php Icons_Manager::render_icon($saasp_horizontal_features['saasp_horizontal_features_icon'], ['aria-hidden' => 'true']); ?> 
                                        <small class="saaspricing-horizontal-feature-text"><?php echo esc_html($saasp_horizontal_features['saasp_horizontal_features_text']); ?></small>
                                    </div>
                                </div>
                        <?php } } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="saaspricing-horizontal-sidebar">
                <!-- Table ribbon -->
                <?php if ('yes' === $settings['saasp_horizontal_show_ribbon'] && '' !== $settings['saasp_horizontal_ribbon_title']) {
                    if ('left' === $settings['saasp_horizontal_ribbon_position']) {
                        $saasp_ribbon_position = 'saaspricing-horizontal-left-position';
                    } elseif ('right' === $settings['saasp_horizontal_ribbon_position']) {
                        $saasp_ribbon_position = 'saaspricing-horizontal-right-position';
                    } else {
                        $saasp_ribbon_position = 'saaspricing-horizontal-right-position';
                    } ?>
                    <span class="saaspricing-horizontal-ribbon <?php echo esc_attr($saasp_ribbon_position); ?>">
                        <?php echo esc_html($settings['saasp_horizontal_ribbon_title']); ?>
                    </span>
                <?php } ?>

                <!-- Table slogan -->
                <p class="saaspricing-horizontal-slogan-title <?php
                    if ('center' === $settings['saasp_horizontal_cta_alignment']) {
                        echo esc_attr('saaspricing-horizontal-pricing-center');
                    } elseif ('right' === $settings['saasp_horizontal_cta_alignment']) {
                        echo esc_attr('saaspricing-horizontal-pricing-right');
                    } elseif ('justify' === $settings['saasp_horizontal_cta_alignment']) {
                        echo esc_attr('saaspricing-horizontal-pricing-center');
                    } else {
                        echo esc_attr('saaspricing-horizontal-pricing-left');
                    } ?>">
                    <?php echo esc_html($settings['saasp_horizontal_cta_slogan_text']); ?>
                </p>

                <!-- Table pricing -->
                <div class="saasprcing-horizontal-pricing <?php
                    if ('center' === $settings['saasp_horizontal_cta_alignment']) {
                        echo esc_attr('saaspricing-horizontal-pricing-center');
                    } elseif ('right' === $settings['saasp_horizontal_cta_alignment']) {
                        echo esc_attr('saaspricing-horizontal-pricing-right');
                    } elseif ('justify' === $settings['saasp_horizontal_cta_alignment']) {
                        echo esc_attr('saaspricing-horizontal-pricing-center');
                    } else {
                        echo esc_attr('saaspricing-horizontal-pricing-left');
                    } ?>">
                    <?php if ('none' !== $settings['saasp_horizontal_currency_symbol'] && 'yes' === $settings['saasp_horizontal_sale']) { ?>
                        <del class="saaspricing-horizontal-original">
                            <span>
                                <?php if ('custom' !== $settings['saasp_horizontal_currency_symbol']) {
                                    echo esc_html($this->get_currency_symbol($settings['saasp_horizontal_currency_symbol']));
                                } else {
                                    echo esc_html($settings['saasp_horizontal_currency_symbol_custom']);
                                } ?>
                                <?php if ('' !== $settings['saasp_horizontal_original_price']) { ?>
                                    <span class="fw-bold">
                                        <?php echo esc_html($settings['saasp_horizontal_original_price']); ?>
                                    </span>
                                <?php } ?>
                            </span>
                        </del>
                    <?php } ?>

                    <?php if ('before' === $settings['saasp_horizontal_pricing_symbol_position']) { ?>
                        <span class="saaspricing-horizontal-symbol saaspricing-horizontal-price-text">
                            <?php if ('custom' !== $settings['saasp_horizontal_currency_symbol']) {
                                echo esc_html($this->get_currency_symbol($settings['saasp_horizontal_currency_symbol']));
                            } else {
                                echo esc_html($settings['saasp_horizontal_currency_symbol_custom']);
                            } ?>
                        </span>
                    <?php } ?>

                    <?php if ('' === $settings['saasp_horizontal_currency_format']) { ?>
                        <span class="saaspricing-horizontal-price saaspricing-horizontal-price-text">
                            <?php echo esc_html(explode(".", $settings['sassp_horizontal_price'])[0]); ?>
                        </span>
                        <?php if ('' !== explode(".", $settings['sassp_horizontal_price'])[1]) { ?>
                            <span class="saaspricing-fraction-price">
                                <?php echo esc_html(explode(".", $settings['sassp_horizontal_price'])[1]); ?>
                            </span>
                        <?php } ?>
                    <?php } else { ?>
                        <span class="saaspricing-horizontal-price saaspricing-horizontal-price-text">
                            <?php echo esc_html($settings['sassp_horizontal_price']); ?>
                        </span>
                    <?php } ?>

                    <?php if ('after' === $settings['saasp_horizontal_pricing_symbol_position']) { ?>
                        <span class="saaspricing-horizontal-symbol saaspricing-horizontal-price-text">
                            <?php if ('custom' !== $settings['saasp_horizontal_currency_symbol']) {
                                echo esc_html($this->get_currency_symbol($settings['saasp_horizontal_currency_symbol']));
                            } else {
                                echo esc_html($settings['saasp_horizontal_currency_symbol_custom']);
                            } ?>
                        </span>
                    <?php } ?>

                    <?php if ('' !== $settings['saasp_horizontal_period']) { ?>
                        <span class="saaspricing-horizontal-period <?php if ('below' === $settings['saasp_horizontal_period_position']) { echo esc_attr('w-100 mt-1'); } ?>">
                            <?php echo esc_html($settings['saasp_horizontal_period']); ?>
                        </span>
                    <?php } ?>
                </div>

                <!-- Table countdown -->
                <?php if ('yes' === $settings['saasp_horizontal_show_countdown'] && '' !== $settings['saasp_horizontal_show_countdown']) { ?>
                    <div class="saaspricing-horizontal-countdown">
                        <span class="saaspricing-countdown" data-countdown-index="0" data-expire-date="<?php echo esc_attr($settings['saasp_horizontal_expire_date']); ?>">
                            <?php echo esc_html__('00d: 00h: 00m: 00s', 'saaspricing'); ?>
                        </span>
                    </div>
                <?php } ?>

                <!-- Table review -->
                <?php if ('yes' === $settings['saasp_horizontal_show_rating'] && '' !== $settings['saasp_horizontal_rating_num']) { ?>
                    <div class="saaspricing-ratings saaspricing-horizontal-ratings">
                        <div class="saaspricing-star-icon fs-6">
                            <?php
                            $saasp_rating = $settings['saasp_horizontal_rating_num'];
                            $saasp_full_stars = floor($saasp_rating);
                            $saasp_half_star = $saasp_rating - $saasp_full_stars;

                            for ($k = 0; $k < $saasp_full_stars; $k++) { ?>
                                <span class="saaspricing-icons"><i class="fa fa-star"></i></span>
                            <?php }

                            if ($saasp_half_star >= 0.5) { ?>
                                <span class="saaspricing-icons-half"><i class="fa fa-star"></i></span>
                            <?php }

                            for ($j = 0; $j < 5 - ceil($settings['saasp_horizontal_rating_num']); $j++) { ?>
                                <span class="saaspricing-icons-none"><i class="fa fa-star"></i></span>
                            <?php }

                            if ('' !== $settings['saasp_horizontal_rating_counter']) { ?>
                                <small class="saaspricing-review-text">
                                    <?php echo esc_html__('(', 'saaspricing') . esc_html($settings['saasp_horizontal_rating_counter']) . esc_html__(')', 'saaspricing'); ?>
                                </small>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>

                <!-- Table buttons -->
                <?php if ('' !== $settings['saasp_horizontal_primary_cta_text'] && 'yes' === $settings['saasp_horizontal_primary_cta_switch']) {
                    if (!empty($settings['saasp_horizontal_primary_cta_url']['url'])) {
                        $this->add_link_attributes('saasp_horizontal_primary_cta_url', $settings['saasp_horizontal_primary_cta_url']);
                    } ?>
                    <a class="btn saaspricing-horizontal-primary <?php
                        if ('center' === $settings['saasp_horizontal_cta_alignment']) {
                            echo esc_attr(' mx-auto');
                        } elseif ('right' === $settings['saasp_horizontal_cta_alignment']) {
                            echo esc_attr(' ms-auto');
                        } elseif ('justify' === $settings['saasp_horizontal_cta_alignment']) {
                            echo esc_attr(' w-100');
                        } else {
                            echo esc_attr(' me-auto');
                        }
                        if ('extra-small' === $settings['saasp_horizontal_primary_cta_size']) {
                            echo esc_attr('saaspricing-xsm-btn');
                        } elseif ('small' === $settings['saasp_horizontal_primary_cta_size']) {
                            echo esc_attr(' saaspricing-sm-btn');
                        } elseif ('medium' === $settings['saasp_horizontal_primary_cta_size']) {
                            echo esc_attr(' saaspricing-m-btn');
                        } elseif ('large' === $settings['saasp_horizontal_primary_cta_size']) {
                            echo esc_attr(' saaspricing-l-btn');
                        } elseif ('extra-large' === $settings['saasp_horizontal_primary_cta_size']) {
                            echo esc_attr(' saaspricing-xl-btn');
                        } ?>" 
                        <?php echo wp_kses($this->get_render_attribute_string('saasp_horizontal_primary_cta_url'), $this->saasp_allowed_tags()); ?>>
                        <?php echo esc_html($settings['saasp_horizontal_primary_cta_text']); ?>
                        <span class="saaspricing-primary-spacing">
                            <?php Icons_Manager::render_icon($settings['saasp_horizontal_primary_cta_icon'], ['aria-hidden' => 'true']); ?>
                        </span>
                    </a>
                <?php } ?>

                <?php if ('' !== $settings['saasp_horizontal_secondary_cta_text'] && 'yes' === $settings['saasp_horizontal_secondary_cta_switch']) {
                    if (!empty($settings['saasp_horizontal_secondary_cta_url']['url'])) {
                        $this->add_link_attributes('saasp_horizontal_secondary_cta_url', $settings['saasp_horizontal_secondary_cta_url']);
                    } ?>
                    <div class="saaspricng-horizontal-secondary-main <?php
                        if ('center' === $settings['saasp_horizontal_cta_alignment']) {
                            echo esc_attr('text-center ');
                        } elseif ('right' === $settings['saasp_horizontal_cta_alignment']) {
                            echo esc_attr(' text-end');
                        } ?>">
                        <a class="btn saaspricing-horizontal-secondary <?php
                            if ('justify' === $settings['saasp_horizontal_cta_alignment']) {
                                echo esc_attr(' w-100');
                            }
                            if ('extra-small' === $settings['saasp_horizontal_secondary_cta_size']) {
                                echo esc_attr(' saaspricing-xsm-btn');
                            } elseif ('small' === $settings['saasp_horizontal_secondary_cta_size']) {
                                echo esc_attr(' saaspricing-sm-btn');
                            } elseif ('medium' === $settings['saasp_horizontal_secondary_cta_size']) {
                                echo esc_attr(' saaspricing-m-btn');
                            } elseif ('large' === $settings['saasp_horizontal_secondary_cta_size']) {
                                echo esc_attr(' saaspricing-l-btn');
                            } elseif ('extra-large' === $settings['saasp_horizontal_secondary_cta_size']) {
                                echo esc_attr(' saaspricing-xl-btn');
                            } ?>" 
                            <?php echo wp_kses($this->get_render_attribute_string('saasp_horizontal_secondary_cta_url'), $this->saasp_allowed_tags()); ?>>
                            <?php echo esc_html($settings['saasp_horizontal_secondary_cta_text']); ?>
                            <span class="saaspricing-secondary-spacing">
                                <?php Icons_Manager::render_icon($settings['saasp_horizontal_secondary_cta_icon'], ['aria-hidden' => 'true']); ?>
                            </span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
}
protected function _content_template() {
?>
<div class="saaspricing-horizontal">
    <#
        let rowReverse = '';
        if ('yes' === settings.saasp_horizontal_cta_row_reverse) {
            rowReverse = 'saaspricing-row-reverse';
        }
    #>
    
    <#
        let symbols = {
            dollar: '&#36;',
            euro: '&#128;',
            franc: '&#8355;',
            pound: '&#163;',
            ruble: '&#8381;',
            shekel: '&#8362;',
            baht: '&#3647;',
            yen: '&#165;',
            won: '&#8361;',
            guilder: '&fnof;',
            peso: '&#8369;',
            peseta: '&#8359;',
            lira: '&#8356;',
            rupee: '&#8360;',
            indian_rupee: '&#8377;',
            real: 'R$',
            krona: 'kr'
        };

        let symbol = '';
        if (settings.saasp_horizontal_currency_symbol) {
            if ('custom' !== settings.saasp_horizontal_currency_symbol) {
                symbol = symbols[settings.saasp_horizontal_currency_symbol] || '';
            } else {
                symbol = settings.saasp_horizontal_currency_symbol_custom;
            }
        }
    #>

    <#
        let ctaAlignment = settings.saasp_horizontal_cta_alignment === 'right' ? 'ms-auto' :
            settings.saasp_horizontal_cta_alignment === 'center' ? 'mx-auto' :
            settings.saasp_horizontal_cta_alignment === 'left' ? 'me-auto' : 'mx-auto';

        let buttonSize = settings.saasp_horizontal_primary_cta_size === 'extra-small' ? 'saaspricing-xsm-btn' :
            settings.saasp_horizontal_primary_cta_size === 'small' ? 'saaspricing-sm-btn' :
            settings.saasp_horizontal_primary_cta_size === 'medium' ? 'saaspricing-m-btn' :
            settings.saasp_horizontal_primary_cta_size === 'large' ? 'saaspricing-l-btn' :
            settings.saasp_horizontal_primary_cta_size === 'extra-large' ? 'saaspricing-xl-btn' : 'saaspricing-m-btn';

        let buttonSizeSecondary = settings.saasp_horizontal_secondary_cta_size === 'extra-small' ? 'saaspricing-xsm-btn' :
            settings.saasp_horizontal_secondary_cta_size === 'small' ? 'saaspricing-sm-btn' :
            settings.saasp_horizontal_secondary_cta_size === 'medium' ? 'saaspricing-m-btn' :
            settings.saasp_horizontal_secondary_cta_size === 'large' ? 'saaspricing-l-btn' :
            settings.saasp_horizontal_secondary_cta_size === 'extra-large' ? 'saaspricing-xl-btn' : 'saaspricing-m-btn';

        let buttonAlignment = settings.saasp_horizontal_cta_alignment === 'center' ? 'text-center' :
            settings.saasp_horizontal_cta_alignment === 'right' ? 'text-end' : 
            settings.saasp_horizontal_cta_alignment === 'left' ? 'text-start' : 'text-center';

        let ButtonWidth = 'justify' === settings.saasp_horizontal_cta_alignment ? 'w-100' : '';
    #>

    <div class="row gx-0 saaspricing-horizontal-wrapper {{ rowReverse }}">
        <div class="col-lg-8">
            <div class="sasspricing-horizontal-left d-flex flex-column justify-content-center position-relative h-100">
                <!-- Table header -->
                <div class="saaspricing-horizontal-header">
                    <#
                        if ('' !== settings.saasp_horizontal_header_title) {
                    #>
                        <{{{ settings.saasp_horizontal_header_title_tag }}} class="saaspricing-horizontal-title">
                            {{{ settings.saasp_horizontal_header_title }}}
                        </{{{ settings.saasp_horizontal_header_title_tag }}}>
                    <#
                        }
                    #>
                    <#
                        if ('' !== settings.saasp_horizontal_header_description) {
                    #>
                        <p class="saaspricing-horizontal-description">
                            {{{ settings.saasp_horizontal_header_description }}}
                        </p>
                    <#
                        }
                    #>
                </div>

                <# if ('yes' === settings.saasp_horizontal_show_divider) { #>
                    <div class="saasp-horizontal-divider">
                        <hr>
                    </div>
                <# } #>

                <!-- Table features -->
                <div class="saaspricing-horizontal-feature-list">
                    <# if ('' !== settings.saasp_horizontal_features_title) { #>
                        <p class="saaspricing-horizontal-feature-title">
                            {{{ settings.saasp_horizontal_features_title }}}
                        </p>
                    <# } #>

                    <div class="row">
                        <# if (settings.saasp_horizontal_features) {
                            settings.saasp_horizontal_features.forEach(function(saasp_horizontal_features) { #>
                                <div class="saasp-columns">
                                    <div class="saasp-horizontal-icon-wrapper elementor-repeater-item-{{{ saasp_horizontal_features._id }}}">
                                        <#
                                            let featureIcon = elementor.helpers.renderIcon(view, saasp_horizontal_features.saasp_horizontal_features_icon, { 'aria-hidden': true }, 'i', 'object');
                                        #>
                                        {{{ featureIcon.value }}}
                                        <small class="saaspricing-horizontal-feature-text">
                                            {{{ saasp_horizontal_features.saasp_horizontal_features_text }}}
                                        </small>
                                    </div>
                                </div>
                            <# });
                        } #>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="saaspricing-horizontal-sidebar">
                <!-- Table ribbon -->
                <# if ('yes' === settings.saasp_horizontal_show_ribbon && '' !== settings.saasp_horizontal_ribbon_title) {
                    let saasp_ribbon_position = 'saaspricing-horizontal-' + settings.saasp_horizontal_ribbon_position + '-position';
                #>
                    <span class="saaspricing-horizontal-ribbon {{ saasp_ribbon_position }}">
                        {{{ settings.saasp_horizontal_ribbon_title }}}
                    </span>
                <# } #>

                <!-- Table slogan -->
                <p class="saaspricing-horizontal-slogan-title {{ 
                    'center' === settings.saasp_horizontal_cta_alignment ? 'saaspricing-horizontal-pricing-center' :
                    'right' === settings.saasp_horizontal_cta_alignment ? 'saaspricing-horizontal-pricing-right' :
                    'justify' === settings.saasp_horizontal_cta_alignment ? 'saaspricing-horizontal-pricing-center' :
                    'saaspricing-horizontal-pricing-left' }}">
                    {{{ settings.saasp_horizontal_cta_slogan_text }}}
                </p>

                <!-- Table pricing -->
                <div class="saasprcing-horizontal-pricing {{ 
                    'center' === settings.saasp_horizontal_cta_alignment ? 'saaspricing-horizontal-pricing-center' :
                    'right' === settings.saasp_horizontal_cta_alignment ? 'saaspricing-horizontal-pricing-right' :
                    'justify' === settings.saasp_horizontal_cta_alignment ? 'saaspricing-horizontal-pricing-center' :
                    'saaspricing-horizontal-pricing-left' }}">
                    <#
                        if ('none' !== settings.saasp_horizontal_currency_symbol && 'yes' === settings.saasp_horizontal_sale) {
                    #>
                        <del class="saaspricing-horizontal-original">
                            <span>
                                {{{ symbol }}}
                                <# if ('' !== settings.saasp_horizontal_original_price) { #>
                                    <span class="fw-bold">
                                        {{{ settings.saasp_horizontal_original_price }}}
                                    </span>
                                <# } #>
                            </span>
                        </del>
                    <# } #>

                    <# if ('before' === settings.saasp_horizontal_pricing_symbol_position) { #>
                        <span class="saaspricing-horizontal-symbol saaspricing-horizontal-price-text">
                            {{{ symbol }}}
                        </span>
                    <# } #>

                    <# if ('' === settings.saasp_horizontal_currency_format) { #>
                        <span class="saaspricing-horizontal-price saaspricing-horizontal-price-text">
                            {{{ settings.sassp_horizontal_price.split('.')[0] }}}
                        </span>
                        <# if ('' !== settings.sassp_horizontal_price.split('.')[1]) { #>
                            <span class="saaspricing-fraction-price">
                                {{{ settings.sassp_horizontal_price.split('.')[1] }}}
                            </span>
                        <# }
                    } else { #>
                        <span class="saaspricing-horizontal-price saaspricing-horizontal-price-text">
                            {{{ settings.sassp_horizontal_price }}}
                        </span>
                    <# } #>

                    <# if ('after' === settings.saasp_horizontal_pricing_symbol_position) { #>
                        <span class="saaspricing-horizontal-symbol saaspricing-horizontal-price-text">
                            {{{ symbol }}}
                        </span>
                    <# } #>

                    <# if ('' !== settings.saasp_horizontal_period) { #>
                        <span class="saaspricing-horizontal-period {{ 'below' === settings.saasp_horizontal_period_position ? 'w-100 mt-1' : '' }}">
                            {{{ settings.saasp_horizontal_period }}}
                        </span>
                    <# } #>
                </div>

                <!-- Table countdown -->
                <# if ('yes' === settings.saasp_horizontal_show_countdown && '' !== settings.saasp_horizontal_expire_date) { #>
                    <div class="saaspricing-horizontal-countdown {{ ctaAlignment }}">
                        <span class="saaspricing-countdown" data-countdown-index="0" data-expire-date="{{ settings.saasp_horizontal_expire_date }}">
                            <?php echo esc_html__('00d: 00h: 00m: 00s', 'saaspricing'); ?>
                        </span>
                    </div>
                <# } #>

                <!-- Table review -->
                <# if ('yes' === settings.saasp_horizontal_show_rating && '' !== settings.saasp_horizontal_rating_num) {
                    let saasp_rating = settings.saasp_horizontal_rating_num;
                    let saasp_full_stars = Math.floor(saasp_rating);
                    let saasp_half_star = saasp_rating - saasp_full_stars;
                    let saasp_empty_stars = 5 - Math.ceil(saasp_rating);
                #>
                    <div class="saaspricing-ratings saaspricing-horizontal-ratings {{ ctaAlignment }}">
                        <div class="saaspricing-star-icon fs-6"> 
                            <# for (let k = 0; k < saasp_full_stars; k++) { #>
                                <span class="saaspricing-icons">
                                    <i class="fa fa-star"></i>
                                </span>
                            <# } if (saasp_half_star >= 0.5) { #>
                                <span class="saaspricing-icons-half">
                                    <i class="fa fa-star"></i>
                                </span>
                            <# } for (let j = 0; j < saasp_empty_stars; j++) { #>
                                <span class="saaspricing-icons-none">
                                    <i class="fa fa-star"></i>
                                </span>
                            <# } if ('' !== settings.saasp_horizontal_rating_counter) { #>
                                <small class="saaspricing-review-text">
                                    {{{ '(' + settings.saasp_horizontal_rating_counter + ')' }}}
                                </small>
                            <# } #>
                        </div>
                    </div>
                <# } #>

                <!-- Primary CTA -->
                <# if ('' !== settings.saasp_horizontal_primary_cta_text && 'yes' === settings.saasp_horizontal_primary_cta_switch) { #>
                    <a class="btn saaspricing-horizontal-primary {{ ctaAlignment }} {{ ButtonWidth }} {{ buttonSize }}" href="{{ settings.saasp_horizontal_primary_cta_url.url }}">
                        {{{ settings.saasp_horizontal_primary_cta_text }}}
                        <span class="saaspricing-primary-spacing">
                            <#
                                let primaryButton = elementor.helpers.renderIcon(view, settings.saasp_horizontal_primary_cta_icon, { 'aria-hidden': true }, 'i', 'object');
                            #>
                            {{{ primaryButton.value }}}
                        </span>
                    </a>
                <# } #>

                <!-- Secondary CTA -->
                <# if ('' !== settings.saasp_horizontal_secondary_cta_text && 'yes' === settings.saasp_horizontal_secondary_cta_switch) { #>
                    <div class="saaspricng-horizontal-secondary-main {{ buttonAlignment }}">
                        <a class="btn saaspricing-horizontal-secondary {{ ButtonWidth }} {{ buttonSizeSecondary }}" href="{{ settings.saasp_horizontal_secondary_cta_url.url }}">
                            {{{ settings.saasp_horizontal_secondary_cta_text }}}
                            <span class="saaspricing-secondary-spacing">
                                <#
                                    let secondaryButton = elementor.helpers.renderIcon(view, settings.saasp_horizontal_secondary_cta_icon, { 'aria-hidden': true }, 'i', 'object');
                                #>
                                {{{ secondaryButton.value }}}
                            </span>
                        </a>
                    </div>
                <# } #>
            </div>
        </div>
    </div>
</div>
<?php
    }
}