<?php
/**
 * Elementor RS Couter Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSCounter_Widget extends \Elementor\Widget_Base {

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
		return 'rs-counter';
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
		return esc_html__( 'RS Counter', 'rsaddon' );
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
		return 'glyph-icon flaticon-count';
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
		return [ 'counter' ];
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
			'section_counter',
			[
				'label' => esc_html__( 'Counter', 'rsaddon' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Counter Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rsaddon'),
					'style2' => esc_html__( 'Style 2', 'rsaddon'),
					'style3' => esc_html__( 'Style 3', 'rsaddon'),
					

				],
			]
		);
	
		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Counter Number', 'rsaddon' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Number Prefix', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Prefix', 'rsaddon' ),
				'separator' => 'before',
			]
			
		);

		$this->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Number Suffix', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 'Suffix',
				'separator' => 'before',
			]
		);

		
		
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Counter Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Happy Clients', 'rsaddon' ),
				'placeholder' => esc_html__( 'Clients', 'rsaddon' ),
				'separator' => 'before',
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
				'label' => esc_html__( 'Select Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICON,
				'options' => rsaddon_pro_get_icons(),				
				'default' => 'fa fa-smile-o',
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
				'type' => \Elementor\Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
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
                    '{{WRAPPER}} .counter-top-area' => 'text-align: {{VALUE}}'
                ],                
				'separator' => 'before',
				'condition' => [
					'style' => 'style1',
				],
            ]
        );

		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_number',
			[
				'label' => esc_html__( 'Number', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'number_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .counter-top-area:hover .count-number span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'rsaddon' ),
				'name' => 'typography_number',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .count-number span',
			]
		);

		$this->add_control(
		    'number_top_spacing',
		    [
		    	'label' => esc_html__( 'Padding', 'rsaddon' ),
		    	'type' => Controls_Manager::DIMENSIONS,
		    	'size_units' => [ 'px', 'em', '%' ],
		    	'selectors' => [
		    	    '{{WRAPPER}} .count-number span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		    	],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Sufix Typography', 'rsaddon' ),
				'name' => 'typography_suffix',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .count-number span.suffix',
			]
		);

		$this->add_control(
			'prefix_color',
			[
				'label' => esc_html__( 'Sufix Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span.prefix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Prefix Typography', 'rsaddon' ),
				'name' => 'typography_prefix',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .count-number span.prefix',
			]
		);

		$this->add_control(
			'stroke_color_yes_no',
			[
				'label'   => esc_html__( 'Stroke Color Enable/Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'disable',
				'options' => [					
					'enable' => esc_html__( 'Enable', 'rsaddon'),
					'disable' => esc_html__( 'Disable', 'rsaddon'),
				],
			]
		);

        $this->add_control(
			'stroke_number_color',
			[
				'label' => esc_html__( 'Stroke Inside Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span' => '-webkit-text-fill-color: {{VALUE}};',
				],
				'condition' => [
		            'stroke_color_yes_no' => 'enable'
		        ],
			]
		);

        $this->add_control(
			'stroke_outside_number_color',
			[
				'label' => esc_html__( 'Stroke Outside Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .count-number span' => '-webkit-text-stroke-color: {{VALUE}};',
				],
				'condition' => [
		            'stroke_color_yes_no' => 'enable'
		        ],
			]
		);

        $this->add_control(
			'stroke_number_width',
			[
				'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::TEXT,
		        'size_units' => [ 'px' ],			
				'selectors' => [
					'{{WRAPPER}} .count-number span' => '-webkit-text-stroke-width: {{SIZE}}px;',
				],
				'condition' => [
		            'stroke_color_yes_no' => 'enable'
		        ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				],
				'selectors' => [
					'{{WRAPPER}} .count-text .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .counter-top-area:hover .count-text .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_title',				
				'selector' => '{{WRAPPER}} .count-text .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

				$this->add_responsive_control(
		            'icon_align',
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
		                    '{{WRAPPER}} .counter-icon' => 'text-align: {{VALUE}}'
		                ],                
						'separator' => 'before',
		            ]
		        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'rsaddon' ),
				'name' => 'typography_icon',				
				'selector' => '{{WRAPPER}} .counter-icon i',
		        'condition' => [
		            'icon_type' => 'icon'
		        ]
			]
		);

		$this->add_responsive_control(
		    'icon_width',
		    [
		        'label' => esc_html__( 'Icon/Image Part Width', 'rsaddon' ),
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
		            '{{WRAPPER}} .counter-icon' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_height',
		    [
		        'label' => esc_html__( 'Icon/Image Part Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_line_height',
		    [
		        'label' => esc_html__( 'Icon/Image Part Line Height', 'rsaddon' ),
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
		            '{{WRAPPER}} .counter-icon, {{WRAPPER}} .counter-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
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
		            '{{WRAPPER}} .counter-icon img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                  'icon_type' => 'image'
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
		            '{{WRAPPER}} .counter-icon img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                  'icon_type' => 'image'
                ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Icon Part Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_margin',
		    [
		        'label' => esc_html__( 'Icon Part Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->start_controls_tabs( 'back_part_btn_tabs' );

		    $this->start_controls_tab(
		        'icon_tabs_normal',
		        [
		            'label' => esc_html__( 'Normal', 'rsaddon' ),
		        ]
		    );
		    	$this->add_group_control(
		    	    Group_Control_Border::get_type(),
		    	    [
		    	        'name' => 'icon_part_border',
		    	        'selector' => '{{WRAPPER}} .counter-icon',
		    	    ]
		    	);

				$this->add_control(
				    'icon_part_border_radius',
				    [
				        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

		    	$this->add_group_control(
		    	    Group_Control_Box_Shadow::get_type(),
		    	    [
		    	        'name' => 'icon_part_box_shadow',
		    	        'selector' => '{{WRAPPER}} .counter-icon',
		    	    ]
		    	);

				$this->add_control(
					'icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,				
						'selectors' => [
							'{{WRAPPER}} .counter-icon i' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
				    Group_Control_Background::get_type(),
				    [
				        'name' => 'icon_part_bg',
				        'label' => esc_html__( 'Background', 'rsaddon' ),
				        'types' => [ 'classic', 'gradient' ],
				        'selector' => '{{WRAPPER}} .counter-icon',
				    ]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
			    'icon_tabs_hover',
			    [
			        'label' => esc_html__( 'Hover', 'rsaddon' ),
			    ]
			);
				$this->add_group_control(
				    Group_Control_Border::get_type(),
				    [
				        'name' => 'icon_part_hover_border',
				        'selector' => '{{WRAPPER}} .counter-top-area:hover .counter-icon',
				    ]
				);

				$this->add_control(
				    'icon_part_hover_border_radius',
				    [
				        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
				        'type' => Controls_Manager::DIMENSIONS,
				        'size_units' => [ 'px', '%' ],
				        'selectors' => [
				            '{{WRAPPER}} .counter-top-area:hover .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				        ],
				    ]
				);

				$this->add_group_control(
				    Group_Control_Box_Shadow::get_type(),
				    [
				        'name' => 'icon_part_hover_box_shadow',
				        'selector' => '{{WRAPPER}} .counter-top-area:hover .counter-icon',
				    ]
				);

				$this->add_control(
					'icon_hover_color',
					[
						'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
						'type' => Controls_Manager::COLOR,				
						'selectors' => [
							'{{WRAPPER}} .counter-top-area:hover .counter-icon i' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
				    Group_Control_Background::get_type(),
				    [
				        'name' => 'icon_part_hover_bg',
				        'label' => esc_html__( 'Background', 'rsaddon' ),
				        'types' => [ 'classic', 'gradient' ],
				        'selector' => '{{WRAPPER}} .counter-icon',
				    ]
				);

		    $this->end_controls_tab();
		$this->end_controls_tab();
	$this->end_controls_section();
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
		$this->add_inline_editing_attributes( 'suffix', 'basic' );
        $this->add_render_attribute( 'suffix', 'class', 'suffix' );	

        $this->add_inline_editing_attributes( 'number', 'basic' );
        $this->add_render_attribute( 'number', 'class', 'rs-counter' );

        $this->add_inline_editing_attributes( 'prefix', 'basic' );
        $this->add_render_attribute( 'prefix', 'class', 'prefix' );	

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'title' );	

		?>
		<div class="counter-top-area <?php echo esc_attr( $settings['style']);?>">
		    <div class="rs-counter-list">
		    	
		    	<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>
		    		<div class="counter-icon">
			    		<?php if(!empty($settings['selected_icon'])) : ?>
			    			<i class="fa <?php echo esc_html($settings['selected_icon']);?>"></i>
			    		<?php endif; ?>

			    		<?php if(!empty($settings['selected_image'])) :?>
			    			<img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="image"/>
			    		<?php endif;?>
		    		</div>	

		    	<?php }?>
		    		       
			    <div class="count-text">
			    	<div class="count-number">
			    		<?php if($settings['suffix']) :?><span <?php echo wp_kses_post($this->print_render_attribute_string('suffix'));?>><?php echo esc_html($settings['suffix']);?></span><?php endif; ?>
			    			<span <?php echo wp_kses_post($this->print_render_attribute_string('number'));?>> <?php echo esc_html($settings['number']);?></span>
			    		<?php if($settings['prefix']) :?><span <?php echo wp_kses_post($this->print_render_attribute_string('prefix'));?>><?php echo esc_html($settings['prefix']);?></span><?php endif; ?>
			    	</div>

			    	<?php if(!empty($settings['title'])) : ?>
			    		<span <?php echo wp_kses_post($this->print_render_attribute_string('title'));?>>  <?php echo esc_html($settings['title']);?></span>	
			    	<?php endif; ?>	

			    </div>
			</div>
		</div>		
	<?php
	}
}
