<?php
/**
 * Elementor RS video Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_RSvideo_Widget extends \Elementor\Widget_Base {

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
		return 'rs-video';
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
		return __( 'RS Video', 'rsaddon' );
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
		return 'glyph-icon flaticon-multimedia';
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
		return [ 'video' ];
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
			'section_counter',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
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
                    'right' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rsaddon' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default'     => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-video' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_control(
			'rs_video_style',
			[
				'label'   => esc_html__( 'Select Video Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'rsaddon'),
					'style2' => esc_html__( 'Style 2', 'rsaddon'),
					'style3' => esc_html__( 'Style 3', 'rsaddon'),
				],
			]
		);

	
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Enter Link Here', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__( 'Video link here', 'rsaddon' ),				
				'separator' => 'before',
			]
		);
	
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Background Image', 'rsaddon' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				'separator' => 'before',
				'condition' => [
		            'rs_video_style' => ['style1', 'style2'],
		        ],
			]
		);

			$this->add_control(
			'rs_video_title',
			[
				'label' => esc_html__( 'Video Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,	
				'separator' => 'before',
				'condition' => [
		            'rs_video_style' => 'style2'
		        ],
			]
		);

		$this->add_control(
			'section_icons',
			[
				'label' => esc_html__( 'Icon / Image', 'rsaddon' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'rs_video_style' => 'style3',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'rsaddon'),
					'image' => esc_html__( 'Image', 'rsaddon'),
								
				],
				'condition' => [
					'rs_video_style' => 'style3',
				],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'      => Controls_Manager::ICON,
				'options'   => rsaddon_pro_get_icons(),				
				'default'   => 'fa fa-smile-o',
				'condition' => [
					'icon_type' => 'icon',
					'rs_video_style' => 'style3',
				],				
			]
		);

		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'rsaddon' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
					'rs_video_style' => 'style3',
				],
			]
		);
		
		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Video Description', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,	
				'default'     => 'Add your video description here',
				'placeholder' => esc_html__( 'Add your video description here..', 'rsaddon' ),
				'condition' => [
					'rs_video_style' => ['style1', 'style2'],
				],
				'separator' => 'before',
			]
			
		);
	
			
		
		$this->end_controls_section();

				
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color_style2',
			[
				'label' => esc_html__( 'Title Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .video_title' => 'color: {{VALUE}};',
				],				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_title_text',				
				'selector' => '{{WRAPPER}} .video_title',
				
			]
		);


		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Content Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .video-desc' => 'color: {{VALUE}};',
				],

				
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_text',				
				'selector' => '{{WRAPPER}} .video-desc',
				
			]
		);

		$this->add_responsive_control(
            'video_title_postion',
            [
                'label' => esc_html__( 'Content Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
               'range' => [
                   'px' => [
                       'min' => -500,
                       'max' => 500,
                   ],
               ],                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .video-desc' => 'top: {{SIZE}}px;',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'video_title_horaizontal',
            [
                'label' => esc_html__( 'Content Position Horizontal', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
               'range' => [
                   'px' => [
                       'min' => -500,
                       'max' => 500,
                   ],
               ],                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .video-desc' => 'left: {{SIZE}}px;',                   
                ],
            ]
        );

        $this->add_responsive_control(
		    'video_full_area_padding',
		    [
		        'label' => esc_html__( 'Area Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-video' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'icon_btn',
			[
				'label' => esc_html__( 'Button Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inner .rs-icon-btn a' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
		            'rs_video_style' => 'style2'
		        ],
			]
		);


		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video .popup-videos i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border i' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'rsaddon' ),
				'name' => 'typography_icon',				
				'selector' => '{{WRAPPER}} .rs-video .popup-videos i, {{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border i',
				'separator' => 'before',
			]
		);

		

		$this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
		        'name' => 'background',
		        'label' => __( 'Background', 'plugin-domain' ),
		        'types' => [ 'classic', 'gradient' ],
		        'selector' => '{{WRAPPER}} .rs-video .popup-videos, {{WRAPPER}} .rs-video .popup-videos:before, {{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border',
		    ]
		);


		$this->add_control(
			'icon_border',
			[
				'label' => esc_html__( 'Icon Border Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .rs-video .overly-border' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border:after' => 'border-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
            'video_icon_postion_ver',
            [
                'label' => esc_html__( 'Icon Position Vertical', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .overly-border' => 'top: {{SIZE}}%;',                   
                    '{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border' => 'top: {{SIZE}}px;',                   
                ],
            ]
        );

		$this->add_responsive_control(
            'video_icon_postion_ht',
            [
                'label' => esc_html__( 'Icon Position Horizontal', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ '%' ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                
                'selectors' => [
                    '{{WRAPPER}} .rs-video .overly-border' => 'left: {{SIZE}}%;',                   
                    '{{WRAPPER}} .rs-video.style2 .rs-icon-inners .animate-border .popup-border' => 'left: {{SIZE}}%;',                   
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
	
		$settings = $this->get_settings_for_display();	
		$rand = rand(12, 3330);

		$this->add_inline_editing_attributes( 'description', 'basic' );
        $this->add_render_attribute( 'description', 'class', 'video-desc' ); 

		?>
  		<div class="rs-video video-item-<?php echo esc_attr($rand);?> <?php echo esc_html($settings['align']);?> <?php echo esc_html($settings['rs_video_style']);?>" <?php if(!empty($settings['image']['url'])):?>style="background: url(<?php echo esc_url($settings['image']['url']);?>);"<?php endif;?>>


   				<?php if($settings['rs_video_style'] == 'style1') { ?>	
  						<div class="overly-border">
						    <a class="popup-videos" href="<?php echo esc_url($settings['video_link']);?>">
								<i class="fa fa-play"></i>
							</a>
						</div>

				    <?php if( !empty( $settings['description'])) : ?>
				    	<div <?php echo wp_kses_post($this->print_render_attribute_string('description')); ?>>
				    		<?php echo wp_kses_post($settings['description']); ?>
				    	</div>
				    <?php endif; ?>

				<?php }; ?>

				<?php if($settings['rs_video_style'] == 'style2') : ?>	
  					
  					<span class="video_title"><?php echo esc_html($settings['rs_video_title']); ?></span>

				    <?php if( !empty( $settings['description'])) : ?>
				    	<div class="video-desc">
				    		<?php echo wp_kses_post($settings['description']); ?>
				    	</div>
				    <?php endif;?>
				    <div class="rs-icon-inners">
  						<?php if($settings['rs_video_style'] == 'style2'): ?>
	  						<div class="animate-border">
							    <a class="popup-border" href="<?php echo esc_url($settings['video_link']);?>">
									<i class="fa fa-play"></i>
								</a>
							</div>
  						<?php endif; ?>
					</div>
				<?php endif; ?>

   				<?php if($settings['rs_video_style'] == 'style3') { ?>	
					<div class="overly-border">
					    
					    	<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>

					    		<div class="icon-area <?php echo esc_attr( $animation ); ?>">
						    		<?php if(!empty($settings['selected_icon'])) : ?>
						    			<a class="popup-videos icon-type" href="<?php echo esc_url($settings['video_link']);?>">
						    				<i class="<?php echo esc_html($settings['selected_icon']);?>"></i>
						    			</a>
						    		<?php endif; ?>

						    		<?php if(!empty($settings['selected_image'])) :?>
						    			<a class="popup-videos image-type" href="<?php echo esc_url($settings['video_link']);?>"><img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="image"/></a>
						    		<?php endif;?>
					    		</div>
					    	<?php }?>
					</div>

				    <?php if( !empty( $settings['description'])) : ?>
				    	<div <?php echo wp_kses_post($this->print_render_attribute_string('description')); ?>>
				    		<?php echo wp_kses_post($settings['description']); ?>
				    	</div>
				    <?php endif; ?>

				<?php }; ?>
				    
			</div>	


		<script type="text/javascript">			
			jQuery(document).ready(function(){
				jQuery('.popup-videos').magnificPopup({
			        disableOn: 10,
			        type: 'iframe',
			        mainClass: 'mfp-fade',
			        removalDelay: 160,
			        preloader: false,

			        fixedContentPos: false
			    }); 
			});
		</script>
    
<?php 
	}
}