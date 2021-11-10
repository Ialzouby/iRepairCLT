<?php
/**
 * Main Elementor Rsaddon Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Rsaddon_Elementor_Pro_Extension {
	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'rsaddon' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'rsaddon_register_plugin_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'rsaddon_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'rsaddon_register_plugin_admin_styles' ] );

		add_action( 'wp_enqueue_scripts', [ $this, 'rselements_studio_fonts_url' ] );

		$this->include_files();
		
	}

	function rselements_studio_fonts_url() {
          $font_url = '';
          
          /*
          Translators: If there are characters in your language that are not supported
          by chosen font(s), translate this to 'off'. Do not translate into your own language.
           */
          if ( 'off' !== _x( 'on', 'Google font: on or off', 'rsaddon' ) ) {
              $font_url = add_query_arg( 'family', urlencode( 'Open Sans: 400,500,600,700|Montserrat: 400,500,600,700' ), "//fonts.googleapis.com/css" );
          }
        return $font_url;
    }

	public function rsaddon_register_plugin_styles() {

		$dir = plugin_dir_url(__FILE__);

        wp_enqueue_style( 'bootstrap', $dir.'assets/css/bootstrap.min.css' ); 
        wp_enqueue_style( 'magnific-popup', $dir.'assets/css/magnific-popup.css'); 
        wp_enqueue_style( 'font-awesome-latest', $dir.'assets/css/fontawesome.css' );
        wp_enqueue_style( 'slick', $dir.'assets/css/slick.css' ); 
        wp_enqueue_style( 'materialize', $dir.'assets/css/materialize.css' ); 
        wp_enqueue_style( 'slick-theme', $dir.'assets/css/slick-theme.css' );
        wp_enqueue_style( 'brands', $dir.'assets/css/brands.css' );
        wp_enqueue_style( 'solid', $dir.'assets/css/solid.css' );
        wp_enqueue_style( 'rsaddons-floaticon', $dir.'assets/fonts/flaticon.css' );
        wp_enqueue_style( 'headding-title', $dir.'assets/css/headding-title.css' );

        wp_enqueue_style( 'dataTables', '//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css' );
        wp_enqueue_style( 'rsaddons-pro', $dir.'assets/css/rsaddons.css' );      

		wp_enqueue_script( 'jquery-plugin', $dir.'assets/js/jquery.plugin.js' , array('jquery'), '201513434', true);  
		wp_enqueue_script( 'jquery-cookie', $dir.'assets/js/jquery.cookie.js' , array('jquery'), '201513434', true); 
		wp_enqueue_script( 'magnific-popup', $dir.'assets/js/jquery.magnific-popup.min.js' , array('jquery'), '201513434', true);	
		wp_enqueue_script( 'popper', $dir.'assets/js/popper.min.js' , array('jquery'), '201513434', true);  
        wp_enqueue_script( 'bootstrap', $dir.'assets/js/bootstrap.min.js' , array('jquery'), '201513434', true );    
        wp_enqueue_script( 'datatables', $dir.'assets/js/datatables.min.js' , array('jquery'), '201513434', true );    
        wp_enqueue_script( 'waypoints', $dir.'assets/js/waypoints.min.js' , array('jquery'), '201513434', true );
        wp_enqueue_script( 'jquery-counterup', $dir.'assets/js/jquery.counterup.min.js' , array('jquery'), '201513434', true );  
        wp_enqueue_script( 'time-circle', $dir.'assets/js/time-circle.js' , array('jquery'), '201513434', true );     
        wp_enqueue_script( 'headding-title', $dir.'assets/js/headding-title.js' , array('jquery'), '201513434', true);  
        wp_enqueue_script( 'slick', $dir.'assets/js/slick.min.js' , array('jquery'), '201513434', true);   
        wp_enqueue_script( 'materialize', $dir.'assets/js/materialize.min.js' , array('jquery'), '201513434', true);   
        wp_enqueue_script( 'js-tilt-view', $dir.'assets/js/tilt.jquery.min.js', array('jquery'), '201513434', true);            
        wp_enqueue_script( 'jquery-ui', $dir.'assets/js/jquery-ui.js', array('jquery'), '201513434', true);    
        wp_enqueue_script( 'jquery-plugin-progressbar', $dir.'assets/js/jQuery-plugin-progressbar.js' , array('jquery'), '201513434', true);      
        wp_enqueue_script( 'rsaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201513434', true);  	
       	
    }

    public function rsaddon_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'rsaddons-admin-floaticon-pro', $dir.'assets/fonts/flaticon.css' );
    } 

    public function rsaddon_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/rs-addon-icons.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
        require( __DIR__ . '/inc/single-templates.php' );
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'rsaddon_category',
            [
                'title' => esc_html__( 'RS Elementor Addons', 'rsaddon' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rsaddon' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'rsaddon' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'rsaddon' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'rsaddon' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'rsaddon' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		
		require_once( __DIR__ . '/widgets/heading/heading.php' );
		require_once( __DIR__ . '/widgets/dual-heading/dual-heading.php' );
		require_once( __DIR__ . '/widgets/animated-heading/animated-heading.php' );
		require_once( __DIR__ . '/widgets/team-member/team-grid-widget.php' );	
		require_once( __DIR__ . '/widgets/team-member-slider/team-slider-widget.php' );		
		require_once( __DIR__ . '/widgets/counter/rs-counter.php' );
		require_once( __DIR__ . '/widgets/services/rs-service-grid.php' );
		require_once( __DIR__ . '/widgets/portfolio-grid/portfolio-grid-widget.php' );
		require_once( __DIR__ . '/widgets/portfolio-filter/portfolio-filter-widget.php' );
		require_once( __DIR__ . '/widgets/portfolio-slider/portfolio-slider-widget.php' );
		require_once( __DIR__ . '/widgets/video/rs-video.php' );
		require_once( __DIR__ . '/widgets/pricing-table/pricing-table.php' );
		require_once( __DIR__ . '/widgets/price-list/price-list.php' );
		require_once( __DIR__ . '/widgets/table/table.php' );
		require_once( __DIR__ . '/widgets/logo-widget/logo.php' );	
		require_once( __DIR__ . '/widgets/button/button.php' );
		require_once( __DIR__ . '/widgets/cta/cta.php' );
		require_once( __DIR__ . '/widgets/testimonial/testimonail-widget.php' );
		require_once( __DIR__ . '/widgets/testimonial-slider/testimonail-slider-widget.php' );
		require_once( __DIR__ . '/widgets/flip-box/flip-box.php' );
		require_once( __DIR__ . '/widgets/tab/tab.php' );
		require_once( __DIR__ . '/widgets/advanced-tab/tab.php' );
		require_once( __DIR__ . '/widgets/iconbox/rs-iconbox.php' );
		require_once( __DIR__ . '/widgets/blog-grid/blog-grid-widget.php' );
		require_once( __DIR__ . '/widgets/blog-slider/blog-slider-widget.php' );
		require_once( __DIR__ . '/widgets/number/rs-number.php' );
		require_once( __DIR__ . '/widgets/cf7/contact-cf7.php' );
		require_once( __DIR__ . '/widgets/progress/rs-progress.php' );
		require_once( __DIR__ . '/widgets/progress-pie/progress-pie.php' );
		require_once( __DIR__ . '/widgets/countdown/countdown.php' );
		require_once( __DIR__ . '/widgets/contact-box/contact-box.php' );		
		require_once( __DIR__ . '/widgets/tooltip/rs-tooltip.php' );		
		require_once( __DIR__ . '/widgets/static-product/static-product.php' );	
		require_once( __DIR__ . '/widgets/faq/rs-faq.php' );	
		require_once( __DIR__ . '/widgets/image-widget/image.php' );
		require_once( __DIR__ . '/widgets/apps-screenshots/apps-screenshots.php' );
		require_once( __DIR__ . '/widgets/image-hover-widget/image-hover-effect.php' );	
		require_once( __DIR__ . '/widgets/image-animation/image-animation.php' );	
		require_once( __DIR__ . '/widgets/business-hour/rs-hour.php' );	
		require_once( __DIR__ . '/widgets/feature-list/feature-list.php' );		
		require_once( __DIR__ . '/widgets/dual-button/dual-button.php' );
		require_once( __DIR__ . '/widgets/image-box/image.php' );
		require_once( __DIR__ . '/widgets/rs-accordion/rs-accordion.php' );
		require_once( __DIR__ . '/widgets/rs-banner-animate/animate_line.php' );
		if(class_exists('woocommerce')):		
			require_once( __DIR__ . '/widgets/woocommerce/product-grid.php' );		
			require_once( __DIR__ . '/widgets/woocommerce/product-slider.php' );		
			require_once( __DIR__ . '/widgets/woocommerce/product-list.php' );	
		endif;			

		// Register widget
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Heading_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Heading_dual_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Animated_Heading_Widget());
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Team_Grid_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Team_Slider_Pro_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Portfolio_pro_Grid_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Portfolio_pro_Filter_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Portfolio_Slider_Pro_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSCounter_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSservices_Grid_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSvideo_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Pricing_Table_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Price_List_Pro_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Button_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Logo_Showcase_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_CTA_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Testimonial_Grid_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Pro_Testimonial_Slider_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Flip_Box_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Tab_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Pro_Advance_Tab_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSIcon_Box_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Blog_Grid_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Pro_Blog_Slider_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSnumber_Grid_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSCF7_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_progress_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Pro_Progress_Pie_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RScontactbox_Grid_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSTooltip_Box_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_RSStatic_Product_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Faq_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Image_Showcase_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Image_Hover_Effect_Widget() );		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_pro_Business_Hour_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Pro_Features_List_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Pro_Countdown_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Pro_Table_Elementor_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Pro_Dual_Button_Widget() );	
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Image_hover_Widget() );				
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Image_Animation_Effect_Widget() );				
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_Apps_screenshots_Widget() );				
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Widget_Rs_Accordion() );				
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_pro_banner_animate_Widget() );				
		if(class_exists('woocommerce')):
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Pro_Product_Grid_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Pro_Product_Slider_Widget() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Rsaddon_Elementor_Pro_Product_List_Widget() );
		endif;
		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
	}
}
Rsaddon_Elementor_Pro_Extension::instance();