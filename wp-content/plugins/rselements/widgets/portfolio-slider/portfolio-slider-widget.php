<?php
/**
 * Elementor rsgallery Widget.
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
use Elementor\Group_Control_Background;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Portfolio_Slider_Pro_Widget extends \Elementor\Widget_Base {

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
		return 'portfolio-slider';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Portfolio Slider', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-slider-3';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
        return [ 'rsaddon_category' ];
    }

	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

	  
		

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'portfolio_slider_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2',
					'3' => 'Style 3',					
					'4' => 'Style 4',					
					'5' => 'Style 5',					
					'6' => 'Style 6',					
				],											
			]
		);


		$this->add_control(
			'portfolio_category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',		
			]

		);

		

		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Portfolio Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'rsaddon' ),
				'separator' => 'before',
			]
		);		

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );  

        $this->end_controls_section();


		$this->start_controls_section(
			'content_slider',
			[
				'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

	
		$this->add_control(
			'col_lg',
			[
				'label'   => esc_html__( 'Desktops > 1199px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3,
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]			
		);


		$this->add_control(
			'slider_centers_pad3',
			[
				'label'   => esc_html__( 'Center Mode Padding', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',				
				'separator' => 'before',	
				'condition' => [
				    'slider_centerMode' => 'true',
				]						
			]			
		);
		


		$this->add_control(
			'col_md',
			[
				'label'   => esc_html__( 'Desktops > 991px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3,			
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),						
				],
				'separator' => 'before',							
			]			
		);

		$this->add_control(
			'slider_centers_pad',
			[
				'label'   => esc_html__( 'Center Mode Padding', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',				
				'separator' => 'before',	
				'condition' => [
				    'slider_centerMode' => 'true',
				]						
			]			
		);

		$this->add_control(
			'col_sm',
			[
				'label'   => esc_html__( 'Tablets > 767px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 2,			
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]			
		);

		$this->add_control(
			'slider_centers_pad2',
			[
				'label'   => esc_html__( 'Center Mode Padding', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',				
				'separator' => 'before',	
				'condition' => [
				    'slider_centerMode' => 'true',
				]						
			]			
		);

		$this->add_control(
			'col_xs',
			[
				'label'   => esc_html__( 'Tablets < 768px', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 1,			
				'options' => [
					'1' => esc_html__( '1 Column', 'rsaddon' ),	
					'2' => esc_html__( '2 Column', 'rsaddon' ),
					'3' => esc_html__( '3 Column', 'rsaddon' ),
					'4' => esc_html__( '4 Column', 'rsaddon' ),
					'6' => esc_html__( '6 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slides_ToScroll',
			[
				'label'   => esc_html__( 'Slide To Scroll', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 2,			
				'options' => [
					'1' => esc_html__( '1 Item', 'rsaddon' ),
					'2' => esc_html__( '2 Item', 'rsaddon' ),
					'3' => esc_html__( '3 Item', 'rsaddon' ),
					'4' => esc_html__( '4 Item', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
			
		);		

		$this->add_control(
			'slider_dots',
			[
				'label'   => esc_html__( 'Navigation Dots', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 'false',
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_nav',
			[
				'label'   => esc_html__( 'Navigation Nav', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 'false',			
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_autoplay',
			[
				'label'   => esc_html__( 'Autoplay', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 'false',			
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_autoplay_speed',
			[
				'label'   => esc_html__( 'Autoplay Slide Speed', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3000,			
				'options' => [
					'1000' => esc_html__( '1 Seconds', 'rsaddon' ),
					'2000' => esc_html__( '2 Seconds', 'rsaddon' ),	
					'3000' => esc_html__( '3 Seconds', 'rsaddon' ),	
					'4000' => esc_html__( '4 Seconds', 'rsaddon' ),	
					'5000' => esc_html__( '5 Seconds', 'rsaddon' ),	
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_stop_on_hover',
			[
				'label'   => esc_html__( 'Stop on Hover', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',				
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),				
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_interval',
			[
				'label'   => esc_html__( 'Autoplay Interval', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 3000,			
				'options' => [
					'5000' => esc_html__( '5 Seconds', 'rsaddon' ),	
					'4000' => esc_html__( '4 Seconds', 'rsaddon' ),	
					'3000' => esc_html__( '3 Seconds', 'rsaddon' ),	
					'2000' => esc_html__( '2 Seconds', 'rsaddon' ),	
					'1000' => esc_html__( '1 Seconds', 'rsaddon' ),		
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_loop',
			[
				'label'   => esc_html__( 'Loop', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),
				],
				'separator' => 'before',
							
			]
			
		);

		$this->add_control(
			'slider_centerMode',
			[
				'label'   => esc_html__( 'Center Mode', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'false',
				'options' => [
					'true' => esc_html__( 'Enable', 'rsaddon' ),
					'false' => esc_html__( 'Disable', 'rsaddon' ),
				],
				'separator' => 'before',							
			]			
		);

		$this->add_control(
			'slider_centerMode_pad',
			[
				'label'   => esc_html__( 'Center Mode Padding', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',				
				'separator' => 'before',	
				'condition' => [
				    'slider_centerMode' => 'true',
				]						
			]			
		);

		$this->add_responsive_control(
			'item_gap_custom',
			[
				'label' => esc_html__( 'Item Gap', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,				
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 15,
				],			

				'selectors' => [
                    '{{WRAPPER}} .rs-addon-sliders .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',                    
                ],
			]
		); 
				
		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

         $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-title > a, {{WRAPPER}} .rs-portfolio .portfolio-item .p-title a' => 'color: {{VALUE}};',                   

                ],                
            ]
        );



        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-title > a:hover, {{WRAPPER}} .slider-style-5 .rs-portfolio4 .portfolio-item .portfolio-inner .p-title a:hover, {{WRAPPER}} .rs-portfolio .portfolio-item .p-title a:hover, {{WRAPPER}} .rs-portfolio-style3 .portfolio-item .portfolio-content h4 a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-title > a, {{WRAPPER}} .p-title a',                    
			]
		);


        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-title .p-category a, {{WRAPPER}} .p-category a' => 'color: {{VALUE}};',                   

                ],                
            ]
        );

        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-title .p-category a:hover, {{WRAPPER}} .p-category a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );  

        $this->add_control(
            'icon_color6',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-icon i' => 'color: {{VALUE}};',                   

                ], 
                'condition' => [
		            'portfolio_slider_style' => '6',
		        ],               
            ]
        ); 

        $this->add_control(
            'icon_bg_color6',
            [
                'label' => esc_html__( 'Icon Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item .portfolio-content .p-icon i' => 'background: {{VALUE}};',                   

                ], 
                'condition' => [
		            'portfolio_slider_style' => '6',
		        ],               
            ]
        ); 

        $this->add_control(
            'item_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item:before' => 'background: {{VALUE}};',                   

                ], 
                'condition' => [
		            'portfolio_slider_style' => '6',
		        ],               
            ]
        ); 

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'text_bg_color',
                'label' => esc_html__( 'Text Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'condition' => [
		            'portfolio_slider_style' => '5',
		        ],
                'selector' => '{{WRAPPER}} .slider-style-5 .rs-portfolio4 .portfolio-item .portfolio-inner'
            ]
        );


        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .portfolio-content:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .slider-style-5 .rs-portfolio4 .portfolio-item' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-portfolio-style3 .portfolio-item .portfolio-content' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item:before' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'style_overly_bg',
                'label' => esc_html__( 'Overlay Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-portfolio-slider.slider-style-6 .portfolio-item:after',
                'condition' => [
		            'portfolio_slider_style' => '6'
		        ]
            ]
        );
      
        $this->add_control(
			'arrow_options',
			[
				'label' => esc_html__( 'Arrow Style', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_responsive_control(
		    'arrow_left_position',
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
		                'min' => -1000,
		                'max' => 1000,
		            ],
		        ],
		        'condition' => [
				    'slider_centerMode' => 'true',
				],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider.slider-style-5 .rs-addon-sliders .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-sliders .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);	

		$this->add_responsive_control(
		    'arrow_right_position',
		    [
				'label'      => esc_html__( 'Right Position', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
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
		        'condition' => [
				    'slider_centerMode' => 'true',
				],
		        'selectors' => [
		            '{{WRAPPER}} .rs-portfolio-slider.slider-style-5 .rs-addon-sliders .slick-next' => 'right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .rs-addon-sliders .slick-next' => 'right: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);


        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-sliders .slick-next, .rs-addon-sliders .slick-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-sliders .slick-next, .rs-addon-sliders .slick-next' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-sliders .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-sliders .slick-prev::before' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'ars_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
        		    'arrows_custom_style' => 'custom',
        		],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-next, {{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-prev' => 'border-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_control(
        	'arrows_custom_style',
        	[
        		'label'   => esc_html__( 'Select Arrow Style', 'rsaddon' ),
        		'type'    => Controls_Manager::SELECT,
        		'default' => 'default',				
        		'options' => [
        			'default' => 'Default',
        			'custom' => 'Custom',					
        		],
		        'condition' => [
				    'portfolio_slider_style' => '3',
				],											
        	]
        );


        $this->add_responsive_control(
            'arrows_tops_positions',
            [
        		'label'      => esc_html__( 'Top Position', 'rsaddon' ),
        		'type'       => Controls_Manager::SLIDER,
        		'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
        		    'arrows_custom_style' => 'custom',
        		],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );	

        $this->add_responsive_control(
            'arrows_lefts_positions',
            [
        		'label'      => esc_html__( 'Left Position', 'rsaddon' ),
        		'type'       => Controls_Manager::SLIDER,
        		'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
        		    'arrows_custom_style' => 'custom',
        		],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );	

        $this->add_responsive_control(
            'arrow_tos_positions',
            [
        		'label'      => esc_html__( 'Top Position', 'rsaddon' ),
        		'type'       => Controls_Manager::SLIDER,
        		'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
        		    'arrows_custom_style' => 'custom',
        		],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'arrows_rights_positions',
            [
        		'label'      => esc_html__( 'Right Position', 'rsaddon' ),
        		'type'       => Controls_Manager::SLIDER,
        		'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'px' => [
                        'min' => -5000,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
        		    'arrows_custom_style' => 'custom',
        		],
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rs-portfolio-slider.rs-portfolio-style3.rs-custom .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );


        $this->add_control(
			'bullet_options',
			[
				'label' => esc_html__( 'Bullet Style', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-sliders .slick-dots li button' => 'border-color: {{VALUE}};',

                ],                
            ]
        );



        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-sliders .slick-dots li button:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-sliders .slick-dots li.slick-active button' => 'background: {{VALUE}};',

                ],                
            ]
        );

          $this->add_control(
			'bullet_spacing_custom',
			[
				'label' => esc_html__( 'Top Gap', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,				
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 25,
				],			

				'selectors' => [
                    '{{WRAPPER}} .rs-addon-sliders .slick-dots' => 'margin-bottom:-{{SIZE}}{{UNIT}};',                    
                ],
			]
		); 

        

		$this->end_controls_section();
	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings              = $this->get_settings_for_display();				
		$slidesToShow          = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;		
		$autoplaySpeed         = $settings['slider_autoplay_speed'];
		$interval              = $settings['slider_interval'];
		$slidesToScroll        = $settings['slides_ToScroll'];
		$slider_autoplay       = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
		$pauseOnHover          = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
		$sliderDots            = $settings['slider_dots'] == 'true' ? 'true' : 'false';
		$sliderNav             = $settings['slider_nav'] == 'true' ? 'true' : 'false';		
		$infinite              = $settings['slider_loop'] === 'true' ? 'true' : 'false';
		$centerMode            = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
		$slider_centerMode_pad = !empty($settings['slider_centerMode_pad']) ? $settings['slider_centerMode_pad'] : '400px';
		$col_lg                = $settings['col_lg'];
		$col_md                = $settings['col_md'];
		$col_sm                = $settings['col_sm'];
		$col_xs                = $settings['col_xs'];
		$slider_centers_pad    = $settings['slider_centers_pad'];
		$slider_centers_pad2   = $settings['slider_centers_pad2'];
		$slider_centers_pad3   = $settings['slider_centers_pad3'];

		$unique = rand(2012,35120);

		$slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs', 'slider_centerMode_pad', 'slider_centers_pad', 'slider_centers_pad2', 'slider_centers_pad3');	

		?>	 

		<div class="rsaddon-unique-slider rs-addon-slider rs-portfolio-slider rs-portfolio rs-portfolio-style<?php echo esc_attr($settings['portfolio_slider_style']); ?> slider-style-<?php echo esc_attr($settings['portfolio_slider_style']); ?> rs-<?php echo esc_attr($settings['arrows_custom_style']); ?> ">
			<div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-sliders">
			 <?php 	if('1' == $settings['portfolio_slider_style']){ 
					include plugin_dir_path(__FILE__)."/style1.php";
				}

				if('2' == $settings['portfolio_slider_style']){
					include plugin_dir_path(__FILE__)."/style2.php";
				}

				if('3' == $settings['portfolio_slider_style']){
					include plugin_dir_path(__FILE__)."/style3.php";
				}

				if('4' == $settings['portfolio_slider_style']){
					include plugin_dir_path(__FILE__)."/style4.php";
				}

				if('5' == $settings['portfolio_slider_style']){
					include plugin_dir_path(__FILE__)."/style5.php";
				}

				if('6' == $settings['portfolio_slider_style']){
					include plugin_dir_path(__FILE__)."/style6.php";
				}				
				
			?>
		</div>
		<div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
	</div>
	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			jQuery( '.rs-addon-sliders' ).each(function( index ) {        
	        var slider_id       = jQuery(this).attr('id'); 
	        var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
	      
	        if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            jQuery('#'+slider_id).not('.slick-initialized').slick({
            slidesToShow    : parseInt(slider_conf.col_lg),
            centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
            dots            : (slider_conf.sliderDots)  == "true" ? true : false,
            arrows          : (slider_conf.sliderNav) == "true" ? true : false,
            autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
            slidesToScroll  : parseInt(slider_conf.slidesToScroll),
            centerPadding   : slider_conf.slider_centerMode_pad,
            autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
            pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
            loop : false,
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_md),
                    slidesToScroll: 1,              
                }
            },
            {
                breakpoint: 1199,
                settings: {
                    centerPadding   : slider_conf.slider_centers_pad3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_sm),
                    slidesToScroll: 1,
                    centerPadding   : slider_conf.slider_centers_pad,
                }
            }, 
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: parseInt(slider_conf.col_xs),
                    slidesToScroll: 1,
                    centerPadding   : slider_conf.slider_centers_pad2,
                }
            }, 
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    slidesToScroll: 1,
                    centerPadding   : '0px',
                }
            }]
            });
        }
	   
		});
	});
    </script>
	<?php 
	}
	public function getCategories(){
        $cat_list = [];
         	if ( post_type_exists( 'portfolios' ) ) { 
          	$terms = get_terms( array(
             	'taxonomy'    => 'portfolio-category',
             	'hide_empty'  => true            
         	) );
            
	        foreach($terms as $post) {
	        	$cat_list[$post->slug]  = [$post->name];
	        }
    	}  
        return $cat_list;
    }
}?>