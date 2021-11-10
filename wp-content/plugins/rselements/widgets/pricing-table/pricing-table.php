<?php
/**
 * Pricing table widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Pricing_Table_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rsprice';
    }   


    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'RS Pricing Table', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-price';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'pricing', 'table', 'package', 'product', 'plan' ];
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Header', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__( 'Basic', 'rsaddon' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_icon',
            [
                'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );  

        $this->add_control(
            'selected_image_postion',
            [
                'label' => esc_html__( 'Select Image & Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__( 'Top', 'rsaddon' ),
                    'middle' => esc_html__( 'Middle', 'rsaddon' ),
                   
                ],
                'default' => 'top',            
            ]
        );       

        $this->start_controls_tabs(
            'style_tabs_icon'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Select Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICON,
                'options' => rsaddon_pro_get_icons(),                         
            ]
        );       

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Image', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type' => Controls_Manager::MEDIA,
            ]
        ); 

    

          

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_pricing',
            [
                'label' => esc_html__( 'Pricing', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__( 'Currency', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    '' => esc_html__( 'None', 'rsaddon' ),
                    'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'rsaddon' ),
                    'bdt' => '&#2547; ' . _x( 'BD Taka', 'Currency Symbol', 'rsaddon' ),
                    'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'rsaddon' ),
                    'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'rsaddon' ),
                    'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'rsaddon' ),
                    'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'rsaddon' ),
                    'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'rsaddon' ),
                    'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'rsaddon' ),
                    'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'rsaddon' ),
                    'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'rsaddon' ),
                    'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'rsaddon' ),
                    'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'rsaddon' ),
                    'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'rsaddon' ),
                    'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'rsaddon' ),
                    'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'rsaddon' ),
                    'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'rsaddon' ),
                    'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'rsaddon' ),
                    'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'rsaddon' ),
                    'custom' => esc_html__( 'Custom', 'rsaddon' ),
                ],
                'default' => 'dollar',
            ]
        );

        $this->add_control(
            'currency_custom',
            [
                'label' => esc_html__( 'Custom Symbol', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'condition' => [
                    'currency' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__( 'Price', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => '11.19',
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => esc_html__( 'Period', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Per Month', 'rsaddon' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_features',
            [
                'label' => esc_html__( 'Features', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'features_title',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Features', 'rsaddon' ),
                'separator' => 'after',
            ]
        );


        $this->add_control(
            'icon_show',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'icon_postion',
            [
                'label'   => esc_html__( 'Icon Position', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [                  
                    'left' => esc_html__( 'Left', 'rsaddon'),
                    'right_position' => esc_html__( 'Right', 'rsaddon'),
                ],
                'condition' => [
                    'icon_show' => 'yes'
                ]
            ]
        );

      
        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Exciting Feature', 'rsaddon' ),

            ]
        );

        

        $repeater->add_control(
            'icon_show',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );



        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-check',
                'include' => [
                    'fa fa-check',
                    'fa fa-close',
                ],
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__( 'Awesome Features', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__( 'Responsive Pricing Table', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                    [
                        'text' => esc_html__( 'Yearly Subscribe', 'rsaddon' ),
                        'icon' => 'fa fa-close',
                    ],
                    [
                        'text' => esc_html__( 'Professional Design', 'rsaddon' ),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_footer',
            [
                'label' => esc_html__( 'Footer', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Subscribe', 'rsaddon' ),
                'placeholder' => esc_html__( 'Type button text here', 'rsaddon' ),
                'label_block' => false,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__( 'Link', 'rsaddon' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'placeholder' => esc_html__( 'https://example.com/', 'rsaddon' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label' => esc_html__( 'Icon', 'rsaddon' ),
                'type' => Controls_Manager::ICON,
                'options' => rsaddon_pro_get_icons(),               
                'default' => '',
                'separator' => 'before',            
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_badge',
            [
                'label' => esc_html__( 'Badge', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

      
        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__( 'Badge Text', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Popular', 'rsaddon' ),
                'placeholder' => esc_html__( 'Type badge text', 'rsaddon' ),
                'condition' => [
                    'show_badge' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
 

    
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'General', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rsaddon' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}  .elementor-widget-container' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'general_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'general_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->start_controls_tabs( '_tabs_general' );

        $this->start_controls_tab(
            'general_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title,'
                    . '{{WRAPPER}} .rs-pricing-table-currency,'
                    . '{{WRAPPER}} .rs-pricing-table-period,'
                    . '{{WRAPPER}} .rs-pricing-table-features-title,'
                    . '{{WRAPPER}} .rs-pricing-table-features-list li,'
                    . '{{WRAPPER}} .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .rs-price-table'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'general_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-title,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-currency,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-period,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-title,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-list li,'
                    . '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_hover_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover'
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();       


        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );       
        

        $this->start_controls_tabs( '_tabs_icon' );

        $this->start_controls_tab(
            'icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'icon_hover_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_hover_bg',
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_icon_inner',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Icon Inner Part', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'icon_width',
            [
                'label' => esc_html__( 'Icon Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'icon_height',
            [
                'label' => esc_html__( 'Icon Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 

        $this->add_responsive_control(
            'icon_line_height',
            [
                'label' => esc_html__( 'Line Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );

        $this->start_controls_tabs( '_tabs_icon_inner' );

        $this->start_controls_tab(
            'icon_inner_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_inner_bg',
                'label' => esc_html__( 'Icon Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-icon  i',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_inner_border',
                'selector' => '{{WRAPPER}} .rs-pricing-icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_inner_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_inner_top',
            [
                'label' => esc_html__( 'Top Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_left_position',
            [
                'label' => esc_html__( 'Left/Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_left_transform',
            [
                'label' => esc_html__( 'Transform Left/Right', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_inner_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon  i ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_inner_hover_bg',
                'label' => esc_html__( 'Icon Hover Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_inner_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i',
            ]
        );

        $this->add_responsive_control(
            'icon_inner_hover_border_radius',
            [
                'label' => esc_html__( 'Hover Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_left_position',
            [
                'label' => esc_html__( 'Hover Left Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_hover_left_transform',
            [
                'label' => esc_html__( 'Hover Transform Left/Right', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-icon i' => 'transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();   

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );


        $this->add_responsive_control(
            'icon_bottom_spacing',
            [
                'label' => esc_html__( 'Icon Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 3,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon' => 'margin-bottom: {{SIZE}}{{UNIT}} ;',
                ],                
            ]
        );

       
        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Image Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Image Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-icon img' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );                    

        $this->end_controls_section();  

        $this->start_controls_section(
            '_section_style_header',
            [
                'label' => esc_html__( 'Header', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_header' );

        $this->start_controls_tab(
            'header_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-header',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'header_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_hover_bg',
                'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-header',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-title',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_style_pricing',
            [
                'label' => esc_html__( 'Pricing', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pricing_inline',
            [
                'label' => esc_html__( 'Display Inline', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Disable', 'rsaddon' ),
                    'display-inline' => esc_html__( 'Enable', 'rsaddon' ),
                    'display-inline2' => esc_html__( 'Enable 2', 'rsaddon' ),
                ],
            ]
        );

        $this->add_control(
            '_heading_price',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Price', 'rsaddon' ),
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'price_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_pricing' );

        $this->start_controls_tab(
            'pricing_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-price',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'pricing_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'price_hover_color',
            [
                'label' => esc_html__( 'Price Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-price-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'price_hover_bg',
                'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-price',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-price .rs-pricing-table-price-tag .rs-pricing-table-price-text',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            '_heading_currency',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Currency', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'currency_spacing',
            [
                'label' => esc_html__( 'Side Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label' => esc_html__( 'Currency Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'currency_hover_color',
            [
                'label' => esc_html__( 'Currency Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-currency' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'currency_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-price .rs-pricing-table-currency',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            '_heading_period',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Period', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'period_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'period_spacing',
            [
                'label' => esc_html__( 'Top Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'period_color',
            [
                'label' => esc_html__( 'Period Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'period_hover_color',
            [
                'label' => esc_html__( 'Period Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-period' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-period',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_control(
            '_heading_separator',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Separator', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
                    'pricing_inline' => 'display-inline'
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline'
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline'
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_spacing_left',
            [
                'label' => esc_html__( 'Left Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline'
                ],
            ]
        );

        $this->add_responsive_control(
            'separator_spacing_top',
            [
                'label' => esc_html__( 'Top Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline'
                ],
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label' => esc_html__( 'Separator Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-period::before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline'
                ],
            ]
        );

        $this->add_control(
            'seperator_hover_color',
            [
                'label' => esc_html__( 'Separator Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-period::before' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'pricing_inline' => 'display-inline'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_features',
            [
                'label' => esc_html__( 'Features', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'align_features',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rsaddon' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_features' );

        $this->start_controls_tab(
            'features_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'features_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-body .rs-pricing-table-features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_container_spacing',
            [
                'label' => esc_html__( 'Container Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-body',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'features_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-body',
            ]
        );

        $this->add_control(
            'features_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'features_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-body',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'features_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'features_hover_padding',
            [
                'label' => esc_html__( 'Hover Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_hover_container_spacing',
            [
                'label' => esc_html__( 'Hover Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_hover_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'features_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body',
            ]
        );

        $this->add_control(
            'features_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'features_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-body',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            '_heading_features_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_title_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_color',
            [
                'label' => esc_html__( 'Feature Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'features_title_hover_color',
            [
                'label' => esc_html__( 'Feature Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_title_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            '_heading_features_list',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'List', 'rsaddon' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'features_list_padding',
            [
                'label' => esc_html__( 'List Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'features_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list li i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'features_list_spacing',
            [
                'label' => esc_html__( 'Spacing Between', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list > li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_list' );

        $this->start_controls_tab(
            'list_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'features_list_color',
            [
                'label' => esc_html__( 'List Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-features-list > li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_list_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list > li',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_list_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list li',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'list_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'features_list_hover_color',
            [
                'label' => esc_html__( 'List Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-list > li' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'features_list_hover_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-features-list > li',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_list_hover_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list li',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'features_list_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-features-list > li',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_footer',
            [
                'label' => esc_html__( 'Footer', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( '_tabs_footer' );

        $this->start_controls_tab(
            'footer_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'footer_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .btn-part',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'footer_border',
                'selector' => '{{WRAPPER}} .btn-part',
            ]
        );

        $this->add_control(
            'footer_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'footer_box_shadow',
                'selector' => '{{WRAPPER}} .btn-part',
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'footer_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'footer_hover_padding',
            [
                'label' => esc_html__( 'Hover Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .btn-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'footer_hover_bg_color',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-price-table:hover .btn-part',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'footer_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .btn-part',
            ]
        );

        $this->add_control(
            'footer_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .btn-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'footer_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .btn-part',
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control(
            '_heading_button',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button', 'rsaddon' ),
            ]
        );

        $this->add_responsive_control(
            'btn_width',
            [
                'label' => esc_html__( 'Button Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'btn_height',
            [
                'label' => esc_html__( 'Button Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 

        $this->add_responsive_control(
            'btn_line_height',
            [
                'label' => esc_html__( 'Line Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'line-height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );   

        $this->add_responsive_control(
            'button_position',
            [
                'label' => esc_html__( 'Button Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'top: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

      

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn',
            ]
        );

        $this->add_control(
            'btn_icon_spacing',
            [
                'label' => esc_html__( 'Icon Translate X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ], 
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn:hover, {{WRAPPER}} .rs-pricing-table-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_hover_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn:hover',
            ]
        );

        $this->add_control(
            'button_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-btn:hover',
            ]
        );

        $this->add_control(
            'btn_icon_hover_spacing',
            [
                'label' => esc_html__( 'Icon Translate X', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-btn:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ], 
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_btn_hover',
                'label' => __( 'Background Color', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .btn-part:hover .rs-pricing-table-btn',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_badge',
            [
                'label' => esc_html__( 'Badge', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,                
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_top_position',
            [
                'label' => esc_html__( 'Top Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_bottom_position',
            [
                'label' => esc_html__( 'Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_left_position',
            [
                'label' => esc_html__( 'Left Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_right_position',
            [
                'label' => esc_html__( 'Right Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_badge' );

        $this->start_controls_tab(
            '_tab_badge_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__( 'Badge Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_border',
                'selector' => '{{WRAPPER}} .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_box_shadow',
                'selector' => '{{WRAPPER}} .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-pricing-table-badge',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        ); 

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_badge_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_hover_color',
            [
                'label' => esc_html__( 'Badge Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'badge_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'badge_hover_border',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'badge_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'badge_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge',
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'badge_hover_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}} .rs-price-table:hover .rs-pricing-table-badge',
                'scheme' => Scheme_Typography::TYPOGRAPHY_3,
                'condition' => [
                    'show_badge' => 'yes'
                ],
            ]
        );         

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private static function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'baht' => '&#3647;',
            'bdt' => '&#2547;',
            'dollar' => '&#36;',
            'euro' => '&#128;',
            'franc' => '&#8355;',
            'guilder' => '&fnof;',
            'indian_rupee' => '&#8377;',
            'pound' => '&#163;',
            'peso' => '&#8369;',
            'peseta' => '&#8359',
            'lira' => '&#8356;',
            'ruble' => '&#8381;',
            'shekel' => '&#8362;',
            'rupee' => '&#8360;',
            'real' => 'R$',
            'krona' => 'kr',
            'won' => '&#8361;',
            'yen' => '&#165;',
        ];

        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
    }

	protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute( 'badge_text', 'class',
            [
                'rs-pricing-table-badge',                
            ]
        );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'rs-pricing-table-title' );

        $this->add_inline_editing_attributes( 'price', 'none' );
        $this->add_render_attribute( 'price', 'class', 'rs-pricing-table-price-text' );

        $this->add_inline_editing_attributes( 'period', 'none' );
        $this->add_render_attribute( 'period', 'class', 'rs-pricing-table-period' );

        $this->add_inline_editing_attributes( 'features_title', 'basic' );
        $this->add_render_attribute( 'features_title', 'class', 'rs-pricing-table-features-title' );

        $this->add_inline_editing_attributes( 'button_text', 'none' );
        $this->add_render_attribute( 'button_text', 'class', 'rs-pricing-table-btn' );

        $this->add_render_attribute( 'button_text', 'href', esc_url( $settings['button_link']['url'] ) );
        if ( ! empty( $settings['button_link']['is_external'] ) ) {
            $this->add_render_attribute( 'button_text', 'target', '_blank' );
        }
        if ( ! empty( $settings['button_link']['nofollow'] ) ) {
            $this->add_render_attribute( 'button_text', 'rel', 'nofollow' );
        }

        if ( $settings['currency'] === 'custom' ) {
            $currency = $settings['currency_custom'];
        } else {
            $currency = self::get_currency_symbol( $settings['currency'] );
        }
        ?>
        


        <div class="rs-price-table"> 
            <?php if ( $settings['show_badge'] ) : ?>
                <span <?php $this->print_render_attribute_string( 'badge_text' ); ?>><?php echo esc_html($settings['badge_text']); ?></span>
            <?php endif; ?>


            
            <?php if ( 'top' == $settings['selected_image_postion'] ): ?>
                <?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])) : ?>
                    <div class="rs-pricing-icon">
                         <?php if ( $settings['selected_icon'] ) : ?>
                            <i class="fa <?php echo esc_html($settings['selected_icon']);?>"></i>
                        <?php endif; ?>

                         <?php if ( $settings['selected_image']['url'] ) : ?>
                           <img src="<?php echo esc_url($settings['selected_image']['url']);?>"  alt="<?php echo esc_url($settings['selected_image']['url']);?>" />
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


            <div class="rs-pricing-table-header">
                <?php if ( $settings['title'] ) : ?>
                    <h3 <?php $this->print_render_attribute_string( 'title' ); ?>><?php echo esc_html($settings['title']); ?></h3>
                <?php endif; ?>
            </div>

            <?php if ( 'middle' == $settings['selected_image_postion'] ): ?>
                <?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])) : ?>
                    <div class="rs-pricing-icon">
                         <?php if ( $settings['selected_icon'] ) : ?>
                            <i class="fa <?php echo esc_html($settings['selected_icon']);?>"></i>
                        <?php endif; ?>

                         <?php if ( $settings['selected_image']['url'] ) : ?>
                           <img src="<?php echo esc_url($settings['selected_image']['url']);?>"  alt="<?php echo esc_url($settings['selected_image']['url']);?>" />
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>



            <div class="rs-pricing-table-price <?php echo esc_attr($settings['pricing_inline']); ?>">
                <div class="rs-pricing-table-price-tag">
                    <span class="rs-pricing-table-currency"><?php echo esc_html( $currency ); ?></span><span <?php $this->print_render_attribute_string( 'price' ); ?>><?php echo esc_html($settings['price']); ?></span><span <?php $this->print_render_attribute_string( 'period' ); ?>><?php echo esc_html($settings['period']); ?></span>
                </div>
            </div>

            <div class="rs-pricing-table-body">
                <?php if ( $settings['features_title'] ) : ?>
                    <h3 <?php $this->print_render_attribute_string( 'features_title' ); ?>><?php echo wp_kses_post( $settings['features_title'] ); ?></h3>
                <?php endif; ?>

                <?php if ( is_array( $settings['features_list'] ) ) : ?>
                    <ul class="rs-pricing-table-features-list <?php echo($settings['icon_postion']);?>">
                        <?php foreach ( $settings['features_list'] as $index => $feature ) :
                            $name_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
                            $this->add_inline_editing_attributes( $name_key, 'basic' );
                            $this->add_render_attribute( $name_key, 'class', 'rs-pricing-table-feature-text' );
                            ?>
                            <li class="<?php echo esc_attr( 'elementor-repeater-item-' . $feature['_id'] ); ?>">
                            	<?php if ( $settings['icon_show'] ) : 
                                	if ( $feature['icon'] ) : ?>
	                                    <i class="<?php echo esc_attr( $feature['icon'] ); ?>"></i>

	                            <?php endif; endif; ?>

                                <span <?php $this->print_render_attribute_string( $name_key ); ?>><?php echo wp_kses_post( $feature['text'] ); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if ( $settings['button_text'] ) : ?>
                <div class="btn-part">
                    <a <?php $this->print_render_attribute_string( 'button_text' ); ?>><?php echo esc_html( $settings['button_text'] ); ?>
                    <?php if(!empty($settings['btn_icon'])) : ?>
                        <i class="fa <?php echo esc_html( $settings['btn_icon'] );?>"></i>
                    <?php endif; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}
