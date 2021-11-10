<?php
/**
 * Elementor RS Static Product Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSStatic_Product_Widget extends \Elementor\Widget_Base {

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
		return 'rs-static-product';
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
		return esc_html__( 'RS Static Product', 'rsaddon' );
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
		return 'glyph-icon flaticon-shopping-cart';
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
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function _register_controls() {

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Image', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,				
			]
		);

		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'separator' => 'before',
			]
		);		
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title & Description', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
	
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Product Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Product Title',
				'placeholder' => esc_html__( 'Box Title', 'rsaddon' ),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'title_link',
			[	'label_block' => true,
				'label' => esc_html__( 'Title Link', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '#', 'rsaddon' ),			
			]
		);

		$this->add_control(
			'link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'rsaddon'),
					'yes' => esc_html__( 'Yes', 'rsaddon'),					

				],
			]
		);

		$this->add_control(
		    'title_tag',
		    [
		        'label' => esc_html__( 'Title HTML Tag', 'rsaddon' ),
		        'type' => Controls_Manager::CHOOSE,
		        'options' => [
		            'h1'  => [
		                'title' => esc_html__( 'H1', 'rsaddon' ),
		                'icon' => 'eicon-editor-h1'
		            ],
		            'h2'  => [
		                'title' => esc_html__( 'H2', 'rsaddon' ),
		                'icon' => 'eicon-editor-h2'
		            ],
		            'h3'  => [
		                'title' => esc_html__( 'H3', 'rsaddon' ),
		                'icon' => 'eicon-editor-h3'
		            ],
		            'h4'  => [
		                'title' => esc_html__( 'H4', 'rsaddon' ),
		                'icon' => 'eicon-editor-h4'
		            ],
		            'h5'  => [
		                'title' => esc_html__( 'H5', 'rsaddon' ),
		                'icon' => 'eicon-editor-h5'
		            ],
		            'h6'  => [
		                'title' => esc_html__( 'H6', 'rsaddon' ),
		                'icon' => 'eicon-editor-h6'
		            ]
		        ],
		        'default' => 'h2',
		        'toggle' => false,
		    ]
		);
		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Product Description', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'It is a long established fact that the readable content of a  The point of using is that it has a more-or-less normal',
				'separator' => 'before',
			]			
		);
		$this->end_controls_section();	

		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__( 'Button', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'services_btn_text',
			[
				'label' => esc_html__( 'Product Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'View Details',
				'placeholder' => esc_html__( 'Product Button Text', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'services_btn_link',
			[
				'label' => esc_html__( 'Button Link', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '#',
				'placeholder' => esc_html__( '#', 'rsaddon' ),			
			]
		);

		$this->add_control(
			'services_btn_link_open',
			[
				'label'   => esc_html__( 'Link Open New Window', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [					
					'no' => esc_html__( 'No', 'rsaddon'),
					'yes' => esc_html__( 'Yes', 'rsaddon'),

				],
			]
		);

		$this->add_control(
			'services_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICON,
				'options' => rsaddon_pro_get_icons(),				
				'default' => 'fa fa-angle-right',
				'separator' => 'before',			
			]
		);

		$this->add_control(
		    'services_btn_icon_position',
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
		            ],
		        ],
		        'default' => 'after',
		        'toggle' => false,
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		    ]
		); 

		$this->add_control(
		    'services_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'condition' => [
		            'services_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .rs-product-button .product-button.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .rs-product-button .product-button.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_services',
			[
				'label' => esc_html__( 'Area Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-static-products .box-inner' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
		    'full_product_padding',
		    [
		        'label' => esc_html__( 'Product Content Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		//Icon/Image
		$this->start_controls_section(
		    '_section_media_style',
		    [
		        'label' => esc_html__( 'Image', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);


		$this->add_responsive_control(
		    'media_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'media_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area > img, {{WRAPPER}} .icon-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'media_border',
		        'selector' => '{{WRAPPER}} .icon-area > img, {{WRAPPER}} .icon-area',
		    ]
		);

		$this->add_responsive_control(
		    'media_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .icon-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);
	

		$this->end_controls_section();
		

		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Title & Description', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);
	
		$this->start_popover();

		$this->add_responsive_control(
		    'border_offset_y',
		    [
		        'label' => esc_html__( 'Offset Top', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'condition' => [
		            'offset_toggle' => 'yes'
		        ],
		        'range' => [
		            'px' => [
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            // Media translate styles
		            '(desktop){{WRAPPER}} .rs-static-products .box-inner::after' => '-ms-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}});',
		            '(tablet){{WRAPPER}} .rs-static-products .box-inner::after' => '-ms-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}});',
		            '(mobile){{WRAPPER}} .rs-static-products .box-inner::after' => '-ms-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}});',
		            // Body text styles
		        ],
		    ]
		);
		$this->end_popover();	


		$this->add_control(
		    'title_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'rsaddon' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_responsive_control(
		    'title_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .text-area .product-title .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .text-area .product-title .title, {{WRAPPER}}  .rs-static-products .box-inner .text-area .product-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner:hover .text-area .product-title .title, {{WRAPPER}}  .rs-static-products .box-inner:hover .text-area .product-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-static-products .box-inner .product-title .title',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_2
		    ]
		);		

		$this->add_control(
		    'description_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Description', 'rsaddon' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_responsive_control(
		    'description_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .text-area .product-des' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .text-area .product-des' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner:hover .text-area .product-des' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-static-products .box-inner .text-area .product-des',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_3,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'selector' => '{{WRAPPER}} .box-inner',
		    ]
		);

		$this->add_responsive_control(
		    'content_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .box-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);	

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow',
		        'label' => esc_html__( 'Text Area Box Shadow', 'rsaddon' ),
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .rs-static-products .box-inner'
		    ]
		);


		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow_hover',
		        'label' => esc_html__( 'Text Area Box Shadow Hover', 'rsaddon' ),
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .rs-static-products .box-inner:hover'
		    ]
		);

		$this->add_responsive_control(
		    'content_area_padding',
		    [
		        'label' => esc_html__( 'Product Content Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-product-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();


		//Buttom Style
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_4,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .product-button',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button',
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
		    'link_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
		            '{{WRAPPER}} .rs-static-products .box-inner .rs-product-button .product-button, {{WRAPPER}} .rs-static-products .box-inner .rs-product-button:focus .product-button' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .box-inner:hover .rs-product-button .product-button, {{WRAPPER}} .rs-static-products .box-inner:focus .rs-product-button .product-button' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-static-products .rs-product-button .product-button:hover, {{WRAPPER}} .rs-static-products .rs-product-button .product-button:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_icon_translate',
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
		            '{{WRAPPER}} .rs-static-products.rs-product-button .product-button.icon-before:hover i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .rs-static-products .rs-product-button .product-button.icon-after:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();

		
	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();	
		$this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title' );

        $this->add_inline_editing_attributes( 'text', 'basic' );
        $this->add_render_attribute( 'text', 'class', 'product-des' );

        $this->add_inline_editing_attributes( 'services_btn_text', 'basic' );
        $this->add_render_attribute( 'services_btn_text', 'class', 'btn-txt' );
		?>
		
		<div class="rs-static-products">
		    <div class="box-inner">
		    	<?php if(!empty($settings['selected_image']['url'])){?>
		    		<div class="icon-area">
			    		<?php if(!empty($settings['selected_image'])) :?>
			    			<img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="image"/>
			    		<?php endif;?>
		    		</div>
		    	<?php }?>
		    	<div class="rs-product-content">      
				    <div class="text-area">
				    	<?php if(!empty($settings['title'])){ ?>
					    	<div class="product-title">
					    		<?php if(!empty($settings['title_link'])) : 
					    			$link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
					    		?>	
					    							    			
					    		<<?php echo esc_html($settings['title_tag']);?> class="title"> <a <?php echo wp_kses_post($this->print_render_attribute_string('title')); ?> href="<?php echo esc_url($settings['title_link']);?>" <?php echo wp_kses_post( $link_open ); ?>><?php echo esc_html( $settings['title'] );?></a></<?php echo esc_html( $settings['title_tag'] );?>>

					    		<?php else: ?>
					    			<<?php echo esc_html($settings['title_tag']);?> <?php echo wp_kses_post($this->print_render_attribute_string('title')); ?>> <?php echo esc_html($settings['title']);?></<?php echo esc_html($settings['title_tag']);?>>
					    		<?php endif;
					    		?>
					    		
					    	</div>

				    	<?php } ?>	
				    	<?php if(!empty($settings['text'])) : ?>
				    		<p <?php echo wp_kses_post($this->print_render_attribute_string('text'));?>>  <?php echo wp_kses_post($settings['text']);?></p>	
				    	<?php endif; ?>	
				    </div>
			        <?php if(!empty($settings['services_btn_text'])){ ?>
    		    	<div class="rs-product-button">
    		    		<?php if(!empty($settings['services_btn_link'])) : 
    		    			$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : '';
    		    		?>

    		    		<?php  
    		    			$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
    		    		?>
    		    			<a class="product-button <?php echo esc_attr($icon_position); ?>" href="<?php echo esc_url($settings['services_btn_link']);?>" <?php echo wp_kses_post($link_open); ?>>
    		    				<span <?php echo wp_kses_post($this->print_render_attribute_string('services_btn_text')); ?>><?php echo wp_kses_post($settings['services_btn_text']);?></span>
    		    				<?php if(!empty($settings['services_btn_icon'])) : ?>
    		    					<i class="fa <?php echo esc_html($settings['services_btn_icon']);?>"></i>
    		    				<?php endif; ?>
    		    			</a>
    		    		<?php else: ?>

    		    		<?php endif;
    		    		?>
    		    	</div>
	    	    	<?php } ?>
    	    	</div>

			</div>
		</div>
		
	<?php
	}
}
