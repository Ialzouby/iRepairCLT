<?php
/**
 * Logo widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Apps_screenshots_Widget extends \Elementor\Widget_Base {
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
        return 'rs-apps-screenshots';
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
        return esc_html__( 'Apps Screenshots', 'rsaddon' );
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
        return 'eicon-gallery-grid';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Apps Screenshots', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Screenshots Image', 'rsaddon'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'rsaddon'),
                'type' => Controls_Manager::URL,                
            ]
        ); 

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Brand Name', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'rsaddon' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Brand Description', 'rsaddon'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'rsaddon' ),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );        

        


        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => esc_html__( 'Settings', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-grid-figure' => 'text-align: {{VALUE}}'
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
                ]
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Select Style', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'grid' => esc_html__( 'Grid', 'rsaddon' ),
                    'slider' => esc_html__( 'Slider', 'rsaddon' ),
                   
                ],
                'default' => 'slider',            
            ]
        );

        $this->add_control(
            'logo_grid_style',
            [
                'label'   => esc_html__( 'Select Grid Style', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [                  
                    'style1' => esc_html__( 'Style 1', 'rsaddon'),                   
                ],
                'condition' => [
                    'layout' => 'grid'
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 4,
                'options' => [
                    6 => esc_html__( '2 Columns', 'rsaddon' ),
                    4 => esc_html__( '3 Columns', 'rsaddon' ),
                    3 => esc_html__( '4 Columns', 'rsaddon' ),                  
                    2 => esc_html__( '6 Columns', 'rsaddon' ),
                ],                           
            ]
        );

        $this->add_control(
            'columns-gap',
            [
                'label' => esc_html__( 'Columns Gap', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'rsaddon' ),
                    'no-padding' => esc_html__( 'No Gap', 'rsaddon' ),                   
                ],                           
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => 'slider'
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
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
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
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
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
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
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
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-addon-slider .grid-item' => 'padding:0 {{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 
                
        $this->end_controls_section();

   
        $this->start_controls_section(
            '_section_style_grid',
            [
                'label' => esc_html__( 'Item', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'grid_border',
                'selector' => '{{WRAPPER}} .rs-grid-figure',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'selector' => '{{WRAPPER}} .rs-grid-figure',
            ]
        ); 

        $this->add_responsive_control(
            'grid_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );     

        $this->add_control(
            'grid_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            '_tabs_image_effects',
            [
                'separator' => 'before'
            ]
        );

        $this->start_controls_tab(
            '_tab_image_effects_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        );

        $this->add_responsive_control(
            'show_tooltip',
            [
                'label' => esc_html__( 'Show Tooltip', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'image_opacity',
            [
                'label' => esc_html__( 'Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure .rs-grid-img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'image_blur',
            [
                'label' => esc_html__( 'Blur', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure .rs-grid-img' => 'filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters',
                'selector' => '{{WRAPPER}} .rs-grid-figure .rs-grid-img',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab( 'hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        );

        $this->add_control(
            'image_opacity_hover',
            [
                'label' => esc_html__( 'Opacity', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .rs-grid-img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'image_blur_hover',
            [
                'label' => esc_html__( 'Blur', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                        'min' => 0,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .rs-grid-img' => 'filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'image_css_filters_hover',
                'selector' => '{{WRAPPER}} .rs-grid-figure:hover .rs-grid-img',
            ]
        );

        $this->add_control(
            'image_scale',
            [
                'label' => esc_html__( 'Zoom', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .rs-grid-img' => 'transform: scale({{image_scale.SIZE}})',
                ],
            ]
        );

        $this->add_control(
            'image_bg_hover_transition',
            [
                'label' => esc_html__( 'Transition Duration', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .rs-grid-img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'rsaddon' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            '_title_style_grid',
            [
                'label' => esc_html__( 'Title Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'show_title',
            [
                'label' => esc_html__( 'Show Title', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
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
                'default' => 'h3',
                'toggle' => false,
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}}  .logo-title .title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'separator'   => 'before',
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'title_border',
                'selector' => '{{WRAPPER}} .logo-title',
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logo-title .title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .logo-title .title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_bg',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logo-title' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'title_hover_bg',
            [
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .logo-title' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_title' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_desc_style_grid',
            [
                'label' => esc_html__( 'Description Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'show_desc',
            [
                'label' => esc_html__( 'Show Description', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}}  .logo-desc .description',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'separator'   => 'before',
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'desc_border',
                'selector' => '{{WRAPPER}} .logo-desc',
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .logo-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logo-desc .description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .logo-desc .description' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_bg',
            [
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .logo-desc' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'desc_hover_bg',
            [
                'label' => esc_html__( 'Hover Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-grid-figure:hover .logo-desc' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    'show_desc' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Slider Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'slider'
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

        if ( empty($settings['logo_list'] ) ) {
            return;
        }
        ?>

        <?php

            /*----------grid style-------
            -----------------------------*/

            if ( 'style1' == $settings['logo_grid_style'] ):?>
            <div class="rs-logo-grid logo-grid-<?php echo esc_attr($settings['logo_grid_style']); ?>">
                <div class="row">
                <?php
                    foreach ( $settings['logo_list'] as $index => $item ) :
                        $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = Utils::get_placeholder_image_src();
                        }
                        
                        $title = !empty($item['name']) ? $item['name'] : '';

                        $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
                        
                        $description = !empty($item['description']) ? $item['description'] : '';

                        $target = !empty($item['link']['is_external']) ? 'target=_blank' : '';  

                        $link = !empty($item['link']['url']) ? $item['link']['url'] : '';

                        $gap = $settings['columns-gap'] == 'no-padding' ? 'no-padding' : '';

                        $show_tooltip = $settings['show_tooltip'] == 'yes' ? 'data-toggle= tooltip data-placement= top ' : '';

                        $animation = !empty($settings['hover_animation'])? 'elementor-animation-'.$settings['hover_animation'].'':'';

                        ?>
                        <div class="col-lg-<?php echo esc_attr($settings['columns']);?> col-md-6 col-xs-1 <?php echo esc_attr( $gap );?>">
                            <div  class="rs-grid-figure">
                                <div class="logo-img">
                                    <a href="<?php echo esc_url($link);?>" <?php echo wp_kses_post($target);?>><img class="rs-grid-img <?php echo esc_attr( $animation ); ?>" <?php echo esc_attr( $show_tooltip );?> src="<?php echo esc_url( $image ); ?>" title="<?php echo esc_attr( $item['name'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>"></a>
                                </div>
                                <?php if(!empty($item['name'])):?>
                                    <?php if ( 'yes' === $settings['show_title'] ):?>
                                        <div class="logo-title">
                                            <<?php echo esc_attr($title_tag);?> class="title"> <?php echo esc_attr ($title);?></<?php echo esc_attr($title_tag);?>>                                    
                                        </div>
                                    <?php endif;?>
                                <?php endif;?>
                                <?php if(!empty($item['description'])):?>
                                    <?php if ( 'yes' === $settings['show_desc'] ):?>
                                        <div class="logo-desc">
                                            <p class="description"> <?php echo esc_attr ($description);?></p>
                                        </div>
                                    <?php endif;?>
                                <?php endif;?>
                            </div>
                        </div>                   
                    <?php endforeach; ?>
                </div>
            </div>

            <?php /*----------Slider style-------
            -----------------------------*/

            else: ?>

            <div class="rsaddon-unique-slider">
                <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-apps-screenshots">    
                    <div class="carousel">    
                        <?php
                            foreach ( $settings['logo_list'] as $index => $item ) :
                                $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                                if ( ! $image ) {
                                    $image = Utils::get_placeholder_image_src();
                                }
                                
                                $title        = !empty($item['name']) ? $item['name'] : '';                                
                                $title_tag    = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
                                $description  = !empty($item['description']) ? $item['description'] : '';
                                $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';  
                                $link         = !empty($item['link']['url']) ? $item['link']['url'] : '';
                                $gap          = $settings['columns-gap'] == 'no-padding' ? 'no-padding' : '';                            
                                $show_tooltip = $settings['show_tooltip'] == 'yes' ? 'data-toggle= tooltip data-placement= top ' : '';
                                $animation    = !empty($settings['hover_animation'])? 'elementor-animation-'.$settings['hover_animation'].'':'';
                                ?>

                                    <div class="carousel-item">
                                        <a href="<?php echo esc_url($link);?>" <?php echo wp_kses_post($target);?>><img class="rs-grid-img <?php echo esc_attr( $animation ); ?>" <?php echo esc_attr( $show_tooltip );?> src="<?php echo esc_url( $image ); ?>" title="<?php echo esc_attr( $item['name'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>"></a>

                                    </div>
                                    <?php if(!empty($item['name'])):?>
                                        <?php if ( 'yes' === $settings['show_title'] ):?>
                                            <div class="logo-title">
                                                <<?php echo esc_attr($title_tag);?> class="title"> <?php echo esc_attr ($title);?></<?php echo esc_attr($title_tag);?>>                                    
                                            </div>
                                        <?php endif;?>
                                    <?php endif;?>
                                    <?php if(!empty($item['description'])):?>
                                        <?php if ( 'yes' === $settings['show_desc'] ):?>
                                            <div class="logo-desc">
                                                <p class="description"> <?php echo esc_attr ($description);?></p>
                                            </div>
                                        <?php endif;?>
                                    <?php endif;?>

                                    
                            <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <script type="text/javascript"> 
                jQuery(document).ready(function(){
                    // 3D Slider Carousel
                    if (jQuery('.rs-apps-screenshots .carousel').length) { 
                        jQuery('.rs-apps-screenshots .carousel').carousel({
                            autoplay: true,
                            duration: 0,
                            shift: 5,
                            padding: 10,
                        });
                    }



            });
            </script>
        <?php endif;

    }
}