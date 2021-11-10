<?php
/**
 * Elementor RS Iconbox Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || die();

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;

class Rsaddon_Elementor_pro_RSIcon_Box_Widget extends \Elementor\Widget_Base {

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
		return 'rs-iconbox';
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
		return esc_html__( 'RS Icon Box', 'rsaddon' );
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
		return 'glyph-icon flaticon-shipping-and-delivery-1';
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
			'section_services',
			[
				'label' => esc_html__( 'Icon Box Global', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
                    '{{WRAPPER}} .rs-iconbox-area .box-inner' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->end_controls_section();



		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
					'image' => esc_html__( 'Image', 'rsaddon'),
								
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'      => Controls_Manager::ICON,
				'options'   => rsaddon_pro_get_icons(),				
				'default'   => 'fa fa-smile-o',
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'icon',
				],				
			]
		);

		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
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
				'label'       => esc_html__( 'Box Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Box Title',
				'placeholder' => esc_html__( 'Box Title', 'rsaddon' ),
				'separator'   => 'before',
			]
		);

		$this->add_control(
		'title_link',
		[
			'label' => __( 'Link', 'featuer_box' ),
			'type' => Controls_Manager::URL,
			'dynamic' => [
				'active' => true,
			],
			'placeholder' => __( 'https://your-link.com', 'featuer_box' ),
			'default' => [
				'url' => '#',
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

		$this->add_responsive_control(
		    'title_prefix',
		    [
		        'label' => esc_html__( 'Title Prefix Enable/Disable', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'block' => esc_html__( 'Enable', 'rsaddon'),
		        	'none' => esc_html__( 'Disable', 'rsaddon'),		

		        ],
		        'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title::before' => 'display: {{VALUE}}'
                ],
		    ]
		);
		
		$this->add_control(
			'title_prefix_text',
			[
				'label'       => esc_html__( 'Prefix Text', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '01.',
				'placeholder' => esc_html__( 'Prefix', 'rsaddon' ),
				'separator'   => 'before',
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title::before' => 'content: "{{VALUE}}";',
		        ],
			]
		);
		
		$this->add_control(
			'title_prefix_position',
			[
				'label'       => esc_html__( 'Prefix Position', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [					
					'' => esc_html__( 'Top', 'rsaddon'),
					'unset' => esc_html__( 'Left', 'rsaddon'),
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title::before' => 'top: {{VALUE}};',
		        ],
			]
		);

		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Box Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Box Text',
				'separator' => 'before',
			]			
		);

		$this->add_control(
			'badge_title',
			[
				'label'       => esc_html__( 'Badge Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'New',
				'placeholder' => esc_html__( 'Badge Title', 'rsaddon' ),
				'separator'   => 'before',
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
				'label' => esc_html__( 'Icon Box Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( 'Icon Box Button Text', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'services_btn_link',
			[
				'label' => esc_html__( 'Icon Box Button Link', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		


		//Icon/Image
		$this->start_controls_section(
		    '_section_media_style',
		    [
		        'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

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
		            '{{WRAPPER}} .icon-area' => 'font-size: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'icon_line_height',
		    [
		        'label' => esc_html__( 'Line Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'line-height: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'image_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
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
		            '{{WRAPPER}} .icon-area img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'icon_type' => 'image'
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'image_height',
		    [
		        'label' => esc_html__( 'Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .icon-area img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'icon_type' => 'image'
		        ]
		    ]
		);

		$this->add_control(
		    'offset_toggle',
		    [
		        'label' => esc_html__( 'Offset', 'rsaddon' ),
		        'type' => Controls_Manager::POPOVER_TOGGLE,
		        'label_off' => esc_html__( 'None', 'your-plugin' ),
		        'label_on' => esc_html__( 'Custom', 'your-plugin' ),
		        'return_value' => 'yes',
		    ]
		);

		$this->start_popover();

		$this->add_responsive_control(
		    'media_offset_x',
		    [
		        'label' => esc_html__( 'Offset Left', 'rsaddon' ),
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
		        'render_type' => 'ui',

		    ]
		);

		$this->add_responsive_control(
		    'media_offset_y',
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
		            '(desktop){{WRAPPER}} .icon-area' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}) !important;',
		            '(tablet){{WRAPPER}} .icon-area' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}) !important;',
		            '(mobile){{WRAPPER}} .icon-area' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}) !important;',
		            // Body text styles
		            '{{WRAPPER}} .text-area' => 'margin-top: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_popover();

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

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
				'name'     => 'media_box_shadow',
				'exclude'  => [
				'box_shadow_position',
			],
				'selector' => '{{WRAPPER}} .icon-area > img, {{WRAPPER}} .rs-iconbox-area.services-style3 .box-inner .icon-area, {{WRAPPER}} .icon-area'
		    ]
		);

		$this->add_control(
		    'icon_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .box-inner:hover .icon-area' => 'color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .icon-area' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_hover_bg_color',
		    [
		        'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .box-inner:hover .icon-area' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_effect',
		    [
		        'label' => esc_html__( 'Effect Enable/Disable', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
		        'options' => [
		        	'block' => esc_html__( 'Enable', 'rsaddon'),
		        	'none' => esc_html__( 'Disable', 'rsaddon'),		

		        ],
		        'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .icon-area::after' => 'display: {{VALUE}}'
                ],
		    ]
		);

		$this->add_control(
		    'icon_effect_color',
		    [
		        'label' => esc_html__( 'Effect Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'icon_effect' => 'block'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .icon-area::after' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_bg_rotate',
		    [
		        'label' => esc_html__( 'Background Rotate', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'deg' ],
		        'default' => [
		            'unit' => 'deg',
		        ],
		        'range' => [
		            'deg' => [
		                'min' => 0,
		                'max' => 360,
		            ],
		        ],
		        'selectors' => [
		            // Icon box transform styles
		            '(desktop){{WRAPPER}} .icon-area' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(tablet){{WRAPPER}} .icon-area' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(mobile){{WRAPPER}} .icon-area' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		        ],
		    ]
		);

		  $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'rsaddon' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
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
		            '(desktop){{WRAPPER}} .rs-iconbox-area .box-inner::after' => '-ms-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}});',
		            '(tablet){{WRAPPER}} .rs-iconbox-area .box-inner::after' => '-ms-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}});',
		            '(mobile){{WRAPPER}} .rs-iconbox-area .box-inner::after' => '-ms-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}});',
		            // Body text styles
		        ],
		    ]
		);
		$this->end_popover();	


		$this->add_responsive_control(
		    'content_bottom_border_height',
		    [
		        'label' => esc_html__( 'Bottom Border Height', 'rsaddon' ),		        
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner::after' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		    ]
		);


		$this->add_responsive_control(
		    'content_bottom_border_left',
		    [
		        'label' => esc_html__( 'Start Point', 'rsaddon' ),		        
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner::after' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'content_bottom_border_color',
		    [
		        'label' => esc_html__( 'Bottom Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner::after' => 'background:  {{VALUE}};',
		        ],
		    ]
		);

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
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title, {{WRAPPER}}  .rs-iconbox-area .box-inner .text-area .iconbox-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner:hover .text-area .iconbox-title .title, {{WRAPPER}}  .rs-iconbox-area .box-inner:hover .text-area .iconbox-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-iconbox-area .box-inner .iconbox-title .title',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_2
		    ]
		);		

		$this->add_control(
		    'title_heading_prefix',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title Prefix', 'rsaddon' ),
		        'separator' => 'before',
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		    ]
		);

		$this->add_control(
		    'title_prefix_padding',
		    [
		        'label' => esc_html__( 'Prefix Gap', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		    ]
		);
		
		$this->add_control(
			'title_prefix_text_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .iconbox-title .title::before' => 'color: {{VALUE}}',
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
			]
		);
		
		$this->add_control(
			'title_prefix_text_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-iconbox-area .box-inner:hover .text-area .iconbox-title .title::before' => 'color: {{VALUE}}',
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
			]
		);		

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_prefix_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-iconbox-area .box-inner .text-area .iconbox-title .title::before',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_2,
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
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
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .services-txt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .services-txt' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner:hover .text-area .services-txt' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-iconbox-area .box-inner .text-area .services-txt',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_3,
		    ]
		);

		$this->add_responsive_control(
		    'content_area_padding',
		    [
		        'label' => esc_html__( 'Content Area Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .box-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
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
		        'selector' => '{{WRAPPER}} .rs-iconbox-area .box-inner'
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
		        'selector' => '{{WRAPPER}} .rs-iconbox-area .box-inner:hover'
		    ]
		);


		$this->end_controls_section();


		//Badge Style
		$this->start_controls_section(
		    '_section_icon_badge',
		    [
		        'label' => esc_html__( 'Badge Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);


		$this->add_control(
            'iconbox_badge_color_position',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => 'color: {{VALUE}};',                   
                ],
            ]
        );

		$this->add_control(
            'iconbox_badge_bg_position',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => 'background-color: {{VALUE}};',                      
                ],
            ]
        );

        $this->add_responsive_control(
		    'iconbox_badge_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
            'iconbox_badge_position_top',
            [
                'label' => esc_html__( 'Badge Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => 'top: {{SIZE}}%;',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'iconbox_badge_position',
            [
                'label' => esc_html__( 'Badge Position Horizontal', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => 'left: {{SIZE}}%;',                   
                ],
            ]
        );

        $this->add_responsive_control(
		    'iconbox_badge_rotate',
		    [
		        'label' => esc_html__( 'Badge Rotate', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'deg' ],
		        'default' => [
		            'unit' => 'deg',
		        ],
		        'range' => [
		            'deg' => [
		                'min' => -360,
		                'max' => 360,
		            ],
		        ],
		        'selectors' => [
		            // Icon box transform styles

		            '(desktop){{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); 
		            -webkit-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',

		            '(tablet){{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(mobile){{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'iconbox_badge_border_radius_position',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .rs-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_4,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .services-btn',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn',
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
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
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
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
		            '{{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part .services-btn, {{WRAPPER}} .rs-iconbox-area .box-inner .services-btn-part:focus .services-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-iconbox-area .box-inner:hover .services-btn-part .services-btn, {{WRAPPER}} .rs-iconbox-area .box-inner:focus .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
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
		            '{{WRAPPER}} .rs-iconbox-area .services-btn-part .services-btn:hover, {{WRAPPER}} .rs-iconbox-area .services-btn-part .services-btn:focus' => 'border-color: {{VALUE}};',
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
		            '{{WRAPPER}} .rs-iconbox-area.services-btn-part .services-btn.icon-before:hover i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .rs-iconbox-area .services-btn-part .services-btn.icon-after:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
            $this->add_render_attribute( 'text', 'class', 'services-txt' );	

            $this->add_inline_editing_attributes( 'badge_title', 'basic' );
            $this->add_render_attribute( 'badge_title', 'class', 'rs-badge' );	

            $animation = !empty($settings['hover_animation'])? 'elementor-animation-'.$settings['hover_animation'].'':'';
            $animation_box = !empty($animation) ? 'rs-animation-yes' : '';

		?>	
		<div class="rs-iconbox-area <?php echo esc_attr($animation_box);?>">
		    <div class="box-inner">
		    	<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>

		    		<div class="icon-area <?php echo esc_attr( $animation ); ?>">
			    		<?php if(!empty($settings['selected_icon'])) : ?>
			    			<i class="<?php echo esc_html($settings['selected_icon']);?>"></i>
			    		<?php endif; ?>

			    		<?php if(!empty($settings['selected_image'])) :?>
			    			<a href="<?php echo esc_url($settings['title_link']['url']);?>"><img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="image"/></a>
			    		<?php endif;?>
		    		</div>
		    	<?php }?>      
			    <div class="text-area">
			    	<?php if(!empty($settings['title'])){ ?>
				    	<div class="iconbox-title">
				    		<?php if(!empty($settings['title_link'])) : 				    			
								$target   = $settings['title_link']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $settings['title_link']['nofollow'] ? ' rel="nofollow"' : '';
				    		?>	
				    							    			
				    		<<?php echo esc_html($settings['title_tag']);?> <?php echo wp_kses_post($this->print_render_attribute_string('title')); ?>> <a href="<?php echo esc_url($settings['title_link']['url']);?>" <?php echo wp_kses_post($target); ?> <?php echo wp_kses_post($nofollow); ?>><?php echo esc_html($settings['title']);?></a></<?php echo esc_html($settings['title_tag']);?>>

				    		<?php else: ?>
				    			<<?php echo esc_html($settings['title_tag']);?> <?php echo wp_kses_post($this->print_render_attribute_string('title')); ?>> <?php echo esc_html($settings['title']);?></<?php echo esc_html($settings['title_tag']);?>>
				    		<?php endif;
				    		?>
				    		
				    	</div>

			    	<?php } ?>	
			    	<?php if(!empty($settings['text'])) : ?>
			    		<p <?php echo wp_kses_post($this->print_render_attribute_string('text')); ?>>  <?php echo wp_kses_post($settings['text']);?></p>	
			    	<?php endif; ?>	
			    </div>

		        <?php if(!empty($settings['services_btn_text'])){ ?>

    		    	<div class="services-btn-part">
    		    		<?php if(!empty($settings['services_btn_link'])) : 
    		    			$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : '';
    		    		?>

    		    		<?php  
    		    			$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
    		    		?>
    		    			<a class="services-btn <?php echo esc_attr($icon_position) ?>" href="<?php echo esc_url($settings['services_btn_link']);?>" <?php echo wp_kses_post( $link_open ); ?>>
    		    				<span class="btn-txt"><?php echo wp_kses_post( $settings['services_btn_text'] );?></span>
    		    				<?php if(!empty($settings['services_btn_icon'])) : ?>
    		    					<i class="fa <?php echo esc_html( $settings['services_btn_icon'] );?>"></i>
    		    				<?php endif; ?>
    		    			</a>
    		    		<?php else: ?>

    		    		<?php endif;
    		    		?>
    		    		
    		    	</div>
    	    	<?php } ?>


			    <?php if(!empty($settings['badge_title'])){ ?>
			    <div <?php echo wp_kses_post($this->print_render_attribute_string('badge_title')); ?>><?php echo esc_html ($settings['badge_title']);?></div>
			    <?php } ?>

			</div>
		</div>	
	<?php
	}
}
