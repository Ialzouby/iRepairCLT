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

class Rsaddon_Elementor_pro_Team_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rsteam';
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
		return __( 'RS Team Grid', 'rsaddon' );
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
		return 'glyph-icon flaticon-network';
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
			'team_grid_source',
			[
				'label'   => esc_html__( 'Select Team Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',				
				'options' => [
					'custom' => esc_html__('Custom', 'rsaddon'),
					'dynamic' => esc_html__('Dynamic', 'rsaddon')					
				],											
			]
		);


		$this->add_control(
			'team_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => esc_html__('Style 1', 'rsaddon'),
					'style2' => esc_html__('Style 2', 'rsaddon'),
					'style3' => esc_html__('Style 3', 'rsaddon'),
					'style4' => esc_html__('Style 4', 'rsaddon'),
					'style5' => esc_html__('Style 5', 'rsaddon'),
					'style6' => esc_html__('Style 6', 'rsaddon'),
				],
				'separator' => 'before',										
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
				'condition' => [
					'team_grid_source' => 'dynamic',
				],	
			]

		);

		

		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Team Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'example 3', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],
			]
		);
	
		$this->add_control(
			'team_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
				'default' => 4,			
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'12' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],
							
			]
		);

		$this->add_control(
			'memeber_image',
			[
				'label' => esc_html__( 'Member Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,
				
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'custom',
				],
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
                'condition' => [
					'team_grid_source' => 'dynamic',
				],
            ]
        ); 


          $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Name', 'rsaddon' ),                
                'type' => Controls_Manager::TEXT,
                'default' => 'Elements Name',
                'placeholder' => esc_html__( 'Type Member Name', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
			]

        );

        $this->add_control(
            'designation',
            [
                'label' => esc_html__( 'Designation', 'rsaddon' ),               
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Developer', 'rsaddon' ),
                'separator' => 'before',
                'placeholder' => esc_html__( 'Type Member Designation', 'rsaddon' ),
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'phone',
            [
                'label' => esc_html__( 'Phone', 'rsaddon' ),               
                'type' => Controls_Manager::TEXT,                
                'separator' => 'before',                
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
        $this->add_control(
            'email',
            [
                'label' => esc_html__( 'Email Address', 'rsaddon' ),                
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Email Address', 'rsaddon' ),
                'separator' => 'before',               
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );

        $this->add_control(
            'bio',
            [
                'label' => esc_html__( 'Short Bio', 'rsaddon' ),                
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( '', 'rsaddon' ),
                'rows' => 5,
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );

        $this->add_control(
            'popup_description',
            [
                'label' => esc_html__( 'Description', 'rsaddon' ),                
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ‘Content here.',
                'placeholder' => esc_html__( '', 'rsaddon' ),
                'rows' => 10,
                'separator' => 'before',
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );
 		

        $this->add_control(
			'team_grid_popup',
			[
				'label'   => esc_html__( 'Show Popup', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'popup',				
				'options' => [
					'popup'   => 'Popup Style',
					'default' => 'Default Style'				
				],
				'separator' => 'before',
				'condition' => [
					'team_grid_source' => 'dynamic',
				],											
			]
		);   


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__( 'Social Profiles', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );


 		$repeater = new Repeater();
 		
 		$repeater->add_control(
 		    'link',
 		    [
 		        'label' => esc_html__('Enter Link', 'rsaddon'),
 		        'type' => Controls_Manager::URL,                
 		    ]
 		); 

 		$repeater->add_control(
 		    'social_profile',
 		    [
 		        'label' => esc_html__('Select Social Profile Name', 'rsaddon'),
 		        'type' => Controls_Manager::SELECT, 		       
 		        'label_block' => true,
 		        'options' => [
					'fa fa-500px'          => esc_html__( '500px', 'rsaddon' ),
					'fa fa-apple'          => esc_html__( 'Apple', 'rsaddon' ),
					'fa fa-behance'        => esc_html__( 'Behance', 'rsaddon' ),		          
					'fa fa-codepen'        => esc_html__( 'CodePen', 'rsaddon' ),				
					'fa fa-digg'           => esc_html__( 'Digg', 'rsaddon' ),
					'fa fa-dribbble'       => esc_html__( 'Dribbble', 'rsaddon' ),		           
					'fa fa-facebook'       => esc_html__( 'Facebook', 'rsaddon' ),
					'fa fa-flickr'         => esc_html__( 'Flicker', 'rsaddon' ),
					'fa fa-foursquare'     => esc_html__( 'FourSquare', 'rsaddon' ),
					'fa fa-github'         => esc_html__( 'Github', 'rsaddon' ),
					'fa fa-houzz'          => esc_html__( 'Houzz', 'rsaddon' ),
					'fa fa-instagram'      => esc_html__( 'Instagram', 'rsaddon' ),
					'fa fa-jsfiddle'       => esc_html__( 'JS Fiddle', 'rsaddon' ),
					'fa fa-linkedin'       => esc_html__( 'LinkedIn', 'rsaddon' ),
					'fa fa-medium'         => esc_html__( 'Medium', 'rsaddon' ),
					'fa fa-pinterest'      => esc_html__( 'Pinterest', 'rsaddon' ),
					'fa fa-product-hunt'   => esc_html__( 'Product Hunt', 'rsaddon' ),
					'fa fa-reddit'         => esc_html__( 'Reddit', 'rsaddon' ),
					'fa fa-slideshare'     => esc_html__( 'Slide Share', 'rsaddon' ),
					'fa fa-snapchat'       => esc_html__( 'Snapchat', 'rsaddon' ),
					'fa fa-soundcloud'     => esc_html__( 'SoundCloud', 'rsaddon' ),
					'fa fa-spotify'        => esc_html__( 'Spotify', 'rsaddon' ),
					'fa fa-stack-overflow' => esc_html__( 'StackOverflow', 'rsaddon' ),
					'fa fa-tripadvisor'    => esc_html__( 'TripAdvisor', 'rsaddon' ),
					'fa fa-tumblr'         => esc_html__( 'Tumblr', 'rsaddon' ),
					'fa fa-twitch'         => esc_html__( 'Twitch', 'rsaddon' ),
					'fa fa-twitter'        => esc_html__( 'Twitter', 'rsaddon' ),
					'fa fa-vimeo'          => esc_html__( 'Vimeo', 'rsaddon' ),
					'fa fa-vk'             => esc_html__( 'VK', 'rsaddon' ),
					'fa fa-website'        => esc_html__( 'Website', 'rsaddon' ),
					'fa fa-whatsapp'       => esc_html__( 'WhatsApp', 'rsaddon' ),
					'fa fa-wordpress'      => esc_html__( 'WordPress', 'rsaddon' ),
					'fa fa-xing'           => esc_html__( 'Xing', 'rsaddon' ),
					'fa fa-yelp'           => esc_html__( 'Yelp', 'rsaddon' ),
					'fa fa-youtube'        => esc_html__( 'YouTube', 'rsaddon' ),					
				],
 		        'separator'   => 'before',
 		    ]
 		);
 		

 		$this->add_control(
 		    'social_icon_list',
 		    [
 		        'show_label' => false,
 		        'type' => Controls_Manager::REPEATER,
 		        'fields' => $repeater->get_controls(),
 		        'title_field' => '{{{ social_profile }}}',
 		        'default' => [
                    [
                        'link' => '#',
                        'social_profile' => 'fa fa-facebook',
                    ],
                    [
                        'link' => '#',
                        'social_profile' => 'fa fa-twitter',
                    ],
                    [
                        'link' => '#',
                        'social_profile' => 'fa fa-linkedin',
                    ],                  
                ],
 		    ]
 		);



        $this->add_control(
			'image_spacing_custom',
			[
				'label'      => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator'  => 'before',
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
                'condition' => [
					'team_grid_source' => 'dynamic',
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
                    '{{WRAPPER}} .team-grid-style1 .team-item .team-content h3.team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style6 .team-item .team-content h3.team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style2 .team-item-wrap .team-img .team-content .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style3 .team-img .team-img-sec .team-content .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style4 .team-item .team-content .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap .team-content .member-desc .team-name a' => 'color: {{VALUE}};',

                ],                
            ]
        );



        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style1 .team-item .team-content h3.team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style6 .team-item .team-content h3.team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style2 .team-item-wrap .team-img .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style3 .team-img .team-img-sec .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style4 .team-item .team-content .team-name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a:hover' => 'color: {{VALUE}};',
                ],                
            ]

            
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => 
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap .team-content .member-desc .team-name a, {{WRAPPER}} .team-grid-style4 .team-item .team-content .team-name a, {{WRAPPER}} .team-grid-style2 .team-item-wrap .team-img .team-content .team-name a, {{WRAPPER}} .team-grid-style6 .team-item .team-content h3.team-name a, {{WRAPPER}} .team-grid-style1 .team-item .team-content h3.team-name a',
			]
		);


        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-content .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style4 .team-item .team-content .team-title' => 'color: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_hover_bg',
            [
                'label' => esc_html__( 'Content Hover Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_grid_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap:hover .team-content' => 'background: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_hover_text_color',
            [
                'label' => esc_html__( 'Content Hover Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_grid_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap:hover .team-content .member-desc .team-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap:hover .team-content .social-icons a i' => 'color: {{VALUE}};',

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
                    '{{WRAPPER}} .team-grid-style3 .team-img .team-img-sec .team-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style4 .team-item .team-content .team-text' => 'color: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_top_border_color',
            [
                'label' => esc_html__( 'Content Top Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_grid_style' => 'style4',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style4 .team-item .team-content .team-text::before' => 'background: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'content_bottom_border_color',
            [
                'label' => esc_html__( 'Content Bottom Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_grid_style' => 'style5',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap .team-content::before' => 'background: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_grid_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style3 .team-img .team-img-sec::before' => 'background: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'image_corner_border_color',
            [
                'label' => esc_html__( 'Image Corner Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_grid_style' => 'style3',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style3 .team-img::before' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style3 .team-img::after' => 'border-top-color: {{VALUE}};',

                ],                
            ]
        );


        $this->add_control(
            'icon_section_bg',
            [
                'label' => esc_html__( 'Icon Section Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                	'team_grid_style' => 'style1',
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-grid-style1 .team-item .image-wrap .social-icons1' => 'background: {{VALUE}};',
                ],
                'separator' => 'before',                
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
                     '{{WRAPPER}} .team-grid-style6 .team-item .social-icons a i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
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
                    '{{WRAPPER}} .team-grid-style4 .team-item .team-content .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap .team-content .social-icons a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style6 .team-item .social-icons a i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',                
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Icon Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons1 a i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-social a i:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style4 .team-item .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style5 .team-inner-wrap .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-grid-style6 .team-item .social-icons a:hover i' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',                
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
				'selector' => '{{WRAPPER}} .team-content',
				
			]
		);

        $this->add_control(
		    'background_title_image',
		    [
		    	'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Image Background', 'rsaddon' ),
				'condition' => [
                	'team_grid_style' => 'style6',
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
		            '{{WRAPPER}} .team-grid-style6 .team-item .image-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
                	'team_grid_style' => 'style6',
                ],
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_image',
				'label' => esc_html__( 'Image Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .team-grid-style6 .team-item .image-wrap',
				'condition' => [
                	'team_grid_style' => 'style6',
                ],
			]
		);

		$this->end_controls_section();


		//Popup Style Setting
		$this->start_controls_section(
			'section_popup_style',
			[
				'label' => esc_html__( 'Popup Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'team_grid_popup' => 'popup',
				]
			]
		);

		$this->add_control(
            'popup_title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,                              
            ]
        );


        $this->add_control(
            'popup_designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );

        $this->add_control(
            'popup_content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );	

        $this->add_control(
            'popup_phn_email_color',
            [
                'label' => esc_html__( 'Phone and Email Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );		

        $this->add_control(
            'popup_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
        );

        $this->add_control(
            'popup_icon_bg_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
            ]
            
        );

        $this->add_control(
            'popup_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
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

		$popup_title_color = !empty( $settings['popup_title_color']) ? 'style="color: '.$settings['popup_title_color'].'"' : '';
		$popup_designation_color = !empty( $settings['popup_designation_color']) ? 'style="color: '.$settings['popup_designation_color'].'"' : '';
		$popup_content_color = !empty( $settings['popup_content_color']) ? 'style="color: '.$settings['popup_content_color'].'"' : '';
		$popup_phn_email_color = !empty( $settings['popup_phn_email_color']) ? 'style="color: '.$settings['popup_phn_email_color'].'"' : '';
		$popup_background = !empty( $settings['popup_background']) ? 'style="background: '.$settings['popup_background'].'"' : '';

		//Icon Style
		$icon_style='';
		if(!empty($settings['popup_icon_color']) && empty($settings['popup_icon_bg_color'])){
			$icon_style = 'style="color: '.$settings['popup_icon_color'].'"';				
		}
		if(!empty($settings['popup_icon_bg_color'])){
			$icon_style = ($settings['popup_icon_bg_color']) ? ' style="background: '.$settings['popup_icon_bg_color'].'"' : '';
		}

		if(!empty($settings['popup_icon_color']) && !empty($settings['popup_icon_bg_color'])){
			$icon_style = 'style="background: '.$settings['popup_icon_bg_color'].'; color: '.$settings['popup_icon_color'].'"';				
		}
		
		if($settings['team_grid_source'] == 'dynamic'){

			if('style1' == $settings['team_grid_style']){
			include plugin_dir_path(__FILE__)."/style1.php";
			}

			if('style2' == $settings['team_grid_style']){
				include plugin_dir_path(__FILE__)."/style2.php";
			}

			if('style3' == $settings['team_grid_style']){
				include plugin_dir_path(__FILE__)."/style3.php";
			}

			if('style4' == $settings['team_grid_style']){
				include plugin_dir_path(__FILE__)."/style4.php";
			}

			if('style5' == $settings['team_grid_style']){
				include plugin_dir_path(__FILE__)."/style5.php";
			}	

			if('style6' == $settings['team_grid_style']){
				include plugin_dir_path(__FILE__)."/style6.php";
			}		
		}else{ ?>


			<div class="rs-team-grid rs-team team-grid-<?php echo esc_html($settings['team_grid_style']);?> <?php echo esc_html($settings['team_grid_popup']);?> rsaddon_pro_box">
				<?php 
					$unique = rand(2012,3554120);
				?>
				<div class="team-item">
					<div class="team-inner-wrap">
						<div class="image-wrap">
							<a class="pointer-events" href="#rs_popupBox_<?php echo esc_attr($unique);?>" data-effect="mfp-zoom-in">
								<?php if ( $settings['memeber_image']['url'] ) : ?>
			                       <img src="<?php echo esc_url($settings['memeber_image']['url']);?>"  alt="<?php echo esc_url($settings['memeber_image']['url']);?>" />
			                    <?php endif; ?>
							</a>

							<?php if('style1' == $settings['team_grid_style']){ ?>
							<div class="social-icons1">	
								<?php foreach ( $settings['social_icon_list'] as $index => $item ) :

									$target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
				            		$link         = !empty($item['link']['URL']) ? $item['link']['URL'] : ''; ?>
				            								
										<a href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
											<i class="<?php echo esc_html($item['social_profile']); ?>"></i>
										</a>			
							        
							   <?php  endforeach; ?>   
						   </div> 
							<?php } ?>
						</div>

						<div class="team-content">
							<div class="member-desc">								
								<?php if($settings['title']):?>
						       		<h3 class="team-name"><a class="pointer-events" href="#rs_popupBox_<?php echo esc_attr($unique);?>"><?php echo esc_html($settings['title']);?></a></h3>
						        <?php endif; 

								if($settings['designation']) : ?>
									<span class="team-title"><?php echo esc_html($settings['designation']);?></span>
								<?php endif ; ?>
							</div>
							<?php if($settings['bio']): ?>
						        	<p class="team-desc"><?php echo esc_html($settings['bio']);?></p>
			                  	<?php endif; ?>								  	
						  	<?php if ( !empty(is_array( $settings['social_icon_list'] )) ) : ?>
								<div class="social-icons">	
									<?php foreach ( $settings['social_icon_list'] as $index => $item ) :

										$target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
					            		$link         = !empty($item['link']['URL']) ? $item['link']['URL'] : '';
					            	?>
				            								
										<a href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
											<i class="<?php echo esc_html($item['social_profile']); ?>"></i>
										</a>			
							        
							   		<?php  endforeach; ?>   
						   		</div>	
							<?php endif; ?>	
						</div>
			  		</div>
			  	</div>

  				<!-- Hidden PupupBox Text -->
				<div id="rs_popupBox_<?php echo esc_attr($unique);?>" class="rspopup_style1 mfp-with-anim mfp-hide" <?php echo wp_kses_post($popup_background);?>>
					<div class="row">
						<div class="col-md-5">
							<div class="rsteam_img">
								<?php if ( $settings['memeber_image']['url'] ) : ?>
			                       <img src="<?php echo esc_url($settings['memeber_image']['url']);?>"  alt="<?php echo esc_url($settings['memeber_image']['url']);?>" />
			                    <?php endif; ?>	
					  		</div>
						</div>
						<div class="col-md-7">
							<div class="rsteam_content">
								<div class="team-content">
									<div class="team-heading">

									  	<?php if($settings['title']) : ?>
								  		<h3 class="team-name"><a class="pointer-events" href="#rs_popupBox_<?php echo esc_attr($x);?>" data-effect="mfp-zoom-in"><?php echo esc_html($settings['title']);?></a></h3>
								  		<?php endif; ?>
								  		<?php if($settings['designation']) : ?>
								  			<span class="team-title"><?php echo esc_html($settings['designation']);?></span>
								  		<?php endif; ?>	
									</div> 

									
									<?php if($settings['popup_description']) : ?>
									<div class="team-des" <?php echo wp_kses_post($popup_content_color);?>>
										<?php echo esc_html($settings['popup_description']);?>
									</div>
									<?php endif; ?>


									<?php if($settings['phone'] || $settings['email'])   : ?>
									<div class="contact-info">

										<ul>
											<?php if($settings['phone']): ?>
												<li <?php echo wp_kses_post($popup_phn_email_color);?>>
													<span><?php echo esc_html('Phone:', 'rsaddon');?> </span>
													<?php echo esc_html($settings['phone']);?>
												</li>

											<?php endif; ?>



											<?php if($settings['email']): ?>
												<li <?php echo wp_kses_post($popup_phn_email_color);?>>
													<span><?php echo esc_html('Email:', 'rsaddon');?> </span>
													<a href="<?php echo esc_html($show_email); ?>"<?php echo wp_kses_post($popup_phn_email_color);?>>
														<?php echo esc_html($settings['email']);?></a>
												</li>
											<?php endif; ?>
										</ul>
									</div>
									<?php endif; ?>

								  	<div class="rs-social-icons">
										<div class="social-icons1">	
										<?php foreach ( $settings['social_icon_list'] as $index => $item ) :

											$target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
						            		$link         = !empty($item['link']['URL']) ? $item['link']['URL'] : ''; ?>
						            								
												<a href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
													<i class="<?php echo esc_html($item['social_profile']); ?>"></i>
												</a>			
									        
									   <?php  endforeach; ?>   
								   </div>
								  	</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		<?php 

		}		
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