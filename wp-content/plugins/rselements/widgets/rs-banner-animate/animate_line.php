<?php
/**
 * Image widget class
 *
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_banner_animate_Widget extends \Elementor\Widget_Base {
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
        return 'rs-rain-animates';
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
        return esc_html__( 'RS Rain Animation', 'rsaddon' );
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
        return 'eicon-divider';
    }

	protected function _register_controls() {

		$this->start_controls_section(
		    'rain_line_style',
		    [
		        'label' => esc_html__( 'Rain Static Line Style', 'rsaddon' ),
		        'type' => Controls_Manager::HEADING,
		    ]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-rain-animate .line'
            ]
        );

		$this->end_controls_section();	

		$this->start_controls_section(
		    'rain_dt_style',
		    [
		        'label' => esc_html__( 'Rain Animate Line Style', 'rsaddon' ),
		        'type' => Controls_Manager::HEADING,
		    ]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_dt',
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-rain-animate .line:after'
            ]
        );

        $this->add_responsive_control(
            'animation_style_deafult',
            [
                'label' => esc_html__( 'Animation Time', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 's' ],
                'range' => [
                    's' => [
                        'min' => 0.2,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-rain-animate .line:after' => 'animation:rain-line {{SIZE}}s 0s linear infinite;',
                ],
            ]
        );

		$this->end_controls_section();		
	}

	



	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrapper', 'class', 'elementor-image' ); ?>
		<!-- Banner Section Start -->
		
	    <div class="rs-rain-animate">
	        <div class="line"></div>
	        <div class="line"></div>
	        <div class="line"></div>
	    </div>
		
		<!-- Banner Section End -->
		<?php
	}

	/**
	 * Render image widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */

	/**
	 * Retrieve image widget link URL.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param array $settings
	 *
	 * @return array|string|false An array/string containing the link URL, or false if no link.
	 */
}

