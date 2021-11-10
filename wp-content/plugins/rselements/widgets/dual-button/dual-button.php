<?php
/**
 * Dual Button widget class
 *
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

defined( 'ABSPATH' ) || die();

class Rsaddon_Pro_Dual_Button_Widget extends \Elementor\Widget_Base {
    
    /**
     * Get widget name.
     *
     * Retrieve counter widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'rs-dual-button';
    }

    /**
     * Get widget title.
     *
     * Retrieve counter widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'RS Dual Button', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve counter widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-menu';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'button' ];
    }

    /**
     * Register counter widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls() {
        $this->start_controls_section(
            '_section_button',
            [
                'label' => esc_html__( 'Dual Buttons', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs( '_tabs_buttons' );

        $this->start_controls_tab(
            '_tab_button_primary',
            [
                'label' => esc_html__( 'Primary', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'left_button_text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Primary Button',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'left_button_link',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://rstheme.com/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        
            $this->add_control(
                'left_button_icon',
                [
                    'label' => esc_html__( 'Icon', 'rsaddon' ),
                    'type' => Controls_Manager::ICON,
                    'options' => rsaddon_pro_get_icons(),
                ]
            );

            $condition = ['left_button_icon!' => ''];
       
        $this->add_control(
            'left_button_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => esc_html__( 'Before', 'rsaddon' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => esc_html__( 'After', 'rsaddon' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'before',
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'left_button_icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left .rselement-dual-btn-icon--before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rselement-dual-btn--left .rselement-dual-btn-icon--after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_connector',
            [
                'label' => esc_html__( 'Connector', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'button_connector_hide',
            [
                'label' => esc_html__( 'Hide Connector?', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Hide', 'rsaddon' ),
                'label_off' => esc_html__( 'Show', 'rsaddon' ),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_connector_type',
            [
                'label' => esc_html__( 'Connector Type', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'text' => [
                        'title' => esc_html__( 'Text', 'rsaddon' ),
                        'icon' => 'fa fa-text-width',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'rsaddon' ),
                        'icon' => 'fa fa-star',
                    ]
                ],
                'toggle' => false,
                'default' => 'text',
                'condition' => [
                    'button_connector_hide!' => 'yes',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_connector_text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Or', 'rsaddon' ),
                'condition' => [
                    'button_connector_hide!' => 'yes',
                    'button_connector_type' => 'text',
                ]
            ]
        );

        
            $this->add_control(
                'button_connector_icon',
                [
                    'label' => esc_html__( 'Icon', 'rsaddon' ),
                    'type' => Controls_Manager::ICON,
                    'options' => rsaddon_pro_get_icons(),
                    'condition' => [
                        'button_connector_hide!' => 'yes',
                        'button_connector_type' => 'icon',
                    ]
                ]
            );
        

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_secondary',
            [
                'label' => esc_html__( 'Secondary', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'right_button_text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Secondary Button',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'right_button_link',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'https://rstheme.com',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        
            $this->add_control(
                'right_button_icon',
                [
                    'label' => esc_html__( 'Icon', 'rsaddon' ),
                    'type' => Controls_Manager::ICON,
                    'options' => rsaddon_pro_get_icons(),
                ]
            );

            $condition = ['right_button_icon!' => ''];
         

        $this->add_control(
            'right_button_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => esc_html__( 'Before', 'rsaddon' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => esc_html__( 'After', 'rsaddon' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => false,
                'default' => 'after',
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'right_button_icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right .rselement-dual-btn-icon--before' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rselement-dual-btn--right .rselement-dual-btn-icon--after' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
   
        $this->end_controls_section();
   
        $this->start_controls_section(
            '_section_style_common',
            [
                'label' => esc_html__( 'Common', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_gap',
            [
                'label' => esc_html__( 'Space Between Buttons', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [                    
                    '{{WRAPPER}}.elementor-widget-rs-dual-button .rselement-dual-btn--left' => 'margin-right: calc({{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}}.elementor-widget-rs-dual-button .rselement-dual-btn--right' => 'margin-left: calc({{SIZE}}{{UNIT}}/2);',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rselement-dual-btn',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .rselement-dual-btn'
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'toggle' => true,
                'prefix_class' => 'rselement-dual-button-layout-',
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-button-layout-{{VALUE}} .elementor-widget-container' => 'justify-content: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_left_button',
            [
                'label' => esc_html__( 'Primary Button', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'left_button_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'left_button_border',
                'selector' => '{{WRAPPER}} .rselement-dual-btn--left'
            ]
        );

        $this->add_responsive_control(
            'left_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'left_button_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rselement-dual-btn--left',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'left_button_box_shadow',
                'selector' => '{{WRAPPER}} .rselement-dual-btn--left'
            ]
        );

        $this->start_controls_tabs( '_tabs_left_button' );

        $this->start_controls_tab(
            '_tab_left_button_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'left_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'left_button_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_left_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'left_button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'left_button_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'left_button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--left:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'left_button_border_border!' => ''
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_connector',
            [
                'label' => esc_html__( 'Connector', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'connector_notice',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__( 'Connector is hidden now, please enable connector from Content > Connector tab.', 'rsaddon' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'button_connector_hide' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'connector_text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn-connector' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'connector_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn-connector' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'connector_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rselement-dual-btn-connector',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'connector_box_shadow',
                'selector' => '{{WRAPPER}} .rselement-dual-btn-connector'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_right_button',
            [
                'label' => esc_html__( 'Secondary Button', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'right_button_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'right_button_border',
                'selector' => '{{WRAPPER}} .rselement-dual-btn--right'
            ]
        );

        $this->add_responsive_control(
            'right_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'right_button_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rselement-dual-btn--right',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'right_button_box_shadow',
                'selector' => '{{WRAPPER}} .rselement-dual-btn--right'
            ]
        );

        $this->start_controls_tabs( '_tabs_right_button' );

        $this->start_controls_tab(
            '_tab_right_button_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'right_button_text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tabs_right_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'right_button_hover_text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'right_button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rselement-dual-btn--right:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'right_button_border_border!' => ''
                ]
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();        
        // Left button
        $this->add_render_attribute( 'left_button', 'class', 'rselement-dual-btn rselement-dual-btn--left' );
        $this->add_render_attribute( 'left_button', 'href', esc_url( $settings['left_button_link']['url'] ) );
        if ( ! empty( $settings['left_button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'left_button', 'target', '_blank' );
        }
        if ( ! empty( $settings['left_button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'left_button', 'rel', 'nofollow' );
        }
        $this->add_inline_editing_attributes( 'left_button_text', 'none' );

        if ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) {
            $this->add_render_attribute( 'left_button_icon', 'class', [
                'rselement-dual-btn-icon',
                'rselement-dual-btn-icon--' . esc_attr( $settings['left_button_icon_position'] )
            ] );
        }



        // Button connector
        $this->add_render_attribute( 'button_connector_text', 'class', 'rselement-dual-btn-connector' );
        if ( $settings['button_connector_type'] === 'icon' && ( ! empty( $settings['button_connector_icon'] ) || ! empty( $settings['button_connector_selected_icon'] ) ) ) {
            $this->add_render_attribute( 'button_connector_text', 'class', 'rselement-dual-btn-connector--icon' );
        } else {
            $this->add_render_attribute( 'button_connector_text', 'class', 'rselement-dual-btn-connector--text' );
            $this->add_inline_editing_attributes( 'button_connector_text', 'none' );
        }

        // Right button
        $this->add_render_attribute( 'right_button', 'class', 'rselement-dual-btn rselement-dual-btn--right' );
        $this->add_render_attribute( 'right_button', 'href', esc_url( $settings['right_button_link']['url'] ) );
        if ( ! empty( $settings['right_button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'right_button', 'target', '_blank' );
        }
        if ( ! empty( $settings['right_button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'right_button', 'rel', 'nofollow' );
        }
        $this->add_inline_editing_attributes( 'right_button_text', 'none' );

        if ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) {
            $this->add_render_attribute( 'right_button_icon', 'class', [
                'rselement-dual-btn-icon',
                'rselement-dual-btn-icon--' . esc_attr( $settings['right_button_icon_position'] )
            ] );
        }
        ?>
        <div class="rselement-dual-btn-wrapper">
            <a <?php $this->print_render_attribute_string( 'left_button' ); ?>>
                <?php if ( $settings['left_button_icon_position'] === 'before' && ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_icon' ); ?>>
                        <i class="<?php echo esc_html($settings['left_button_icon']);?>"></i>
                    </span>
                <?php endif; ?>
                <?php if ( $settings['left_button_text'] ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_text' ); ?>><?php echo esc_html( $settings['left_button_text'] ); ?></span>
                <?php endif; ?>
                <?php if ( $settings['left_button_icon_position'] === 'after' && ( ! empty( $settings['left_button_icon'] ) || ! empty( $settings['left_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'left_button_icon' ); ?>>
                        <i class="<?php echo esc_html($settings['left_button_icon']);?>"></i>
                    </span>
                <?php endif; ?>
            </a>
            <?php if ( $settings['button_connector_hide'] !== 'yes' ) : ?>
                <span <?php $this->print_render_attribute_string( 'button_connector_text' ); ?>>
                    <?php if ( $settings['button_connector_type'] === 'icon' && ( ! empty( $settings['button_connector_icon'] ) || ! empty( $settings['button_connector_selected_icon'] ) ) ) : ?>
                        <i class="<?php echo esc_html($settings['button_connector_icon']);?>"></i>
                    <?php else :
                        echo esc_html( $settings['button_connector_text'] );
                    endif; ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="rselement-dual-btn-wrapper">
            <a <?php $this->print_render_attribute_string( 'right_button' ); ?>>
                <?php if ( $settings['right_button_icon_position'] === 'before' && ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_icon' ); ?>>
                       <i class="<?php echo esc_html($settings['right_button_icon']);?>"></i>
                    </span>
                <?php endif; ?>
                <?php if ( $settings['right_button_text'] ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_text' ); ?>><?php echo esc_html( $settings['right_button_text'] ); ?></span>
                <?php endif; ?>
                <?php if ( $settings['right_button_icon_position'] === 'after' && ( ! empty( $settings['right_button_icon'] ) || ! empty( $settings['right_button_selected_icon'] ) ) ) : ?>
                    <span <?php $this->print_render_attribute_string( 'right_button_icon' ); ?>>
                         <i class="<?php echo esc_html($settings['right_button_icon']);?>"></i>
                    </span>
                <?php endif; ?>
            </a>
        </div>
        <?php
    }
}
