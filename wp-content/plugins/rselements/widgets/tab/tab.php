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

class Rsaddon_pro_Tab_Widget extends \Elementor\Widget_Base {
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
        return 'rs-tab';
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
        return esc_html__( 'RS Tab', 'rsaddon' );
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
                'label' => esc_html__( 'Title & Description', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Tab Title', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Title', 'rsaddon' ),
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tab_icon',
            [
                'label' => esc_html__( 'Title Icon', 'rsaddon' ),
                'label_block' => true,
                'type' => Controls_Manager::ICON,
                'options' => rsaddon_pro_get_icons(),                         
            ]
        );

        $repeater->add_control(
            'selected_image',
            [
                'label' => esc_html__( 'Title Image', 'rsaddon' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );


        $repeater->add_control(
            'tab_content',
            [
                'label' => esc_html__( 'Content', 'rsaddon' ),
                'default' => esc_html__( 'Tab Content', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Content', 'rsaddon' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
            ]
        );
        
        $repeater->add_control(
            'contents_image',
            [
                'label' => esc_html__( 'Content Image', 'rsaddon' ),
                'type' => Controls_Manager::MEDIA, 
                'label_block' => true,              
            ]
        );

        $repeater->add_control(
            'show_video_btn',
            [
                'label' => __( 'Show Video Button', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'yes' => __( 'Show', 'rsaddon' ),
                'no' => __( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'tab_video_link',
            [
                'label' => esc_html__( 'Video Link', 'rsaddon' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Youtube video link here', 'rsaddon' ),
                'label_block' => true,
                'condition' => [
                    'show_video_btn' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__( 'Tabs Items', 'rsaddon' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title' => esc_html__( 'Tab #1', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                    [
                        'tab_title' => esc_html__( 'Tab #2', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Ohh your data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],

                    [
                        'tab_title' => esc_html__( 'Tab #3', 'rsaddon' ),
                        'tab_content' => esc_html__( 'You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );


        $this->add_control(
            'view',
            [
                'label' => esc_html__( 'View', 'rsaddon' ),
                'type' => Controls_Manager::HIDDEN,
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
                    'vertical_2' => esc_html__( 'Vertical 2', 'rsaddon' ),
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
                'condition' => [
                    'type!' => 'vertical_2',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography_vertical2',
                'selector' => '{{WRAPPER}} .rstab-main ul.nav li a span',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'type' => 'vertical_2',
                ],
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
                    'type' => 'vertical_2',
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

        // Description Design Vertical 2
        $this->add_control(
            'description_heading_vertical2',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        $this->add_control(
            'tab_desc_color_vertical2',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_desc_typography_vertical2',
                'selector' => '{{WRAPPER}} .rstab-main ul.nav li a.active p',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'type' => 'vertical_2',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_desc_margin_vertical2',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        $this->add_responsive_control(
            'tab_desc_padding_vertical2',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        // Title Icon design Vertical 2
        $this->add_control(
            'icon_heading_vertical2',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title Icon', 'rsaddon' ),
                'separator' => 'before',
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        $this->add_control(
            'tab_icon_color_vertical2',
            [
                'label' => esc_html__( 'Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_icon_typography_vertical2',
                'selector' => '{{WRAPPER}} .rstab-main ul.nav li a i',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'condition' => [
                    'type' => 'vertical_2',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_icon_margin_vertical2',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        $this->add_responsive_control(
            'tab_icon_position_vertical2_y',
            [
                'label' => esc_html__( 'Icon Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a i' => 'top: {{SIZE}}{{UNIT}}; position: relative;',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        $this->add_responsive_control(
            'tab_icon_position_vertical2_x',
            [
                'label' => esc_html__( 'Icon Position Horizontal', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => -300,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a i' => 'left: {{SIZE}}{{UNIT}}; position: relative;',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
            ]
        );

        // Hover Normal tab start
        $this->start_controls_tabs(
            '_tabs_title_icon',
            [
                'separator' => 'before',
            ]
        );

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
                'condition' => [
                    'type!' => 'vertical_2',
                ]
            ]
        );

        $this->add_control(
            'tab_color_vertical2',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a span' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'type' => 'vertical_2',
                ]
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
                'condition' => [
                    'type!' => 'vertical_2',
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
                'condition' => [
                    'type!' => 'vertical_2',
                ], 

            ]
        );

        $this->add_control(
            'tab_active_color_vertical2',
            [
                'label' => esc_html__( 'Active Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main ul.nav li a.active span' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'type' => 'vertical_2'
                ]
               
            ]
        );

        $this->add_control(
            'ti_active_menu_background_color_vertical2',
            [
                'label' => esc_html__( 'Title Active Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,

                'selectors' => [ 
                    '{{WRAPPER}} .rstab-main ul.nav li a.active' => 'background-color: {{VALUE}};',                                 
                ],
                'condition' => [
                    'type' => 'vertical_2'
                ]
                
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
                'label' => esc_html__( 'Full Content Padding', 'rsaddon' ),
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
            'tabmedias_padding',
            [
                'label' => esc_html__( 'Content Image Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstbd .tab-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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


        //play button styling
        $this->start_controls_section(
            'section_playbtn_style',
            [
                'label' => esc_html__( 'Play Button', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'show_video_btn' => 'yes',
                // ],
            ]
        );

        $this->add_responsive_control(
            'playbtn_size',
            [
                'label' => esc_html__( 'Button Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'playbtn_icon_size',
            [
                'label' => esc_html__( 'Button Icon Size', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'playbtn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'playbtn_pulse_show_hide',
            [
                'label' => esc_html__( 'Pulse Design', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => esc_html__( 'Show', 'rsaddon' ),
                        'icon' => 'fa fa-eye',
                    ],
                    'none' => [
                        'title' => esc_html__( 'Hide', 'rsaddon' ),
                        'icon' => 'fa fa-eye-slash',
                    ],
             
                ],
                'default' => 'block',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:after' => 'display: {{VALUE}}',
                    '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:before' => 'display: {{VALUE}}',
                ]
            ]
        );

        // Play Button Normal/Hover Selector Tab Start
        $this->start_controls_tabs( 'playbtn_style_tab' );

            // Tab Normal Start
            $this->start_controls_tab(
                'playbtn_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'rsaddon' ),
                ]
            );
                $this->add_control(
                    'playbtn_normal_color',
                    [
                        'label' => esc_html__( 'Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a' => 'color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'playbtn_normal_bg',
                    [
                        'label' => esc_html__( 'Background Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a' => 'background: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_control(
                    'playbtn_pulse_border_color',
                    [
                        'label' => esc_html__( 'Pulse Border Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:before' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'playbtn_pulse_show_hide' => 'block',
                        ]
                    ]
                );
                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'playbtn_border',
                        'selector' => '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a',
                    ]
                );

            $this->end_controls_tab();
            // Tab Normal End

            // Tab Hover Start
            $this->start_controls_tab(
                'playbtn_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rsaddon' ),
                ]
            );

                $this->add_control(
                    'playbtn_hover_color',
                    [
                        'label' => esc_html__( 'Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'playbtn_hover_bg',
                    [
                        'label' => esc_html__( 'Background Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:hover' => 'background: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'playbtn_pulse_border_hover_color',
                    [
                        'label' => esc_html__( 'Pulse Border Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:hover:after' => 'border-color: {{VALUE}};',
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:hover:before' => 'border-color: {{VALUE}};',
                        ],
                        'condition' => [
                            'playbtn_pulse_show_hide' => 'block',
                        ]
                    ]
                );

                $this->add_control(
                    'playbtn_hover_border_color',
                    [
                        'label' => esc_html__( 'Border Color', 'rsaddon' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .rstab-main .tab-content .tab-image .rs-videos .animate-border a:hover' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();
            // Tab Hover End

        $this->end_controls_tabs();
        // Play Button Normal/Hover Selector Tab End

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



        <?php if ( 'vertical_2'!= $settings['type'] ){ ?>

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
                    $tab_icon_align = !empty($settings['tab_icon_title_align']) ? $settings['tab_icon_title_align'] : '';
                    
        $titleimg    = !empty($item['selected_image']) ? '<img class="'.esc_html($tab_icon_align).'" src="'. $item['selected_image']['url']. '" alt="'. $item['selected_image']['url']. '">' : '';
                    ?>
                    <li class="nav-item"><a class="nav-link <?php echo esc_attr($active_tab); ?>" data-toggle="tab" href="#a<?php echo esc_html($x);?><?php echo esc_html( $unique );?>">
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
                            <div class="rstbd">
                                <?php 
                                $ctnimg    = !empty($item['contents_image']['url']) ? '<img src="'. $item['contents_image']['url']. '" alt="'. $item['contents_image']['url']. '">' : ''; ?>
                                
                                <?php if(!empty($ctnimg)){?>
                                    <div class="tab-image"> 
                                        <?php echo wp_kses_post ( $ctnimg ); ?>
                                    </div>
                                    <?php } ?>                            
                                <div class="tab-contents"> 
                                    <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                                </div> 
                            </div>                                                            
                        </div>
                <?php endforeach; ?>                              
            </div>
        </div>
        <?php } ?>

        <?php if ( 'vertical_2'=== $settings['type'] ){ ?>

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
                    $tab_icon_align = !empty($settings['tab_icon_title_align']) ? $settings['tab_icon_title_align'] : '';
                    
        $titleimg    = !empty($item['selected_image']) ? '<img class="'.esc_html($tab_icon_align).'" src="'. $item['selected_image']['url']. '" alt="'. $item['selected_image']['url']. '">' : '';
                    ?>
                    <li class="nav-item"><a class="nav-link <?php echo esc_attr($active_tab); ?>" data-toggle="tab" href="#a<?php echo esc_html($x);?><?php echo esc_html( $unique );?>">
                        <?php if(!empty($icon)){
                            echo wp_kses_post ( $icon );
                            } else{
                                echo ($titleimg);
                            }
                        ?>
                        <?php if(!empty($item['tab_title'])){ ?>  
                            <span><?php echo esc_html($item['tab_title']); ?></span>
                        <?php } ?>
                        <?php if(!empty($item['tab_content'])){ ?>    
                            <p>
                            <?php echo $this->parse_text_editor( $item['tab_content'] ); ?> 
                            </p>
                        <?php } ?>
                        </a>
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


                            <div class="rstbd">
                                <?php 
                                $ctnimg    = !empty($item['contents_image']['url']) ? '<img src="'. $item['contents_image']['url']. '" alt="'. $item['contents_image']['url']. '">' : ''; ?>
                                
                                <?php if(!empty($ctnimg)){?>

                                    <div class="tab-image"> 
                                        <?php echo wp_kses_post ( $ctnimg ); ?>

                                            <?php  if ( 'yes' === $item['show_video_btn'] ) { ?>

                                                <div class="rs-videos ">
                                                    <div class="animate-border main-home">
                                                        <a class="popup-border popup-videos" href="<?php echo esc_url($item['tab_video_link']); ?>">
                                                            <i class="fa fa-play"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                    </div>
                                    <?php } ?>
                            </div>                                                            
                        </div>
                <?php endforeach; ?>                              
            </div>
        </div>
        <?php } ?>

   
        <?php
    }
}