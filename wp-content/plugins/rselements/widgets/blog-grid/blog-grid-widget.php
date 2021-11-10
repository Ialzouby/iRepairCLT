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

class Rsaddon_Elementor_pro_Blog_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rsblog';
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
		return esc_html__( 'RS Blog Grid', 'rsaddon' );
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
		return 'glyph-icon flaticon-blogging';
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

		$category_dropdown[0] = 'Select Category';
		
		$terms  = get_terms( array( 'taxonomy' => "category", 'fields' => 'id=>name' ) );		
		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		} 


		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => [		
						
				]+ $category_dropdown,
				'multiple' => true,	
				'separator' => 'before',		
			]

		);
	
		$this->add_control(
			'blog_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,	
                'default' => 4,			
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'1' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',
							
			]
		);


		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Blog Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '6', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
            'blog_content_postion_style',
            [
                'label' => esc_html__( 'Content Style', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'rsaddon' ),
                    'transparent' => esc_html__( 'transparent', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Author Image Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__( 'Category Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'blog_meta_show_hide',
            [
                'label' => esc_html__( 'Date Meta Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'blog_content_show_hide',
            [
                'label' => esc_html__( 'Description Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'blog_word_show',
			[
				'label' => esc_html__( 'Show Content Limit', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '20', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
                    'blog_content_show_hide' => 'yes',
                ]
			]
		);

		$this->add_control(
            'blog_readmore_show_hide',
            [
                'label' => esc_html__( 'ReadMore Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
            'blog_pagination_show_hide',
            [
                'label' => esc_html__( 'Pagination Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );


		$this->add_control(
			'blog_btn_text',
			[
				'label' => esc_html__( 'Blog Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
				'placeholder' => esc_html__( 'Blog Button Text', 'rsaddon' ),
				'separator' => 'before',
				'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ]
			]
		);


		$this->add_control(
			'blog_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICON,
				'options' => rsaddon_pro_get_icons(),				
				'default' => 'fa fa-angle-right',
				'separator' => 'before',
				'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ]			
			]
		);

		$this->add_control(
		    'blog_btn_icon_position',
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
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_icon!' => '',
                ]
		    ]
		); 

		$this->add_control(
		    'blog_btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'condition' => [
		            'blog_btn_icon!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                ]
		    ]
		);

				
		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Blog Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'blog_meta_style',
            [
                'label' => esc_html__( 'Blog Meta Style', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__( 'Style 1', 'rsaddon' ),
                    'style2' => esc_html__( 'Style 2', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
            'blog_avatar_position',
            [
                'label' => esc_html__( 'Blog Author Image Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .blog-item .image-wrap .author-avatar' => 'left: {{SIZE}}%;',                   
                ],
                'condition' => [
                    'blog_avatar_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__( 'Meta Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .blog-meta span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .blog-meta' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'blog_meta_bg_color',
            [
                'label' => esc_html__( 'Meta Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .blog-meta' => 'background: {{VALUE}};',

                ], 
                'condition' => [
                    'blog_meta_style' => 'style2',
                ]               
            ]
        );

        $this->add_responsive_control(
            'blog_cat_position',
            [
                'label' => esc_html__( 'Category Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .cat_list' => 'left: {{SIZE}}%;',                   
                ],
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_cat_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .cat_list ul li a' => 'color: {{VALUE}};',

                ],
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ]                
            ]
        );

        $this->add_control(
            'blog_cat_bg_color',
            [
                'label' => esc_html__( 'Category Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .cat_list ul li a' => 'background: {{VALUE}};',

                ], 
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ]               
            ]
        );

        $this->add_responsive_control(
            'blog4_date_position',
            [
                'label' => esc_html__( 'Date Meta Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .blog-meta' => 'left: {{SIZE}}%;',                   
                ],
                'condition' => [
                    'blog_meta_style' => 'style2',
                ]  
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-content h3.blog-name a' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item:hover .blog-content h3.blog-name a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .blog-item .blog-content h3.blog-name a',
			]
		);

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content p' => 'color: {{VALUE}};',

                ],                
            ]
        );


         $this->add_responsive_control(
		    'blog_content_padding',
		    [
		        'label' => esc_html__( 'Content Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'blog_bottom_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-blog-grid .blog-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);


        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .blog-item .blog-inner-wrap',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'plugin-domain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .blog-content',
				
			]
		);

        $this->add_responsive_control(
            'blog_item_padding',
            [
                'label' => esc_html__( 'Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();


		//Read More Style
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Read More Style', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'blog_btn_link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .blog-btn',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_4,
		    ]
		);

		$this->add_control(
		    'blog_btn_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'blog_btn_box_shadow',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .blog-btn',
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
		    '_blog_btn_normal',
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
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_icon_translate',
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
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
		    '_blog_btn_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'rsaddon' ),
		    ]
		);

		$this->add_control(
		    'blog_btn_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content:hover .blog-btn, {{WRAPPER}} .blog-item .blog-content:focus .blog-btn ' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content:hover .blog-btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn:hover, {{WRAPPER}} .blog-item .blog-content .blog-btn:focus' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_hover_icon_translate',
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
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn.icon-before:hover i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .blog-item .blog-content .blog-btn.icon-after:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_section();


		



		// Start Blog Pagination Style
		$this->start_controls_section(
		    '_blog_pagination_style',
		    [
		        'label' => esc_html__( 'Pagination Style', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		        'condition' => [
                    'blog_pagination_show_hide' => 'yes',
                ]
		    ]
		);

		$this->add_control(
		    'blog_pagi_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .rs-blog-grid .rs-pagination-area .nav-links a' => 'color: {{VALUE}};',
		        ],
		        'condition' => [
                    'blog_pagination_show_hide' => 'yes',
                ]
		    ]
		);

		$this->add_control(
		    'blog_pagi_hover_color',
		    [
		        'label' => esc_html__( 'Text Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .rs-blog-grid .rs-pagination-area .nav-links a:hover' => 'color: {{VALUE}};',
		            '{{WRAPPER}} .rs-blog-grid .rs-pagination-area .nav-links span.current' => 'color: {{VALUE}};',
		        ],
		        'condition' => [
                    'blog_pagination_show_hide' => 'yes',
                ]
		    ]
		);

		$this->add_control(
		    'blog_pagi_divider_color',
		    [
		        'label' => esc_html__( 'Divider Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .rs-blog-grid .rs-pagination-area .nav-links a' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .rs-blog-grid .rs-pagination-area .nav-links span.current' => 'border-color: {{VALUE}};',
		        ],
		        'condition' => [
                    'blog_pagination_show_hide' => 'yes',
                ]
		    ]
		);

		$this->add_control(
		    'blog_pagiesc_html__bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-blog-grid .rs-pagination-area .nav-links' => 'background-color: {{VALUE}};',
		        ],
		        'condition' => [
                    'blog_pagination_show_hide' => 'yes',
                ]
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_pagi_shadow',
				'label' => esc_html__( 'Box Shadow', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .rs-blog-grid .rs-pagination-area .nav-links',
				'condition' => [
                    'blog_pagination_show_hide' => 'yes',
                ]
			]
		);

		$this->end_controls_section();

		// End Blog Pagination Style


		

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

		$settings = $this->get_settings_for_display(); ?>
			<div class="rs-blog-grid blog-grid">
				<div class="row">
				 	<?php 
				        $cat = $settings['category'];
				        if(($settings['blog_pagination_show_hide'] == 'yes')){
							global  $paged;
					        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							if(empty($cat)){
					        	$best_wp = new wp_Query(array(
					        			'post_type'      => 'post',
										'posts_per_page' => $settings['per_page'],
										'paged'          => $paged					
								));	  
					        }   
					        else{
					        	$best_wp = new wp_Query(array(
					        			'post_type'      => 'post',
										'posts_per_page' => $settings['per_page'],
										'paged'          => $paged,
										'tax_query'      => array(
									        array(
												'taxonomy' => 'category',
												'field'    => 'term_id', 
												'terms'    => $cat 
									        ),
									    )
								));	  
					        }
					    }

					    else{

						    if(empty($cat)){
					        	$best_wp = new wp_Query(array(
					        			'post_type'      => 'post',
										'posts_per_page' => $settings['per_page'],				
								));	  
					        }   
					        else{
					        	$best_wp = new wp_Query(array(
					        			'post_type'      => 'post',
										'posts_per_page' => $settings['per_page'],
										'tax_query'      => array(
									        array(
												'taxonomy' => 'category',
												'field'    => 'term_id', 
												'terms'    => $cat 
									        ),
									    )
								));	  
					        }
					    }
				        
						while($best_wp->have_posts()): $best_wp->the_post(); 

						$full_date      = get_the_date();
						$blog_date      = get_the_date('d M y');	
						$post_admin     = get_the_author();

						
						if(!empty($settings['blog_word_show'])){
							$limit = $settings['blog_word_show'];
						}
						else{
							$limit = 20;
						}

						?>
						
						<div class="col-lg-<?php echo esc_html($settings['blog_columns']);?> col-md-6 col-xs-1">
							<div class="blog-item <?php echo esc_html($settings['blog_content_postion_style']);?> blog_meta_<?php echo esc_html($settings['blog_meta_style']);?>">
								<div class="blog-inner-wrap ">
									<div class="image-wrap">
										<a class="pointer-events" href="<?php the_permalink();?>">
											<?php the_post_thumbnail(); ?>
										</a> 
										<?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
										<div class="author-avatar">
											<?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?> 
										</div>
										<?php } ?> 

										<?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>

											<?php if(($settings['blog_meta_style'] == 'style2') ){ ?>
												<div class="blog-meta">
													<?php if(!empty($blog_date)){ ?>
														<span class="date"><?php echo esc_html($blog_date);?></span>
													<?php } ?>
												</div>
											<?php } } ?>
											
											<?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
												<div class="cat_list">
													<?php the_category( ); ?>
												</div>
											<?php } ?>

									</div>	
									<div class="blog-content">

									  	<h3 class="blog-name"><a class="pointer-events" href="<?php the_permalink();?>"><?php the_title();?></a></h3>

                                        <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                                            <?php if(($settings['blog_meta_style'] == 'style1') ){ ?>
                                            <div class="blog-meta">

                                                <?php if(!empty($full_date)){ ?>
                                                <span class="date"><i class="fa fa-clock-o"></i> <?php echo esc_html($full_date);?></span>
                                                <?php } ?>

                                                <?php if(!empty($post_admin)){ ?>
                                                <span class="admin"><i class="fa fa-user"></i> <?php echo esc_html($post_admin);?></span>
                                                <?php } ?>

                                            </div>
                                        <?php } } ?>

									  	<?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
									  		<p><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
										<?php } ?>

										<?php if(($settings['blog_readmore_show_hide'] == 'yes') ){ ?>
                                            <?php if(!empty($settings['blog_btn_text'])){ ?>
                                                <div class="blog-btn-part">
                                                    <?php  
                                                        $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                    ?>
                                                        <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                            <span class="btn-txt"><?php echo esc_html($settings['blog_btn_text']);?></span>
                                                            <?php if(!empty($settings['blog_btn_icon'])) : ?>
                                                                <i class="fa <?php echo esc_html($settings['blog_btn_icon']);?>"></i>
                                                            <?php endif; ?>
                                                        </a>

                                                </div>
                                            <?php }else{ ?>
                                                <div class="blog-btn-part">
                                                    <?php  
                                                        $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                    ?>
                                                        <a class="blog-btn <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                            <span class="btn-txt"><?php echo esc_html__('Read More', 'rsaddon'); ?></span>
                                                            <?php if(!empty($settings['blog_btn_icon'])) : ?>
                                                                <i class="fa <?php echo esc_html($settings['blog_btn_icon']);?>"></i>
                                                            <?php endif; ?>
                                                        </a>

                                                </div>
                                          <?php  }
                                        } ?>


									</div>
						  		</div>
					  		</div>
						</div>
						<?php
						endwhile;
						wp_reset_query();  ?>
				</div>

				<?php 
					$paginate = paginate_links( array(
					    'total' => $best_wp->max_num_pages
					));

					if(!empty($paginate ) && ($settings['blog_pagination_show_hide'] == 'yes')){ ?>
						<div class="rs-pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
				<?php } ?>

			</div>
		<?php

	}
}?>