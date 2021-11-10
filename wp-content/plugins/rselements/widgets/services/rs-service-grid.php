<?php
/**
 *
 * @since 1.0.0
 */


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSservices_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rs-service-grid';
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
		return esc_html__( 'RS Services Grid', 'rsaddon' );
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
		return 'glyph-icon flaticon-support';
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
				'label' => esc_html__( 'Services Global', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'services_style',
			[
				'label'   => esc_html__( 'Select Services Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rsaddon'),
					'style2' => esc_html__( 'Style 2', 'rsaddon'),
					'style3' => esc_html__( 'Style 3', 'rsaddon'),
					'style4' => esc_html__( 'Style 4', 'rsaddon'),
					'style5' => esc_html__( 'Style 5', 'rsaddon'),
					'style6' => esc_html__( 'Style 6', 'rsaddon'),
					'style7' => esc_html__( 'Style 7', 'rsaddon'),
					'style8' => esc_html__( 'Style 8', 'rsaddon'),
					'style9' => esc_html__( 'Style 9', 'rsaddon'),
				],
			]
		);

		$this->add_control(
			'services_serial_number',
			[
				'label'   => esc_html__( 'Serial Number Enable/Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'serial_disable',
				'options' => [					
					'serial_enable' => esc_html__( 'Enable', 'rsaddon'),
					'serial_disable' => esc_html__( 'Disable', 'rsaddon'),
				],
			]
		);

		$this->add_control(
			'serial_number_position',
			[
				'label'   => esc_html__( 'Number Position Enable/Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'disable_position',
				'options' => [					
					'enable_position' => esc_html__( 'Enable', 'rsaddon'),
					'disable_position' => esc_html__( 'Disable', 'rsaddon'),
				],
			]
		);

		$this->add_control(
			'serial_text',
			[
				'label'       => esc_html__( 'Serial Number', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '01',
				'placeholder' => esc_html__( '01', 'rsaddon' ),
				'condition' => [
					'services_serial_number' => 'serial_enable',
				],	
				'separator'   => 'before',
			]
		);

				$this->add_responsive_control(
				    'numbers_left_position',
				    [
						'label'      => esc_html__( 'Number Left To Right Position', 'rsaddon' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
				        'range' => [
				            '%' => [
				                'min' => 0,
				                'max' => 1000,
				            ],
				            'px' => [
				                'min' => -1000,
				                'max' => 1000,
				            ],
				        ],
		                'condition' => [
		        			'serial_number_position' => 'enable_position',
		        		],
				        'selectors' => [
				            '{{WRAPPER}} .rs-addon-services .serial_number' => 'left: {{SIZE}}{{UNIT}};',
				        ],
				        'separator' => 'before',
				    ]
				);

				$this->add_responsive_control(
				    'numbers_tops_position',
				    [
						'label'      => esc_html__( 'Number Top To Buttom Position', 'rsaddon' ),
						'type'       => Controls_Manager::SLIDER,
						'size_units' => [ 'px', '%' ],
				        'range' => [
				            '%' => [
				                'min' => 0,
				                'max' => 1000,
				            ],
				            'px' => [
				                'min' => -1000,
				                'max' => 1000,
				            ],
				        ],
		                'condition' => [
		        			'serial_number_position' => 'enable_position',
		        		],
				        'selectors' => [
				            '{{WRAPPER}} .rs-addon-services .serial_number' => 'top: {{SIZE}}{{UNIT}};',
				        ],
				        'separator' => 'before',
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
                    '{{WRAPPER}} .rs-addon-services .services-part' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
		    '_services_full_part_style',
		    [
		        'label' => esc_html__( 'Services Full Part', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		        'condition' => [
		            'services_style' => 'style2'
		        ],
		    ]
		);

		$this->add_control(
		    'services_full_part_overlay_color',
		    [
		        'label' => esc_html__( 'Overlay Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services.services-style2::before' => 'background-color: {{VALUE}};',
		        ],
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
					'image-hover' => esc_html__( 'Hover Image', 'rsaddon'),
								
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_type_align',
			[
				'label'   => esc_html__( 'Select Image Align', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',			
				'options' => [					
					'top' => esc_html__( 'Top', 'rsaddon'),
					'left' => esc_html__( 'Left', 'rsaddon'),								
				],
				'condition' => [
					'icon_type' => 'image-hover',
				],
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
					'icon_type' => ['image', 'image-hover'],
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_image_hover',
			[
				'label' => esc_html__( 'Choose Hover Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				'condition' => [
					'icon_type' => ['image', 'image-hover'],
				],
				'separator' => 'before',
			]
		);


		$this->add_control(
			'shape_image_enable',
			[
				'label'   => esc_html__( 'Shape Enable/Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'enable',			
				'options' => [					
					'enable' => esc_html__( 'Enable', 'rsaddon'),
					'disable' => esc_html__( 'Disable', 'rsaddon'),
								
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'shape_image',
			[
				'label' => esc_html__( 'Choose Shape Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,	
				'condition' => [
					'services_style' => 'style6',
					'shape_image_enable' => 'enable',
				],	
				'separator' => 'before',
			]
		);



		$this->add_control(
			'icon_image',
			[
				'label'     => esc_html__( 'Circle Icon', 'rsaddon' ),
				'type'      => Controls_Manager::ICON,
				'options'   => rsaddon_pro_get_icons(),				
				'default'   => 'fa fa-smile-o',
				'separator' => 'before',
				'condition' => [
					'services_style' => 'style5',
				],			
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
				'label'       => esc_html__( 'Services Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Services Title',
				'placeholder' => esc_html__( 'Services Title', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title::before' => 'display: {{VALUE}}'
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title::before' => 'content: "{{VALUE}}";',
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title::before' => 'top: {{VALUE}};',
		        ],
			]
		);
		

		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Services Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,				
				'default' => esc_html__( 'Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. Dummy text generator.', 'rsaddon' ),
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
            'btn_on_off',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
		            'services_style' => 'style5',
		        ],
                
            ]
        );
		$this->add_control(
			'services_btn_text',
			[
				'label' => esc_html__( 'Services Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( 'Services Button Text', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'services_btn_link',
			[
				'label' => esc_html__( 'Services Button Link', 'rsaddon' ),
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
			'btn_icon_border',
			[
				'label'   => esc_html__( 'Button Icon/Border', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'btn_icon' => esc_html__( 'Icon', 'rsaddon'),
					'btn_border' => esc_html__( 'Border', 'rsaddon'),
				],
                'condition' => [
		            'services_style!' => 'style5',
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
				'condition' => [
		            'btn_icon_border' => 'btn_icon',
		        ],			
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
		            'btn_icon_border!' => 'btn_border',

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
		            'btn_icon_border!' => 'btn_border',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_area_style',
		    [
		        'label' => esc_html__( 'Global Style', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'item_padding_area',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_control(
			'global_style_shadow',
			[
				'label'   => esc_html__( 'Box Shadow Active', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'serial_disable',
				'options' => [					
					'enable' => esc_html__( 'Enable', 'rsaddon'),
					'disable' => esc_html__( 'Disable', 'rsaddon'),
				],
			]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'media_box_shadow6',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'condition' => [
		            'global_style_shadow' => 'enable'
		        ],
		        'selector' => '.hover_effect .elementor-row .elementor-widget-container:hover, .hover_effect .elementor-row:not(:hover) .elementor-widget-container .box_shadow_enable'
		    ]
		);

		$this->add_control(
		    'icon_color_circle',
		    [
		        'label' => esc_html__( 'Icon Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.services-style5 .services-part .icon_image i' => 'color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style' => 'style5'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_bg_color_cirle',
		    [
		        'label' => esc_html__( 'Icon Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.services-style5 .services-part .icon_image i' => 'background: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style' => 'style5'
		        ]
		    ]
		);

		$this->add_control(
		    'icon_border_color_cirle',
		    [
		        'label' => esc_html__( 'Icon Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.services-style5 .services-part .icon_image i' => 'border-color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style' => 'style5'
		        ]
		    ]
		);

		$this->add_control(
		    'shape_bg_color',
		    [
		        'label' => esc_html__( 'Shape Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.services-style5:before' => 'background: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-addon-services.services-style5:after' => 'border-color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style' => 'style5'
		        ]
		    ]
		);

		$this->add_control(
		    'shape_border_color',
		    [
		        'label' => esc_html__( 'Shape Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.services-style5:before' => 'border-color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style' => 'style5'
		        ]
		    ]
		);

		$this->add_control(
		    'shape_bg_hover_color',
		    [
		        'label' => esc_html__( 'Shape Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.services-style5 .services-part:before, {{WRAPPER}} .rs-addon-services.services-style5:hover:before' => 'background: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-addon-services.services-style5:hover:after' => 'border-color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style' => 'style5'
		        ]
		    ]
		);

		$this->add_control(
		    'serial_text_color',
		    [
		        'label' => esc_html__( 'Serial Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .serial_number' => 'color: {{VALUE}}',
		        ],
				'condition' => [
					'services_serial_number' => 'serial_enable',
				],	
		    ]
		);

		$this->add_control(
		    'serial_text_color_hovers',
		    [
		        'label' => esc_html__( 'Serial Text Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .serial_number' => 'color: {{VALUE}}',
		        ],
				'condition' => [
					'services_serial_number' => 'serial_enable',
				],	
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'serial_text_typography',
		        'label' => esc_html__( 'Serial Text Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-addon-services .serial_number',
				'condition' => [
					'services_serial_number' => 'serial_enable',
				],	
		        'scheme' => Scheme_Typography::TYPOGRAPHY_2
		    ]
		);


		$this->add_responsive_control(
		    'serial_text_padding',
		    [
		        'label' => esc_html__( 'Serial Text Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'condition' => [
					'services_serial_number' => 'serial_enable',
				],	
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .serial_number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		

		$this->end_controls_section();


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
		            '{{WRAPPER}} .services-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
		            '{{WRAPPER}} .services-icon i:before' => 'font-size: {{SIZE}}{{UNIT}} !important;',
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
		            '{{WRAPPER}} .services-icon.icon' => 'min-width: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .services-icon img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'image_height',
		    [
				'label'      => esc_html__( 'Height', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon.icon, {{WRAPPER}} .services-icon img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
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
		            '{{WRAPPER}} .services-icon' => 'line-height: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'separator' => 'before',

		    ]
		);

		$this->add_responsive_control(
            'align_icon',
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
                    '{{WRAPPER}} .rs-addon-services .services-part .services-icon' => 'text-align: {{VALUE}}'
                ],
                'condition' => [
		            'icon_type' => 'icon'
		        ],
                'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
		    'icon_left_position',
		    [
				'label'      => esc_html__( 'Left Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
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
		            'services_style' => 'style3'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
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
		                'min' => 0,
		                'max' => 100,
		            ],
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'condition' => [
		            'services_style' => 'style3'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hvoer .rs-addon-services.services-style3 .services-part
		              .services-icon' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'icon_top_position',
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
		            'services_style' => 'style3'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);


		$this->add_responsive_control(
		    'icon_hover_top_position',
		    [
		        'label' => esc_html__( 'Hover Top Position', 'rsaddon' ),
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
		            'services_style' => 'style3'
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-icon' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
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
		            '(desktop){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x.SIZE || 0}}{{UNIT}}, {{media_offset_y.SIZE || 0}}{{UNIT}}) !important;',
		            '(tablet){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_tablet.SIZE || 0}}{{UNIT}}, {{media_offset_y_tablet.SIZE || 0}}{{UNIT}}) !important;',
		            '(mobile){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}); transform: translate({{media_offset_x_mobile.SIZE || 0}}{{UNIT}}, {{media_offset_y_mobile.SIZE || 0}}{{UNIT}}) !important;',
		            // Body text styles
		            '{{WRAPPER}} .services-text' => 'margin-top: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .services-icon' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
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
		            '{{WRAPPER}} .services-icon > img, {{WRAPPER}} .services-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'media_border',
		        'selector' => '{{WRAPPER}} .services-icon > img, {{WRAPPER}} .services-icon',
		    ]
		);

		$this->add_responsive_control(
		    'media_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-style7 .image_border_shape, {{WRAPPER}} .services-icon > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .services-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'media_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .rs-addon-services.services-style6 .services-part .services-icon, {{WRAPPER}} .services-icon > img, {{WRAPPER}} .rs-addon-services.services-style3 .services-part .services-icon, {{WRAPPER}} .services-icon'
		    ]
		);

		$this->add_control(
		    'icon_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .services-icon' => 'color: {{VALUE}} !important',
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
		            '{{WRAPPER}} .elementor-widget-container:hover .services-part .services-icon' => 'color: {{VALUE}} !important',
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
		            '{{WRAPPER}} .services-style7 .image_border_shape, {{WRAPPER}} .services-icon, {{WRAPPER}} .rs-addon-services .services-icon.icon_animation i:after' => 'background-color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style!' => ['style6', 'style8']
		        ]
		    ]
		);


		$this->add_control(
		    'border_color6',
		    [
		        'label' => esc_html__( 'Icon Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services.services-style6 .services-part .services-icon:before' => 'border-color: {{VALUE}} !important',
		        ],
		        'condition' => [
		            'services_style' => ['style6']
		        ]
		    ]
		);
		

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_color6',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [
		            'services_style' => 'style6',
		        ],
                'selector' => '{{WRAPPER}} .rs-addon-services.services-style6 .services-part .services-icon'
            ]
        );
		

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg_color8',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [
		            'services_style' => 'style8',
		        ],
                'selector' => '{{WRAPPER}} .rs-addon-services.services-style8 .services-icon'
            ]
        );

		$this->add_control(
		    'icon_hover_bg_color',
		    [
		        'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services.services-style8 .services-icon, {{WRAPPER}} .rs-addon-services:hover .services-icon.icon_animation i:after, {{WRAPPER}} .elementor-widget-container .services-part .services-icon' => 'background-color: {{VALUE}} !important',
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
                    '{{WRAPPER}} .rs-addon-services .services-part .services-icon::after' => 'display: {{VALUE}}'
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-icon::after' => 'background-color: {{VALUE}}',
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
		            '(desktop){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(tablet){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(mobile){{WRAPPER}} .services-icon' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		        ],
		    ]
		);

		$this->add_control(
			'icon_animation_type',
			[
				'label'   => esc_html__( 'Icon Shape', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'condition' => [
					'icon_type' => 'icon',
				],			
				'options' => [					
					'no' => esc_html__( 'No', 'rsaddon'),
					'icon_animation' => esc_html__( 'Yes', 'rsaddon'),
					'icon_two_border' => esc_html__( 'Icon Second Border', 'rsaddon'),		
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
		    'icon_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-icon.icon_animation i, {{WRAPPER}} .rs-addon-services .services-icon.icon_animation i:after' => 'width: {{SIZE}}px;',
		        ],
		        'condition' => [
		            'icon_animation_type' => 'icon_animation'
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'icon_height',
		    [
				'label'      => esc_html__( 'Height', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-icon.icon_animation i, {{WRAPPER}} .rs-addon-services .services-icon.icon_animation i:after' => 'height: {{SIZE}}px;',
		        ],
		        'condition' => [
		            'icon_animation_type' => 'icon_animation'
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'icon_line_height',
		    [
				'label'      => esc_html__( 'Line Height', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-icon.icon_animation i:after' => 'line-height: {{SIZE}}px;',
		        ],
		        'condition' => [
		            'icon_animation_type' => 'icon_animation'
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'icon_bg_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} / {{TOP1}}{{UNIT}} {{RIGHT1}}{{UNIT}} {{BOTTOM1}}{{UNIT}} {{LEFT1}}{{UNIT}};',
		        ],
		    ]
		);


		$this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'rsaddon' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
		    'shape_border_width',
		    [
		        'label' => esc_html__( 'Shape Width', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-style7 .image_border_shape' => 'min-width: {{SIZE}}px;',
		        ],
		        'condition' => [
		            'services_style' => 'style7',
		        ],
		        'separator' => 'before',
		    ]
		);

        $this->add_responsive_control(
		    'shape_border_height',
		    [
		        'label' => esc_html__( 'Shape Height', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-style7 .image_border_shape' => 'height: {{SIZE}}px;',
		        ],
		        'condition' => [
		            'services_style' => 'style7',
		        ],
		        'separator' => 'before',
		    ]
		);

        $this->add_responsive_control(
		    'shape_border_line_height',
		    [
		        'label' => esc_html__( 'Shape Line Height', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-style7 .image_border_shape' => 'line-height: {{SIZE}}px;',
		        ],
		        'condition' => [
		            'services_style' => 'style7',
		        ],
		        'separator' => 'before',
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

		$this->add_responsive_control(
		    'content_padding',
		    [
		        'label' => esc_html__( 'Content Box Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'margin_padding',
		    [
		        'label' => esc_html__( 'Content Box Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'selector' => '{{WRAPPER}} .services-text',
		    ]
		);

		$this->add_responsive_control(
		    'content_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .services-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		

		$this->add_responsive_control(
		    'content_bottom_border',
		    [
		        'label' => esc_html__( 'Bottom Border Enable/Disable', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'block' => esc_html__( 'Enable', 'rsaddon'),
		        	'none' => esc_html__( 'Disable', 'rsaddon'),		

		        ],
		        'default' => 'none',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-part::after' => 'display: {{VALUE}};',
                ],
		    ]
		);			

		$this->add_responsive_control(
		    'fixed_bottom_border',
		    [
		        'label' => esc_html__( 'Fixed Bottom Border', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'unset' => esc_html__( 'Enable', 'rsaddon'),
		        	'' => esc_html__( 'Disable', 'rsaddon'),		

		        ],
		        'default' => 'unset',
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services .services-part::after' => 'width: {{VALUE}};',
                ],
		        'condition' => [
		            'content_bottom_border' => 'block',
		        ],
		    ]
		);		

		$this->add_responsive_control(
		    'content_bottom_border_width',
		    [
		        'label' => esc_html__( 'Border Width', 'rsaddon' ),		        
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 0,
		                'max' => 500,
		            ],
		            '%' => [
		                'min' => 0,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part::after' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'fixed_bottom_border' => 'unset',
		        ],
		    ]
		);

		$this->add_control(
		    'offset_border',
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
		    'border_offset_x',
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
		            '(desktop){{WRAPPER}} .rs-addon-services .services-part::after' => '-ms-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}});',
		            '(tablet){{WRAPPER}} .rs-addon-services .services-part::after' => '-ms-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}});',
		            '(mobile){{WRAPPER}} .rs-addon-services .services-part::after' => '-ms-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}});',
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
		            '{{WRAPPER}} .rs-addon-services .services-part::after' => 'height: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .rs-addon-services .services-part::after' => 'left: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .rs-addon-services .services-part::after' => 'background:  {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .services-text'
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
		    'title_margin_spacing',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
		            'services_style' => 'style1'
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title, {{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title a, {{WRAPPER}} .rs-addon-services.services-style8 .services-text .services-titles .title a, {{WRAPPER}} .rs-addon-services.services-style8 .services-text .services-titles .title' => 'color: {{VALUE}}',
		        ],
		    ]
		);



		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		        	'{{WRAPPER}} .elementor-widget-container .rs-addon-services.services-style8:hover .services-part .services-text .services-title .title a,
		        	 {{WRAPPER}} .elementor-widget-container .rs-addon-services .services-part .services-text .services-title .title:hover,
		        	 {{WRAPPER}} .elementor-widget-container:hover .rs-addon-services.services-style8 .services-text .services-titles .title,
		        	 {{WRAPPER}} .elementor-widget-container:hover .rs-addon-services.services-style8 .services-text .services-titles .title a,
		             {{WRAPPER}} .elementor-widget-container .rs-addon-services .services-part .services-text .services-title .title a:hover' => 'color: {{VALUE}}',
		        ],
		    ]
		);


		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-addon-services .services-part .services-title .title, {{WRAPPER}} .rs-addon-services.services-style8 .services-text .services-titles .title a, {{WRAPPER}} .rs-addon-services .services-part .services-title .title a, {{WRAPPER}} .rs-addon-services.services-style8 .services-text .services-titles .title',
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				    '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-title .title::before' => 'color: {{VALUE}}',
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
				    '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-text .services-title .title::before' => 'color: {{VALUE}}',
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
		        'selector' => '{{WRAPPER}}  .rs-addon-services .services-part .services-text .services-title .title::before',
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-txt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-txt' => 'color: {{VALUE}}',
		        ],
		    ]
		);
		

		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services.services-style8 .services-part .services-text .services-txt, {{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-text .services-txt' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-txt',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_3,
		    ]
		);

		$this->end_controls_section();

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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn',
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn',
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_border_bg_color',
		    [
		        'label' => esc_html__( 'Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn .border-right' => 'background: {{VALUE}};',
		        ],
		        'condition' => [
		            'btn_icon_border' => 'btn_border',
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
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-text .services-btn-part .services-btn, {{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-text .services-btn-part:focus .services-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-text .services-btn-part .services-btn, {{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part:focus .services-text .services-btn-part .services-btn' => 'background-color: {{VALUE}};',
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
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-text .services-btn-part, {{WRAPPER}} .elementor-widget-container .rs-addon-services .services-part .services-text .services-btn-part .services-btn:focus' => 'border-color: {{VALUE}};',
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
		            '{{WRAPPER}} .elementor-widget-container:hover .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .elementor-widget-container .rs-addon-services .services-part .services-text .services-btn-part .services-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
        $this->add_inline_editing_attributes( 'services_btn_text', 'basic' );
        $this->add_render_attribute( 'services_btn_text', 'class', 'btn_text' );

        $animation = !empty($settings['hover_animation'])? 'elementor-animation-'.$settings['hover_animation'].'':'';
        $animation_box = !empty($animation) ? 'rs-animation-yes' : '';
		?>
		
		<div class="<?php echo $animation_box;?> rs-addon-services services-<?php echo esc_attr( $settings['services_style'] ); ?> service_shape_<?php echo esc_attr( $settings['btn_on_off'] ); ?> box_shadow_<?php echo esc_attr( $settings['global_style_shadow'] ); ?>">
		    <div class="services-part image-align-<?php echo esc_attr( $settings['icon_type_align'] ); ?>">
		    	<?php if('enable' == $settings['shape_image_enable']){ ?>
			    	<?php if(!empty($settings['shape_image']['url'])) : ?>
		    			<img class="shape-image" src="<?php echo esc_url( $settings['shape_image']['url'] );?>" alt="image"/>
		    		<?php endif;?>
	    		<?php } ?>

		    	<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>

		    			
		    			<?php if('style7' == $settings['services_style']){ ?>
							<div class="image_border_shape">
					    		<div class="services-icon <?php echo  $animation;?> <?php echo esc_html( $settings['icon_type'] );?> <?php echo esc_html( $settings['icon_animation_type'] );?>">

						    		<?php if(!empty($settings['selected_icon'])) : ?>
						    			<i class="fa <?php echo esc_html( $settings['selected_icon'] );?>"></i>
						    		<?php endif; ?>

						    		<?php if(!empty($settings['selected_image'])) :?>
						    			<img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/>
						    		<?php endif;?>

					    		</div>	
				    		</div>	
			    		<?php } else { ?>
			    			<div class="services-icon <?php echo  $animation;?> <?php echo esc_html( $settings['icon_type'] );?> <?php echo esc_html( $settings['icon_animation_type'] );?>">

					    		<?php if(!empty($settings['selected_icon'])) : ?>
					    			<i class="fa <?php echo esc_html( $settings['selected_icon'] );?>"></i>
					    		<?php endif; ?>

					    		
					    		<?php if( !empty($settings['selected_image']['url'])){?>
					    			<img class="main-img" src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/>
					    			
					    		<?php } ?>
					    		<?php if( !empty($settings['selected_image_hover']['url'])){?>					    			
					    			<img class="hover-img" src="<?php echo esc_url( $settings['selected_image_hover']['url'] );?>" alt="image"/>
					    		<?php } ?>

				    		</div>
			    		<?php } ?>


		    	<?php }?>
		    		       
			    <div class="services-text">

			    	<?php if('style5' == $settings['services_style']){ ?>
				    	<?php if( !empty($settings['icon_image'])){?>
				    	 <div class="icon_image">
				    	 	<i class="fa <?php echo esc_html( $settings['icon_image'] );?>"></i>
				    	 </div>
				    	<?php } ?>
			    	<?php } ?>

			    	<?php if('image-hover' == $settings['icon_type']){ ?>
				    	<?php if(!empty($settings['title'])){ ?>
					    	<div class="services-titles">				    		
					    		<?php if(!empty($settings['title_link'])) : 
					    			$link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
					    		?>					    							    			
					    		<<?php echo esc_html($settings['title_tag']);?>  <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>> <a href="<?php echo esc_url($settings['title_link']);?>" <?php echo wp_kses_post($link_open); ?> ><?php echo esc_html($settings['title']);?></a></<?php echo esc_html($settings['title_tag']);?>>
					    		<?php else: ?>
					    			<<?php echo esc_html($settings['title_tag']);?> <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>> <?php echo esc_html($settings['title']);?></<?php echo esc_html($settings['title_tag']);?>>
					    		<?php endif; ?>				    		
					    	</div>
				    	<?php } ?>	
				    <?php } else{ ?>
		    	    	<?php if(!empty($settings['title'])){ ?>
		    		    	<div class="services-title">				    		
		    		    		<?php if(!empty($settings['title_link'])) : 
		    		    			$link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
		    		    		?>					    							    			
		    		    		<<?php echo esc_html($settings['title_tag']);?>  <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>> <a href="<?php echo esc_url($settings['title_link']);?>" <?php echo wp_kses_post($link_open); ?> ><?php echo esc_html($settings['title']);?></a></<?php echo esc_html($settings['title_tag']);?>>
		    		    		<?php else: ?>
		    		    			<<?php echo esc_html($settings['title_tag']);?> <?php  echo wp_kses_post($this->print_render_attribute_string( 'title' )); ?>> <?php echo esc_html($settings['title']);?></<?php echo esc_html($settings['title_tag']);?>>
		    		    		<?php endif; ?>				    		
		    		    	</div>
		    	    	<?php } ?>
				    <?php } ?>

			    	<?php if(!empty($settings['text'])) : ?>
			    		<p <?php  echo wp_kses_post($this->print_render_attribute_string( 'text' )); ?>>  <?php echo wp_kses_post($settings['text']);?></p>	
			    	<?php endif; ?>	



			    	<?php if('style5' == $settings['services_style']){ ?>
			    		<?php if ( $settings['btn_on_off'] ){ ?>
			    	    	<?php if(!empty($settings['services_btn_text']) || !empty($settings['services_btn_icon'])){ ?>
			    		    	<div class="services-btn-part">
			    		    		<?php 
			    		    			$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : ''; 		    		 
			    		    			$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
			    		    		?>
			    		    		
		    		    			<a class="services-btn <?php echo esc_html($icon_position); ?>" href="<?php echo esc_url($settings['services_btn_link']);?>" <?php echo wp_kses_post($link_open); ?>>

		    		    				<span <?php echo wp_kses_post($this->print_render_attribute_string( 'services_btn_text' )); ?>>
		    		    					<?php echo esc_html($settings['services_btn_text']);?>    						
		    		    				</span>

		    		    				<?php if(!empty($settings['services_btn_icon'])) : ?>
		    		    					<i class="<?php echo esc_html($settings['services_btn_icon']);?>"></i>
		    		    				<?php endif; ?>

		    		    			</a>
			    		    	</div>
			    	    <?php } } ?>

	    	    	<?php } else{ ?>
	    	    		<?php if(!empty($settings['services_btn_text'])){ ?>
		    		    	<div class="services-btn-part">
		    		    		<?php 
		    		    			$link_open = $settings['services_btn_link_open'] == 'yes' ? 'target=_blank' : ''; 		    		 
		    		    			$icon_position = $settings['services_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
		    		    		?>



		    		    		
	    		    			<a class="services-btn <?php echo esc_html($icon_position); ?>" href="<?php echo esc_url($settings['services_btn_link']);?>" <?php echo wp_kses_post($link_open); ?>>

	    		    				<span <?php echo wp_kses_post($this->print_render_attribute_string( 'services_btn_text' )); ?>>
	    		    					<?php echo esc_html($settings['services_btn_text']);?>    						
	    		    				</span>

	    		    				<?php if('btn_icon' == $settings['btn_icon_border']){ ?>
		    		    				<?php if(!empty($settings['services_btn_icon'])) : ?>
		    		    					<i class="<?php echo esc_html($settings['services_btn_icon']);?>"></i>
		    		    				<?php endif; ?>
	    		    				<?php } else{ ?>
	    		    					<span class="border-right"></span>
	    		    				<?php } ?>


	    		    			</a>
		    		    	</div>
		    		    	
		    	    	<?php } 
	    	    	}?>
	    	    	<?php if(!empty($settings['serial_text'])) { ?>
    		    		<div class="serial_number <?php echo esc_html($settings['serial_number_position']);?>">
    		    			<?php echo esc_html($settings['serial_text']);?> 
    		    		</div>
    		    	<?php } ?>




			    </div>
			</div>
		</div>	
		
	<?php
	}
}
