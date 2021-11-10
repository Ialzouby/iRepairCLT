<?php
/**
 * Logo widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\render_icon;
use Elementor\Icons_Manager;
use Elementor\is_migration_allowed;
use Elementor\Global_Colors;
use Elementor\Global_Typography;



defined( 'ABSPATH' ) || die();

class Widget_Rs_Accordion extends \Elementor\Widget_Base {
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
        return 'rs-accordions';
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
        return esc_html__( 'RS Accordion', 'rsaddon' );
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
        return 'eicon-accordion';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'Accordion' ];
    }


    protected function _register_controls() {       

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Accordion Item', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();  


        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'rsaddon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'rsaddon'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'rsaddon' ),
                'separator'   => 'before',
            ]
        );       

        $repeater->add_control(
        	'description',
        	[
        		'label' => __( 'Content', 'elementor' ),
        		'type' => Controls_Manager::WYSIWYG,
        		'default' => __( 'Accordion Content', 'elementor' ),
        		'show_label' => false,
        	]
        );       

        $this->add_control(
            'accordion_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                ]
            ]
        );

        $this->add_control(
        	'accord_style',
        	[
        		'label'   => esc_html__( 'Select Accordion Style', 'rsaddon' ),
        		'type'    => Controls_Manager::SELECT,
        		'default' => 'style1',
        		'options' => [					
        			'style1' => esc_html__( 'Style 1', 'rsaddon'),
        			'style2' => esc_html__( 'Style 2', 'rsaddon'),
        		],
        	]
        );

        $this->add_control(
        	'icon_type',
        	[
        		'label'   => esc_html__( 'Select Accordion Type', 'rsaddon' ),
        		'type'    => Controls_Manager::SELECT,
        		'default' => 'icons',			
        		'options' => [					
        			'icons' => esc_html__( 'Icon', 'rsaddon'),
        			'image' => esc_html__( 'Image', 'rsaddon'),		
        		],
        		'separator' => 'before',
        	]
        );

        $this->add_control(
        	'ac_selected_image',
        	[
        		'label' => esc_html__( 'Choose Default Image', 'rsaddon' ),
        		'type'  => Controls_Manager::MEDIA,
        		'condition' => [
        			'icon_type' => 'image',
        		],
        		'separator' => 'before',
        	]
        );

        $this->add_control(
        	'selected_image',
        	[
        		'label' => esc_html__( 'Choose Active Image', 'rsaddon' ),
        		'type'  => Controls_Manager::MEDIA,
        		'condition' => [
        			'icon_type' => 'image',
        		],
        		'separator' => 'before',
        	]
        );

        $this->add_control(
        	'selected_active_icon',
        	[
        		'label' => __( 'Icon', 'elementor' ),
        		'type' => Controls_Manager::ICONS,
        		'fa4compatibility' => 'icon_active',
        		'default' => [
        			'value' => 'fas fa-minus',
        			'library' => 'fa-solid',
        		],
        		'recommended' => [
        			'fa-solid' => [
        				'chevron-up',
        				'angle-up',
        				'angle-double-up',
        				'caret-up',
        				'caret-square-up',
        			],
        			'fa-regular' => [
        				'caret-square-up',
        			],
        		],
        		'skin' => 'inline',
        		'label_block' => false,
        		'condition' => [
        			'icon_type' => 'icons',
        		],
        	]
        );


        $this->add_control(
        	'selected_icon',
        	[
        		'label' => __( 'Active Icon', 'elementor' ),
        		'type' => Controls_Manager::ICONS,
        		'separator' => 'before',
        		'fa4compatibility' => 'icon',
        		'default' => [
        			'value' => 'fas fa-plus',
        			'library' => 'fa-solid',
        		],
        		'recommended' => [
        			'fa-solid' => [
        				'chevron-down',
        				'angle-down',
        				'angle-double-down',
        				'caret-down',
        				'caret-square-down',
        			],
        			'fa-regular' => [
        				'caret-square-down',
        			],
        		],
        		'condition' => [
        			'icon_type' => 'icons',
        		],
        		'skin' => 'inline',
        		'label_block' => false,
        	]
        );

         

        $this->add_control(
        	'title_html_tag',
        	[
        		'label' => __( 'Title HTML Tag', 'elementor' ),
        		'type' => Controls_Manager::SELECT,
        		'options' => [
        			'h1' => 'H1',
        			'h2' => 'H2',
        			'h3' => 'H3',
        			'h4' => 'H4',
        			'h5' => 'H5',
        			'h6' => 'H6',
        			'div' => 'div',
        		],
        		'default' => 'div',
        		'separator' => 'before',
        	]
        ); 
        $this->end_controls_section();

        $this->start_controls_section(
        	'section_title_style',
        	[
        		'label' => __( 'Accordion', 'elementor' ),
        		'tab' => Controls_Manager::TAB_STYLE,
        	]
        );

        $this->add_responsive_control(
            'margin_acc',
            [
                'label' => esc_html__( 'Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-accordion .ui-accordion-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
        	'section_toggle_style_title',
        	[
        		'label' => __( 'Title', 'elementor' ),
        		'tab' => Controls_Manager::TAB_STYLE,
        	]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-addon-accordion .ui-accordion-header',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgroundc',
                'label' => __( 'Active Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-addon-accordion .ui-accordion-header.ui-accordion-header-active',
            ]
        );

        $this->add_control(
        	'title_color',
        	[
        		'label' => __( 'Color', 'elementor' ),
        		'type' => Controls_Manager::COLOR,
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header a, {{WRAPPER}} .rs-addon-accordion .ui-accordion-header .elementor-accordion-icon' => 'color: {{VALUE}};',
        		],
        	]
        );

        $this->add_control(
        	'tab_active_color',
        	[
        		'label' => __( 'Active Color', 'elementor' ),
        		'type' => Controls_Manager::COLOR,
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header.ui-accordion-header-active .elementor-accordion-icon, {{WRAPPER}} .rs-addon-accordion .ui-accordion-header.ui-accordion-header-active a' => 'color: {{VALUE}};',
        		],
        	]
        );

        $this->add_group_control(
        	Group_Control_Typography::get_type(),
        	[
        		'name' => 'title_typography',
        		'selector' => '{{WRAPPER}} .rs-addon-accordion .ui-accordion-header a',
        	]
        );

        $this->add_responsive_control(
        	'title_padding',
        	[
        		'label' => __( 'Padding', 'elementor' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', 'em', '%' ],
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

        $this->add_responsive_control(
        	'title_padding_active',
        	[
        		'label' => __( 'Active Padding', 'elementor' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', 'em', '%' ],
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header.ui-accordion-header-active' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

        $this->add_responsive_control(
            'title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-accordion .ui-accordion-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'active_title_border_radius',
            [
                'label' => esc_html__( 'Active Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-accordion .ui-accordion-header.ui-accordion-header-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


       $this->add_group_control(
           Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'box_shadow',
               'selector' => '{{WRAPPER}} .rs-addon-accordion .ui-accordion-header',
           ]
       );

        $this->end_controls_section();

        $this->start_controls_section(
        	'section_toggle_style_icon',
        	[
        		'label' => __( 'Icon', 'elementor' ),
        		'tab' => Controls_Manager::TAB_STYLE,
        		'condition' => [
        			'selected_icon[value]!' => '',
        		],
        	]
        );

        $this->add_control(
        	'icon_align',
        	[
        		'label' => __( 'Alignment', 'elementor' ),
        		'type' => Controls_Manager::CHOOSE,
        		'options' => [
        			'left' => [
        				'title' => __( 'Start', 'elementor' ),
        				'icon' => 'eicon-h-align-left',
        			],
        			'right' => [
        				'title' => __( 'End', 'elementor' ),
        				'icon' => 'eicon-h-align-right',
        			],
        		],
        		'default' => is_rtl() ? 'right' : 'left',
        		'toggle' => false,
        	]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background1',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-addon-accordion.accdstyle2 .ui-accordion-header.ui-accordion-header-active .elementor-accordion-icon',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background2',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-addon-accordion.accdstyle2 .elementor-accordion-icon',
            ]
        );

        $this->add_control(
        	'icon_color',
        	[
        		'label' => __( 'Color', 'elementor' ),
        		'type' => Controls_Manager::COLOR,
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
        			'{{WRAPPER}} .rs-addon-accordion.accdstyle2 .ui-accordion-header .elementor-accordion-icon' => 'color: {{VALUE}};',
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
        			'{{WRAPPER}} .rs-addon-accordion.accdstyle2 .ui-accordion-header .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
        		],
        	]
        );

        $this->add_control(
        	'icon_active_color',
        	[
        		'label' => __( 'Active Color', 'elementor' ),
        		'type' => Controls_Manager::COLOR,
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header.ui-accordion-header-active .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
        			'{{WRAPPER}} .rs-addon-accordion .ui-accordion-header.ui-accordion-header-active .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
        		],
        	]
        );

        $this->add_responsive_control(
        	'icon_space',
        	[
        		'label' => __( 'Spacing', 'elementor' ),
        		'type' => Controls_Manager::SLIDER,
        		'range' => [
        			'px' => [
        				'min' => 0,
        				'max' => 100,
        			],
        		],
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .elementor-accordion-icon.elementor-accordion-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
        			'{{WRAPPER}} .rs-addon-accordion .elementor-accordion-icon.elementor-accordion-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
        		],
        	]
        );

        $this->end_controls_section();

        $this->start_controls_section(
        	'section_toggle_style_content',
        	[
        		'label' => __( 'Content', 'elementor' ),
        		'tab' => Controls_Manager::TAB_STYLE,
        	]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'backgrounds',
                'label' => __( 'Background', 'plugin-domain' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-addon-accordion .accordion-desc',
            ]
        );

        $this->add_control(
        	'content_color',
        	[
        		'label' => __( 'Color', 'elementor' ),
        		'type' => Controls_Manager::COLOR,
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .accordion-desc' => 'color: {{VALUE}};',
        			'{{WRAPPER}} .rs-addon-accordion .accordion-desc p' => 'color: {{VALUE}};',
        		],
        	]
        );

        $this->add_group_control(
        	Group_Control_Typography::get_type(),
        	[
        		'name' => 'content_typography',
        		'selector' => '{{WRAPPER}} .rs-addon-accordion .accordion-desc p, {{WRAPPER}} .rs-addon-accordion .accordion-desc',
        	]
        );

        $this->add_responsive_control(
        	'content_padding',
        	[
        		'label' => __( 'Padding', 'elementor' ),
        		'type' => Controls_Manager::DIMENSIONS,
        		'size_units' => [ 'px', 'em', '%' ],
        		'selectors' => [
        			'{{WRAPPER}} .rs-addon-accordion .accordion-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        		],
        	]
        );

        $this->add_responsive_control(
            'margin_cons',
            [
                'label' => esc_html__( 'Content Margin', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-accordion .accordion-desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-addon-accordion .accordion-desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
    	
        $settings = $this->get_settings_for_display();
        $unique = rand(2012,35120);
        if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
        	// @todo: remove when deprecated
        	// added as bc in 2.6
        	// add old default
        	$settings['icon'] = 'fa fa-plus';
        	$settings['icon_active'] = 'fa fa-minus';
        	$settings['icon_align'] = $this->get_settings( 'icon_align' );
        }

        $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
        $has_icon = ( ! $is_new || ! empty( $settings['selected_icon']['value'] ) );
        $id_int = substr( $this->get_id_int(), 0, 3 );
      
        if ( empty($settings['accordion_list'] ) ) {
            return;
        }

        ?>
            <div class="rsaddon-unique-accordion">
                <div id="accordion<?php echo esc_attr($unique); ?>" class="rs-addon-accordion accd<?php echo esc_attr( $settings['accord_style'] ); ?>">                   
                        
                    <?php
                        foreach ( $settings['accordion_list'] as $index => $item ) :
                                                        
                            $title        = !empty($item['name']) ? $item['name'] : '';                                
                            $description  = !empty($item['description']) ? $item['description'] : '';

                        ?>
                        
                        <<?php echo $settings['title_html_tag']; ?> <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                        	<?php if ( $has_icon ) : ?>
                        		<span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
                        		<?php
                        		if ( $is_new || $migrated ) { ?>
                        			<span class="elementor-accordion-icon-closed"><?php Icons_Manager::render_icon( $settings['selected_icon'] ); ?></span>
                        			<span class="elementor-accordion-icon-opened"><?php Icons_Manager::render_icon( $settings['selected_active_icon'] ); ?></span>
                        		<?php } else { ?>
                        			<i class="elementor-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
                        			<i class="elementor-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i>
                        		<?php } ?>
                        		</span>
                        	<?php endif; ?>
                        	<a class="elementor-accordion-title" href="">
                        		<?php if('left' == $settings['icon_align']){ ?>
	                        		<?php if(!empty($settings['selected_image']['url'])) { ?>
	                        			<cite class="default-img"><img src="<?php echo esc_url($settings['selected_image']['url']);?>"></cite>
	                        		<?php } ?>
	                        		<?php if(!empty($settings['ac_selected_image']['url'])) { ?>
	                        			<cite class="active-img"><img src="<?php echo esc_url($settings['ac_selected_image']['url']);?>"></cite>
	                        		<?php } ?>
	                        	<?php } ?>

                        		<span><?php echo esc_attr ($title);?></span>  

                        		<?php if('right' == $settings['icon_align']){ ?>
	                        		<?php if(!empty($settings['selected_image']['url'])) { ?>
	                        			<cite class="default-img rights"><img src="<?php echo esc_url($settings['selected_image']['url']);?>"></cite>
	                        		<?php } ?>
	                        		<?php if(!empty($settings['ac_selected_image']['url'])) { ?>
	                        			<cite class="active-img rights"><img src="<?php echo esc_url($settings['ac_selected_image']['url']);?>"></cite>
	                        		<?php } ?>
	                        	<?php } ?>

                        	</a>
                        	</<?php echo $settings['title_html_tag']; ?>>                                                                 
                            

                            <?php if(!empty($item['description'])):?>                                            
                                <div class="accordion-desc">                                    
                               		<?php echo $this->parse_text_editor( $item['description'] ); ?> 
                            	</div>                                            
                            <?php endif;?>                                
                            
                        <?php endforeach; ?>
                      
                </div>              
            </div>
            <script>
            jQuery( function() {            	
              	jQuery("#accordion<?php echo esc_attr($unique); ?>").accordion();
            	} );
            </script>
        <?php
    }

}