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
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Testimonial_Grid_Widget extends \Elementor\Widget_Base {

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
        return 'rs-testimonial';
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
        return esc_html__( 'RS Testimonial Grid', 'rsaddon' );
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
        return 'glyph-icon flaticon-rate';
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
            'per_page',
            [
                'label' => esc_html__( 'Testimonial Show Per Page', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '3', 'rsaddon' ),
                'separator' => 'before',
            ]
        );     
    
        $this->add_control(
            'testimonial_columns',
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
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
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
                'toggle' => false,
                'default' => 'left',
                'prefix_class' => 'rs-testimonial--',
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial' => 'text-align: {{VALUE}}'
                ]
               
            ]
        );

        $this->add_control(
            '_design',
            [
                'label' => esc_html__( 'Design', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => false,
                'options' => [
                    'basic' => esc_html__( 'Default', 'rsaddon' ),
                    'bubble' => esc_html__( 'Bubble', 'rsaddon' ),
                ],
                'default' => 'bubble',
                
            ]
        );


        $this->add_responsive_control(
            'bubble_position',
            [
                'label' => esc_html__( 'Bubble Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .item-content.bubble:after' => 'left: {{SIZE}}%;',                    
                    '{{WRAPPER}} .rs-testimonial--center .item-content.bubble:after' => 'left: {{SIZE}}%;',                    
                    '{{WRAPPER}} .rs-testimonial--right .item-content.bubble:after' => 'left: {{SIZE}}%;',                    
                ],

                'condition' => [
                    '_design' => 'bubble'
                ]
            ]
        );

        $this->end_controls_section();

         $this->start_controls_section(
            '_section_ratings',
            [
                'label' => esc_html__( 'Ratings', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'show_ratings',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'rating_bottom_position',
            [
                'label' => esc_html__( 'Bottom Gap', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .ratings' => 'padding-bottom: {{SIZE}}{{UNIT}};',                    
                ],

                'condition' => [
                    'show_ratings' => 'yes'
                ]
            ]
        );     
       

        $this->end_controls_section();

         $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'testimonial_style' => 'slider'
                ],
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

        $this->add_control(
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
                    '{{WRAPPER}} .rs-addon-slider .testimonial-item' => 'margin:0 {{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 
                
        $this->end_controls_section();
       
                
        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Title/Designation/Ratings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-name' => 'color: {{VALUE}};',             

                ],                
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'rsaddon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-name',                     
            ]
        );


        $this->add_control(
            'designation_color',
            [
                'label' => esc_html__( 'Designation Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                    
                    '{{WRAPPER}} .rs-testimonial .testimonial-title' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'label' => esc_html__( 'Designation Typography', 'rsaddon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-title',                    
            ]
        );
        

         $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Title Area Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_position',
            [
                'label'   => esc_html__( 'Title/Ratings/Image ', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'bottom',            
                'options' => [
                    'top' => esc_html__( 'Above Content', 'rsaddon' ),
                    'bottom' => esc_html__( 'Below Content', 'rsaddon' ),                                  
                ],
                'separator' => 'before',                            
            ]
        );      

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Testimonial Content', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial p' => 'color: {{VALUE}};',                    

                ],                
            ]
        );

          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Content Typography', 'rsaddon' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .rs-testimonial p'
            ]
        );

         $this->add_responsive_control(
            'testimonial_padding',
            [
                'label' => esc_html__( 'Content Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_top_position',
            [
                'label' => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        ); 

       
        $this->add_control(
            'testimonial_bg_color',
            [
                'label' => esc_html__( 'Content Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .rs-testimonial .testimonial-item .item-content.bubble:after' => 'border-top-color:{{VALUE}};',
                ],
            ]
        );      

        $this->add_responsive_control(
            'testimonial_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item p',
            ]
        );

        $this->add_responsive_control(
            'name_spacing',
            [
                'label' => esc_html__( 'Content Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_image',
            [
                'label' => esc_html__( 'Image', 'rsaddon' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

         $this->add_control(
            'show_images',
            [
                'label' => esc_html__( 'Show', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 65,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrap img' => 'width: {{SIZE}}{{UNIT}};',                    
                ],

                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Height', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrap img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );

        

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .image-wrap > img',
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]

        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .image-wrap > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '.image-wrap > img',
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );


         $this->add_responsive_control(
            'title_top_position',
            [
                'label' => esc_html__( 'Top/Bottom Position', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 300,
                    ],
                ],
               
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_left_position',
            [
                'label' => esc_html__( 'Left/Right Position', 'rsaddon' ),
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
               
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_images' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_boxes_style',
            [
                'label' => esc_html__( 'Testimonial Box Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


         $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

          $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       
        $this->add_control(
            'box_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'background-color: {{VALUE}};',                    
                ],
            ]
        );  

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item',
            ]
        );    

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-testimonial .testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testimonial_boxes_shadow',
                'selector' => '{{WRAPPER}} .rs-testimonial .testimonial-item',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_slider_style_arrow',
            [
                'label' => esc_html__( 'Slider Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'slider'
                ],

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

        $this->add_control(
            'navigation_arrow_background',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
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
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-next::before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-prev::before' => 'color: {{VALUE}};',

                ],                
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
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button' => 'border-color: {{VALUE}};',

                ],                
            ]
        );



        $this->add_control(
            'navigation_dot_icon_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li button:hover' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-addon-slider .slick-dots li.slick-active button' => 'background: {{VALUE}};',

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
                    '{{WRAPPER}} .rs-addon-slider .slick-dots' => 'margin-bottom:-{{SIZE}}{{UNIT}};',                    
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
        $settings = $this->get_settings_for_display(); ?>



            <div class="rs-testimonial-grid rs-testimonial">
                <div class="row">
                    <?php
                        $url = plugin_dir_url( __FILE__ );

                        $best_wp = new wp_Query(array(
                                'post_type'      => 'testimonials',
                                'posts_per_page' => $settings['per_page'],
                                                
                        ));

                        while($best_wp->have_posts()): $best_wp->the_post();
                            $designation  = !empty(get_post_meta( get_the_ID(), 'designation', true )) ? get_post_meta( get_the_ID(), 'designation', true ):'';

                            $ratings  = !empty(get_post_meta( get_the_ID(), 'ratings', true )) ? get_post_meta( get_the_ID(), 'ratings', true ):'';
                            
                        ?>
                            
                            <div class="col-lg-<?php echo esc_html($settings['testimonial_columns']);?>  col-xs-1">
                                <div class="testimonial-item <?php echo esc_attr( $settings['align'] );?>"> 
                                    <?php if('top' == $settings['title_position']) {?>                               
                                        <div class="testimonial-content">                                   
                                            <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                                <div class="image-wrap">                                    
                                                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>                                                   
                                                </div>
                                            <?php endif;?>  
                                            
                                                <div class="testimonial-information">
                                                    <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                        <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" /></div>
                                                    <?php endif;?> 
                                                    <?php if(get_the_title()):?>                         
                                                        <div class="testimonial-name"><?php the_title();?></div>
                                                    <?php endif;?>
                                                    <?php if( $designation ):?>
                                                        <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                                    <?php endif; ?>
                                                </div>
                                           
                                        </div>
                                    <?php }?>   

                                    <div class="item-content <?php echo esc_attr($settings['_design']);?>"> 
                                        <?php the_content();?>  
                                    </div>  

                                    <?php if('bottom' == $settings['title_position']) {?>                               
                                        <div class="testimonial-content">                                   
                                            <?php if(has_post_thumbnail() && $settings['show_images'] == 'yes' ): ?>
                                                <div class="image-wrap">                                    
                                                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>                                                   
                                                </div>
                                            <?php endif;?>  
                                            
                                                <div class="testimonial-information">
                                                    <?php if($settings['show_ratings'] == 'yes' && $ratings != ''): ?>
                                                        <div class="ratings"><img src="<?php echo esc_url($url); ?>/img/<?php echo esc_html($ratings); ?>.png" /></div>
                                                    <?php endif;?> 
                                                    <?php if(get_the_title()):?>                         
                                                        <div class="testimonial-name"><?php the_title();?></div>
                                                    <?php endif;?>
                                                    <?php if( $designation ):?>
                                                        <span class="testimonial-title"><?php echo esc_html( $designation );?></span>
                                                    <?php endif; ?>
                                                </div>
                                           
                                        </div>
                                    <?php }?>                       
                                </div>
                            </div>
                        <?php   
                        endwhile;
                        wp_reset_query();  
                     ?>  
                </div>
            </div>
        <?php        
        
    }
}?>