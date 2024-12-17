<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
class Saaspricing_Pricelist extends Widget_Base {


	public function get_name() {
		return 'saaspricing-pricelist';
	}

	public function get_title() {
		return __( 'Pricelist', 'saaspricing' );
	}

	public function get_icon() {
		return 'saasp-icon eicon-price-list';
	}

	public function get_categories() {
		return [ 'saas_pricing_category' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'saasp_pricelist_repeater_content_section',
			[
				'label' => esc_html__( 'Price List', 'saaspricing' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$saasp_priclist_repeater = new Repeater();

		$saasp_priclist_repeater->add_control(
			'saasp_pricelist_list_title',
			[
				'label' => esc_html__( 'List Title', 'saaspricing' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'saaspricing' ),
				'placeholder' => esc_html__( 'Type your title here', 'saaspricing' ),
			]
		);

		$saasp_priclist_repeater->add_control(
			'saasp_pricelist_list_description',
			[
				'label' => esc_html__( 'List Description', 'saaspricing' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 3,
				'default' => esc_html__( 'Default description', 'saaspricing' ),
				'placeholder' => esc_html__( 'Type your description here', 'saaspricing' ),
			]
		);

		$saasp_priclist_repeater->add_control(
			'saasp_pricelist_list_price',
			[
				'label' => esc_html__( 'List Price', 'saaspricing' ),
				'type' =>  Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 99999999999999999,
				'step' => 1,
				'default' => 10,
			]
		);

		$this->add_control(
			'saasp_pricelist_repeater',
			[
				'label' => esc_html__( 'Pricelist Items', 'saaspricing' ),
				'type' =>  Controls_Manager::REPEATER,
				'fields' => $saasp_priclist_repeater->get_controls(),
				'default' => [
					[
						'saasp_pricelist_list_title' => esc_html__( 'Mobile Optimized "Link-In-Bio" Store A place', 'saaspricing' ),
						'saasp_pricelist_list_description' => esc_html__( 'Item content. Click the edit button to change this text.', 'saaspricing' ),
					],
					[
						'saasp_pricelist_list_title' => esc_html__( 'Calender Invites & Bookings', 'saaspricing' ),
						'saasp_pricelist_list_description' => esc_html__( 'Item content. Click the edit button to change this text.', 'saaspricing' ),
					],
					[
						'saasp_pricelist_list_title' => esc_html__( 'Course Builder', 'saaspricing' ),
						'saasp_pricelist_list_description' => '',
					],
					[
						'saasp_pricelist_list_title' => esc_html__( 'Audience Analytics', 'saaspricing' ),
						'saasp_pricelist_list_description' => '',
					],
				],
				'title_field' => '{{{ saasp_pricelist_list_title }}}',
			]
		);

		$this->add_control(
			'saasp_pricelist_symbol_heading',
			[
				'label' => esc_html__( 'Pricing', 'saaspricing' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->add_control(
			'saasp_pricelist_currency_symbol',
			[
				'label' => esc_html__( 'Currency Symbol', 'saaspricing'  ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'saaspricing'  ),
					'taka' => '&#2547; ' . esc_html__( 'Taka', 'Currency', 'saaspricing'  ),
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
			'saasp_pricelist_currency_symbol_custom',
			[
				'label' => esc_html__( 'Custom Symbol', 'saaspricing'  ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'saasp_pricelist_currency_symbol' => 'custom',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'saasp_pricelist_section_style',
			[
				'label' => esc_html__( 'Price List', 'saaspricing' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'saasp_pricelist_background_color',
			[
				'label' => esc_html__( 'Background Color', 'saaspricing' ),
				'type' =>  Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-main-container' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'saasp_pricelist_list_spacing_style',
			[
				'label' => esc_html__( 'Pricelist Gap Between', 'saaspricing' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 13,
				],
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-wraper:not(:first-child)' => 'padding-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .saasp-pricelist-wraper:not(:last-child)' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .saasp-pricelist-main-container',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'saasp_pricelist_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'saaspricing' ),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-main-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	
		$this->add_group_control(
			 Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'saasp_pricelist_box_shadow',
				'selector' => '{{WRAPPER}} .saasp-pricelist-main-container',
			]
		);

		$this->add_responsive_control(
			'saasp_pricelist_padding',
			[
				'label' => esc_html__( 'Padding', 'saaspricing' ),
				'type' =>  Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em'],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-main-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'saasp_pricelist_title_style_heading',
			[
				'label' => esc_html__( 'Title', 'saaspricing' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'saasp_pricelist_title_typography',
				'selector' => '{{WRAPPER}} .saasp-pricelist-title',
			]
		);

		$this->add_control(
			'saasp_pricelist_title_color_style',
			[
				'label' => esc_html__( 'Color', 'saaspricing' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'saasp_pricelist_title_spacing_style',
			[
				'label' => esc_html__( 'Spacing', 'saaspricing' ),
				'type' =>  Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'saasp_pricelist_description_style_heading',
			[
				'label' => esc_html__( 'Description', 'saaspricing' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'saasp_pricelist_description_typography',
				'selector' => '{{WRAPPER}} .saasp-pricelist-description',
			]
		);

		$this->add_control(
			'saasp_pricelist_description_color_style',
			[
				'label' => esc_html__( 'Color', 'saaspricing' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'saasp_pricelist_price_style_heading',
			[
				'label' => esc_html__( 'Price', 'saaspricing' ),
				'type' =>  Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'saasp_pricelist_price_typography',
				'selector' => '{{WRAPPER}} .saasp-pricelist-price',
			]
		);

		$this->add_control(
			'saasp_pricelist_price_color_style',
			[
				'label' => esc_html__( 'Color', 'saaspricing' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .saasp-pricelist-price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	private function get_currency_symbol( $saasp_symbol_name ) {
		$saasp_symbols = [
			'taka' => '&#2547;',
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

	protected function render(){
		$settings = $this->get_settings_for_display();
	?>
	<div class="container saasp-pricelist-main-container">
    	<div class="saasp-pricelist-main">
			<!-- Pricelist Repeater Start -->
			<div class="saasp-wraped-lists">
				<?php
				if ('' !== $settings['saasp_pricelist_repeater']) {
					foreach ($settings['saasp_pricelist_repeater'] as $pricelist) {
				?>
					<div class="row saasp-pricelist-wraper">
						<?php
						if ($pricelist['saasp_pricelist_list_title'] || $pricelist['saasp_pricelist_list_description'] || $pricelist['saasp_pricelist_list_price']) {
						?>
							<div class="col">
								<div class="saasp-pricelist-right d-flex justify-content-between saasp-pricelist-content-alignment">
									<?php
									if ('' !== $pricelist['saasp_pricelist_list_title'] || '' !== $pricelist['saasp_pricelist_list_description']) {
									?>
										<div class="saasp-pricelist">
											<h3 class="saasp-pricelist-title">
												<?php echo esc_html($pricelist['saasp_pricelist_list_title']); ?>
											</h3>
											<p class="saasp-pricelist-description">
												<?php echo esc_html($pricelist['saasp_pricelist_list_description']); ?>
											</p>
										</div>
									<?php
									}
									?>
									<?php
									if ('' !== $pricelist['saasp_pricelist_list_price']) {
									?>
										<h3 class="saasp-pricelist-price text-end text-nowrap">
											<span class="saasp-pricelist-currency">
											<?php 
											if ('custom' !== $settings['saasp_pricelist_currency_symbol']) {
												echo esc_html($this->get_currency_symbol($settings['saasp_pricelist_currency_symbol']));
											} else {
												echo esc_html($settings['saasp_pricelist_currency_symbol_custom']);
											}
											?></span><span class="saasp-pricelist-list-num"><?php echo esc_html($pricelist['saasp_pricelist_list_price']); ?></span>
										</h3>
									<?php
									}
									?>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				<?php
					}
				}
				?>
			</div>
    	</div>
	</div>

	<?php
	}

	public function content_template() {
	?>
		<div class="container saasp-pricelist-main-container">
			<div class="saasp-pricelist-main">
				<div class="saasp-wraped-lists">
					<!-- Pricelist Repeater Start -->
					<#
						let symbols = {
							taka: '&#2547;',
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

						let symbol = '',
							iconsHTML = {};

						if (settings.saasp_pricelist_currency_symbol) {
							if ('custom' !== settings.saasp_pricelist_currency_symbol) {
								symbol = symbols[settings.saasp_pricelist_currency_symbol] || '';
							} else {
								symbol = settings.saasp_pricelist_currency_symbol_custom;
							}
						}

						if (settings.saasp_pricelist_repeater) {
							_.each(settings.saasp_pricelist_repeater, function(pricelist) {
					#>
						<div class="row saasp-pricelist-wraper">
							<#
								if (pricelist.saasp_pricelist_list_title || pricelist.saasp_pricelist_list_description || pricelist.saasp_pricelist_list_price) {
							#>
								<div class="col">
									<div class="saasp-pricelist-right d-flex justify-content-between saasp-pricelist-content-alignment">
										<#
										if (pricelist.saasp_pricelist_list_title || pricelist.saasp_pricelist_list_description) {
										#>
											<div class="saasp-pricelist">
												<h3 class="saasp-pricelist-title">
													{{{ pricelist.saasp_pricelist_list_title }}}
												</h3>
												<p class="saasp-pricelist-description">
													{{{ pricelist.saasp_pricelist_list_description }}}
												</p>
											</div>
										<#
										}
										#>
										<#
										if (pricelist.saasp_pricelist_list_price !== null && pricelist.saasp_pricelist_list_price !== undefined) {
										#>
											<h3 class="saasp-pricelist-price text-end text-nowrap">
												<span class="saasp-pricelist-currency">{{{symbol}}}</span><span class="saasp-pricelist-list-num">{{{ pricelist.saasp_pricelist_list_price }}}</span>
											</h3>
										<#
										}
										#>
									</div>
								</div>
							<#
							}
							#>
						</div>
					<#
						});
					}
					#>
				</div>
			</div>
		</div>
	<?php
	}

}