<?php
/**
 * @author  WpWax
 * @since   1.0.0
 * @version 1.0.0
 */

namespace AddonskitForElementor\Elements\UserRegistration;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

trait Styles {
    protected function register_form_fields_separator_controls( $section_label = '', $prefix = '', $selector = '' ): void {

        $this->start_controls_section(
            "section_{$prefix}_style",
            [
                'label' => $section_label,
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            "{$prefix}_border",
            [
                'label'      => __( 'Width', 'addonskit-for-elementor' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    "{{WRAPPER}} {$selector}" => 'border-bottom: {{SIZE}}{{UNIT}} solid;',
                ],
            ]
        );

        $this->add_control(
            "{$prefix}_border_color",
            [
                'label'     => __( 'Color', 'addonskit-for-elementor' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    "{{WRAPPER}} {$selector}" => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }
}