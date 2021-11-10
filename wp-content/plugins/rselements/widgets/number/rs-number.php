<?php
/**
 * Elementor RS Couter Widget.
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

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSnumber_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rs-number-grid';
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
		return esc_html__( 'Number Grid', 'rsaddon' );
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
		return 'glyph-icon flaticon-one';
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
	 * Register number widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function _register_controls() {



		$this->start_controls_section(
			'section_number',
			[
				'label' => esc_html__( 'Global Style', 'rsaddon' ),
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
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-number .number-part' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->end_controls_section();


		//Star Number Prefix
		$this->start_controls_section(
			'number_prefix_section',
			[
				'label' => esc_html__( 'Number Prefix', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number_prefix',
			[
				'label'       => esc_html__( 'Number Prefix', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '1',
				'placeholder' => esc_html__( 'Number Prefix', 'rsaddon' ),
				'separator'   => 'before',
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
		    ]
		);

		$this->end_controls_section();
		//End Number Prefix

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
				'label'       => esc_html__( 'Number Title', 'rsaddon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Number Title',
				'placeholder' => esc_html__( 'Number Title', 'rsaddon' ),
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
				'label' => esc_html__( 'Number Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Quisque placerat vitae lacus ut scelerisque. Fusce luctus odio ac nibh luctus, in porttitor theo lacus egestas. Dummy text generator', 'rsaddon'),
		
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
			'number_btn_text',
			[
				'label' => esc_html__( 'Number Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( 'Number Button Text', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'number_btn_link',
			[
				'label' => esc_html__( 'Number Button Link', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( '#', 'rsaddon' ),			
			]
		);

		$this->add_control(
			'number_btn_link_open',
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
			'number_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICON,
				'options' => rsaddon_pro_get_icons(),				
				'default' => 'fa fa-angle-right',
				'separator' => 'before',			
			]
		);

		$this->add_control(
		    'number_btn_icon_position',
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
		            'number_btn_icon!' => '',
		        ],
		    ]
		); 

		$this->add_control(
		    'number_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'condition' => [
		            'number_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();



		$this->start_controls_section(
		    '_number_section_media_style',
		    [
		        'label' => esc_html__( 'Number Prefix', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);


		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'mun_prefix_border',
		        'selector' => '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area:before',
		    ]
		);
	

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'number_prefix_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-addon-number .number-part .number-text .number-prefix',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_2,
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		    ]
		);	

		
		$this->add_responsive_control(
		    'number_prefix_width_color',
		    [
		        'label' => esc_html__( 'Background Area Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 50,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area' => 'width: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'number_prefix_hight_color',
		    [
		        'label' => esc_html__( 'Background Area Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 50,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area' => 'height: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'number_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);


		$this->add_responsive_control(
		    'number_left_position',
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
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'number_hover_left_position',
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
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number:hover .number-part .number-text .number-area' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'number_top_position',
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
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);


		$this->add_responsive_control(
		    'number_hover_top_position',
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
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number:hover .number-part .number-text .number-area' => 'top: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'number_bg_rotate',
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
		            '(desktop){{WRAPPER}} .rs-addon-number .number-part .number-text .number-area:before' => '-ms-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x.SIZE || 0}}px, {{media_offset_y.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(tablet){{WRAPPER}} .rs-addon-number .number-part .number-text .number-area:before' => '-ms-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_tablet.SIZE || 0}}px, {{media_offset_y_tablet.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		            '(mobile){{WRAPPER}} .rs-addon-number .number-part .number-text .number-area:before' => '-ms-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); -webkit-transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg); transform: translate({{media_offset_x_mobile.SIZE || 0}}px, {{media_offset_y_mobile.SIZE || 0}}px) rotate({{SIZE}}deg) !important;',
		        ],
		    ]
		);
		$this->add_control(
		    'number_prefix_margin',
		    [
		        'label' => esc_html__( 'Prefix Gap', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
		    ]
		);	
		$this->start_controls_tabs( '_tabs_number' );
		$this->start_controls_tab(
		    '_tab_number_normal',
		    [
		        'label' => esc_html__( 'Normal', 'rsaddon' ),
		    ]


		);

		$this->add_control(
			'number_prefix_text_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-prefix' => 'color: {{VALUE}}',
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
			]
		);

		$this->add_control(
			'number_prefix_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-area:before' => 'background: {{VALUE}}',
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_number_hover',
		    [
		        'label' => esc_html__( 'Hover', 'rsaddon' ),
		    ]
		);



		$this->add_control(
			'number_border_color',
			[
				'label' => esc_html__( 'Border Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-addon-number:hover .number-part .number-text .number-area:before' => 'border-color: {{VALUE}}',
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
			]
		);

		$this->add_control(
			'number_prefix_text_hover_color',
			[
				'label' => esc_html__( 'Number Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-addon-number:hover .number-part .number-text .number-prefix' => 'color: {{VALUE}}',
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
			]
		);	

		$this->add_control(
			'number_prefix_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
				    '{{WRAPPER}} .rs-addon-number:hover .number-part .number-text .number-area:before' => 'background: {{VALUE}}',
				],
		        'condition' => [
		            'title_prefix' => 'block'
		        ],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
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
		            '{{WRAPPER}} .number-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'selector' => '{{WRAPPER}} .number-text',
		    ]
		);

		$this->add_responsive_control(
		    'content_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .number-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .rs-addon-number .number-part::after' => 'display: {{VALUE}};',
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
                    '{{WRAPPER}} .rs-addon-number .number-part::after' => 'width: {{VALUE}};',
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
		            '{{WRAPPER}} .rs-addon-number .number-part::after' => 'width: {{SIZE}}{{UNIT}};',
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
		            '(desktop){{WRAPPER}} .rs-addon-number .number-part::after' => '-ms-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}}); transform: translate({{border_offset_x.SIZE}}{{UNIT}}, {{border_offset_y.SIZE}}{{UNIT}});',
		            '(tablet){{WRAPPER}} .rs-addon-number .number-part::after' => '-ms-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_tablet.SIZE}}{{UNIT}}, {{border_offset_y_tablet.SIZE}}{{UNIT}});',
		            '(mobile){{WRAPPER}} .rs-addon-number .number-part::after' => '-ms-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); -webkit-transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}}); transform: translate({{border_offset_x_mobile.SIZE}}{{UNIT}}, {{border_offset_y_mobile.SIZE}}{{UNIT}});',
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
		            '{{WRAPPER}} .rs-addon-number .number-part::after' => 'height: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .rs-addon-number .number-part::after' => 'left: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .rs-addon-number .number-part::after' => 'background:  {{VALUE}};',
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
		        'selector' => '{{WRAPPER}} .number-text'
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
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-title .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-title .title, {{WRAPPER}}  .rs-addon-number .number-part .number-text .number-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part:hover .number-text .number-title .title, {{WRAPPER}}  .rs-addon-number .number-part:hover .number-text .number-title .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}}  .rs-addon-number .number-part .number-title .title',
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
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-txt' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-txt' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part:hover .number-text .number-txt' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'rsaddon' ),
		        'selector' => '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-txt',
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
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_4,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .number-btn',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn',
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
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn' => 'background-color: {{VALUE}};',
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
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
		            '{{WRAPPER}} .rs-addon-number .number-part:hover .number-text .number-btn-part .number-btn, {{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part:focus .number-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-addon-number .number-part:hover .number-text .number-btn-part .number-btn, {{WRAPPER}} .rs-addon-number .number-part:focus .number-text .number-btn-part .number-btn' => 'background-color: {{VALUE}};',
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
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn:hover, {{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn:focus' => 'border-color: {{VALUE}};',
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
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn.icon-before:hover i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .rs-addon-number .number-part .number-text .number-btn-part .number-btn.icon-after:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
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
            $this->add_render_attribute( 'text', 'class', 'number-txt' );	

            $this->add_inline_editing_attributes( 'number_prefix', 'basic' );
            $this->add_render_attribute( 'number_prefix', 'class', 'number-prefix' );

            $this->add_inline_editing_attributes( 'number_btn_text', 'basic' );
            $this->add_render_attribute( 'number_btn_text', 'class', 'btn-txt' );

		?>			
		<div class="rs-addon-number number">
		    <div class="number-part">	    		       
			    <div class="number-text">
			    	<?php if(!empty($settings['number_prefix'])) : ?>
			    		<div class="number-area">
				    		<span <?php echo wp_kses_post($this->print_render_attribute_string('number_prefix')); ?>>
				    			<?php echo esc_html( $settings['number_prefix'] );?>
				    		</span>
			    		</div>
		    		<?php endif; ?>

			    	<?php if(!empty($settings['title'])){ ?>
				    	<div class="number-title">
				    		<?php if(!empty($settings['title_link'])) : 
				    			$link_open = $settings['link_open'] == 'yes' ? 'target=_blank' : '';
				    		?>	
				    							    			
				    		<<?php echo esc_html( $settings['title_tag'] );?> class="title"> <a <?php echo wp_kses_post($this->print_render_attribute_string('title')); ?> href="<?php echo esc_url($settings['title_link']);?>" <?php echo wp_kses_post( $link_open ); ?>><?php echo esc_html($settings['title']);?></a></<?php echo  esc_html( $settings['title_tag'] );?>>
				    		<?php else: ?>
				    			<<?php echo esc_html( $settings['title_tag']);?> <?php echo wp_kses_post($this->print_render_attribute_string('title')); ?>> <?php echo esc_html( $settings['title'] );?></<?php echo esc_html( $settings['title_tag'] );?>>
				    		<?php endif;
				    		?>
				    		
				    	</div>
			    	<?php } ?>	

			    	<?php if(!empty($settings['text'])) : ?>
			    		<p <?php echo wp_kses_post($this->print_render_attribute_string('text'));?>>  <?php echo wp_kses_post( $settings['text'] );?></p>	
			    	<?php endif; ?>	

	    	    	<?php if(!empty($settings['number_btn_text'])){ ?>

	    		    	<div class="number-btn-part">

	    		    		<?php if(!empty($settings['number_btn_link'])) : 

								$link_open     = $settings['number_btn_link_open'] == 'yes' ? 'target=_blank' : '';    		    		
								$icon_position = $settings['number_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';

	    		    		?>
    		    			<a class="number-btn <?php echo esc_attr( $icon_position ); ?>" href="<?php echo esc_url($settings['number_btn_link']);?>" <?php echo wp_kses_post( $link_open ); ?>>

    		    				<span <?php echo wp_kses_post($this->print_render_attribute_string('number_btn_text'));?>><?php echo esc_html( $settings['number_btn_text'] );?></span>

    		    				<?php if(!empty($settings['number_btn_icon'])) : ?>
    		    					<i class="fa <?php echo esc_html ($settings['number_btn_icon'] );?>"></i>
    		    				<?php endif; ?>
    		    			</a>
	    		    		<?php else: ?>
	    		    		<?php endif; ?>	    		    		
	    		    	</div>
	    	    	<?php } ?>
			    </div>
			</div>
		</div>				
	<?php
	}
}
