<?php
/**
 * Elementor rsgallery Widget.
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
use Elementor\Group_Control_Background;
use Elementor\Scheme_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Rsaddon_Portfolio_pro_Filter_Widget extends \Elementor\Widget_Base {

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
		return 'rsportfolio-filter';
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
		return __( 'RS Portfolio Filter', 'rsaddon' );
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
		return 'glyph-icon flaticon-spreadsheet';
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
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'portfolio_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',				
				'options' => [
					'1' => 'Style 1',
					'2' => 'Style 2',
					'3' => 'Style 3',				
					'4' => 'Style 4',				
					'5' => 'Style 5',				
					'6' => 'Style 6',				
					'7' => 'Style 7',				
				],											
			]
		);


		$this->add_control(
			'portfolio_category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'default' => 0,			
				'options' => $this->getCategories(),
				'multiple' => true,	
				'separator' => 'before',		
			]

		);

		

		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Project Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => -1,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label'   => esc_html__( 'Show Filter', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter_show',	
				'condition' => [
                	'portfolio_grid_style!' => ['9', '8']
                ],			
				'options' => [
					'filter_show' => 'Show',
					'filter_hide' => 'Hide',				
				],											
			]
		);

		$this->add_control(
			'filter_title',
			[
				'label' => esc_html__( 'Filter Default Title', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
                'condition' => [
                	'portfolio_grid_style!' => ['9', '8']
                ],	
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
            'align_filter',
            [
                'label' => esc_html__( 'Alignment Filter Menu', 'rsaddon' ),
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
                    '{{WRAPPER}} .portfolio-filter' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
				'condition' => [
                	'show_filter' => 'filter_show',
                ],
            ]
        );
	
		$this->add_control(
			'portfolio_columns',
			[
				'label'   => esc_html__( 'Columns', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'6' => esc_html__( '2 Column', 'rsaddon' ),
					'4' => esc_html__( '3 Column', 'rsaddon' ),
					'3' => esc_html__( '4 Column', 'rsaddon' ),
					'2' => esc_html__( '6 Column', 'rsaddon' ),
					'1' => esc_html__( '1 Column', 'rsaddon' ),					
				],
				'separator' => 'before',							
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'rsaddon' ),
				'type'      => Controls_Manager::ICON,
				'options'   => rsaddon_pro_get_icons(),				
				'default'   => 'fa fa-plus',
				'separator' => 'before',
				'condition' => [
					'portfolio_grid_style' => ['2', '1', '7'],
				],				
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );  


        $this->add_control(
			'image_spacing_custom',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rsaddon' ),
				'type' => Controls_Manager::SLIDER,
				'show_label' => true,
				'separator' => 'before',
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
				],			

				'selectors' => [
                    '{{WRAPPER}} .portfolio-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-inner-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
			]
		);   


        $this->add_control(
			'gap_conditon',
			[
				'label' => esc_html__( 'left Right Gap', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'options' => [
					''   => 'Yes',
					'no-gutters' => 'No'				
				],	
				'default' => '',
			]
		); 

		$this->add_responsive_control(
            'background_border_radius',
            [
                'label' => esc_html__( 'Background Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-item, {{WRAPPER}} .portfolio-item .portfolio-content:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

		 


		$this->add_control(
			'grid_popup',
			[
				'label'   => esc_html__( 'Show Popup', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'popup',				
				'options' => [
					'popup'   => 'Popup Style',
					'default' => 'Default Style'				
				],
				'separator' => 'before',
													
			]
		);    

				
		$this->end_controls_section();

		
        $this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a' => 'color: {{VALUE}};',                   

                ],                
            ]
        );



        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-title a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );

       

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .p-title > a',                    
			]
		);

		 $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => esc_html__( 'Category Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .p-category',
			]
		);

        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-category a' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .p-category a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]
            
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img i, {{WRAPPER}} .rs-portfolio-style7 .content-overlay i, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon i' => 'color: {{VALUE}};',                    
                ],              
            ]
            
        );  

        $this->add_control(
            'icon_bg_color',
            [
                'label' => esc_html__( 'Icon Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img i, {{WRAPPER}} .rs-portfolio-style7 .content-overlay i, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon' => 'background: {{VALUE}};',                    
                ],              
            ]
            
        );  

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .rs-portfolio-style1 .portfolio-item .portfolio-img i, {{WRAPPER}} .rs-portfolio-style7 .content-overlay i, {{WRAPPER}} .rs-portfolio-style2 .portfolio-item .portfolio-content .p-icon',                    
			]
		);



        $this->add_control(
            'image_overlay',
            [
                'label' => esc_html__( 'Image Overlay', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .portfolio-content:before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item:before' => 'background: {{VALUE}};',

                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'gradient_bg_color',
                'label' => esc_html__( 'Background', 'rsaddon' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .rs-portfolio-style2 .portfolio-item:before, {{WRAPPER}} .portfolio-content:before, {{WRAPPER}} .rs-portfolio-style7 .content-overlay:before, {{WRAPPER}} .rs-portfolio-style6 .portfolio-item .portfolio-content:before',

            ]
        ); 

        $this->end_controls_section();

		//Popup Style Setting
		$this->start_controls_section(
			'section_portfolio_grid_style',
			[
				'label' => esc_html__( 'Popup Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'popup_port_title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,                              
            ]
        );


        $this->add_control(
            'popup_port_content_color',
            [
                'label' => esc_html__( 'Content Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );	

        $this->add_control(
            'popup_port_info_color',
            [
                'label' => esc_html__( 'Project Information Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,              
            ]
        );		

        $this->add_control(
            'popup_port_background',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',                
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

	$popup_port_title_color = !empty( $settings['popup_port_title_color']) ? 'style="color: '.$settings['popup_port_title_color'].'"' : '';
	$popup_port_content_color = !empty( $settings['popup_port_content_color']) ? 'style="color: '.$settings['popup_port_content_color'].'"' : '';
	$popup_port_info_color = !empty( $settings['popup_port_info_color']) ? 'style="color: '.$settings['popup_port_info_color'].'"' : '';
	$popup_port_background = !empty( $settings['popup_port_background']) ? 'style="background: '.$settings['popup_port_background'].'"' : '';

	$taxonomy ="";

	?>
		<div class="rs-portfolio-style<?php echo esc_attr($settings['portfolio_grid_style']); ?> rsaddon_pro_box">

			<?php if('filter_show' == $settings['show_filter']){?>
				<div class="portfolio-filter">
				    <button class="active" data-filter="*"><?php echo esc_html($settings['filter_title']);?></button>

				    <?php $taxonomy = "portfolio-category";
					    $select_cat = $settings['portfolio_category'];
	                    foreach ($select_cat as $catid) {
	                    
	                    $term = get_term_by('slug', $catid, $taxonomy);
	                    $term_name  =  $term->name;
	                    $term_slug  =  $term->slug;
                    ?>
		            	<button data-filter=".filter_<?php echo esc_html($term_slug);?>"><?php echo esc_html($term_name);?></button>
		            <?php  } ?>

				</div>
			<?php } ?>
			
			

			
			<div class="row grid <?php echo esc_html($settings['gap_conditon']);?>">

			    <?php 			

					if('1' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style1.php";
					}

					if('2' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style2.php";
					}

					if('3' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style3.php";
					}

					if('4' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style4.php";
					}

					if('5' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style5.php";
					}

					if('6' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style6.php";
					}

					if('7' == $settings['portfolio_grid_style']){
						include plugin_dir_path(__FILE__)."/style7.php";
					}
					
				?>
			</div>


		</div>
	
	<?php	

	}
	public function getCategories(){
        $cat_list = [];
         	if ( post_type_exists( 'portfolios' ) ) { 
          	$terms = get_terms( array(
             	'taxonomy'    => 'portfolio-category',
             	'hide_empty'  => true            
         	) );           
         
  
	        foreach($terms as $post) {
	        	$cat_list[$post->slug]  = [$post->name];
	        }
    	}  
        return $cat_list;
    }
}?>