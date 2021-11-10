<?php
/**
 * Elementor RS Couter Widget.
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

class Rsaddon_Elementor_pro_Faq_Widget extends \Elementor\Widget_Base {

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
		return 'rs-faq';
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
		return esc_html__( 'RS FAQ', 'rsaddon' );
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
		return 'glyph-icon flaticon-conversation';
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
			'faq_title',
			[
				'label' => esc_html__( 'Title & Description', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,							
			]
		);

		$repeater->add_control(
			'faq_content',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'type' => Controls_Manager::WYSIWYG,			
				'show_label' => false,
			]
		);


		$this->add_control(
			'faqs',
			[
				'label' => esc_html__( 'FAQ Items', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'faq_title' => esc_html__( 'What is the RS Addon Elementor?', 'rsaddon' ),
						'faq_content' => esc_html__( 'It is a long esfaqlished fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here making it look like readable English.', 'rsaddon' ),
					],
					[
						'faq_title' => esc_html__( 'Why use RS Addon Elementor Plugin?', 'rsaddon' ),
						'faq_content' => esc_html__( 'It is a long esfaqlished fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here', 'rsaddon' ),
					],

					[
						'faq_title' => esc_html__( 'RS Addon Elementor Plugin work as drag and drop?', 'rsaddon' ),
						'faq_content' => esc_html__( 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here', 'rsaddon' ),
					],
				],
				'title_field' => '{{{ faq_title }}}',
			]
		);

		$this->add_control(
		    'rs_faq_style',
		    [
				'label' => esc_html__( 'FAQ Style', 'rsaddon' ),
				'type'  => Controls_Manager::SELECT,				
		        'options' => [
					'number_style' => esc_html__( 'Number Style', 'rsaddon'),
					'icon_style'   => esc_html__( 'Icon Style', 'rsaddon'),
					'custom_style' => esc_html__( 'custom Style', 'rsaddon'),
		        ],
				'default'   => 'number_style',
				'separator' => 'before',
		    ]
		);

		$this->add_control(
            'faq_icon',
            [
				'label' => esc_html__( 'Icon', 'rsaddon' ),                
				'type'  => Controls_Manager::ICON,
                'options' => rsaddon_pro_get_icons(), 
                'default'   => 'fa fa-check',
                'separator' => 'before',
                'condition' => [
                	'rs_faq_style' => 'icon_style',
                ],                        
            ]
        );

        $this->add_control(
			'custom',
			[
				'label' => esc_html__( 'Custom Prefix', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 'Q:',
				'separator' => 'before',
				'condition' => [
                	'rs_faq_style' => 'custom_style',
                ], 
			]
		);

       $this->end_controls_section();


		$this->start_controls_section(
			'section_faq_style_title',
			[
				'label' => esc_html__( 'Title/Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
		    'title_faq',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'rsaddon' ),		        
		    ]
		);
		

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-faq-main .rs-faq-title' => 'color: {{VALUE}};',
				],				
			]
		);

		$this->add_control(
			'title_background',
			[
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-faq-main .rs-faq-title' => 'background-color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .rs-faq-main .rs-faq-content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-faq-main .rs-faq-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
		    'content_faq',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Content', 'rsaddon' ),
		        'separator' => 'before'
		    ]
		);


		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-faq-main .rs-faq-content' => 'color: {{VALUE}};',
				],				
			]
		);

		$this->add_control(
			'content_background',
			[
				'label' => esc_html__( 'Background', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-faq-main .rs-faq-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .rs-faq-main .rs-faq-content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'rsaddon' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-faq-main .rs-faq-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rs-faq-main .rs-faq-content' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		echo '<div class="rs-faq-main">';

			$num = 1;
			foreach ( $settings['faqs'] as $index => $item ) :				
				if(!empty($settings['faq_icon'])){
					$rs_icon_faq = '<i class="fa '.$settings['faq_icon'].'"></i>';
				}elseif(!empty($settings['custom'])){
					$rs_icon_faq =  $settings['custom'];
				}else{
					$rs_icon_faq = $num++;
				}	

				if(!empty($item['faq_title'])): ?>
					<h3 class="rs-faq-title">
						<span><?php echo wp_kses_post($rs_icon_faq);?></span>
						<?php echo esc_html($item['faq_title']);?>
					</h3>
				<?php endif;

				if(!empty($item['faq_content'])): ?>
					<div class="rs-faq-content"> <?php echo wp_kses_post( $item['faq_content']);?></div>
				<?php endif;

			endforeach;

		echo '</div>';
	}

}