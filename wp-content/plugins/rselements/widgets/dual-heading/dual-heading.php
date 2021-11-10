<?php
/**
 * Elementor Duel Heading Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_pro_Heading_dual_Widget extends \Elementor\Widget_Base {

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
		return 'rs-dual-heading';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Dual Color Heading', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-music-and-multimedia';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
        return [ 'rsaddon_category' ];
    }

	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Dual Heading Info', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		
		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Dual Heading Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'rsaddon'),
					'style1' => esc_html__( 'Border Right', 'rsaddon'),
					'style2' => esc_html__( 'Border Bottom', 'rsaddon'),
					'style3' => esc_html__( 'Border Left', 'rsaddon' ),
					'style4' => esc_html__( 'Border Top', 'rsaddon' ),					
					'style6' => esc_html__( 'Border Top Left', 'rsaddon' ),
					'style7' => esc_html__( 'Border Top Right', 'rsaddon' ),
					'style8' => esc_html__( 'Boder Left Vertical Style', 'rsaddon' ),
					'style9' => esc_html__( 'Heading Image Style', 'rsaddon' ),
					'style5' => esc_html__( 'Heading Bracket Style', 'rsaddon' ),
					'style10' => esc_html__( 'Heading Left Rotate Style', 'rsaddon' ),
					'style11' => esc_html__( 'Heading Right Rotate Style', 'rsaddon' ),
					
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'First Part Heading Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Heading Normal Part', 'rsaddon' ),				
				'separator' => 'before',
			]
		);

		$this->add_control(
			'color_title',
			[
				'label' => esc_html__( 'Second Part Heading Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Dual Color Part', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Select Heading Tag', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [						
					'h1' => esc_html__( 'H1', 'rsaddon'),
					'h2' => esc_html__( 'H2', 'rsaddon'),
					'h3' => esc_html__( 'H3', 'rsaddon' ),
					'h4' => esc_html__( 'H4', 'rsaddon' ),
					'h5' => esc_html__( 'H5', 'rsaddon' ),
					'h6' => esc_html__( 'H6', 'rsaddon' ),				
					
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Sub Heading Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,				
				'placeholder' => esc_html__( 'Sub Heading', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Heading Image', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => 'style9',
				],

				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_postition',
			[
				'label'   => esc_html__( 'Select Image Position', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [						
					'top' => esc_html__( 'Top', 'rsaddon'),
					'bottom' => esc_html__( 'Bottom', 'rsaddon'),						
					
				],
				'condition' => [
					'style' => 'style9',
				],
				'separator' => 'before',
			]
		);


		$this->add_control(
			'watermark',
			[
				'label' => esc_html__( 'Watermark Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Watermark', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content',
			[
				'label' => esc_html__( 'Description', 'rsaddon' ),
				'type' => Controls_Manager::WYSIWYG,
				'rows' => 10,				
				'placeholder' => esc_html__( 'Type your description here', 'rsaddon' ),
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
                    '{{WRAPPER}} .rs-dual-heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__( 'Heading Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rs-dual-heading .title-inner .title .first_title',
			]
		);

		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'First Part Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-dual-heading .title-inner .title' => 'color: {{VALUE}};',
                ],                
            ]
        );

		$this->add_control(
            'title_bg_color',
            [
                'label' => esc_html__( 'First Part Title Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-dual-heading .title-inner .title .first_title' => 'background: {{VALUE}};',
                ],                
            ]
        );

		$this->add_responsive_control(
		    'first_title_padding',
		    [
		        'label' => esc_html__( 'First Part Title Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-dual-heading .title-inner .title .first_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dual_title_typography',
				'label' => esc_html__( 'Second Part Tilte Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .rs-dual-heading .title-inner .title .second_title',
			]
		);

		$this->add_control(
            'last_word_color',
            [
                'label' => esc_html__( 'Second Part Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-dual-heading .title-inner .title .second_title' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'second_title_bg_color',
            [
                'label' => esc_html__( 'Second Part Title Background', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-dual-heading .title-inner .title .second_title' => 'background: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
		    'second_title_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-dual-heading .title-inner .title .second_title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);	

        $this->add_responsive_control(
		    'second_title_padding',
		    [
		        'label' => esc_html__( 'Second Part Title Padding', 'rsaddon' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .rs-dual-heading .title-inner .title .second_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

       

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Subtitle Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .rs-dual-heading .title-inner .sub-text',
			]
		);

		$this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Subtitle Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-dual-heading .title-inner .sub-text' => 'color: {{VALUE}};',
                ],                
            ]
        );  

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
					'{{WRAPPER}} .rs-dual-heading.style2:after '                        => 'background: {{VALUE}};',
					'{{WRAPPER}} .rs-dual-heading.style1 .description:after '           => 'background: {{VALUE}};',
					'{{WRAPPER}} .rs-dual-heading.style4 .title-inner .sub-text:after'  => 'background: {{VALUE}};',
					'{{WRAPPER}} .rs-dual-heading.style4 .title-inner .sub-text:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .rs-dual-heading.style8 .title-inner:after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .rs-dual-heading.style8 .description:after' => 'background: {{VALUE}};',
				]
            ]
        );             

		$this->end_controls_section();
	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display(); 

		$watermark_text = ($settings['watermark']) ? '<span class="watermark">'.($settings['watermark']).'</span>' : '';
		$show_color_title = ($settings['color_title']) ? ' <span class="second_title">'.($settings['color_title']).'</span>' : '';

		$main_title     = ($settings['title']) ? '<'.$settings['title_tag'].' class="title">'.$watermark_text.'<span class="first_title">'.wp_kses_post($settings['title']).'</span>'.$show_color_title.'</'.$settings['title_tag'].'>' : '';

		
		if( "style4"==	$settings['style'] || "style4 Lite"== $settings['style'] || "style6"== $settings['style'] || "style6 Lite"==$settings['style'] || "style7" == $settings['style'] || "style7 Lite"== $settings['style'] ){
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text">'.($settings['subtitle']).'</span>' : '';
		}
		elseif ( "style5" == $settings['style'] ){
			$sub_text = ($settings['subtitle']) ? '<span class="sub-text title-upper">[ <span class="sub-text title-upper">'.($settings['subtitle']).'</span> ] </span>' : '';
		}
		else{
			$sub_text       = ($settings['subtitle'])  ? '<span class="sub-text ">'.($settings['subtitle']) .'</span>' : '';
		}

		$titleimg    = $settings['image'] ? '<img src="' . $settings['image']['url'] . '" />' : '';

		$topimage    = $settings['image_postition'] == 'top' ? '<div class="title-img top"> '.$titleimg .'</div>' : "";

		$bottomimage = $settings['image_postition'] == 'bottom' ? '<div class="title-img bottom-img">'.$titleimg .'</div>' : "";




		

		if( "style9" == $settings['style'] ){
			$main_title     = ($settings['title']) ? '<'.$settings['title_tag'].' class="title" >'.($settings['title']).''.$watermark_text.'</'.$settings['title_tag'].'>' : '';
		}

		    
        // Fill $html var with data
      ?>
        <div class="rs-dual-heading <?php echo esc_attr($settings['style']);?> <?php echo esc_attr($settings['align']);?>">
        	<div class="title-inner">
        		      		
	            <?php 
					echo wp_kses_post( $topimage );
					echo wp_kses_post( $sub_text );
					echo wp_kses_post( $main_title );
					echo wp_kses_post( $bottomimage );
				?>
	        </div>
	        <?php if ($settings['content']) { ?>
            	<div class="description"><?php echo wp_kses_post($settings['content']);?>
            		
            	</div>
        	<?php } ?>
        </div>
        <?php 		
	}
}?>