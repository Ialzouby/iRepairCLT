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
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Blog_Slider_Widget extends \Elementor\Widget_Base {

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
        return 'rsblog-slider';
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
        return esc_html__( 'RS Blog Slider', 'rsaddon' );
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
                    'blog_style_2' => esc_html__( 'Blog Style Two', 'rsaddon' ),
                    'blog_style_3' => esc_html__( 'Blog Style Three', 'rsaddon' ),
                    'transparent' => esc_html__( 'Transparent One', 'rsaddon' ),
                    'transparent_2' => esc_html__( 'Transparent Style Two', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_cat_postion_style',
            [
                'label' => esc_html__( 'Category Position', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'bottom',
                'options' => [
                    'bottom' => esc_html__( 'Bottom', 'rsaddon' ),
                    'top' => esc_html__( 'Top', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Author Show/Hide', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-blog-grid .blog-item .blog-content' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'content_section_button',
            [
                'label' => esc_html__( 'Button Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
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

        //start slider settings
        $this->start_controls_section(
            'section_slider_settings',
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

        $this->end_controls_section(); //end slider settings


        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Blog Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__( 'Meta Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rsaddon-unique-slider .blog_style_2  .blog-content .blog-footer .blog-meta i' => 'color: {{VALUE}} !important;',
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
                    '{{WRAPPER}} .rsaddon-unique-slider .blog_style_2  .blog-content .blog-footer .blog-mata' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .blog-meta' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .blog-meta' => 'background: {{VALUE}};',

                ],                
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
                    '{{WRAPPER}} .blog-item .blog-content h3.blog-name a:hover' => 'color: {{VALUE}};',
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


        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .post-categories li a' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'category_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .post-categories li a:hover' => 'color: {{VALUE}};',

                ],                
            ]
        );




        $this->add_responsive_control(
            'blog_content_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
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
                'selector' => '{{WRAPPER}} .blog-content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Content Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .blog-item .blog-content',
                
            ]
        );

        $this->add_control(
            'blog_btm_shape_color',
            [
                'label' => esc_html__( 'Shape Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'blog_content_postion_style' => 'blog_style_2',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-services.services-style5:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-services.services-style5:after' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blog_btm_hover_shape_color',
            [
                'label' => esc_html__( 'Shape Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'blog_content_postion_style' => 'blog_style_2',
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item.blog_style_2 .blog-inner-wrap:before, {{WRAPPER}} .rs-blog-grid .blog-item.blog_style_2:hover:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-blog-grid .blog-item.blog_style_2:hover:after'  => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_area_content_padding',
            [
                'label' => esc_html__( 'Blog Area Padding', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-blog-grid .blog-item .blog-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'blog_area_content_bg',
            [
                'label' => esc_html__( 'Blog Area Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item .blog-inner-wrap' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'blog_area_box_shadow',
                'selector' => '{{WRAPPER}} .rs-blog-grid .blog-item',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'media_border',
                'selector' => '{{WRAPPER}} .rs-blog-grid .blog-item .blog-inner-wrap',
            ]
        );

        $this->end_controls_section();


        //Cate Style
        $this->start_controls_section(
            '_section_style_catess',
            [
                'label' => esc_html__( 'Category Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


       
        $this->add_control(
           'cate_border_radius',
           [
               'label' => esc_html__( 'Category Border Radius', 'rsaddon' ),
               'type' => Controls_Manager::DIMENSIONS,
               'size_units' => [ 'px', '%' ],
               'selectors' => [
                   '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .cat_list ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
               ],
           ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgroundcate',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .cat_list ul li a',
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
                    '{{WRAPPER}} .blog-item .blog-content .blog-btn, {{WRAPPER}} .blog-item .blog-content .custom-blog-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .blog-item .blog-content .blog-btn, {{WRAPPER}} .blog-item .blog-content .custom-blog-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .blog-item .blog-content  .custom-blog-btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-blog-grid .blog-item.blog_style_2.slick-slide:hover .blog-content .blog-btn-part2 a' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .blog-item .blog-content  .custom-blog-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_position',
            [
                'label' => esc_html__( 'Button Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                        

                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content  .blog-btn-part2' => 'margin-top:-{{SIZE}}{{UNIT}};',                    
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
            'blog_btn_hover_colors',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item.blog_style_2.slick-slide:hover .blog-content .blog-btn-part2 a, {{WRAPPER}} .blog-item .blog-content .blog-btn:hover, {{WRAPPER}} .blog-item .blog-content .custom-blog-btn:hover, {{WRAPPER}} .blog-item .blog-content .blog-btn:hover' => 'color: {{VALUE}};',
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
                     '{{WRAPPER}} .blog-item .blog-content  .custom-blog-btn:hover' => 'background-color: {{VALUE}};',
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
       
        $unique = rand(100,31120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');
        ?>
            <div class="rsaddon-unique-slider rs-blog-grid blog-grid">
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider" >
                    <?php 
                        $cat = $settings['category'];      
                

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
                      
                        
                        while($best_wp->have_posts()): $best_wp->the_post(); 

                        $full_date      = get_the_date();
                        $blog_date      = get_the_date('d M Y');    
                        $post_admin     = get_the_author();

                        
                        if(!empty($settings['blog_word_show'])){
                            $limit = $settings['blog_word_show'];
                        }
                        else{
                            $limit = 20;
                        }

                        ?>
                        
                        
                            <div class="blog-item <?php echo esc_html($settings['blog_content_postion_style']);?>">
                                <div class="blog-inner-wrap ">

                                    <div class="image-wrap">
                                        <a class="pointer-events" href="<?php the_permalink();?>">
                                            <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                                        </a> 
                                        <?php if(($settings['blog_cat_postion_style'] == 'top') ){ ?>

                                        <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                                            <div class="cat_list">
                                                <?php the_category( ); ?>
                                            </div>
                                        <?php } } ?>
                                    </div>



                                    <?php if(($settings['blog_content_postion_style'] == 'transparent_2')){ ?>
                                        <div class="blog-content">

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
                                                    <div class="blog-btn-part2">
                                                        <?php  
                                                            $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                        ?>
                                                            <a class="blog-btn2 <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                              
                                                                <?php if(!empty($settings['blog_btn_icon'])) : ?>
                                                                    <i class="fa <?php echo esc_html($settings['blog_btn_icon']);?>"></i>
                                                                <?php else: ?>
                                                                    <span class="custom-blog-btn">
                                                                        <i class="glyph-icon flaticon-right-arrow"></i>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </a>

                                                    </div>
                                              <?php  }
                                            } ?>  

                                            <?php if(!empty($full_date)){ ?>
                                                <div class="blog-meta">
                                                    <span class="date"></i>
                                                    <?php echo esc_html($full_date);?></span>
                                                </div>
                                            <?php } ?>

                                            

                                            <h3 class="blog-name"><a class="pointer-events" href="<?php the_permalink();?>"><?php the_title();?></a></h3>

                                            <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                                                <p><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                                            <?php } ?>
                                            
                                            <div class="blog-footer d-flex align-items-center justify-content-center">
                                                <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                                                    <div class="author-avatar  d-flex align-items-center">
                                                        <?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?> 
                                                        <?php if(!empty($post_admin)){ ?>
                                                            <span class="admin"><?php echo esc_html($post_admin);?></span>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?> 
                                                        
                                                <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                                                    <div class="cat_list">
                                                        <?php the_category( ); ?>
                                                    </div>
                                                <?php } ?>
                                                    
                                            </div> 
                                        </div>

                                    <?php } elseif (($settings['blog_content_postion_style'] == 'blog_style_3')) { ?>
                                        <div class="blog-content">

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
                                                    <div class="blog-btn-part2">
                                                        <?php  
                                                            $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                        ?>
                                                            <a class="blog-btn2 <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                              
                                                                <?php if(!empty($settings['blog_btn_icon'])) : ?>
                                                                    <i class="fa <?php echo esc_html($settings['blog_btn_icon']);?>"></i>
                                                                <?php else: ?>
                                                                    <span class="custom-blog-btn">
                                                                        <i class="glyph-icon flaticon-right-arrow"></i>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </a>

                                                    </div>
                                              <?php  }
                                            } ?>  

                                            <?php if(!empty($full_date)){ ?>
                                                <div class="blog-meta">
                                                    <span class="date"></i>
                                                    <?php echo esc_html($full_date);?></span>
                                                </div>
                                            <?php } ?>

                                            

                                            <h3 class="blog-name"><a class="pointer-events" href="<?php the_permalink();?>"><?php the_title();?></a></h3>

                                            <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                                                <p><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                                            <?php } ?>
                                            
                                            <div class="blog-footer d-flex align-items-center justify-content-center">
                                                <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                                                    <div class="author-avatar  d-flex align-items-center">
                                                        <?php echo get_avatar(get_the_author_meta( 'ID' ), 40);?> 
                                                        <?php if(!empty($post_admin)){ ?>
                                                            <span class="admin"><?php echo esc_html($post_admin);?></span>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?> 
                                                        
                                                <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                                                    <div class="cat_list">
                                                        <?php the_category( ); ?>
                                                    </div>
                                                <?php } ?>
                                                    
                                            </div> 
                                        </div>
                                    <?php }else{ ?>
                                        <div class="blog-content">

                                         

                                        <?php if(($settings['blog_cat_postion_style'] == 'bottom') ){ ?>

                                        <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                                            <div class="cat_list">
                                                <?php the_category( ); ?>
                                            </div>
                                        <?php } } ?>

                                        <div class="blog-footer d-flex align-items-center justify-content-between">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
                                            <?php if(!empty($blog_date) || !empty($post_admin)){ ?>
                                                <div class="blog-meta">
                                                    <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                                                    <span class="date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                                    <?php echo esc_html($blog_date);?></span>
                                                    <?php } ?>

                                                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                                                        <?php if(!empty($post_admin)){ ?>
                                                            <span class="admin"><i class="fa fa-user-o"></i> <?php echo esc_html($post_admin);?></span>
                                                        <?php } ?>
                                                    <?php } ?> 
                                                </div>
                                            <?php } ?>    
                                        </div>

                                        <h3 class="blog-name"><a class="pointer-events" href="<?php the_permalink();?>"><?php the_title();?></a></h3>



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
                                                <div class="blog-btn-part2">
                                                    <?php  
                                                        $icon_position = $settings['blog_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                                                    ?>
                                                        <a class="blog-btn2 <?php echo esc_attr($icon_position) ?>" href="<?php the_permalink(); ?>">
                                                          
                                                            <?php if(!empty($settings['blog_btn_icon'])) : ?>
                                                                <i class="fa <?php echo esc_html($settings['blog_btn_icon']);?>"></i>
                                                            <?php else: ?>
                                                                <span class="custom-blog-btn">
                                                                    <i class="glyph-icon flaticon-right-arrow"></i>
                                                                </span>
                                                            <?php endif; ?>
                                                        </a>

                                                </div>
                                          <?php  }
                                        } ?> 
                                        
                                        
                                    </div>   
                                    <?php } ?>

                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_query();  ?>
                
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
}?>