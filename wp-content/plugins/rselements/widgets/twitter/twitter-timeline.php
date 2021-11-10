<?php

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Twitter Timeline Widget
 */
class Rsaddon_Elementor_Pro_Twitter_Timeline_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'rs-twitter-timeline';
	}

	public function get_title() {
		return __( 'Twitter Feed', 'rsaddon' );
	}

    /**
	 * Retrieve the list of categories the twitter timeline widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

	public function get_icon() {
		return 'fa fa-twitter';
	}

    /**
	 * Retrieve the list of scripts the twitter timeline widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
   	protected function _register_controls() {
		$this->start_controls_section(
			'section_timeline',
			[
				'label' => __( 'Timeline', 'rsaddon' ),
			]
		);

		$this->add_control(
            'username',
            [
                'label'                 => __( 'User Name', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => '',
            ]
        );

		$this->add_control(
			'theme',
			[
				'label'                 => __( 'Theme', 'rsaddon' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'light',
				'options'               => [
					'light'		=> __( 'Light', 'rsaddon' ),
					'dark' 		=> __( 'Dark', 'rsaddon' ),
				],
			]
		);

		$this->add_control(
			'show_replies',
			[
				'label' => __( 'Show Replies', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'rsaddon' ),
				'label_off' => __( 'No', 'rsaddon' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'layout',
			[
				'label'                 => __( 'Layout', 'rsaddon' ),
				'type'                  => Controls_Manager::SELECT2,
				'default'               => '',
				'options'               => [
					'noheader'		=> __( 'No Header', 'rsaddon' ),
					'nofooter' 		=> __( 'No Footer', 'rsaddon' ),
					'noborders' 	=> __( 'No Borders', 'rsaddon' ),
					'transparent' 	=> __( 'Transparent', 'rsaddon' ),
					'noscrollbar' 	=> __( 'No Scroll Bar', 'rsaddon' ),
				],
				'multiple'	=> true
			]
		);

		$this->add_control(
            'width',
            [
                'label'                 => __( 'Width', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
					'unit'	=> 'px',
					'size'	=> ''
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
				],
            ]
        );
		$this->add_control(
            'height',
            [
                'label'                 => __( 'Height', 'rsaddon' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
					'unit'	=> 'px',
					'size'	=> ''
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
				],
            ]
        );

		$this->add_control(
            'tweet_limit',
            [
                'label'                 => __( 'Tweet Limit', 'rsaddon' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => '',
            ]
        );

		$this->add_control(
			'link_color',
			[
				'label'                 => __( 'Link Color', 'rsaddon' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'                 => __( 'Border Color', 'rsaddon' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		$attrs = array();
		$attr = ' ';

		$user = $settings['username'];

		$attrs['data-theme'] 			= $settings['theme'];
		$attrs['data-show-replies'] 	= ( 'yes' == $settings['show_replies'] ) ? 'true' : 'false';

		if ( ! empty( $settings['width'] ) ) {
			$attrs['data-width'] = $settings['width']['size'];
		}
		if ( ! empty( $settings['height'] ) ) {
			$attrs['data-height'] = $settings['height']['size'];
		}
		if ( isset( $settings['layout'] ) && ! empty( $settings['layout'] ) ) {
			$attrs['data-chrome'] = implode( ' ', $settings['layout'] );
		}
		if ( ! empty( $settings['tweet_limit'] ) && absint( $settings['tweet_limit'] ) ) {
			$attrs['data-tweet-limit'] = absint( $settings['tweet_limit'] );
		}
		if ( ! empty( $settings['link_color'] ) ) {
			$attrs['data-link-color'] 		= $settings['link_color'];
		}
		if ( ! empty( $settings['border_color'] ) ) {
			$attrs['data-border-color'] 	= $settings['border_color'];
		}

		foreach ( $attrs as $key => $value ) {
			$attr .= $key;
			if ( ! empty( $value ) ) {
				$attr .= '="' . $value . '"';
			}

			$attr .= ' ';
		}

		?>
		<div class="rs-twitter-timeline" <?php echo $attr; ?>>
			<a class="twitter-timeline" href="https://twitter.com/<?php echo $user; ?>" <?php echo $attr; ?>><?php echo esc_html__('Tweets by', 'rsaddon');?> <?php echo $user; ?></a>
		</div>
		<?php
	}
}