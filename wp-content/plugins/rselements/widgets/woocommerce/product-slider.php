<?php
/**
 * Elementor Product List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Elementor_Pro_Product_Slider_Widget extends \Elementor\Widget_Base {

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
		return 'rs-product-slider';
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
		return __( 'RS Porduct Slider', 'rsaddon' );
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
		return 'glyph-icon flaticon-shopping-cart';
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
		return [ 'product', 'list', 'category' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
    {
    	// Content Controls
        $this->start_controls_section(
            'rs_section_product_grid_settings',
            [
                'label' => esc_html__('Product Settings', 'rsaddon'),
            ]
        );
        $this->add_control(
            'rs_product_grid_product_filter',
            [
                'label' => esc_html__('Filter By', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent-products',
                'options' => [
					'recent-products'       => esc_html__('Recent Products', 'rsaddon'),
					'featured-products'     => esc_html__('Featured Products', 'rsaddon'),
					'best-selling-products' => esc_html__('Best Selling Products', 'rsaddon'),
					'sale-products'         => esc_html__('Sale Products', 'rsaddon'),
					'top-products'          => esc_html__('Top Rated Products', 'rsaddon'),
                ],
            ]
        );
     
         $this->add_control(
            'rs_product_grid_products_count',
            [
				'label'   => __('Products Count', 'rsaddon'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 1000,
				'step'    => 1,
            ]
        );

        $this->add_control(
            'rs_product_grid_categories',
            [
				'label'       => esc_html__('Product Categories', 'rsaddon'),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     =>rselemetns_woocommerce_product_categories(),
            ]
        );

        $this->add_control(
            'rs_product_grid_style_preset',
            [
                'label' => esc_html__('Style Preset', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'rs-product-simple',
                'options' => [
					'rs-product-default' => esc_html__('Default', 'rsaddon'),					
					'rs-product-overlay' => esc_html__('Overlay Style', 'rsaddon'),
                ],
            ]
        );

       
        $this->end_controls_section();

                $this->start_controls_section(
                    'content_slider',
                    [
                        'label' => esc_html__( 'Slider Settings', 'rsaddon' ),
                        'tab' => Controls_Manager::TAB_CONTENT,
                    ]
                );

            
                $this->add_control(
                    'col_lg',
                    [
                        'label'   => esc_html__( 'Desktops > 1199px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_md',
                    [
                        'label'   => esc_html__( 'Desktops > 991px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                     
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_sm',
                    [
                        'label'   => esc_html__( 'Tablets > 767px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 2,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'col_xs',
                    [
                        'label'   => esc_html__( 'Tablets < 768px', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 1,         
                        'options' => [
                            '1' => esc_html__( '1 Column', 'rsaddon' ), 
                            '2' => esc_html__( '2 Column', 'rsaddon' ),
                            '3' => esc_html__( '3 Column', 'rsaddon' ),
                            '4' => esc_html__( '4 Column', 'rsaddon' ),
                            '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slides_ToScroll',
                    [
                        'label'   => esc_html__( 'Slide To Scroll', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 2,         
                        'options' => [
                            '1' => esc_html__( '1 Item', 'rsaddon' ),
                            '2' => esc_html__( '2 Item', 'rsaddon' ),
                            '3' => esc_html__( '3 Item', 'rsaddon' ),
                            '4' => esc_html__( '4 Item', 'rsaddon' ),                   
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );      

                $this->add_control(
                    'slider_dots',
                    [
                        'label'   => esc_html__( 'Navigation Dots', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_nav',
                    [
                        'label'   => esc_html__( 'Navigation Nav', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',           
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_autoplay',
                    [
                        'label'   => esc_html__( 'Autoplay', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 'false',           
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_autoplay_speed',
                    [
                        'label'   => esc_html__( 'Autoplay Slide Speed', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3000,          
                        'options' => [
                            '1000' => esc_html__( '1 Seconds', 'rsaddon' ),
                            '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                            '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                            '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                            '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_stop_on_hover',
                    [
                        'label'   => esc_html__( 'Stop on Hover', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'false',               
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),              
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_interval',
                    [
                        'label'   => esc_html__( 'Autoplay Interval', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,  
                        'default' => 3000,          
                        'options' => [
                            '5000' => esc_html__( '5 Seconds', 'rsaddon' ), 
                            '4000' => esc_html__( '4 Seconds', 'rsaddon' ), 
                            '3000' => esc_html__( '3 Seconds', 'rsaddon' ), 
                            '2000' => esc_html__( '2 Seconds', 'rsaddon' ), 
                            '1000' => esc_html__( '1 Seconds', 'rsaddon' ),     
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_loop',
                    [
                        'label'   => esc_html__( 'Loop', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'slider_centerMode',
                    [
                        'label'   => esc_html__( 'Center Mode', 'rsaddon' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'true' => esc_html__( 'Enable', 'rsaddon' ),
                            'false' => esc_html__( 'Disable', 'rsaddon' ),
                        ],
                        'separator' => 'before',
                                    
                    ]
                    
                );

                $this->add_control(
                    'item_gap_custom',
                    [
                        'label' => esc_html__( 'Item Gap', 'rsaddon' ),
                        'type' => Controls_Manager::SLIDER,
                        'show_label' => true,               
                        'range' => [
                            'px' => [
                                'max' => 100,
                            ],
                        ],
                        'default' => [
                            'size' => 15,
                        ],          

                        'selectors' => [
                            '{{WRAPPER}} .rs-addon-slider .product-item' => 'padding:0 {{SIZE}}{{UNIT}};',                    
                        ],
                    ]
                ); 
                        
                $this->end_controls_section();



        $this->start_controls_section(
            'rs_product_grid_styles',
            [
                'label' => esc_html__('Products Styles', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_background_color',
            [
                'label' => esc_html__('Content Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'rs_peoduct_grid_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => false,
                        ],
                    ],
                    'color' => [
                        'default' => '#eee',
                    ],
                ],
                'selector' => '{{WRAPPER}} .rselements-product-list',                
            ]
        );        

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_typography',
            [
                'label' => esc_html__('Color &amp; Typography', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_heading',
            [
                'label' => __('Product Title', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_color',
            [
                'label' => esc_html__('Product Title Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list h4 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_product_title_typography',
                'selector' => '{{WRAPPER}} .rselements-product-list h4 a',
            ]
        );

        $this->add_control(
            'rs_product_grid_product_price_heading',
            [
                'label' => __('Product Price', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_price_color',
            [
                'label' => esc_html__('Product Price Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_product_price_typography',
                'selector' => '{{WRAPPER}} .rselements-product-list .product-price',
            ]
        );

       
        $this->add_control(
            'rs_product_grid_sale_badge_heading',
            [
                'label' => __('Sale Badge', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_sale_badge_color',
            [
                'label' => esc_html__('Sale Badge Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .product-img span.sale-rs' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rselements-product-list span ins' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_sale_badge_background',
            [
                'label' => esc_html__('Sale Badge Background', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff2a13',
                'selectors' => [
                    '{{WRAPPER}} .product-img span.sale-rs' => 'background-color: {{VALUE}};', 
                    '{{WRAPPER}} .rselements-product-list span ins' => 'background-color: {{VALUE}};',                  
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_sale_badge_typography',
                'selector' => '{{WRAPPER}} .product-img span.sale-rs',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_add_to_cart_styles',
            [
                'label' => esc_html__('Add to Cart Button Styles', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('rs_product_grid_add_to_cart_style_tabs');

        $this->start_controls_tab('normal', ['label' => esc_html__('Normal', 'rsaddon')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_color',
            [
                'label' => esc_html__('Button Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'color: {{VALUE}};',                   
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_background',
            [
                'label' => esc_html__('Button Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'background-color: {{VALUE}};',                   
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'rs_product_grid_add_to_cart_border',
                'selector' => '{{WRAPPER}}.rselements-product-list .product-btn a',
                '{{WRAPPER}} .product-img.overlay .product-btn a', 
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_add_to_cart_typography',
                'selector' => '{{WRAPPER}}.rselements-product-list .product-btn a',
                '{{WRAPPER}} .product-img.overlay .product-btn a', 
                
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('rs_product_grid_add_to_cart_hover_styles', ['label' => esc_html__('Hover', 'rsaddon')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_color',
            [
                'label' => esc_html__('Button Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}}  .rselements-product-list .product-btn a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'color: {{VALUE}};',                    
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_background',
            [
                'label' => esc_html__('Button Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'background-color: {{VALUE}};',                   
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rselements-product-list .product-btn a:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'border-color: {{VALUE}};',                   
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'rs_peoduct_grid_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .product-btn a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $settings = $this->get_settings_for_display();
        $slidesToShow    = !empty($settings['col_lg']) ? $settings['col_lg'] : 3;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $interval        = $settings['slider_interval'];
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];

        
        $unique = rand(2012,35120);

        $slider_conf = compact('slidesToShow', 'autoplaySpeed', 'interval', 'slidesToScroll', 'slider_autoplay','pauseOnHover', 'sliderDots', 'sliderNav', 'infinite', 'centerMode', 'col_lg', 'col_md', 'col_sm', 'col_xs');   

        
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['rs_product_grid_products_count'] ?: 4,
            'order' => 'DESC',
        ];

        if (!empty($settings['rs_product_grid_categories'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $settings['rs_product_grid_categories'],
                    'operator' => 'IN',
                ],
            ];
        }

        if ($settings['rs_product_grid_product_filter'] == 'featured-products') {
            $args['tax_query'] = [
                [
					'taxonomy' => 'product_visibility',
                    'field' => 'name',
					'terms' => 'featured'
				]
            ];
        } else if ($settings['rs_product_grid_product_filter'] == 'best-selling-products') {
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        } else if ($settings['rs_product_grid_product_filter'] == 'sale-products') {
            $args['meta_query'] = [
                'relation' => 'OR',
                [
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ], [
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ],
            ];
        } else if ($settings['rs_product_grid_product_filter'] == 'top-products') {
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        }

        $settings = [
            'rs_product_grid_style_preset' => $settings['rs_product_grid_style_preset'],               
           
        ];

       
        $the_query = new WP_Query( $args );
      
        ?>
        <div class="rsaddon-unique-slider">
            <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rs-addon-slider">
            <?php         	

            if($settings['rs_product_grid_style_preset'] == 'rs-product-overlay'){
            	while ( $the_query->have_posts() ) : $the_query->the_post();
            	global $product;
            	$product = wc_get_product( get_the_ID() ); //set the global product object ?>
            	<div class="product-item">
	                <div class="product-img overlay">
	                	<div class="product-btn">
		                    <?php woocommerce_template_loop_add_to_cart();?>
		                </div>
	                	<?php if ( $product->is_on_sale() ) {
    						echo '<span class="sale-rs">'.esc_html__('Sale','rsaddon').'</span>';
						 } ?>
	                    <a href="<?php the_permalink() ?>">
	                        <?php if ( has_post_thumbnail( get_the_ID() ) ) {
	                            echo get_the_post_thumbnail( get_the_ID(), 'shop_single' );
	                        } else {
	                            echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
	                        } ?>
	                    </a>
	                </div>
	                <div class="rselements-product-list">
		                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
		                <span class="product-price"><?php echo $product->get_price_html(); ?></span>
		                
		            </div>
            	</div>
    		<?php endwhile;  wp_reset_query(); 
            } 
            else { 
            	while ( $the_query->have_posts() ) : $the_query->the_post();
            	global $product;
            	$product = wc_get_product( get_the_ID() ); //set the global product object ?>
            	<div class="product-item">
	                <div class="product-img">
	                	<?php if ( $product->is_on_sale() ) {
    						echo '<span class="sale-rs">'.esc_html__('Sale','rsaddon').'</span>';
						 } ?>
	                    <a href="<?php the_permalink() ?>">
	                        <?php if ( has_post_thumbnail( get_the_ID() ) ) {
	                            echo get_the_post_thumbnail( get_the_ID(), 'shop_single' );
	                        } else {
	                            echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
	                        } ?>
	                    </a>
	                </div>
	                <div class="rselements-product-list">
		                <h4 class="product-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
		                <span class="product-price"><?php echo $product->get_price_html(); ?></span>
		                <div class="product-btn">
		                    <?php woocommerce_template_loop_add_to_cart();?>
		                </div>
		            </div>
            	</div>
    		<?php endwhile;  wp_reset_query(); }
        ?>	 
        </div>   
        <div class="rsaddon-slider-conf wpsisac-hide" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>        
    	</div>
        <script type="text/javascript"> 
        jQuery(document).ready(function(){
            jQuery( '.rs-addon-slider' ).each(function( index ) {        
            var slider_id       = jQuery(this).attr('id'); 
            var slider_conf     = jQuery.parseJSON( jQuery(this).closest('.rsaddon-unique-slider').find('.rsaddon-slider-conf').attr('data-conf'));
           
            if( typeof(slider_id) != 'undefined' && slider_id != '' ) {
            jQuery('#'+slider_id).not('.slick-initialized').slick({
            slidesToShow    : parseInt(slider_conf.col_lg),
            centerMode      : (slider_conf.centerMode)  == "true" ? true : false,
            dots            : (slider_conf.sliderDots)  == "true" ? true : false,
            arrows          : (slider_conf.sliderNav) == "true" ? true : false,
            autoplay        : (slider_conf.slider_autoplay) == "true" ? true : false,
            slidesToScroll  : parseInt(slider_conf.slidesToScroll),
            centerPadding   : '15px',
            autoplaySpeed   : parseInt(slider_conf.autoplaySpeed),
            pauseOnHover    : (slider_conf.pauseOnHover) == "true" ? true : false,
            loop : false,

            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_md),
                }
            }, 
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: parseInt(slider_conf.col_sm),
                }
            }, 
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    slidesToShow: parseInt(slider_conf.col_xs),
                }
            }, ]
            });
        }
       
        });
    });
    </script>

        <?php 
    	
    }   

}