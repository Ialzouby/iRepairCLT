<?php
/**
 * Image hover widget class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Image_Hover_Effect_Widget extends \Elementor\Widget_Base {
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
        return 'rs-image-hover-effect';
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
        return esc_html__( 'RS Image Hover Effect', 'rsaddon' );
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
        return 'glyph-icon flaticon-image';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function _register_controls() {


        $this->start_controls_section(
            'section_service_image',
            [
                'label' => esc_html__( 'Global Style', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-image-hover-effect .animation-effect' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        
        $this->start_controls_section(
            '_section_image_content',
            [
                'label' => esc_html__( 'Image Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 

        $this->add_control(
            'icon_image',
            [
                'label' => esc_html__( 'Icon Image', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],    
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hover_effect_image',
            [
                'label' => esc_html__( 'Big Image', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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
            'rs_image_effect',
            [
                'label'         => __('Effect', 'rsaddon'),
                'label_block'   => true,
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'animation_none'                    => esc_html__('Animation None', 'rsaddon'),
                    'default'                           => esc_html__('Default', 'rsaddon'),
                    'rs-image-fade'                     => esc_html__('Fade', 'rsaddon'),
                    'rs-image-fade-in-up'               => esc_html__('Fade In Up', 'rsaddon'),
                    'rs-image-fade-in-down'             => esc_html__('Fade In Down', 'rsaddon'),
                    'rs-image-fade-in-left'             => esc_html__('Fade In Left', 'rsaddon'),
                    'rs-image-fade-in-right'            => esc_html__('Fade In Right', 'rsaddon'),
                    'rs-image-slide-up'                 => esc_html__('Slide Up', 'rsaddon'),
                    'rs-image-slide-down'               => esc_html__('Slide Down', 'rsaddon'),
                    'rs-image-slide-left'               => esc_html__('Slide Left', 'rsaddon'),
                    'rs-image-slide-right'              => esc_html__('Slide Right', 'rsaddon'),
                    'rs-image-reveal-up'                => esc_html__('Reveal Up', 'rsaddon'),
                    'rs-image-reveal-down'              => esc_html__('Reveal Down', 'rsaddon'),
                    'rs-image-reveal-left'              => esc_html__('Reveal Left', 'rsaddon'),
                    'rs-image-reveal-right'             => esc_html__('Reveal Right', 'rsaddon'),
                    'rs-image-push-up'                  => esc_html__('Push Up', 'rsaddon'),
                    'rs-image-push-down'                => esc_html__('Push Down', 'rsaddon'),
                    'rs-image-push-left'                => esc_html__('Push Left', 'rsaddon'),
                    'rs-image-push-right'               => esc_html__('Push Right', 'rsaddon'),
                    'rs-image-hinge-up'                 => esc_html__('Hinge Up', 'rsaddon'),
                    'rs-image-hinge-down'               => esc_html__('Hinge Down', 'rsaddon'),
                    'rs-image-hinge-left'               => esc_html__('Hinge Left', 'rsaddon'),
                    'rs-image-hinge-right'              => esc_html__('Hinge Right', 'rsaddon'),
                    'rs-image-flip-horiz'               => esc_html__('Flip Horizontal', 'rsaddon'),
                    'rs-image-flip-vert'                => esc_html__('Flip Vertical', 'rsaddon'),
                    'rs-image-flip-diag-1'              => esc_html__('Flip Crosss 1', 'rsaddon'),
                    'rs-image-flip-diag-2'              => esc_html__('Flip Crosss 2', 'rsaddon'),
                    'rs-image-shutter-out-horiz'        => esc_html__('Shutter Out Horizontal', 'rsaddon'),
                    'rs-image-shutter-out-vert'         => esc_html__('Shutter Out Vertical', 'rsaddon'),
                    'rs-image-shutter-out-diag-1'       => esc_html__('Shutter Out Crosss 1', 'rsaddon'),
                    'rs-image-shutter-out-diag-2'       => esc_html__('Shutter Out Crosss 2', 'rsaddon'),
                    'rs-image-shutter-in-horiz'         => esc_html__('Shutter In Horizontal', 'rsaddon'),
                    'rs-image-shutter-in-vert'          => esc_html__('Shutter In Vertical', 'rsaddon'),
                    'rs-image-shutter-in-out-horiz'     => esc_html__('Shutter In Out Horizontal', 'rsaddon'),
                    'rs-image-shutter-in-out-vert'      => esc_html__('Shutter In Out Vertical', 'rsaddon'),
                    'rs-image-shutter-in-out-diag-1'    => esc_html__('Shutter In Out Crosss 1', 'rsaddon'),
                    'rs-image-shutter-in-out-diag-2'    => esc_html__('Shutter In Out Crosss 2', 'rsaddon'),
                    'rs-image-fold-up'                  => esc_html__('Fold Up', 'rsaddon'),
                    'rs-image-fold-down'                => esc_html__('Fold Down', 'rsaddon'),
                    'rs-image-fold-left'                => esc_html__('Fold Left', 'rsaddon'),
                    'rs-image-fold-right'               => esc_html__('Fold Right', 'rsaddon'),
                    'rs-image-zoom-in'                  => esc_html__('Zoom In', 'rsaddon'),
                    'rs-image-zoom-out'                 => esc_html__('Zoom Out', 'rsaddon'),
                    'rs-image-zoom-out-up'              => esc_html__('Zoom Out Up', 'rsaddon'),
                    'rs-image-zoom-out-down'            => esc_html__('Zoom Out Down', 'rsaddon'),
                    'rs-image-zoom-out-left'            => esc_html__('Zoom Out Left', 'rsaddon'),
                    'rs-image-zoom-out-right'           => esc_html__('Zoom Out Right', 'rsaddon'),
                    'rs-image-zoom-out-flip-vert'       => esc_html__('Zoom Out Flip Vertical', 'rsaddon'),
                    'rs-image-zoom-out-flip-horiz'      => esc_html__('Zoom Out Flip Horizontal', 'rsaddon'),
                    'rs-image-blur'                     => esc_html__('Blur', 'rsaddon'),
                    'rs-image-move-left'                => esc_html__('Image Move Left', 'rsaddon'),
                    'rs-image-move-right'               => esc_html__('Image Move Right', 'rsaddon'),
                    'rs-image-move-top'                 => esc_html__('Image Move Top', 'rsaddon'),
                    'rs-image-move-bottom'              => esc_html__('Image Move Bottom', 'rsaddon'),
                    'rs-image-top-down'                 => esc_html__('Image Scroll Top To Down', 'rsaddon'),
                ],
                'default'       => 'default',
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                'prefix_class' => 'elementor-animation-',
            ]
        );

        $this->add_responsive_control(
            'image_transition',
            [
                'label' => esc_html__( 'Transition', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.10,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image-hover-effect .image-part img' => 'transition: {{SIZE}}s;',
                    '{{WRAPPER}} .rs-image-hover-effect .image-overlay' => 'transition: {{SIZE}}s;',
                    '{{WRAPPER}} .rs-image-hover-effect .image-content' => 'transition: {{SIZE}}s;',
                ],
            ]
        ); 
            

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_content',
            [
                'label' => esc_html__( 'Content', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 

            $this->add_control(
                'show_image_content',
                [
                    'label'        => esc_html__( 'Show Content', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                ]
            );

            $this->add_responsive_control(
                'align',
                [
                    'label' => esc_html__( 'Text Alignment', 'rsaddon' ),
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
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .title-prefix' => 'text-align: {{VALUE}}',
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .description-text' => 'text-align: {{VALUE}}'
                    ],
                    'default'   => 'left',
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                    'separator' => 'before',
                ]
            );


            $this->add_control(
                'image_title_prefix',
                [
                    'label'       => esc_html__( 'Title', 'rsaddon' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => 'Prefix',
                    'placeholder' => esc_html__( 'Prefix', 'rsaddon' ),
                    'separator'   => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_prefix_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .title-part .prefix-part .title-prefix',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_prefix' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_description_text',
                [
                    'label' => esc_html__( 'Description Text', 'rsaddon' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,              
                    'default' => esc_html__( '', 'rsaddon' ),
                    'separator' => 'before',

                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_description_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .description-part .description-text',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_btn_part',
                [
                    'label' => esc_html__( 'Button Part', 'rsaddon' ),
                    'type'  => Controls_Manager::HEADING,
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'image_btn_text',
                [
                    'label'       => esc_html__( 'Button Text', 'rsaddon' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => '',
                    'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
                    'separator'   => 'before',
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'btn_link',
                [
                    'label'       => esc_html__( ' Button Link', 'rsaddon' ),
                    'type'        => Controls_Manager::URL,
                    'label_block' => true, 
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],                     
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'image_btn_typography',
                    'label' => esc_html__( 'Typography', 'rsaddon' ),
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'show_btn_icon',
                [
                    'label'        => esc_html__( 'Show Icon', 'rsaddon' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'rsaddon' ),
                    'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition' => [
                        'show_image_content' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'btn_icon',
                [
                    'label'     => esc_html__( 'Icon', 'rsaddon' ),
                    'type'      => Controls_Manager::ICON,
                    'options'   => rsaddon_pro_get_icons(),             
                    'default'   => 'fa fa-angle-right',
                    'separator' => 'before',

                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],              
                ]
            );

            $this->add_control(
                'image_btn_icon_position',
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
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],
                ]
            ); 

            $this->add_control(
                'btn_icon_spacing',
                [
                    'label' => esc_html__( 'Icon Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 10
                    ],
                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'btn_hover_icon_spacing',
                [
                    'label' => esc_html__( 'Icon Spacing in Hover', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 15
                    ],
                    'condition' => [
                        'show_image_content' => 'yes',
                        'show_btn_icon' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-before:hover i' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn.icon-after:hover i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            

        $this->end_controls_section();

        $this->start_controls_section(
            'image_normal_effect',
            [
                'label' => esc_html__( 'Global Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'image_border',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect',
                ]
            );

            $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'section_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect' => 'background: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'image_box_shadow',
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect',
                ]
            );            

            $this->add_responsive_control(
                'image_overlay_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [
                        'image_overlay_enable' => 'yes'
                    ],
                ]
            );


            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'content_bg',
                    'label' => esc_html__( 'Background', 'rsaddon' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content'
                ]
            );


            $this->add_responsive_control(
                'hover_image_overlay_border_radius',
                [
                    'label' => esc_html__( 'Hover Border Radius', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

        $this->add_control(
            'image_hover_bg',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Hover Overly Background', 'rsaddon' ),
                'separator' => 'before'
            ]
        );    

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'sec_bg_color',
                'label' => esc_html__( 'Hover Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-image-hover-effect:hover .image-overlay'
            ]
        );   

        $this->add_control(
            'section_image_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image-hover-effect' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );    
            
        $this->end_controls_section();

        $this->start_controls_section(
            'image_hover_effect',
            [
                'label' => esc_html__( 'Image Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); 

            $this->add_control(
                'iamage_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-part' => 'background: {{VALUE}}',
                    ],
                ]
            );


        $this->end_controls_section();

        $this->start_controls_section(
            'content_normal_effect',
            [
                'label' => esc_html__( 'Content Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image_content' => 'yes',
                ],
            ]
        );

    
            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => esc_html__( 'Padding', 'rsaddon' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', 'em', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

       
            $this->add_control(
                'icon_image_spacing',
                [
                    'label' => esc_html__( 'Icon Bottom Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .icon-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'title_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-content .title-part .title-prefix' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'title_spacing',
                [
                    'label' => esc_html__( 'Title Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .title-part .title-prefix' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'image_description_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Description', 'rsaddon' ),
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .description-part .description-text' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'description_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'rsaddon' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect:hover .image-content .description-part .description-text' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'description_spacing',
                [
                    'label' => esc_html__( 'Description Spacing', 'rsaddon' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .rs-image-hover-effect .image-content .description-part .description-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'image_button_style',
                [
                    'type' => Controls_Manager::HEADING,
                    'label' => esc_html__( 'Button', 'rsaddon' ),
                    'separator' => 'before',
                ]
            );
            

            $this->start_controls_tabs( 'normal_image_btn_tabs' );

                $this->start_controls_tab(
                    'image_normal_btn_tabs_normal',
                    [
                        'label' => esc_html__( 'Normal', 'rsaddon' ),
                    ]                    
                );

                $this->add_control(
                        'button_color',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'button_padding',
                        [
                            'label' => esc_html__( 'Padding', 'rsaddon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', 'em', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'button_bg',
                        [
                            'label' => esc_html__( 'Background', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn' => 'background: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'button_border',
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'button_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'button_box_shadow',
                            'selector' => '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'normal_button_border_transition',
                        [
                            'label' => esc_html__( 'Transition', 'rsaddon' ),
                            'type' => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 0.10,
                                    'max' => 1,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn, 
                                {{WRAPPER}}  .rs-image-hover-effect .image-content .button-part .image-btn i' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );
                    

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'image_normal_btn_tabs_hover',
                    [
                        'label' => esc_html__( 'Hover', 'rsaddon' ),
                    ]
                );

                    $this->add_control(
                        'normal_button_color_hover',
                        [
                            'label' => esc_html__( 'Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    
                    $this->add_control(
                        'normal_button_bg_hover',
                        [
                            'label' => esc_html__( 'Background Color', 'rsaddon' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .rs-image-hover-effect .image-content .button-part .image-btn:hover' => 'background: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'content_normal_effect_hover',
            [
                'label' => esc_html__( 'Content in Hover', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image_content_hover' => 'yes',
                ],
            ]
        );           
            

        $this->end_controls_section();
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

            
            $this->add_inline_editing_attributes( 'image_title', 'basic' );
            $this->add_render_attribute( 'image_title', 'class', 'image-title' );

            $this->add_inline_editing_attributes( 'image_title_hover', 'basic' );
            $this->add_render_attribute( 'image_title_hover', 'class', 'image-title' );

            $this->add_inline_editing_attributes( 'image_title_prefix', 'basic' );
            $this->add_render_attribute( 'image_title_prefix', 'class', 'title-prefix' );

            $this->add_inline_editing_attributes( 'image_title_prefix_hover', 'basic' );
            $this->add_render_attribute( 'image_title_prefix_hover', 'class', 'title-prefix' );

            $this->add_inline_editing_attributes( 'image_description_text', 'basic' );
            $this->add_render_attribute( 'image_description_text', 'class', 'description-text' );

            $this->add_inline_editing_attributes( 'image_description_text_hover', 'basic' );
            $this->add_render_attribute( 'image_description_text_hover', 'class', 'description-text' );

            $this->add_inline_editing_attributes( 'image_btn_text', 'basic' );
            $this->add_render_attribute( 'image_btn_text', 'class', 'btn-text' );

            $this->add_inline_editing_attributes( 'image_btn_text_hover', 'basic' );
            $this->add_render_attribute( 'image_btn_text_hover', 'class', 'btn-text' );
        ?>

        <div class="rs-image-hover-effect">
            <div class="animation-effect <?php echo esc_html( $settings['rs_image_effect'] );?>">
                <?php if((!empty($settings['image_overlay_enable'])) || (!empty($settings['image_overlay_enable_hover']))) : ?>
                    <div class="image-overlay"></div>
                <?php endif; ?>

                <div class="image-part">
                    <?php if(!empty($settings['hover_effect_image']['id'])) : 
                        echo wp_get_attachment_image( $settings['hover_effect_image']['id'], $settings['thumbnail_size'] );?> 

                        <?php else: ?>
                            <img src="<?php echo esc_url( $settings['hover_effect_image']['url'] );?>" alt="image"/>
                    <?php endif; ?>
                </div>
                <?php if(!empty($settings['show_image_content'])) : ?>
                    <div class="image-content normal_content">

                            <?php if(!empty($settings['image_title_prefix'])){ ?>
                                <div class="title-part">
                                    <div class="prefix-part">
                                        <div <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_title_prefix' )); ?>> <?php echo esc_html($settings['image_title_prefix']);?> </div>
                                    </div> 
                                </div>
                            <?php } ?>

                            <?php if(!empty($settings['image_description_text'])){ ?>
                                <div class="description-part">
                                    <div <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_description_text' )); ?>> <?php echo wp_kses_post($settings['image_description_text']);?> </div>
                                </div>
                            <?php } ?>

                    </div> 
                                     
                <?php endif; ?>
                <div class="image-content hover_content">

                    <?php if(!empty($settings['icon_image']['id'])) :?>
                    <div class="icon-image">
                        <?php echo wp_get_attachment_image( $settings['icon_image']['id'], $settings['thumbnail_size'] );?>
                    </div>
                    <?php endif; ?>

                    <?php if(!empty($settings['image_title_prefix'])){ ?>
                        <div class="title-part">
                            <div class="prefix-part">
                                <a href="<?php the_permalink(); ?>">
                                <div <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_title_prefix' )); ?>> <?php echo esc_html($settings['image_title_prefix']);?></div></a>
                            </div> 
                        </div>
                    <?php } ?>

                    <?php if(!empty($settings['image_description_text'])){ ?>
                        <div class="description-part">
                            <div <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_description_text' )); ?>> <?php echo wp_kses_post($settings['image_description_text']);?> </div>
                        </div>
                    <?php } ?>

                    <?php if(!empty($settings['image_btn_text']) || $settings['btn_icon'] ){ ?>
                        <div class="button-part">
                            <?php 
                                $btn_icon_position = $settings['image_btn_icon_position'] == 'before' ? 'icon-before' : 'icon-after';
                            ?>
                            <a class="image-btn <?php echo esc_html($btn_icon_position); ?>" href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php  echo wp_kses_post($this->print_render_attribute_string( 'image_btn_text' )); ?>>             
                                <span <?php echo wp_kses_post($this->print_render_attribute_string('image_btn_text'));?>><?php echo esc_html($settings['image_btn_text']);?></span>
                                
                            <i class="fa <?php echo esc_html($settings['btn_icon']);?>"></i>
                                
                            </a>
                        </div>
                    <?php } ?>
            </div> 
            </div>
        </div>        
    <?php
    }
}