<?php
/**
 * Tab widget class
 *
 */
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Rsaddon_Pro_Advance_Tab_Widget extends \Elementor\Widget_Base {
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
        return 'rs-tab-advanced';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RS Advance Tab', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-tabs-1';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'tab', 'vertical', 'icon', 'horizental' ];
    }

	protected function _register_controls() {
        $category_dropdown[0] = 'Select Template';
        $best_wp = new wp_Query(array(
        'post_type'      => 'rselements_pro',
        'posts_per_page' => -1
                                         
        ));  

         while($best_wp->have_posts()): $best_wp->the_post(); 

            $title = get_the_title();
            $id = get_the_ID();
            $category_dropdown[$id] = $title;

         endwhile; 
         wp_reset_query();  
      

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'rsaddon' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title & Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tab Title', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Title', 'rsaddon' ),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tab_icon',
            [
                'label'       => esc_html__( 'Title Icon', 'rsaddon' ),
                'label_block' => true,
                'type'        => Controls_Manager::ICON,
                'options'     => rsaddon_pro_get_icons(),                         
            ]
        );

        $repeater->add_control(
            'selected_image',
            [
                'label'       => esc_html__( 'Title Image', 'rsaddon' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'content_location',
            [
                'label'       => esc_html__( 'Select Content Location', 'rsaddon' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'default'     => 'editor',               
                'options' => [
                    'editor'    => 'Editor',
                    'templates' => 'Templates',                                
                ],                                          
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label'       => esc_html__( 'Template', 'rsaddon' ),
                'type'        => Controls_Manager::SELECT, 
                'label_block' => true,
                'default'     => 0,         
                'options' => [      
                        
                ]+ $category_dropdown,                
                'separator' => 'before', 
                'condition' => [
                    'content_location' => 'templates',
                ],      
            ]
        );
 

        $repeater->add_control(
            'tab_content',
            [
                'label'       => esc_html__( 'Content', 'rsaddon' ),
                'default'     => esc_html__( 'Tab Content', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Content', 'rsaddon' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
                 'condition' => [
                    'content_location' => 'editor',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__( 'Tabs Items', 'rsaddon' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title'   => esc_html__( 'Tab #1', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                    [
                        'tab_title'   => esc_html__( 'Tab #2', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Ohh your data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],

                    [
                        'tab_title'   => esc_html__( 'Tab #3', 'rsaddon' ),
                        'tab_content' => esc_html__( 'You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__( 'View', 'rsaddon' ),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );


        $this->add_control(
            'tabs_item_width',
            [
                'label' => esc_html__( 'Tab Menu Item Full', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'full_tab_item',
                'options' => [
                    'full_tab_item' => esc_html__( 'Yes', 'rsaddon' ),
                    'no_item_menu' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

         $this->add_responsive_control(
            'menu_item_alignment',
            [
                'label' => esc_html__( 'Menu Alignment', 'rsaddon' ),
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
             
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main.no_item_menu' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'tabs_item_width' => 'no_item_menu',
                ],
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'rsaddon' ),
                    'vertical' => esc_html__( 'Vertical', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();

        //start title styling

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => esc_html__( 'Title', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}} .rstab-main ul.nav li a',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_control(
            'navigation_width',
            [
                'label' => esc_html__( 'Navigation Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'type' => 'vertical',
                ],
            ]
        );

        $this->add_responsive_control(
		    'tab_title_spacing_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main ul.nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'tab_title_spacing_margin',
		    [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type'  => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main ul.nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);   

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'tab_icon_bg_border',
                'selector' => '{{WRAPPER}} .rstab-main ul.nav li a'                
            ]
        );

        $this->add_control(
            'tab_active_border_color',
            [
                'label' => esc_html__( 'Active Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active' => 'border-color: {{VALUE}};',
                ],
               
            ]
        );

        $this->add_responsive_control(
            'tab_title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );   

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Title Alignment', 'rsaddon' ),
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
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'fa fa-align-right',
                    ],
             
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a' => 'justify-content: {{VALUE}}',
                ]
            ]
        );


        $this->add_control(
            'tab_design',
            [
                'label' => esc_html__( 'Design', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'basic' => esc_html__( 'Default', 'rsaddon' ),
                    'bubble' => esc_html__( 'Bubble', 'rsaddon' ),
                ],
                'default' => 'basic',
            ]
        );


        $this->add_responsive_control(
            'tab_bubble_position',
            [
                'label' => esc_html__( 'Bubble Position Horizontal', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active:after' => 'left: {{SIZE}}%;',                   
                ],

                'condition' => [
                    'tab_design' => 'bubble',
                    'type' => 'horizontal'
                ]
            ]
        );


        $this->add_responsive_control(
            'tab_bubble_position_vertical',
            [
                'label' => esc_html__( 'Bubble Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active:after' => 'top: {{SIZE}}%;',                   
                ],

                'condition' => [
                    'tab_design' => 'bubble',
                    'type' => 'vertical'
                ]
            ]
        );

        $this->add_responsive_control(
            'tab_title_area_padding',
            [
                'label' => esc_html__( 'Title Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs( '_tabs_title_icon' );

        $this->start_controls_tab(
            'tab_icon_bg_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

        $this->add_control(
            'tab_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'ti_menu_background_color',
            [
                'label' => esc_html__( 'Title Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a' => 'background-color: {{VALUE}};',                      
                ],
            ]
        );

        $this->add_control(
            'tmenu_background_full',
            [
                'label' => esc_html__( 'Title Area Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main' => 'background-color: {{VALUE}};',                                   
                ],
            ]
        );

        $this->end_controls_tab();



        $this->start_controls_tab(
            'tab_icon_bg_hover_tab',
            [
                'label' => esc_html__( 'Active', 'rsaddon' ),
            ]
        );
        
        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__( 'Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rstab-main ul.nav li a:hover' => 'color: {{VALUE}};',
                ],
               
            ]
        );

        $this->add_control(
            'ti_active_menu_background_color',
            [
                'label' => esc_html__( 'Title Active Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [ 
                    '{{WRAPPER}} .rstab-main ul.nav li a.active' => 'background-color: {{VALUE}};',                                  
                    '{{WRAPPER}} .rstab-main ul.nav li a:hover' => 'background-color: {{VALUE}};',                                  
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();


        


        $this->end_controls_section();




        //start icon styling
        $this->start_controls_section(
            'section_tabs_icon_style',
            [
                'label' => esc_html__( 'Icon/Image', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_icon_type',
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

        $this->add_responsive_control(
            'tab_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__( 'Left', 'rsaddon' ),
                    'icon_top' => esc_html__( 'Top', 'rsaddon' ),
                ],               
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_icon_title_align',
            [
                'label' => esc_html__( 'Title/Icon Alignment', 'rsaddon' ),
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
             
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav.icon_top li a' => 'text-align: {{VALUE}}',
                ],
                'condition' => [
                    'tab_icon_position' => 'icon_top'
                ]
            ]
        );

        $this->add_responsive_control(
		    'tab_icon_size',
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
		            '{{WRAPPER}} .rstab-main ul.nav li a i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .rstab-main ul.nav li a img' => 'width: {{SIZE}}{{UNIT}} !important;',
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'tab_icon_spacing_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main ul.nav li a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		            '{{WRAPPER}} .rstab-main ul.nav li a img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'tab_icon_spacing_maring',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main ul.nav li a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'tab_icon_border',
		        'selector' => '{{WRAPPER}} .rstab-main ul.nav li a i',
                'selector' => '{{WRAPPER}} .rstab-main ul.nav li a img',
		    ]
		);

		$this->add_responsive_control(
		    'tab_icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rstab-main ul.nav li a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .rstab-main ul.nav li a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
		        ],
		    ]
		);

        $this->add_control(
            'tab_icon_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a i' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_control(
            'tab_icon_active_color',
            [
                'label' => esc_html__( 'Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rstab-main ul.nav li a:hover i'  => 'color: {{VALUE}};',
                ],              
            ]
        );


        $this->add_control(
            'background_icon_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a i'   => 'background-color: {{VALUE}};',                    
                    '{{WRAPPER}} .rstab-main ul.nav li a img' => 'background-color: {{VALUE}};',                    
                ],
            ]
        );

        $this->add_control(
            'icon_active_background_color',
            [
                'label' => esc_html__( 'Active Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active i'   => 'background-color: {{VALUE}};',                    
                    '{{WRAPPER}} .rstab-main ul.nav li a:hover i'    => 'background-color: {{VALUE}};',                    
                    '{{WRAPPER}} .rstab-main ul.nav li a.active img' => 'background-color: {{VALUE}};',                    
                    '{{WRAPPER}} .rstab-main ul.nav li a:hover img'  => 'background-color: {{VALUE}};',                    
                ],
            ]
        );

        $this->end_controls_section();




        //start content styling

         $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'color: {{VALUE}};',
                ],               
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',                
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'content_bg',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
                'separator' => 'before',            
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_bg_border',
                'selector' => '{{WRAPPER}} .rstab-main .tab-content',
                'separator' => 'before',               
            ]
        );


         $this->add_responsive_control(
            'tab_content_align',
            [
                'label' => esc_html__( 'Content Alignment', 'rsaddon' ),
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
             
                ],
                'separator' => 'before',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_top_gap',
            [
                'label' => esc_html__( 'Content Top Gap', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],                
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',                   
                ],
            ]
        );  


        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Content Padding', 'rsaddon' ),
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
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'padding: {{SIZE}}{{UNIT}};',
              
                ],
            ]
        ); 

        

        $this->add_responsive_control(
            'tab_content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        

        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $tabs = $this->get_settings_for_display('tabs');  
        $settings = $this->get_settings_for_display();  
        $id_int = substr( $this->get_id_int(), 0, 3 ); 


        ?>

        <div class="rstab-main <?php echo esc_attr($settings['type']); ?> <?php echo esc_attr($settings['tabs_item_width']); ?>"> 
            <ul  class="nav nav-nav-tabs <?php echo esc_attr($settings['tab_design']);?> <?php echo esc_attr($settings['tab_icon_position']);?>">
                <?php
                $unique = rand(2012,3554120);
                $x= 0;
                foreach ( $tabs as $index => $item ) :
                    $x++;

                    if($x == 1){
                        $active_tab = 'active';
                    }else{
                        $active_tab = '';
                    }

                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

                    $this->add_render_attribute( $tab_title_setting_key, [
                        'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class' => [ 'elementor-tab-title', 'elementor-tab-desktop-title' ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ] );

                    $icon = !empty($item['tab_icon']) ? '<i class="'.$item['tab_icon'].'"></i>': '';
                    
                    $titleimg    = !empty($item['selected_image']) ? '<img src="'. $item['selected_image']['url']. '" />' : '';
                    ?>
                    <li class="nav-item"><a class="nav-link <?php echo esc_attr($active_tab); ?>" data-toggle="tab" href="#a<?php echo esc_html($x);?><?php echo esc_html( $unique );?>" role="tab" aria-selected="true">
                        <?php if(!empty($icon)){
                            echo wp_kses_post ( $icon );
                            } else{
                                echo ($titleimg);
                            }
                        ?>
                        <?php echo esc_html($item['tab_title']); ?></a>
                    </li>

                <?php endforeach; ?>                    
            </ul>

            <div class="tab-content clearfix">
                <?php
                    $x = 0;
                    foreach ( $tabs as $index => $item ) :
                        $tab_count = $index + 1;
                        $x++;
                        if($x == 1){
                            $active_tab = 'active';
                        }else{
                            $active_tab = '';
                        }
                        $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                        $tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

                        $this->add_render_attribute( $tab_content_setting_key, [
                            'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                            'class' => [ 'elementor-tab-content', 'elementor-clearfix' ],
                            'data-tab' => $tab_count,
                            'role' => 'tabpanel',
                            'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                        ] );

                        $this->add_render_attribute( $tab_title_mobile_setting_key, [
                            'class' => [ 'elementor-tab-title', 'elementor-tab-mobile-title' ],
                            'data-tab' => $tab_count,
                            'role' => 'tab',
                        ] );

                        $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );                       
                        ?>
                       
                        <div class="tab-pane <?php echo esc_attr($active_tab);?>" id="a<?php echo esc_html($x);?><?php echo esc_html($unique);?>">
                            <?php if($item['content_location'] == 'editor'){
                                echo $this->parse_text_editor( $item['tab_content'] ); 
                            }else{

                                $id = $item['template'];
                                echo do_shortcode('[SHORTCODE_ELEMENTOR id= '.$id.']');
                            }
                            ?>                                
                        </div>
                <?php endforeach; ?>
                                               
            </div>
          
        </div>
   
        <?php
    }
}