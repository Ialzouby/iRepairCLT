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
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Team_Slider_Pro_Widget extends \Elementor\Widget_Base {

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
		return 'rsteam-slider';
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
		return esc_html__( 'RS Team Slider', 'rsaddon' );
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
		return 'glyph-icon flaticon-slider-1';
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
			'team_slider_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => 'Style 1',
					'style2' => 'Style 2',
					'style3' => 'Style 3',
					'style4' => 'Style 4',
					'style5' => 'Style 5',
					'style6' => 'Style 6',
					'style7' => 'Style 7',
					'style8' => 'Style 8'
				],											
			]
		);


		$this->add_control(
			'team_link_condition',
			[
				'label'   => esc_html__( 'Link Enable / Disable', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'enable',				
				'options' => [
					'enable' => 'Enable',
					'disable' => 'Disable',
				],											
			]
		);


		$this->add_control(
			'team_category',
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
				'label' => esc_html__( 'Team Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'rsaddon' ),
				'separator' => 'before',
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


        $this->add_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],		
				

				'selectors' => [
                    '{{WRAPPER}} .team-item-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .team-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		); 
  
				
		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Team Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style1 .team-item .team-content h3.team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style2 .team-item-wrap .team-img .team-content .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec .team-content .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .member-desc .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style6 .team-content .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-content .team-name a' => 'color: {{VALUE}};',

                ],                
            ]
        );



        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                	
                    '{{WRAPPER}} .rsaddon-unique-slider.team-slider-style8 .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style1 .team-item .team-content h3.team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style2 .team-item-wrap .team-img .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style6 .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-content .team-name a:hover' => 'color: {{VALUE}};',
                ],                
            ]

            
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .team-slider-style7 .team-item .team-content h3.team-name, {{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .member-desc .team-name a, {{WRAPPER}} .team-slider-style4 .team-item .team-content .team-name a, {{WRAPPER}} .team-slider-style2 .team-item-wrap .team-img .team-content .team-name a, {{WRAPPER}} .team-slider-style1 .team-item .team-content h3.team-name a',
			]
		);


        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-title' => 'color: {{VALUE}};',

                ],                
            ]
        );

         $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => esc_html__( 'Designation Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .team-content .team-title, {{WRAPPER}} .team-slider-style4 .team-item .team-content .team-title',
			]
		);




        $this->add_control(
            'content_hover_bg',
            [
                'label' => esc_html__( 'Content Hover Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content' => 'background: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_hover_text_color',
            [
                'label' => esc_html__( 'Content Hover Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .member-desc .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap:hover .team-content .social-icons a i' => 'color: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-item .team-content .team-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec .team-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-text' => 'color: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_top_border_color',
            [
                'label' => esc_html__( 'Content Top Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .team-text::before' => 'background: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_bottom_border_color',
            [
                'label' => esc_html__( 'Content Bottom Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content::before' => 'background: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style3 .team-img .team-img-sec::before' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__( 'Navigation Arrow Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-prev' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-next, .rs-addon-slider .slick-next' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_arrow_icon_color',
            [
                'label' => esc_html__( 'Navigation Arrow Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev::before' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'navigation_dot_border_color',
            [
                'label' => esc_html__( 'Navigation Dot Icon Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-color: {{VALUE}};',

                ],                
            ]
        );



        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__( 'Navigation Dot Icon Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'background: {{VALUE}};',

                ],               
            ]
        );


        $this->add_control(
            'image_corner_border_color',
            [
                'label' => esc_html__( 'Image Corner Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-slider-style3 .team-img::before' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style3 .team-img::after' => 'border-top-color: {{VALUE}};',

                ],  
                'separator' => 'after',               
            ]
        );


        $this->add_control(
			'icon_font_size',
			[
				'label' => esc_html__( 'Icon Font Size', 'rsaddon' ),
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
                     '{{WRAPPER}} .social-icons1 a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-social a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-social a i' => 'font-size: {{SIZE}}{{UNIT}}',
                     '{{WRAPPER}} .team-item .social-icons a i' => 'font-size: {{SIZE}}{{UNIT}}',
                ], 
			]
		);


        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons1 a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a i' => 'color: {{VALUE}};',
                ],              
            ]
        );

        $this->add_control(
            'icon_section_bg',
            [
                'label' => esc_html__( 'Icon Section Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_slider_style' => ['style1', 'style8'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider.team-slider-style8 .team-content .social-icons a, {{WRAPPER}} .team-slider-style1 .team-item .image-wrap .social-icons1' => 'background: {{VALUE}};',
                ],             
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons1 a i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .social-icons a i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social a i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style4 .team-item .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style5 .team-inner-wrap .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-slider-style7 .team-item .social-icons a:hover i' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
			'icon_hover_heading',
			[
				'label' => __( 'Icon Hover Background', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                	'team_slider_style' => ['style8'],
                ],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_section_hover_bg',
				'label' => esc_html__( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'condition' => [
                	'team_slider_style' => ['style8'],
                ],
				'selector' => '{{WRAPPER}} .rsaddon-unique-slider.team-slider-style8 .team-content .social-icons a:hover',
                'separator' => 'after', 
				
			]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .team-content',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rsaddon-unique-slider.team-slider-style8 .team-inner-wrap, {{WRAPPER}} .team-content',
				
			]
		);
		$this->add_control(
		    'background_title_image',
		    [
		    	'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Image Background', 'rsaddon' ),
				'condition' => [
                	'team_slider_style' => 'style7',
                ],
		        'separator' => 'before', 
		    ]
		);

		$this->add_responsive_control(
		    'image_padding_area',
		    [
		        'label' => esc_html__( 'Image Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .team-slider-style7 .team-item .image-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
                	'team_slider_style' => 'style7',
                ],
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_image',
				'label' => esc_html__( 'Image Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .team-slider-style7 .team-item .image-wrap',
				'condition' => [
                	'team_slider_style' => 'style7',
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

		$settings = $this->get_settings_for_display(); 
				
		$slidesToShow    = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
		$autoplaySpeed   = $settings['slider_autoplay_speed'];
		$interval        = $settings['slider_interval'];
		$slidesToScroll  = $settings['slides_ToScroll'];
		$slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
		$pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
		$sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
		$sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';		
		$infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
		$centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
		$col_lg          = $settings['col_lg'];
		$col_md          = $settings['col_md'];
		$col_sm          = $settings['col_sm'];
		$col_xs          = $settings['col_xs'];

		$unique = rand(2012,35120);
		$slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');


		$popup_slider_title_color = !empty( $settings['popup_slider_title_color']) ? 'style="color: '.$settings['popup_slider_title_color'].'"' : '';
		$popup_slider_dgn_color = !empty( $settings['popup_slider_dgn_color']) ? 'style="color: '.$settings['popup_slider_dgn_color'].'"' : '';
		$popup_slider_content_color = !empty( $settings['popup_slider_dgn_color']) ? 'style="color: '.$settings['popup_slider_dgn_color'].'"' : '';
		$popup_slider_info_color = !empty( $settings['popup_slider_info_color']) ? 'style="color: '.$settings['popup_slider_info_color'].'"' : '';
		$popup_slider_background = !empty( $settings['popup_slider_background']) ? 'style="background: '.$settings['popup_slider_background'].'"' : '';

		//Icon Style
		$icon_style='';
		if(!empty($settings['popup_slider_icon_color']) && empty($settings['popup_slider_icon_bg_color'])){
			$icon_style = 'style="color: '.$settings['popup_slider_icon_color'].'"';				
		}
		if(!empty($settings['popup_slider_icon_bg_color'])){
			$icon_style = ($settings['popup_slider_icon_bg_color']) ? ' style="background: '.$settings['popup_slider_icon_bg_color'].'"' : '';
		}

		if(!empty($settings['popup_slider_icon_color']) && !empty($settings['popup_slider_icon_bg_color'])){
			$icon_style = 'style="background: '.$settings['popup_slider_icon_bg_color'].'; color: '.$settings['popup_slider_icon_color'].'"';				
		}

		
		if('disable' == $settings['team_link_condition']){
			$disable_link = "#";
		} 

		?>	 

		<div class="rsaddon-unique-slider rs-team-slider rs-team team-slider-<?php echo esc_attr($settings['team_slider_style']); ?>">
			<div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider" >
				 <?php 	if('style1' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style1.php";
					}

					if('style2' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style2.php";
					}

					if('style3' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style3.php";
					}

					if('style4' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style4.php";
					}

					if('style5' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style5.php";
					}
					if('style6' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style6.php";
					}
					if('style7' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style7.php";
					}
					if('style8' == $settings['team_slider_style']){
						include plugin_dir_path(__FILE__)."/style8.php";
					}
				?>
			</div>
		<div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
	</div>

	<script type="text/javascript"> 
		jQuery(document).ready(function(){
			jQuery( '.rs-addon-slider' ).each(function( index ) {        
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
            centerPadding   : '15px',
            autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
            pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
            loop : false,

            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_md),
                }
            }, 
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_sm),
                }
            }, 
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: parseInt(slider_conf.col_xs),
                }
            }, ]
            });
        }
	   
		});
	});
    </script>
	<?php 
	}

	public function getCategories(){
        $cat_list = [];
         	if ( post_type_exists( 'teams' ) ) { 
          	$terms = get_terms( array(
             	'taxonomy'    => 'team-category',
             	'hide_empty'  => true            
         	) );           
         
  
	        foreach($terms as $post) {
	        	$cat_list[$post->slug]  = [$post->name];
	        }
    	}  
        return $cat_list;
    }
}?>