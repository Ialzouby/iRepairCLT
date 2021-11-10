<?php
/**
 * Elementor RS Countdown Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */


use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Countdown_Widget extends \Elementor\Widget_Base {

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
		return 'rs-timecounter';
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
		return esc_html__( 'RS Countdown', 'rsaddon' );
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
		return 'glyph-icon flaticon-progress';
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

		//Global Style
		$this->start_controls_section(
			'section_timecircle',
			[
				'label' => esc_html__( 'Time Circle Global', 'rs-addon' ),
			]
		);

		$this->add_control(
			'rs_circle_date',
			[
				'label' => esc_html__( 'Date Info', 'rs-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,		
							
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_circle_year',
			[
				'label' => esc_html__( 'Year', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( '2020', 'rsaddon' ),
				'placeholder' => esc_html__( '2020', 'rsaddon' ),				
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_circle_month',
			[
				'label' => esc_html__( 'Month', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( '10', 'rsaddon' ),
				'placeholder' => esc_html__( '10', 'rsaddon' ),				
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_circle_day',
			[
				'label' => esc_html__( 'Day', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( '25', 'rsaddon' ),
				'placeholder' => esc_html__( '25', 'rsaddon' ),				
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_circle',
			[
				'label' => esc_html__( 'Circle', 'rs-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,		
							
				'separator' => 'before',
			]
		);


		$this->add_control(
			'time_circle_style',
			[
				'label'   => esc_html__( 'Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'circle_border_on',
				'separator' => 'before',
				'options' => [					
					'circle_border_on' => esc_html__( 'Border Style On', 'rsaddon'),
					'number_border' => esc_html__( 'Number Style', 'rsaddon'),
					'circle_vartical_border' => esc_html__( 'Vartical Border Style', 'rsaddon'),
					'separator' => esc_html__( 'Separator Dotots', 'rsaddon'),
					'background_style' => esc_html__( 'Background Color', 'rsaddon'),
					'circle_border_of' => esc_html__( 'Border Hidden', 'rsaddon'),
				],
			]
		);

		$this->add_control(
			'animation',
			[
				'label'   => esc_html__( 'Time Circle Animation', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'smooth',
				'separator' => 'before',
				'options' => [					
					'smooth' => esc_html__( 'Smooth', 'rsaddon'),
					'ticks' => esc_html__( 'Ticks', 'rsaddon'),
				],
			]
		);


		$this->add_control(
			'rs_circle_width',
			[
				'label' => esc_html__( 'Circle width', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( '0.020', 'rsaddon' ),
				'placeholder' => esc_html__( '0.020', 'rsaddon' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_circle_bg_width',
			[
				'label' => esc_html__( 'Background width', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( '0.8', 'rsaddon' ),
				'placeholder' => esc_html__( '0.8', 'rsaddon' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_number_size',
			[
				'label' => esc_html__( 'Number Size', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( '0.25', 'rsaddon' ),
				'placeholder' => esc_html__( '0.25', 'rsaddon' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_text_size',
			[
				'label' => esc_html__( 'Text Size', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( '0.1', 'rsaddon' ),
				'placeholder' => esc_html__( '0.1', 'rsaddon' ),
				'label_block' => true,
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		//Day Style
		$this->start_controls_section(
			'section_circle_text',
			[
				'label' => esc_html__( 'Time Circle Text', 'rs-addon' ),
			]
		);		

		$this->add_control(
			'rs_day_text',
			[
				'label' => esc_html__( 'Day', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( 'Day', 'rsaddon' ),
				'placeholder' => esc_html__( 'Day', 'rsaddon' ),				
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'rs_hours_text',
			[
				'label' => esc_html__( 'Hours', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( 'Hours', 'rsaddon' ),
				'placeholder' => esc_html__( 'Hours', 'rsaddon' ),				
				'separator' => 'before',
			]
		);

		$this->add_control(
			'rs_minutes_text',
			[
				'label' => esc_html__( 'Minutes', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( 'Minutes', 'rsaddon' ),
				'placeholder' => esc_html__( 'Minutes', 'rsaddon' ),				
				'separator' => 'before',
			]
		);
	

		$this->add_control(
			'rs_seconds_text',
			[
				'label' => esc_html__( 'Seconds', 'rs-addon' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( 'Seconds', 'rsaddon' ),
				'placeholder' => esc_html__( 'Seconds', 'rsaddon' ),				
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		//Style Tabs
		$this->start_controls_section(
			'rs_section_circle_style',
			[
				'label' => esc_html__( 'Global Style', 'rs-addon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);		

		$this->add_control(
			'rs_countdown_number_color',
			[
				'label' => esc_html__( 'Number Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);		

		$this->add_control(
			'rs_countdown_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);	
		$this->add_control(
		    'separator_color',
		    [
		        'label' => esc_html__( 'Items Separator Dotots Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-timecounter.separator .time_circles > div:after' => 'color: {{VALUE}}',
		        ],
		        'condition' => [
		            'time_circle_style' => 'separator'
		        ]
		    ]
		);	
		$this->add_control(
		    'items_bg_color',
		    [
		        'label' => esc_html__( 'Items Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-timecounter.background_style .time_circles > div:after' => 'background: {{VALUE}}',
		        ],
		        'condition' => [
		            'time_circle_style' => 'background_style'
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'items_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-timecounter.background_style .time_circles > div:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		        'condition' => [
		            'time_circle_style' => 'background_style'
		        ]
		    ]
		);	

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'item_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .rs-timecounter.background_style .time_circles > div:after',
		        'condition' => [
		            'time_circle_style' => 'background_style'
		        ]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'item_border',
		        'selector' => '{{WRAPPER}} .rs-timecounter.background_style .time_circles > div:after',
		        'condition' => [
		            'time_circle_style' => 'background_style'
		        ]
		    ]
		);

		$this->add_responsive_control(
		    'nuber_bg_color',
		    [
		        'label' => esc_html__( 'Number Background Color', 'rsaddon' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .number_border .time_circles > div span, .rs-timecounter.number_border .time_circles > div span' => 'background: {{VALUE}}',
		        ],
		        'condition' => [
		            'time_circle_style' => 'number_border'
		        ]
		    ]
		);
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'item_number_border',
		        'selector' => '{{WRAPPER}} .number_border .time_circles > div span, .rs-timecounter.number_border .time_circles > div span',
		        'condition' => [
		            'time_circle_style' => 'number_border'
		        ]
		    ]
		);
		$this->add_responsive_control(
		    'text_spacing',
		    [
		        'label' => esc_html__( 'Text Top Spacing', 'rsaddon' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .number_border .time_circles > div span, .rs-timecounter.number_border .time_circles > div h4' => 'margin-top: {{SIZE}}{{UNIT}};',
		        ],
		        'condition' => [
		            'time_circle_style' => 'number_border'
		        ]
		    ]
		);

		$this->add_control(
			'rs_circle_bg_color',
			[
				'label' => esc_html__( 'Circle Background Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',
				'condition' => [
				    'time_circle_style' => 'circle_border_on'
				],			
			]
		);

		$this->add_responsive_control(
		    'item_media_padding',
		    [
		        'label' => esc_html__( 'Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-timecounter .time_circles div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'rs_section_day_style',
			[
				'label' => esc_html__( 'Active Border Color', 'rs-addon' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
				    'time_circle_style' => 'circle_border_on'
				],
			]
		);

		$this->add_control(
			'rs_day_border_color',
			[
				'label' => esc_html__( 'Day Border Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);

		$this->add_control(
			'rs_hours_border_color',
			[
				'label' => esc_html__( 'Hours Border Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);

		$this->add_control(
			'rs_minutes_border_color',
			[
				'label' => esc_html__( 'Minutes Border Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);

		$this->add_control(
			'rs_seconds_border_color',
			[
				'label' => esc_html__( 'Seconds Border Color', 'rs-addon' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render progress widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();		
		$unique = rand(10,6554120);

		$rs_circle_width = !empty($settings['rs_circle_width']) ? $settings['rs_circle_width'] : '0.020';
		$rs_circle_bg_width = !empty($settings['rs_circle_bg_width']) ? $settings['rs_circle_bg_width'] : '0.020';
		$rs_number_size = !empty($settings['rs_number_size']) ? $settings['rs_number_size'] : '0.25';

		$rs_text_size = !empty($settings['rs_text_size']) ? $settings['rs_text_size'] : '0.1';

		$rs_circle_bg_color = !empty($settings['rs_circle_bg_color']) ? $settings['rs_circle_bg_color'] : '#bbbbbb';

		$rs_countdown_number_color = !empty($settings['rs_countdown_number_color']) ? $settings['rs_countdown_number_color'] : '#55595c';
		$rs_countdown_text_color = !empty($settings['rs_countdown_text_color']) ? $settings['rs_countdown_text_color'] : '#55595c';

		$rs_day_border_color = !empty($settings['rs_day_border_color']) ? $settings['rs_day_border_color'] : '#55595c';

		$rs_hours_border_color = !empty($settings['rs_hours_border_color']) ? $settings['rs_hours_border_color'] : '#55595c';
		$rs_minutes_border_color = !empty($settings['rs_minutes_border_color']) ? $settings['rs_minutes_border_color'] : '#55595c';
		$rs_seconds_border_color = !empty($settings['rs_seconds_border_color']) ? $settings['rs_seconds_border_color'] : '#55595c';

		$this->add_inline_editing_attributes( 'rs_day_text', 'day' );
		$this->add_inline_editing_attributes( 'rs_hours_text', 'hours' );
		$this->add_inline_editing_attributes( 'rs_minutes_text', 'minutes' );
		$this->add_inline_editing_attributes( 'rs_seconds_text', 'seconds' );
	?>
	

	<div class="rs-timecounter rs-timecounter<?php echo esc_attr($unique);?> <?php echo esc_attr( $settings['time_circle_style'] ); ?>">
	    <div class="rs-timecounter-inner"> 
	        <div data-animation-in="slideInLeft" data-animation-out="animate-out fadeOut" class="RS_CountDownTimer_<?php echo esc_attr($unique);?>" data-date="<?php echo esc_html($settings['rs_circle_year']);?>-<?php echo esc_html($settings['rs_circle_month']);?>-<?php echo esc_html($settings['rs_circle_day']);?> 00:00:00">
	        	
	        </div>
	    </div>
	</div>



	<script type="text/javascript">
        jQuery(document).ready(function () {        

            jQuery(".RS_CountDownTimer_<?php echo esc_attr($unique);?>").TimeCircles({
            	animation_interval: "<?php echo esc_html($settings['animation']);?>",
                fg_width: <?php echo esc_html($rs_circle_width);?>,
                bg_width:<?php echo esc_html($rs_circle_bg_width);?>,           
                circle_bg_color: "<?php echo esc_html($rs_circle_bg_color);?>",
                text_size: <?php echo esc_html($rs_text_size);?>,
                number_size: <?php echo esc_html($rs_number_size);?>,
                time: {
                    Days:{
                        color: "<?php echo esc_html($rs_day_border_color);?>",	
                        text: "<?php echo esc_html($settings['rs_day_text']);?>",				
                    },
                    Hours:{
                        color: "<?php echo esc_html($rs_hours_border_color);?>",
                        text: "<?php echo esc_html($settings['rs_hours_text']);?>",	
                    },
                    Minutes:{
                        color: "<?php echo esc_html($rs_minutes_border_color);?>",
                        text: "<?php echo esc_html($settings['rs_minutes_text']);?>",	
                    },
                    Seconds:{
                        color: "<?php echo esc_html($rs_seconds_border_color);?>",
                        text: "<?php echo esc_html($settings['rs_seconds_text']);?>",
                    }
                }


            });            

            jQuery('.rs-timecounter<?php echo esc_attr($unique);?> .time_circles div span').css({"color": "<?php echo esc_html($rs_countdown_number_color);?>"});            
             jQuery('.rs-timecounter<?php echo esc_attr($unique);?> .time_circles div h4').css({"color": "<?php echo esc_html($rs_countdown_text_color);?>"});
        });

    </script> 



	<?php
	}
}