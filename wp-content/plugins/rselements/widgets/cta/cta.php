<?php
/**
 * Elementor RS Couter Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_CTA_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rs-cta';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS CTA', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-error';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'rsaddon_category' ];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'button' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_cta',
			[
				'label' => esc_html__( 'CTA Content', 'rsaddon' ),
			]
		);				

		$this->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		$this->add_control(
			'cta_title',
			[
				'label' => esc_html__( 'CTA Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Default Call To Action', 'rsaddon'),
				'placeholder' => esc_html__( 'Title', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cta_link',
			[
				'label' => esc_html__( 'Link', 'rsaddon' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,						
			]
		);
		
		$this->add_control(
			'cta_desc',
			[
				'label' => esc_html__( 'CTA Description', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon'),
				'placeholder' => esc_html__( 'Description', 'rsaddon' ),
				'separator' => 'before',
			]
		);


		$this->add_control(
            'button',
            [
                'label' => esc_html__( 'Button', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('View More', 'rsaddon'),
				'placeholder' => esc_html__( 'Button Text', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( ' Button Link', 'rsaddon' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,						
			]
		);

		$this->add_control(
            'show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'type' => Controls_Manager::ICON,
				'options' => rsaddon_pro_get_icons(),				
				'default' => 'fa fa-angle-right',
				'separator' => 'before',

				'condition' => [
					'show_icon' => 'yes',
				],				
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
		    '_section_style_cta',
		    [
		        'label' => esc_html__( 'CTA', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
			'cta_full_width',
			[
		        'label' => esc_html__( 'Full Width ', 'rsaddon' ),
		        'type'    => Controls_Manager::SELECT,
		        'default' => 'inline-flex',
		        'options' => [
		            'inline-block' => esc_html__( 'Enable', 'rsaddon' ),
                    'inline-flex' => esc_html__( 'Disable', 'rsaddon' ),
		        ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta' => 'display: {{VALUE}};',
                ],
		    ]
		);

		$this->add_responsive_control(
            'cta_top_position',
            [
                'label' => esc_html__( 'Align Items', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
		        'default' => '',
		        'options' => [
		            'center' => esc_html__( 'Center', 'rsaddon' ),
                    'start' => esc_html__( 'Start', 'rsaddon' ),
                    'baseline' => esc_html__( 'Baseline', 'rsaddon' ),
                    'unset' => esc_html__( 'Unset
                    	', 'rsaddon' ),
		        ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_cta' );

		$this->start_controls_tab(
            'cta_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

		$this->add_responsive_control(
            'cta_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_border',
                'selector' => '{{WRAPPER}} .rs-cta',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_box_shadow',
                'selector' => '{{WRAPPER}} .rs-cta',
            ]
        ); 

        $this->add_responsive_control(
            'cta_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'cta_bg_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-cta',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'cta_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

        $this->add_responsive_control(
            'cta_hover_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_hover_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_hover_border',
                'selector' => '{{WRAPPER}} .rs-cta:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-cta:hover',
            ]
        ); 

        $this->add_responsive_control(
            'cta_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'cta_hover_bg_color',
				'label' => esc_html__( 'Hover Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-cta:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		

        
        
		
		$this->end_controls_section();


		$this->start_controls_section(
		    '_section_style_content',
		    [
		        'label' => esc_html__( 'Content', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'content_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta .cta-content' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
            'content_position',
            [
                'label' => esc_html__( 'Position', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
				'default' => '-1',
                'options' => [
                    '-1' => esc_html__( 'Left', 'rsaddon'),
					'15' => esc_html__( 'Right', 'rsaddon'),
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-cta .cta-content' => 'order: {{VALUE}};'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_align',
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
                    '{{WRAPPER}} .rs-cta .cta-content' => 'text-align: {{VALUE}}'
                ]
            ]
        );

		$this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta .cta-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta .cta-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .rs-cta .cta-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .rs-cta .cta-content',
            ]
        ); 

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .rs-cta .cta-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );        

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_color',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-cta .cta-content',
			]
		);

        
        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'content_hover_bg_color',
				'label' => esc_html__( 'Background Hover Color', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-cta:hover .cta-content',
			]
		);

		$this->add_control(
            'title_style',
            [
                'label' => esc_html__( 'Title Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}}  .cta-title .title',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
		    'title_gap',
		    [
		        'label' => esc_html__( 'Title Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .cta-title .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .cta-title .title' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta:hover .cta-title .title' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		
		$this->add_control(
            'desc_style',
            [
                'label' => esc_html__( 'Description Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__( 'Typography', 'rsaddon' ),
                'selector' => '{{WRAPPER}}  .cta-text .desc',
                'scheme' => Scheme_Typography::TYPOGRAPHY_2,
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
		    'desc_gap',
		    [
		        'label' => esc_html__( 'Description Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .cta-text .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'desc_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .cta-text .desc' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'desc_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta:hover .cta-text .desc' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_section();


		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'rsaddon' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
            'btn_style',
            [
                'label' => esc_html__( 'Button Style', 'rsaddon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
		    'btn_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta .rs-btn' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
            'btn_position',
            [
                'label' => esc_html__( 'Position', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
				'default' => '14',
                'options' => [
                    '-2' => esc_html__( 'Left', 'rsaddon'),
					'14' => esc_html__( 'Right', 'rsaddon'),
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-cta .rs-btn' => 'order: {{VALUE}};'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'btn_align',
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
                    '{{WRAPPER}} .rs-cta .rs-btn' => 'text-align: {{VALUE}}'
                ]
            ]
        );

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-btn a',
			]
		);

		$this->add_control(
            'btn_opacity',
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
                    '{{WRAPPER}} .rs-btn a' => 'opacity: {{SIZE}};',
                ],
            ]
        );

		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'link_margin',
		    [
		        'label' => esc_html__( 'Margin', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .rs-btn a',
		        'scheme' => Scheme_Typography::TYPOGRAPHY_4,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .rs-btn a',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .rs-btn a',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta:hover .rs-btn a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rs-cta:hover .rs-btn a',
			]
		);

		$this->add_control(
            'btn_hover_opacity',
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
                    '{{WRAPPER}} .rs-btn:hover a' => 'opacity: {{SIZE}};',
                ],
            ]
        );

		$this->add_responsive_control(
		    'link_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta:hover .rs-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'link_hover_margin',
		    [
                'label'      => esc_html__( 'Margin', 'rsaddon' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta:hover .rs-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
                'name'     => 'btn_hover_typography',
                'selector' => '{{WRAPPER}} .rs-cta:hover .rs-btn a',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
                'name'     => 'button_hover_border',
                'selector' => '{{WRAPPER}} .rs-cta:hover .rs-btn a',
		    ]
		);

		$this->add_control(
		    'button_hover_border_radius',
		    [
                'label'      => esc_html__( 'Border Radius', 'rsaddon' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-cta:hover .rs-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .rs-cta:hover .rs-btn a',
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

        $this->add_control(
            'btn_icon_style',
            [
                'label'     => esc_html__( 'Button Icon', 'rsaddon' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_icon' => 'yes'
                ],
            ]
        );

		$this->start_controls_tabs( '_tabs_button_icon' );

		$this->start_controls_tab(
            'btn_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
                'condition' => [
                    'show_icon' => 'yes'
                ],
            ]
        ); 

		$this->add_control(
		    'btn_icon_spacing',
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
		            '{{WRAPPER}} .rs-btn i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		        'condition' => [
					'show_icon' => 'yes',
				],	
		    ]
		);


		$this->add_control(
		    'icon_text_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a i' => 'color: {{VALUE}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_background',
		    [
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .rs-btn a i' => 'background: {{VALUE}};',],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
			]
		);

		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'btn_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
                'condition' => [
                    'show_icon' => 'yes'
                ],
            ]
        ); 

		$this->add_control(
		    'btn_icon_hover_spacing',
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
		            '{{WRAPPER}} .rs-btn:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		        'condition' => [
					'show_icon' => 'yes',
				],	
		    ]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn:hover a i' => 'color: {{VALUE}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_hover_background',
		    [				
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .rs-btn:hover a i'=> 'background: {{VALUE}};',],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
			]
		);

		$this->add_responsive_control(
		    'icon_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn:hover a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-btn:hover a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		

		$this->end_controls_section();

	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {	
	
		$settings = $this->get_settings_for_display();

            $this->add_inline_editing_attributes( 'cta_title', 'basic' );
            $this->add_render_attribute( 'cta_title', 'class', 'title' );

            $this->add_inline_editing_attributes( 'cta_desc', 'basic' );
            $this->add_render_attribute( 'cta_desc', 'class', 'desc' ); 

            $this->add_inline_editing_attributes( 'btn_text', 'basic' );
            $this->add_render_attribute( 'btn_text', 'class', 'btn_text' ); 
        ?>
		<div class="rs-cta">
			<div class="cta-content">
				<?php if(!empty($settings['cta_title'])):?>
			        <div class="cta-title">
			        	<?php $target = $settings['cta_link']['is_external'] ? 'target=_blank' : '';?>

			            <<?php echo esc_attr($settings['title_tag']);?> class="title"> 
			            	<a <?php echo wp_kses_post($this->print_render_attribute_string('cta_title'));?> href="<?php echo esc_url($settings['cta_link']['url']);?>" <?php echo esc_attr($target);?>>				
			            		<?php echo esc_attr ($settings['cta_title']);?>
			            	</a>

			            </<?php echo esc_attr($settings['title_tag']);?>>

			        </div>
				<?php endif;?>
				<?php if(!empty($settings['cta_desc'])):?>
			        <div class="cta-text">
			            <p <?php echo wp_kses_post($this->print_render_attribute_string('cta_desc'));?>> <?php echo wp_kses_post ($settings['cta_desc']);?></p>
			        </div>
				<?php endif;?>
			</div>

            <?php if(!empty($settings['btn_text'])): ?>
			
    			<div class="rs-btn">

    				<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : '';?>

    				<a class="readon rs_button elementor-animation-<?php echo esc_html($settings['hover_animation']);?>" href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php echo esc_attr($target);?>>				
    					<span <?php echo wp_kses_post($this->print_render_attribute_string('btn_text'));?>><?php echo esc_html($settings['btn_text']);?></span>

    					<?php if(!empty($settings['btn_icon'])) : ?>
    						<i class="fa <?php echo esc_html($settings['btn_icon']);?>"></i>
    					<?php endif; ?>
    				</a>

    			</div>
            <?php endif; ?>    

		</div>   
	<?php 
	}
}