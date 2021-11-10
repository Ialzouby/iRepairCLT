<?php 
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
class Rsaddon_Elementor_Pro_Instagram_Widget extends \Elementor\Widget_Base {
    
    /**
	 * Retrieve instagram feed widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pp-instafeed';
    }

    /**
	 * Retrieve instagram feed widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'Instagram Feed', 'rsaddon' );
    }

    /**
	 * Retrieve the list of categories the instagram feed widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    /**
	 * Retrieve instagram feed widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'fa fa-instagram';
    }
    
    /**
	 * Retrieve the list of scripts the instagram feed widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
 
    /**
	 * Register instagram feed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function _register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*	CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Content Tab: Instagram Account
         */
        $this->start_controls_section(
            'section_instaaccount',
            [
                'label'                 => __( 'Instagram Account', 'rsaddon' ),
            ]
        );
		
		$this->add_control(
			'api_info',
			[
				'type'                  => Controls_Manager::RAW_HTML,
				'raw'					=> __( 'Starting October 15, 2019, new client registration and permission review on Instagram API platform are discontinued.', 'rsaddon' ),
				'separator'             => 'after',
				'content_classes' => 'pp-editor-info',
			]
		);
        
        $this->add_control(
            'use_api',
            [
                'label'                 => __( 'Use Instagram API', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
				'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'user_id',
            [
                'label'                 => __( 'User ID', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
				'condition'             => [
					'use_api'	=> 'yes',
				],
            ]
        );
        
        $this->add_control(
            'access_token',
            [
                'label'                 => __( 'Access Token', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
				'condition'             => [
					'use_api'	=> 'yes',
				],
            ]
        );
        
        $this->add_control(
            'client_id',
            [
                'label'                 => __( 'Client ID', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
				'condition'             => [
					'use_api'	=> 'yes',
				],
            ]
        );
        
        $this->add_control(
            'username',
            [
                'label'                 => __( 'Instagram Username', 'rsaddon' ),
                'description'			=> __( 'This must be public account.', 'rsaddon' ),
                'label_block'			=> true,
                'type'                  => Controls_Manager::TEXT,
				'frontend_available'    => true,
				'condition'             => [
					'use_api!'	=> 'yes',
				],
            ]
        );

        $this->end_controls_section();
        
        /**
         * Content Tab: Feed Settings
         */
        $this->start_controls_section(
            'section_instafeed',
            [
                'label'                 => __( 'Feed Settings', 'rsaddon' ),
            ]
        );
        
        $this->add_control(
            'images_count',
            [
                'label'                 => __( 'Images Count', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 5 ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
            ]
        );
		
		$this->add_control(
			'images_info',
			[
				'type'                  => Controls_Manager::RAW_HTML,
				'raw'					=> __( 'Maximum 12 images can be displayed without using API.', 'rsaddon' ),
				'separator'             => 'after',
				'content_classes'		=> 'pp-editor-info',
				'condition'             => [
					'use_api!'   => 'yes',
				],
			]
		);

        $this->add_control(
            'resolution',
            [
                'label'                 => __( 'Image Resolution', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'thumbnail'              => __( 'Thumbnail', 'rsaddon' ),
                   'low_resolution'         => __( 'Low Resolution', 'rsaddon' ),
                   'standard_resolution'    => __( 'Standard Resolution', 'rsaddon' ),
                ],
                'default'               => 'low_resolution',
            ]
        );

        $this->add_control(
            'sort_by',
            [
                'label'                 => __( 'Sort By', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'none'               => __( 'None', 'rsaddon' ),
                   'most-recent'        => __( 'Most Recent', 'rsaddon' ),
                   'least-recent'       => __( 'Least Recent', 'rsaddon' ),
                   'most-liked'         => __( 'Most Liked', 'rsaddon' ),
                   'least-liked'        => __( 'Least Liked', 'rsaddon' ),
                   'most-commented'     => __( 'Most Commented', 'rsaddon' ),
                   'least-commented'    => __( 'Least Commented', 'rsaddon' ),
                   'random'             => __( 'Random', 'rsaddon' ),
                ],
                'default'               => 'none',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: General Settings
         */
        $this->start_controls_section(
            'section_general_settings',
            [
                'label'                 => __( 'General Settings', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'feed_layout',
            [
                'label'                 => __( 'Layout', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'grid',
                'options'               => [
                   'grid'           => __( 'Grid', 'rsaddon' ),                  
                   'carousel'       => __( 'Carousel', 'rsaddon' ),
                ],
				'frontend_available'    => true,
            ]
        );
        
        $this->add_control(
            'square_images',
            [
                'label'                 => __( 'Square Images', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => '',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout'   => ['grid', 'carousel'],
				],
            ]
        );

        $this->add_responsive_control(
            'grid_cols',
            [
                'label'                 => __( 'Grid Columns', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => '5',
                'tablet_default'        => '3',
                'mobile_default'        => '2',
                'options'               => [
                   '1'              => __( '1', 'rsaddon' ),
                   '2'              => __( '2', 'rsaddon' ),
                   '3'              => __( '3', 'rsaddon' ),
                   '4'              => __( '4', 'rsaddon' ),
                   '5'              => __( '5', 'rsaddon' ),
                   '6'              => __( '6', 'rsaddon' ),
                   '7'              => __( '7', 'rsaddon' ),
                   '8'              => __( '8', 'rsaddon' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-grid .pp-feed-item' => 'width: calc( 100% / {{VALUE}} )',
                ],
				'condition'             => [
					'feed_layout'       => ['grid', 'masonry']
				],
            ]
        );
        
        $this->add_control(
            'insta_likes',
            [
                'label'                 => __( 'Likes', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Show', 'rsaddon' ),
                'label_off'             => __( 'Hide', 'rsaddon' ),
                'return_value'          => 'yes',
                'separator'             => 'before',
				'frontend_available'    => true,
            ]
        );
        
        $this->add_control(
            'insta_comments',
            [
                'label'                 => __( 'Comments', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Show', 'rsaddon' ),
                'label_off'             => __( 'Hide', 'rsaddon' ),
                'return_value'          => 'yes',
				'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'content_visibility',
            [
                'label'                 => __( 'Content Visibility', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'always',
                'options'               => [
                   'always'         => __( 'Always', 'rsaddon' ),
                   'hover'          => __( 'On Hover', 'rsaddon' ),
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );       
     
        
        $this->add_control(
            'insta_profile_link',
            [
                'label'                 => __( 'Show Link to Instagram Profile?', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'insta_link_title',
            [
                'label'                 => __( 'Link Title', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => __( 'Follow Us @ Instagram', 'rsaddon' ),
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'insta_profile_url',
            [
                'label'                 => __( 'Instagram Profile URL', 'rsaddon' ),
                'type'                  => Controls_Manager::URL,
                'placeholder'           => 'https://www.your-link.com',
                'default'               => [
                    'url'           => '#',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

		$this->add_control(
			'title_icon',
			[
				'label'					=> __( 'Title Icon', 'rsaddon' ),
				'type'					=> Controls_Manager::ICONS,
				'fa4compatibility'		=> 'insta_title_icon',
				'recommended'			=> [
					'fa-brands' => [
						'instagram',
					],
					'fa-solid' => [
						'user-check',
						'user-plus',
					],
				],
				'default'				=> [
					'value' => 'fab fa-instagram',
					'library' => 'fa-brands',
				],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
			]
		);

        $this->add_control(
            'insta_title_icon_position',
            [
                'label'                 => __( 'Icon Position', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'before_title'   => __( 'Before Title', 'rsaddon' ),
                   'after_title'    => __( 'After Title', 'rsaddon' ),
                ],
                'default'               => 'before_title',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->add_control(
            'load_more_button',
            [
                'label'                 => __( 'Show Load More Button', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
                'separator'             => 'before',
				'condition'             => [
					'use_api'       	=> 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'load_more_button_text',
            [
                'label'                 => __( 'Button Text', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => __( 'Load More', 'rsaddon' ),
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Content Tab: Carousel Settings
         */
        $this->start_controls_section(
            'section_carousel_settings',
            [
                'label'                 => __( 'Carousel Settings', 'rsaddon' ),
				'condition'             => [
					'feed_layout'   => 'carousel',
				],
            ]
        );

        $this->add_responsive_control(
            'items',
            [
                'label'                 => __( 'Visible Items', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 3 ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 10,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
				'condition'             => [
					'feed_layout' => 'carousel',
				],
            ]
        );
        
        $this->add_responsive_control(
            'margin',
            [
                'label'                 => __( 'Items Gap', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 10 ],
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
				'condition'             => [
					'feed_layout'  => 'carousel',
				],
            ]
        );
        
        $this->add_control(
            'autoplay',
            [
                'label'                 => __( 'Autoplay', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout'  => 'carousel',
				],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'                 => __( 'Autoplay Speed', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => '2400',
                'title'                 => __( 'Enter carousel speed', 'rsaddon' ),
                'condition'             => [
                    'autoplay'     => 'yes',
					'feed_layout'  => 'carousel',
                ],
            ]
        );
        
        $this->add_control(
            'infinite_loop',
            [
                'label'                 => __( 'Infinite Loop', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout' => 'carousel',
				],
            ]
        );
        
        $this->add_control(
            'grab_cursor',
            [
                'label'                 => __( 'Grab Cursor', 'rsaddon' ),
                'description'           => __( 'Shows grab cursor when you hover over the slider', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => '',
                'label_on'          => __( 'Show', 'rsaddon' ),
                'label_off'         => __( 'Hide', 'rsaddon' ),
                'return_value'      => 'yes',
            ]
        );
        
        $this->add_control(
            'navigation_heading',
            [
                'label'                 => __( 'Navigation', 'rsaddon' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );
        
        $this->add_control(
            'arrows',
            [
                'label'                 => __( 'Arrows', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout' => 'carousel',
				],
            ]
        );        
  
        
        $this->add_control(
            'direction',
            [
                'label'                 => __( 'Direction', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'left',
                'options'               => [
                    'left'       => __( 'Left', 'rsaddon' ),
                    'right'      => __( 'Right', 'rsaddon' ),
                ],
				'separator'             => 'before',
            ]
        );

        $this->end_controls_section();

	
        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Style Tab: Layout
         */
        $this->start_controls_section(
            'section_layout_style',
            [
                'label'                 => __( 'Layout', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'feed_layout'       => 'grid'
				],
            ]
        );$this->add_responsive_control(
			'columns_gap',
			[
				'label'                 => __( 'Columns Gap', 'rsaddon' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
                    'size' => '',
                    'unit' => 'px',
                ],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-instafeed-grid .pp-feed-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .pp-instafeed-grid' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
				],
				'condition'             => [
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_responsive_control(
			'rows_gap',
			[
				'label'                 => __( 'Rows Gap', 'rsaddon' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
                    'size' => '',
                    'unit' => 'px',
                ],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-instafeed-grid .pp-feed-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'feed_layout'       => 'grid'
				],
			]
		);

        $this->end_controls_section();

        /**
         * Style Tab: Images
         */
        $this->start_controls_section(
            'section_image_style',
            [
                'label'                 => __( 'Images', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_image_style' );

        $this->start_controls_tab(
            'tab_image_normal',
            [
                'label'                 => __( 'Normal', 'rsaddon' ),
            ]
        );
        
        $this->add_control(
            'insta_image_grayscale',
            [
                'label'                 => __( 'Grayscale Image', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'images_border',
				'label'                 => __( 'Border', 'rsaddon' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed .pp-if-img',
			]
		);

		$this->add_control(
			'images_border_radius',
			[
				'label'                 => __( 'Border Radius', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .pp-if-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_hover',
            [
                'label'                 => __( 'Hover', 'rsaddon' ),
            ]
        );
        
        $this->add_control(
            'insta_image_grayscale_hover',
            [
                'label'                 => __( 'Grayscale Image', 'rsaddon' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'rsaddon' ),
                'label_off'             => __( 'No', 'rsaddon' ),
                'return_value'          => 'yes',
            ]
        );

        $this->add_control(
            'images_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-feed-item:hover .pp-if-img' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Content
         */
        $this->start_controls_section(
            'section_content_style',
            [
                'label'                 => __( 'Content', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'content_typography',
                'label'                 => __( 'Typography', 'rsaddon' ),
                'selector'              => '{{WRAPPER}} .pp-feed-item .pp-overlay-container',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );

        $this->add_control(
            'likes_comments_color',
            [
                'label'                 => __( 'Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-feed-item .pp-overlay-container' => 'color: {{VALUE}};',
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );
        
        $this->add_control(
			'content_vertical_align',
			[
				'label'                 => __( 'Vertical Align', 'rsaddon' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'toggle'                => false,
				'default'               => 'middle',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'rsaddon' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Center', 'rsaddon' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'rsaddon' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary'  => [
					'top'          => 'flex-start',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-overlay-container'   => 'align-items: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);
        
        $this->add_control(
			'content_horizontal_align',
			[
				'label'                 => __( 'Horizontal Align', 'rsaddon' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'toggle'                => false,
				'default'               => 'center',
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'rsaddon' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'           => [
						'title' => __( 'Center', 'rsaddon' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'            => [
						'title' => __( 'Right', 'rsaddon' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
                'selectors_dictionary'  => [
					'left'     => 'flex-start',
					'center'   => 'center',
					'right'    => 'flex-end',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-overlay-container' => 'justify-content: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'                 => __( 'Padding', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-overlay-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);
        
        $this->add_control(
            'icons_heading',
            [
                'label'                 => __( 'Icons', 'rsaddon' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );

		$this->add_control(
			'icons_style',
			[
				'label'					=> __( 'Style', 'rsaddon' ),
				'type'					=> Controls_Manager::CHOOSE,
				'label_block'			=> false,
				'toggle'				=> false,
				'default'				=> 'solid',
				'options'				=> [
					'solid'    		=> [
						'title' 	=> __( 'Solid', 'rsaddon' ),
						'icon' 		=> 'fa fa-comment',
					],
					'outline' 		=> [
						'title' 	=> __( 'Outline', 'rsaddon' ),
						'icon' 		=> 'fa fa-comment-o',
					],
				],
				'frontend_available'    => true,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label'                 => __( 'Size', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 2.5,
                        'step'  => 0.1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-feed-item .pp-if-icon' => 'font-size: {{SIZE}}em;',
                    '{{WRAPPER}} .pp-feed-item .pp-overlay-container span' => 'font-size: {{SIZE}}em;',
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Overlay
         */
        $this->start_controls_section(
            'section_overlay_style',
            [
                'label'                 => __( 'Overlay', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_blend_mode',
            [
                'label'                 => __( 'Blend Mode', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'normal',
                'options'               => [
                    'normal'		=> __( 'Normal', 'rsaddon' ),
                    'multiply'		=> __( 'Multiply', 'rsaddon' ),
                    'screen'		=> __( 'Screen', 'rsaddon' ),
                    'overlay'		=> __( 'Overlay', 'rsaddon' ),
                    'darken'		=> __( 'Darken', 'rsaddon' ),
                    'lighten'		=> __( 'Lighten', 'rsaddon' ),
                    'color-dodge'   => __( 'Color Dodge', 'rsaddon' ),
                    'color'			=> __( 'Color', 'rsaddon' ),
                    'hue'			=> __( 'Hue', 'rsaddon' ),
                    'hard-light'	=> __( 'Hard Light', 'rsaddon' ),
                    'soft-light'	=> __( 'Soft Light', 'rsaddon' ),
                    'difference'	=> __( 'Difference', 'rsaddon' ),
                    'exclusion'		=> __( 'Exclusion', 'rsaddon' ),
                    'saturation'	=> __( 'Saturation', 'rsaddon' ),
                    'luminosity'	=> __( 'Luminosity', 'rsaddon' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-overlay-container' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_overlay_style' );

        $this->start_controls_tab(
            'tab_overlay_normal',
            [
                'label'                 => __( 'Normal', 'rsaddon' ),
            ]
        );
			
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'image_overlay_normal',
                'label'                 => __( 'Overlay', 'rsaddon' ),
                'types'                 => [ 'classic','gradient' ],
                'exclude'               => [
                    'image',
                ],
                'selector'              => '{{WRAPPER}} .pp-instagram-feed .pp-overlay-container',
            ]
        );
        
        $this->add_control(
			'overlay_margin_normal',
			[
				'label'                 => __( 'Margin', 'rsaddon' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
                        'min'   => 0,
                        'max'   => 50,
                        'step'  => 1,
                    ],
				],
				'selectors'         => [
					'{{WRAPPER}} .pp-instagram-feed .pp-overlay-container' => 'top: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px; right: {{SIZE}}px;',
				],
			]
		);
        
        $this->add_control(
            'image_overlay_opacity_normal',
            [
                'label'                 => __( 'Overlay Opacity', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-overlay-container' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_overlay_hover',
            [
                'label'                 => __( 'Hover', 'rsaddon' ),
            ]
        );
			
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'image_overlay_hover',
                'label'                 => __( 'Overlay', 'rsaddon' ),
                'types'                 => [ 'classic','gradient' ],
                'exclude'               => [
                    'image',
                ],
                'selector'              => '{{WRAPPER}} .pp-instagram-feed .pp-feed-item:hover .pp-overlay-container',
            ]
        );
        
        $this->add_control(
            'image_overlay_opacity_hover',
            [
                'label'                 => __( 'Overlay Opacity', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-feed-item:hover .pp-overlay-container' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Feed Title
         */
        $this->start_controls_section(
            'section_feed_title_style',
            [
                'label'                 => __( 'Feed Title', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->add_control(
			'feed_title_position',
			[
				'label'                 => __( 'Position', 'rsaddon' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'default'               => 'middle',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'rsaddon' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Middle', 'rsaddon' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'rsaddon' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'prefix_class'          => 'pp-insta-title-',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'feed_title_typography',
                'label'                 => __( 'Typography', 'rsaddon' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .pp-instagram-feed-title',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label'                 => __( 'Normal', 'rsaddon' ),
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_color_normal',
            [
                'label'                 => __( 'Text Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap .pp-icon svg' => 'fill: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap' => 'background: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'title_border_normal',
				'label'                 => __( 'Border', 'rsaddon' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed-title-wrap'
			]
		);

		$this->add_control(
			'title_border_radius_normal',
			[
				'label'                 => __( 'Border Radius', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed-title-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label'                 => __( 'Hover', 'rsaddon' ),
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'                 => __( 'Text Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap a:hover .pp-icon svg' => 'fill: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap:hover' => 'background: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'title_border_hover',
				'label'                 => __( 'Border', 'rsaddon' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed-title-wrap:hover'
			]
		);

		$this->add_control(
			'title_border_radius_hover',
			[
				'label'                 => __( 'Border Radius', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed-title-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

		$this->add_control(
			'title_padding',
			[
				'label'                 => __( 'Padding', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
                'separator'             => 'before',
			]
		);
        
        $this->add_control(
            'title_icon_heading',
            [
                'label'                 => __( 'Icon', 'rsaddon' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->add_responsive_control(
            'title_icon_spacing',
            [
                'label'                 => __( 'Spacing', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 4 ],
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .pp-icon-before_title' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pp-instagram-feed .pp-icon-after_title' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Arrows
         */
        $this->start_controls_section(
            'section_arrows_style',
            [
                'label'                 => __( 'Arrows', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'arrows'       => 'yes',
					'feed_layout'  => 'carousel',
                ],
            ]
        );
        
        $this->add_control(
            'arrow',
            [
                'label'                 => __( 'Choose Arrow', 'your-plugin' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => 'fa fa-angle-right',
                'options'               => [
                    'fa fa-angle-right'             => __( 'Angle', 'rsaddon' ),
                    'fa fa-angle-double-right'      => __( 'Double Angle', 'rsaddon' ),
                    'fa fa-chevron-right'           => __( 'Chevron', 'rsaddon' ),
                    'fa fa-chevron-circle-right'    => __( 'Chevron Circle', 'rsaddon' ),
                    'fa fa-arrow-right'             => __( 'Arrow', 'rsaddon' ),
                    'fa fa-long-arrow-right'        => __( 'Long Arrow', 'rsaddon' ),
                    'fa fa-caret-right'             => __( 'Caret', 'rsaddon' ),
                    'fa fa-caret-square-o-right'    => __( 'Caret Square', 'rsaddon' ),
                    'fa fa-arrow-circle-right'      => __( 'Arrow Circle', 'rsaddon' ),
                    'fa fa-arrow-circle-o-right'    => __( 'Arrow Circle O', 'rsaddon' ),
                    'fa fa-toggle-right'            => __( 'Toggle', 'rsaddon' ),
                    'fa fa-hand-o-right'            => __( 'Hand', 'rsaddon' ),
                ],
            ]
        );
        
        $this->add_responsive_control(
            'arrows_size',
            [
                'label'                 => __( 'Arrows Size', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => '22' ],
                'range'                 => [
                    'px' => [
                        'min'   => 15,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        
        $this->add_responsive_control(
            'left_arrow_position',
            [
                'label'                 => __( 'Align Left Arrow', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => -100,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'         => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        
        $this->add_responsive_control(
            'right_arrow_position',
            [
                'label'                 => __( 'Align Right Arrow', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => -100,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'         => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $this->start_controls_tabs( 'tabs_arrows_style' );

        $this->start_controls_tab(
            'tab_arrows_normal',
            [
                'label'                 => __( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'arrows_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_color_normal',
            [
                'label'                 => __( 'Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'arrows_border_normal',
				'label'                 => __( 'Border', 'rsaddon' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev'
			]
		);

		$this->add_control(
			'arrows_border_radius_normal',
			[
				'label'                 => __( 'Border Radius', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_arrows_hover',
            [
                'label'                 => __( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'arrows_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next:hover, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_color_hover',
            [
                'label'                 => __( 'Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next:hover, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next:hover, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'                 => __( 'Padding', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'             => 'before',
			]
		);
        
        $this->end_controls_section();
        
        /**
         * Style Tab: Pagination: Dots
         */
        $this->start_controls_section(
            'section_dots_style',
            [
                'label'                 => __( 'Pagination: Dots', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label'                 => __( 'Position', 'rsaddon' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'inside'     => __( 'Inside', 'rsaddon' ),
                   'outside'    => __( 'Outside', 'rsaddon' ),
                ],
                'default'               => 'outside',
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'dots_size',
            [
                'label'                 => __( 'Size', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 2,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'dots_spacing',
            [
                'label'                 => __( 'Spacing', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_dots_style' );

        $this->start_controls_tab(
            'tab_dots_normal',
            [
                'label'                 => __( 'Normal', 'rsaddon' ),
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_color_normal',
            [
                'label'                 => __( 'Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'background: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'active_dot_color_normal',
            [
                'label'                 => __( 'Active Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'dots_border_normal',
				'label'                 => __( 'Border', 'rsaddon' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet',
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
			]
		);

		$this->add_control(
			'dots_border_radius_normal',
			[
				'label'                 => __( 'Border Radius', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
			]
		);

		$this->add_responsive_control(
			'dots_margin',
			[
				'label'                 => __( 'Margin', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
                'allowed_dimensions'    => 'vertical',
				'placeholder'           => [
					'top'      => '',
					'right'    => 'auto',
					'bottom'   => '',
					'left'     => 'auto',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullets' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_hover',
            [
                'label'                 => __( 'Hover', 'rsaddon' ),
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_color_hover',
            [
                'label'                 => __( 'Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Pagination: Fraction
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_fraction_style',
            [
                'label'                 => __( 'Pagination: Fraction', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'fraction_text_color',
            [
                'label'                 => __( 'Text Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'fraction',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'fraction_typography',
                'label'                 => __( 'Typography', 'rsaddon' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .swiper-pagination-fraction',
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'fraction',
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_load_more_button_style',
            [
                'label'                 => __( 'Load More Button', 'rsaddon' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );
        
        $this->add_responsive_control(
            'button_alignment',
            [
                'label'                 => __( 'Alignment', 'rsaddon' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'rsaddon' ),
						'icon'  => 'fa fa-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'rsaddon' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'rsaddon' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button-wrap' => 'text-align: {{VALUE}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_control(
            'button_top_spacing',
            [
                'label'                 => __( 'Top Spacing', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 20 ],
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px'],
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_control(
			'button_size',
			[
				'label'                 => __( 'Size', 'rsaddon' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'md',
				'options'               => [
					'xs' => __( 'Extra Small', 'rsaddon' ),
					'sm' => __( 'Small', 'rsaddon' ),
					'md' => __( 'Medium', 'rsaddon' ),
					'lg' => __( 'Large', 'rsaddon' ),
					'xl' => __( 'Extra Large', 'rsaddon' ),
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => __( 'Normal', 'rsaddon' ),
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __( 'Text Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'button_border_normal',
				'label'                 => __( 'Border', 'rsaddon' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-load-more-button',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'                 => __( 'Border Radius', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __( 'Typography', 'rsaddon' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .pp-load-more-button',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_responsive_control(
			'button_padding',
			[
				'label'                 => __( 'Padding', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow',
				'selector'              => '{{WRAPPER}} .pp-load-more-button',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_control(
            'load_more_button_icon_heading',
            [
                'label'                 => __( 'Button Icon', 'rsaddon' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid',
                    'button_icon!' => '',
                ],
            ]
        );

		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label'                 => __( 'Margin', 'rsaddon' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'       => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
                'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid',
                    'button_icon!' => '',
                ],
				'selectors'             => [
					'{{WRAPPER}} .pp-info-box .pp-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'rsaddon' ),
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button:hover' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __( 'Text Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button:hover' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'rsaddon' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button:hover' => 'border-color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_control(
			'button_animation',
			[
				'label'                 => __( 'Animation', 'rsaddon' ),
				'type'                  => Controls_Manager::HOVER_ANIMATION,
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow_hover',
				'selector'              => '{{WRAPPER}} .pp-load-more-button:hover',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

	/**
	 * Slider Settings.
	 *
	 * @access public
	 */
	public function slider_settings() {
        $settings = $this->get_settings();
        
        $slider_options = [
			'direction'              => 'horizontal',
			'speed'                  => 400,
			'slidesPerView'          => ( $settings['items']['size'] !== '' ) ? absint( $settings['items']['size'] ) : 3,
			'spaceBetween'           => ( $settings['margin']['size'] !== '' ) ? $settings['margin']['size'] : 10,
			'grabCursor'             => ( $settings['grab_cursor'] === 'yes' ),
			'autoHeight'             => true,
			'loop'                   => ( $settings['infinite_loop'] === 'yes' ),
		];
        
        if ( $settings['autoplay'] == 'yes' && ! empty( $settings['autoplay_speed'] ) ) {
            $autoplay_speed = $settings['autoplay_speed'];
        } else {
            $autoplay_speed = 999999;
        }
        
        $slider_options['autoplay'] = [
            'delay'                  => $autoplay_speed
        ];
        
               
        if ( $settings['arrows'] == 'yes' ) {
            $slider_options['navigation'] = [
                'nextEl'             => '.swiper-button-next-'.esc_attr( $this->get_id() ),
                'prevEl'             => '.swiper-button-prev-'.esc_attr( $this->get_id() ),
            ];
        }
        
        $slider_options['breakpoints'] = [
            '768'   => [
                'slidesPerView'      => ( $settings['items_tablet']['size'] !== '' ) ? absint( $settings['items_tablet']['size'] ) : 2,
                'spaceBetween'       => ( $settings['margin_tablet']['size'] !== '' ) ? $settings['margin_tablet']['size'] : 10,
            ],
            '480'   => [
                'slidesPerView'      => ( $settings['items_mobile']['size'] !== '' ) ? absint( $settings['items_mobile']['size'] ) : 1,
                'spaceBetween'       => ( $settings['margin_mobile']['size'] !== '' ) ? $settings['margin_mobile']['size'] : 10,
            ],
        ];
        
        $this->add_render_attribute(
			'insta-feed-container',
			[
				'data-slider-settings' => wp_json_encode( $slider_options ),
			]
		);
    }

    /**
	 * Render promo box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings();
		
		if ( $settings['feed_layout'] == 'carousel' ) {
			$layout = 'carousel';
		} else {
			$layout = 'grid';
		}
        
        $this->add_render_attribute( 'insta-feed-wrap', 'class', [
                'pp-instagram-feed',
                'clearfix',
                'pp-instagram-feed-' . $layout,
                'pp-instagram-feed-' . $settings['content_visibility']
            ]
        );

        if ( ($settings['feed_layout'] == 'grid' || $settings['feed_layout'] == 'masonry') && $settings['grid_cols'] ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-instagram-feed-grid-' . $settings['grid_cols'] );
        }

        if ( $settings['insta_image_grayscale'] == 'yes' ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-instagram-feed-gray' );
        }

        if ( $settings['insta_image_grayscale_hover'] == 'yes' ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-instagram-feed-hover-gray' );
        }
		
		if ( $settings['feed_layout'] != 'masonry' && $settings['square_images'] == 'yes' ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-if-square-images' );
        }
        
        $this->add_render_attribute( 'insta-feed-container', 'class', 'pp-instafeed' );
        
        $this->add_render_attribute( 'insta-feed', [
            'id'        => 'pp-instafeed-' . esc_attr( $this->get_id() ),
            'class'     => 'pp-instafeed-grid'
        ] );

        $this->add_render_attribute( 'insta-feed-inner', 'class', 'pp-insta-feed-inner' );
		
		if ( ! isset( $settings['insta_title_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['insta_title_icon'] = 'fa fa-instagram';
		}

		$has_icon = ! empty( $settings['insta_title_icon'] );
		
		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['insta_title_icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}
		
		if ( ! $has_icon && ! empty( $settings['title_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['title_icon'] );
		$is_new = ! isset( $settings['insta_title_icon'] ) && Icons_Manager::is_migration_allowed();
		
		$this->add_render_attribute( 'title-icon', 'class', 'pp-icon pp-icon-' . $settings['insta_title_icon_position'] );
        
        if ( $settings['feed_layout'] == 'carousel' ) {

            $this->add_render_attribute( 'insta-feed-inner', 'class', [
                'swiper-container-wrap',
                'pp-insta-feed-carousel-wrap'
            ] );
            
            $this->add_render_attribute( 'insta-feed-container', 'class', [
                'swiper-container',
                'swiper-container-' . esc_attr( $this->get_id() )
            ] );
            
            $this->slider_settings();
        
            if ( $settings['dots_position'] ) {
                $this->add_render_attribute( 'insta-feed-inner', 'class', 'swiper-container-dots-' . $settings['dots_position'] );
            } elseif ( $settings['pagination_type'] == 'fraction' ) {
                $this->add_render_attribute( 'insta-feed-inner', 'class', 'swiper-container-dots-outside' );
            }
        
            if ( $settings['direction'] == 'right' ) {
                $this->add_render_attribute( 'insta-feed-container', 'dir', 'rtl' );
            }
            
            $this->add_render_attribute( 'insta-feed', 'class', 'swiper-wrapper' );
        }
        
        if ( ! empty( $settings['insta_profile_url']['url'] ) ) {
            $this->add_render_attribute( 'instagram-profile-link', 'href', $settings['insta_profile_url']['url'] );

            if ( ! empty( $settings['insta_profile_url']['is_external'] ) ) {
                $this->add_render_attribute( 'instagram-profile-link', 'target', '_blank' );
            }
        }
        
        $pp_widget_options = [
            'user_id'           => ! empty( $settings['user_id'] ) ? $settings['user_id'] : '',
            'access_token'      => ! empty( $settings['access_token'] ) ? $settings['access_token'] : '',
            'sort_by'           => ! empty( $settings['sort_by'] ) ? $settings['sort_by'] : '',
            'images_count'      => ! empty( $settings['images_count']['size'] ) ? $settings['images_count']['size'] : '3',
            'target'            => 'pp-instafeed-'. esc_attr( $this->get_id() ),
            'resolution'        => ! empty( $settings['resolution'] ) ? $settings['resolution'] : '',
           
        ];
        ?>
        <div <?php echo $this->get_render_attribute_string( 'insta-feed-wrap' ); ?> data-settings='<?php echo wp_json_encode( $pp_widget_options ); ?>'>
            
            <div <?php echo $this->get_render_attribute_string( 'insta-feed-inner' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'insta-feed-container' ); ?>>
					<?php if ( $settings['insta_profile_link'] == 'yes' && $settings['insta_link_title'] ) { ?>
						<span class="pp-instagram-feed-title-wrap">
							<a <?php echo $this->get_render_attribute_string( 'instagram-profile-link' ); ?>>
								<span class="pp-instagram-feed-title">
									<?php if ( $settings['insta_title_icon_position'] == 'before_title' && $has_icon ) { ?>
									<span <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
										<?php
										if ( $is_new || $migrated ) {
											Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] );
										} elseif ( ! empty( $settings['insta_title_icon'] ) ) {
											?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
										}
										?>
									</span>
									<?php } ?>

									<?php echo esc_attr( $settings[ 'insta_link_title' ] ); ?>

									<?php if ( $settings['insta_title_icon_position'] == 'after_title' && $has_icon ) { ?>
									<span <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
										<?php
										if ( $is_new || $migrated ) {
											Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] );
										} elseif ( ! empty( $settings['insta_title_icon'] ) ) {
											?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
										}
										?>
									</span>
									<?php } ?>
								</span>
							</a>
						</span>
					<?php } ?>
                    <div <?php echo $this->get_render_attribute_string( 'insta-feed' ); ?>></div>
                </div>
                <?php
                    $this->render_load_more_button();

                    $this->render_dots();

                    $this->render_arrows();
                ?>
            </div>
        </div>
        <?php
    }

    /**
	 * Render load more button output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_load_more_button() {
        $settings = $this->get_settings();
        
        $this->add_render_attribute( 'load-more-button', 'class', [
				'pp-load-more-button',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
			]
		);

		if ( $settings['button_animation'] ) {
			$this->add_render_attribute( 'load-more-button', 'class', 'elementor-animation-' . $settings['button_animation'] );
		}

        if ( $settings['feed_layout'] == 'grid' && $settings['load_more_button'] == 'yes' ) { ?>
            <div class="pp-load-more-button-wrap">
                <div <?php echo $this->get_render_attribute_string( 'load-more-button' ) ?>>
                    <span class="pp-button-loader"></span>
                    <span class="pp-load-more-button-text">
                        <?php echo $settings['load_more_button_text']; ?>
                    </span>
                </div>
            </div>
        <?php }
    }

    /**
	 * Render insta feed carousel dots output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_dots() {
        $settings = $this->get_settings();

        if ( $settings['feed_layout'] == 'carousel' ) { ?>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-<?php echo esc_attr( $this->get_id() ); ?>"></div>
        <?php }
    }

    /**
	 * Render insta feed carousel arrows output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_arrows() {
        $settings = $this->get_settings();

        if ( $settings['feed_layout'] == 'carousel' && $settings['arrows'] == 'yes' ) { ?>
            <?php
                if ( $settings['arrow'] ) {
                    $pa_next_arrow = $settings['arrow'];
                    $pa_prev_arrow = str_replace("right","left",$settings['arrow']);
                }
                else {
                    $pa_next_arrow = 'fa fa-angle-right';
                    $pa_prev_arrow = 'fa fa-angle-left';
                }
            ?>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
                <i class="<?php echo esc_attr( $pa_next_arrow ); ?>"></i>
            </div>
            <div class="swiper-button-prev swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
                <i class="<?php echo esc_attr( $pa_prev_arrow ); ?>"></i>
            </div>
        <?php }
    }

    protected function content_template() {}

}