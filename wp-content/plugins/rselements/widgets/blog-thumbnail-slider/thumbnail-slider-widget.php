<?php
/**
 * Elementor rs Thumbnail Slider Widget.
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

class Rsaddon_Elementor_Pro_thumbnail_slider_Widget extends \Elementor\Widget_Base {

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
		return 'rsthumbnail-slider';
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
		return esc_html__( 'RS Thumbnail Slider', 'rsaddon' );
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
		return 'glyph-icon flaticon-slider-1';
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

		$post_categories = get_terms( 'category' );

        $post_options = [];
        foreach ( $post_categories as $category ) {
            $post_options[ $category->slug ] = $category->name;
        }     

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'category',
			[
				'label'   => esc_html__( 'Category', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT2,	
				'options'     => $post_options,
                'default'     => [],
                'label_block' => true,
                'multiple' => true, 
				'separator' => 'before',		
			]

		);
		


		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Blog Show Per Page', 'rsaddon' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '6', 'rsaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        ); 

		$this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__( 'Category Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );		

        $this->add_control(
            'date_show_hide',
            [
                'label' => esc_html__( 'Date Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );        

        $this->add_control(
            'author_show_hide',
            [
                'label' => esc_html__( 'Author Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_slider_style',
            [
                'label' => esc_html__( 'Blog Style', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'blog_cat_color',
            [
                'label' => esc_html__( 'Category Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rs-blog-grid .blog-item .image-wrap .cat_list ul li a, .thumbnail-slider .cat_list li a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .thumbnail-slider .cat_list li::after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'blog_cat_show_hide' => 'yes',
                ]                
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .slider-content .blog-name a' => 'color: {{VALUE}};',

                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .item .slider-content .blog-name a:hover' => 'color: {{VALUE}};',
                ],                
            ]            
        ); 


        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__( 'Meta Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .slider-section .item .slider-content .slider-admin .date i, .thumbnail-slider .slider-section .item .slider-content .slider-admin .blog-meta, .thumbnail-slider .slider-section .item .slider-content .slider-admin .blog-meta i' => 'color: {{VALUE}};',
                ],                
            ]            
        );

        $this->add_control(
            'nav_border_color',
            [
                'label' => esc_html__( 'Nav Thumbnail Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .slider-nav-thumbnail .item' => 'border-color: {{VALUE}};',
                ],                
            ]            
        ); 

        $this->add_control(
            'nav_active_border',
            [
                'label' => esc_html__( 'Nav Thumbnail Active Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .slider-nav-thumbnail .item.slick-current' => 'border-color: {{VALUE}};',
                ],                
            ]            
        ); 

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rsaddon' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => 
                    '{{WRAPPER}} .thumbnail-slider .slider-section .item .slider-content .blog-name a',
			]
		);

		$this->end_controls_section();


        //Read More Style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'blog_readmore_show_hide',
            [
                'label' => esc_html__( 'ReadMore Show/Hide', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rsaddon' ),
                    'no' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'blog_btn_text',
            [
                'label'       => esc_html__( 'Blog Button Text', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => '',
                'placeholder' => esc_html__( 'Blog Button Text', 'rsaddon' ),
                'separator'   => 'before',
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );


        $this->add_responsive_control(
            'blog_btn_link_padding',
            [
                'label' => esc_html__( 'Padding', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'rsaddon' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        
        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_blog_btn_normal',
            [
                'label' => esc_html__( 'Normal', 'rsaddon' ),
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );


        $this->add_control(
            'link_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn' => 'color: {{VALUE}};',
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_btn_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn' => 'background-color: {{VALUE}};',
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_btn_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn' => 'border-color: {{VALUE}};',
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->end_controls_tab();


        $this->start_controls_tab(
            '_blog_btn_button_hover',
            [
                'label' => esc_html__( 'Hover', 'rsaddon' ),
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_btn_hover_color',
            [
                'label' => esc_html__( 'Text Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn:hover' => 'color: {{VALUE}}',
                   
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_btn_hover_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn:hover' => 'background-color: {{VALUE}};',
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_btn_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', 'rsaddon' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .thumbnail-slider .blog-btn .blog-btn:hover' => 'border-color: {{VALUE}};',
                ],
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->end_controls_section();
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
        $unique = rand(100,31120);

        ?>
			<div class="rs-blog-grid blog-grid thumbnail-slider">
				<div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="slider-section sliderthumbnail">
				 	<?php 

				        $cat = $settings['category'];         
				      

					    if(empty($cat)){
				        	$best_wp = new wp_Query(array(
				        		'post_type'      => 'post',
								'posts_per_page' => $settings['per_page'],				
							));	  
				        }   
				        else{
				        	$best_wp = new wp_Query(array(
				        			'post_type'      => 'post',
									'posts_per_page' => $settings['per_page'],
									'tax_query'      => array(
								        array(
											'taxonomy' => 'category',
											'field'    => 'slug', 
											'terms'    => $cat 
								        ),
								    )
							));	  
				        }
					  
				        
						while($best_wp->have_posts()): $best_wp->the_post(); 

    						$full_date      = get_the_date();
    						$blog_date      = get_the_date('d M y');	
    						$post_admin     = get_the_author();
                            $categories =     get_the_category();    

                          
    						
    						if(!empty($settings['blog_word_show'])){
    							$limit = $settings['blog_word_show'];
    						}
    						else{
    							$limit = 20;
    						}
						?>                        
                        <div class="item">
                            <a class="pointer-events" href="<?php the_permalink();?>">
                                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                            </a>
                            <div class="slider-content text-center">
                                <?php if(($settings['blog_cat_show_hide'] == 'yes') ){ ?>
                                    <ul class="cat_list">
                                       <?php
                                        foreach ($categories as $value) {
                                            if ( ! empty( $value ) ) {
                                                echo '<li><a href="' . esc_url( get_category_link( $value->term_id ) ) . '">' . esc_html( $value->name ) . '</a></li>';
                                            }
                                        }                                            
                                       ?>
                                    </ul>
                                <?php } ?>

                                <div class="blog-name"><a class="pointer-events" href="<?php the_permalink();?>"><?php the_title();?></a></div>
                                <div class="slider-admin">
                                    <div class="blog-meta">
                                    	<?php if(($settings['date_show_hide'] == 'yes') ){ ?>
                                        	<span class="date"><?php echo esc_html($full_date);?></span>
                                        <?php } ?>

                                        <?php if(($settings['author_show_hide'] == 'yes') ){ ?>
                                        	<span class="admin"><?php echo esc_html($post_admin);?></span>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php if(($settings['blog_readmore_show_hide'] == 'yes') ){ ?>
                                    <?php if(!empty($settings['blog_btn_text'])){ ?>
                                        <div class="blog-btn">                                            
                                            <a class="blog-btn" href="<?php the_permalink(); ?>">
                                                <span class="btn-txt"><?php echo esc_html($settings['blog_btn_text']);?></span>
                                            </a>
                                        </div>                                    
                                    <?php  }
                                } ?>
                            </div> 
                        </div>					
					<?php
					endwhile;
					wp_reset_query();?>
                </div>
                <div class="slider-nav-thumbnail">
                    <?php while($best_wp->have_posts()): $best_wp->the_post();?>                            
                    <div class="item">
                        <?php the_post_thumbnail('vloglab_slider_thumbnail_size'); ?>
                    </div>  
                    <?php endwhile;
                    wp_reset_query();?>
                </div>
			</div>
            <script type="text/javascript"> 
            jQuery(document).ready(function(){
            var sliderthumbnail = jQuery('.sliderthumbnail');
                if(sliderthumbnail.length){
                    jQuery('.sliderthumbnail').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        swipe: false,
                        cssEase: 'ease-in-out',
                        fade: true,
                        asNavFor: '.slider-nav-thumbnail',
                        responsive: [
                            {
                                breakpoint: 991,
                                settings: {
                                    swipe: true,
                                }
                            }
                        ]
                    });
                }
                var slidernavthumbnail = jQuery('.slider-nav-thumbnail');
                if(slidernavthumbnail.length){
                    jQuery('.slider-nav-thumbnail').slick({
                        slidesToShow: 4,
                        asNavFor: '.sliderthumbnail',
                        dots: false,
                        arrows : false,
                        focusOnSelect: true,
                        centerMode:false,                       
                        responsive: [
                            {
                                breakpoint: 800,
                                settings: {
                                    slidesToShow: 2,
                                }
                            }
                        ]
                    });
                }
            });
    </script>
		<?php

	}
}?>