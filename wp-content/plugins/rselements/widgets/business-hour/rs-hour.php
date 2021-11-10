<?php
/**
 * Elementor Buisness Hour Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Business_Hour_Widget extends \Elementor\Widget_Base {

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
		return 'rs-business-hour';
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
		return esc_html__( 'RS Business Hour', 'rsaddon' );
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
		return 'glyph-icon flaticon-24-hours';
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
			'rs_section_title',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'business_day',
			[
				'label' => esc_html__( 'Day', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,							
			]
		);

		$repeater->add_control(
			'business_time',
			[
				'label' => esc_html__( 'Time', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,	
				'separator'    => 'before',		
			]
		);

		$repeater->add_control(
			'rs_close_this_day',
			[
				'label'        => esc_html__( 'Highlight this day', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);
		
		$repeater->add_responsive_control(
			'rs_single_business_day_color',
			[
				'label'     => esc_html__( 'Day Color', 'rsaddon' ),
				'type'      => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .yes .rs-business-day' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rs_close_this_day' => 'yes',
				],
				'default' => '#ff0000',
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'single_business_time_color',
			[
				'label'     => esc_html__( 'Time Color', 'rsaddon' ),
				'type'      => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .yes .rs-business-time' => 'color: {{VALUE}}',
				],
				'condition' => [
					'rs_close_this_day' => 'yes',
				],
				'default' => '#ff0000',
				'separator' => 'before',
			]
		);


		$this->add_control(
			'rs_business_hour_list',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => array_values( $repeater->get_controls() ),
				'default' => [					

					[
						'business_day'  => esc_html__( 'Saturday', 'rsaddon' ),
						'business_time' => esc_html__( '10:00 AM to 3:00 PM','rsaddon' ),						
					],

					[
						'business_day'  => esc_html__( 'Monday', 'rsaddon' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','rsaddon' ),
					],

					[
						'business_day'  => esc_html__( 'Tues Day', 'rsaddon' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','rsaddon' ),
					],

					[
						'business_day'  => esc_html__( 'Wednesday', 'rsaddon' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','rsaddon' ),
					],

					[
						'business_day'  => esc_html__( 'Thursday', 'rsaddon' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','rsaddon' ),
					],

					[
						'business_day'  => esc_html__( 'Friday', 'rsaddon' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','rsaddon' ),
					],

					[
						'business_day'      => esc_html__( 'Sunday', 'rsaddon' ),
						'business_time'     => esc_html__( 'Close','rsaddon' ),
						'rs_close_this_day' => esc_html__( 'yes','rsaddon' ),
					],
				],
				'title_field' => '{{{ business_day }}}',
			]
		);
		

       $this->end_controls_section();


		$this->start_controls_section(
			'section_faq_style_title',
			[
				'label' => esc_html__( 'Day/Time', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_color',
			[
				'label' => esc_html__( 'Item Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'color: {{VALUE}};',
				],
				'separator' => 'before',				
			]
		);

		$this->add_control(
			'item_background',
			[
				'label' => esc_html__( 'Item Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_typography',
				'selector' => '{{WRAPPER}} .rs-business-hour .rs-business-schedule span',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		
		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		
		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__( 'Margin', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
    	    Group_Control_Border::get_type(),
    	    [
    	        'name' => 'item_border',
    	        'selector' => '{{WRAPPER}} .rs-business-hour .rs-business-schedule',
    	    ]
		);

		
		$this->end_controls_section();
	}

	/**
	 * Render accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="rs-business-hour">';			
			foreach ( $settings['rs_business_hour_list'] as $index => $item ) :
			?>
				<div class="rs-business-schedule <?php echo esc_attr($item['rs_close_this_day']); ?>">
					<span class="rs-business-day"><?php echo esc_html($item['business_day']); ?></span>
					<span class="rs-business-time"><?php echo esc_html($item['business_time']); ?></span>
				</div>
			<?php					
			endforeach;
		echo '</div>';
	}
}