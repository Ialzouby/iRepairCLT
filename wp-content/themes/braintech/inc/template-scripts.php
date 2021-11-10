<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

function braintech_scripts() {
	//register styles
	global $braintech_option;
	wp_enqueue_style( 'boostrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css' );	
	wp_enqueue_style( 'font-awesome-all', get_template_directory_uri() .'/assets/css/font-awesome.min.all.css');
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/assets/css/font-awesome.min.css');	
	wp_enqueue_style( 'flaticon', get_template_directory_uri() .'/assets/css/flaticon.css');
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() .'/assets/css/owl.carousel.css' );
	wp_enqueue_style( 'slick', get_template_directory_uri() .'/assets/css/slick.css' );	
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/css/magnific-popup.css');
	wp_enqueue_style( 'braintech-style-default', get_template_directory_uri() .'/assets/css/default.css' );
	wp_enqueue_style( 'braintech-style-custom', get_template_directory_uri() .'/assets/css/custom.css' );

	wp_enqueue_style( 'braintech-style-responsive', get_template_directory_uri() .'/assets/css/responsive.css' );

	wp_enqueue_style( 'braintech-style', get_stylesheet_uri() );	

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr-2.8.3.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array('jquery'), '20151215', true );


	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'isotope-braintech', get_template_directory_uri() . '/assets/js/isotope-braintech.js', array('jquery', 'imagesloaded'), '20151215', true );	
	
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '20151215', true );		
	
	wp_enqueue_script('braintech-classie', get_template_directory_uri() . '/assets/js/classie.js', array('jquery'), '201513434', true);
	
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', array('jquery'), '20151215', true );

	
	// Mouse Pointer Scripts
	$rs_mouse_pointer="";
	$rs_mouse_pointer  = get_post_meta(get_queried_object_id(), 'mouse-pointer', true);
	
	if($rs_mouse_pointer != 'hide'){
		if(!empty($braintech_option['show_pointer']) || ($rs_mouse_pointer == 'show') ){
			wp_enqueue_script( 'pointer', get_template_directory_uri() . '/assets/js/pointer.js', array('jquery'), '20151215', true );
		} 
	}

	if ( is_page_template( 'page-single.php' ) || is_page_template( 'page-single2.php' ) ) {
		wp_enqueue_script( 'jquery-nav', get_template_directory_uri() . '/assets/js/jquery.easing.min.js', array('jquery'), '20151215', true );
	}
	
	wp_enqueue_script('braintech-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '201513434', true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'braintech_scripts' );
	
add_action( 'wp_enqueue_scripts', 'braintech_rtl_scripts', 1500 );
if ( !function_exists( 'braintech_rtl_scripts' ) ) {
	function braintech_rtl_scripts() {	
		// RTL
		if ( is_rtl() ) {
			wp_enqueue_style( 'braintech-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), 1.0 );
		}		
		
	}
}

add_action( 'admin_enqueue_scripts', 'braintech_load_admin_styles' );
function braintech_load_admin_styles($screen) {
	wp_enqueue_style( 'braintech-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', true, '1.0.0' );
	wp_enqueue_script( 'braintech-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '20151215', true );
} 



if ( file_exists( get_template_directory() . '/inc/font_awesome_5.php' ) ) {
	require_once( get_template_directory() . '/inc/font_awesome_5.php' );

	add_action( 'vc_base_register_front_css', 'braintech_vc_iconpicker_base_register_css' );
	add_action( 'vc_base_register_admin_css', 'braintech_vc_iconpicker_base_register_css' );
	function braintech_vc_iconpicker_base_register_css(){
	    wp_enqueue_style( 'fontawesome-5', get_template_directory_uri() .'/assets/css/font-awesome.min.all.css', '' , '5.0.0');	
	}

	add_action( 'vc_backend_editor_enqueue_js_css', 'braintech_vc_iconpicker_editor_jscss' );
	add_action( 'vc_frontend_editor_enqueue_js_css', 'braintech_vc_iconpicker_editor_jscss' );
	function braintech_vc_iconpicker_editor_jscss(){
	    wp_enqueue_style( 'fontawesome-5' );
	}

	add_action('vc_enqueue_font_icon_element', 'braintech_enqueue_font_awesome_5');
	function braintech_enqueue_font_awesome_5($font){
	    switch ( $font ) {
	        case 'fontawesomenew': wp_enqueue_style( 'fontawesome-5' );
	    }
	}
}