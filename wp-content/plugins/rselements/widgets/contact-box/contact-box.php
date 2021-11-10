<?php
/**
 * Elementor RS Contact Box Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RScontactbox_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rs-contact-box';
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
		return esc_html__( 'RS Contact Box', 'rsaddon' );
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
		return 'glyph-icon flaticon-membership';
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
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function _register_controls() {


		$this->start_controls_section(
			'rs_section_contact_box',
			[
				'label' => esc_html__( 'Contact Box', 'rsaddon' ),
			]
		);

		$repeater = new Repeater();

		$this->add_control(
		    'rs_contact_d_style',
		    [
		        'label' => esc_html__( 'Contact Box Style', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'style1' => esc_html__( 'Style 1', 'rsaddon'),
		        	'style2' => esc_html__( 'Style 2', 'rsaddon'),		

		        ],
		        'default' => 'style1',
		    ]
		);

		$repeater->add_control(
			'type_contact_box',
			[
				'label'   => esc_html__( 'Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text_box',
				'dynamic' => [
					'active' => true,
				],
				'options' => [					
					'text_box' => esc_html__( 'Address', 'rsaddon'),
					'email' => esc_html__( 'Email', 'rsaddon'),
					'phone' => esc_html__( 'Phone', 'rsaddon'),
				],
			]
		);

		$repeater->add_control(
			'contact_label',
			[
				'label' => esc_html__( 'label', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Address', 'rsaddon' ),
				'show_label' => false,

				'condition' => [
		            'type_contact_box' => 'text_box'
		        ],
			]
		);


		$repeater->add_control(
			'contact_label_email',
			[
				'label' => esc_html__( 'Email', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
		            'type_contact_box' => 'email'
		        ],
			]
		);

		$repeater->add_control(
			'contact_label_phone',
			[
				'label' => esc_html__( 'Phone', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
		            'type_contact_box' => 'phone'
		        ],
			]
		);


		$repeater->add_control(
			'icon_type',
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

		$repeater->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'      => Controls_Manager::ICON,
				'options'   => rsaddon_pro_get_icons(),				
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'icon',
				],				
			]
		);

		$repeater->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
			]
		);		
		

		$this->add_control(
			'tabs',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'contact_label' => esc_html__( 'Email:', 'rsaddon' ),
						'tab_content' => esc_html__( '(+088)589-8745', 'rsaddon' ),
						'selected_icon' => 'fa fa-home',
					],
					[
						'contact_label' => esc_html__( 'Phone:', 'rsaddon' ),
						'tab_content' => esc_html__( 'support@rstheme.com', 'rsaddon' ),
						'selected_icon' => 'fa fa-phone',
					],
					[
						'contact_label' => esc_html__( 'Address:', 'rsaddon' ),
						'tab_content' => esc_html__( 'New Jesrsy, 1201, USA', 'rsaddon' ),
						'selected_icon' => 'fa fa-map-marker',
					],
				],
				'title_field' => '{{{ contact_label }}}',
			]
		);

		$this->add_control(
		    'rs_contact_box_style',
		    [
		        'label' => esc_html__( 'Contact Box Style', 'rsaddon' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'vertical' => esc_html__( 'Vertical', 'rsaddon'),
		        	'horizontal' => esc_html__( 'Horizontal', 'rsaddon'),		

		        ],
		        'default' => 'horizontal',
		    ]
		);

		$this->end_controls_section();


		$this->start_controls_section(
		    'rs_contact_icons',
		    [
		        'label' => esc_html__( 'Icon', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'icon_size',
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
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);


		$this->add_control(
		    'icon_color',
		    [
		        'label' => esc_html__( 'Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon i' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'Background_i_bg',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],                
                'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-icon',
            ]
        );

		$this->add_control(
		    'icon_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Effect Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon:before' => 'background-color: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon:after' => 'background-color: {{VALUE}} !important',
		        ],
		    ]
		);

		

		$this->add_responsive_control(
		    'ico _spacing',
		    [
		        'label' => esc_html__( 'Icon Right Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item.horizontal .address-icon' => 'margin-right: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'condition' => [
					'rs_contact_box_style' => 'horizontal',
				],
		    ]
		);



		$this->add_responsive_control(
		    'icon_image_width',
		    [
		        'label' => esc_html__( 'Image Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'image_width',
		    [
		        'label' => esc_html__( 'Width', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px'],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'min-width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'image_height',
		    [
				'label'      => esc_html__( 'Height', 'rsaddon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);


		$this->add_responsive_control(
		    'icon_line_height',
		    [
		        'label' => esc_html__( 'Line Height', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'line-height: {{SIZE}}{{UNIT}} !important;',
		        ],
		        'separator' => 'before',

		    ]
		);

		$this->add_responsive_control(
            'align_icon',
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
                    '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'media_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-icon'
		    ]
		);

		$this->add_responsive_control(
		    'icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		


		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Label', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
		    'label_color',
		    [
		        'label' => esc_html__( 'Label Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text span.label' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-text span.label',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Margin', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-contact-box .address-item .address-text span.label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
		    '_section_des_style',
		    [
		        'label' => esc_html__( 'Description', 'rsaddon' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
		    'des_color',
		    [
		        'label' => esc_html__( 'Description Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text a' => 'color: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text .des' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_control(
		    'des_hover_color',
		    [
		        'label' => esc_html__( 'Description Hover Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text a:hover' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text a' => 'color: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text .des' => 'color: {{VALUE}} !important',
		        ],
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
		    'area_spacing',
		    [
		        'label' => esc_html__( 'Area Bottom Gap', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

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
		$settings = $this->get_settings_for_display(); ?>
		

		<!-- Style 1 Start -->
		<div class="rs-contact-box">

		<?php 
			foreach ( $settings['tabs'] as $item ) :
			?>
				<div class="address-item <?php echo esc_attr($settings['rs_contact_box_style']); ?> box<?php echo esc_attr($settings['rs_contact_d_style']); ?>">

					<?php if(!empty($item['selected_icon']) || !empty($item['selected_image'])){ ?>
		            <div class="address-icon">
		            	<?php if($item['selected_icon']) { ?>
		            		<i class="<?php echo esc_html($item['selected_icon']); ?>"></i>
		            	<?php } else{ ?>
		            		<img src="<?php echo esc_html($item['selected_image']['url']); ?>" />
		            	<?php } ?>
		            </div>
		            <?php } ?>

		            <div class="address-text">
		            	<?php if(!empty($item['tab_content'])){ ?>
		            	<div class="text">
		            		<?php if($item['contact_label']){ ?>
		            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
		            		<?php } ?>
		            		<?php if(!empty($item['tab_content'])){ ?>
		            		<span class="des">
				                <?php echo nl2br($item['tab_content']);?>
				            </span>
				            <?php } ?>
			            </div>
			       		<?php } ?>


		            	<?php if(!empty($item['contact_label_phone'])){ ?>
			            	<div class="phone">
			            		<?php if($item['contact_label']){ ?>
			            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
			            		<?php } ?>
				                
				                <a href="tel:+<?php echo esc_html($item['contact_label_phone']);?>"><?php echo esc_html($item['contact_label_phone']);?></a>
				            </div>
			       		<?php } ?>


		            	<?php if(!empty($item['contact_label_email'])){ ?>
			            	<div class="email">
			            		<?php if($item['contact_label']){ ?>
			            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
			            		<?php } ?>
				                <a href="mailto:<?php echo esc_html($item['contact_label_email']);?>"><?php echo esc_html($item['contact_label_email']);?></a>
				            </div>
			       		<?php } ?>
		            </div>
		        </div>
			<?php endforeach; ?>
		</div>

	<!-- Style 1 End -->	
		
	<?php
	}
}
