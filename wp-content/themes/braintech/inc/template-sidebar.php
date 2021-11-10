<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

function braintech_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'braintech' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'This is sidebar area for blog post and single post.', 'braintech' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar Shop', 'braintech' ),
			'id'            => 'sidebar_shop',
			'description'   => esc_html__( 'Sidebar Shop', 'braintech' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	if (class_exists( 'ReduxFramework' )){
		register_sidebar( array(
			'name'          => esc_html__( 'Off Canvas Sidebar', 'braintech' ),
			'id'            => 'sidebarcanvas-1',
			'description'   => esc_html__( 'Off canvas widget area.', 'braintech' ),
			'before_widget' => '<div id="%1$s" class="widget icon-list %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		
		register_sidebar( array(
			'name'          => esc_html__( 'Project Sidebar', 'braintech' ),
			'id'            => 'project-1',
			'description'   => esc_html__( 'Project sidebar.', 'braintech' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Service Sidebar', 'braintech' ),
			'id'            => 'service-1',
			'description'   => esc_html__( 'Services sidebar widget area.', 'braintech' ),
			'before_widget' => '<div id="%1$s" class="service-singles widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'CTA Widget', 'braintech' ),
			'id'            => 'cta_widget',
			'description'   => esc_html__( 'This is the footer top widget area.', 'braintech' ),
			'before_widget' => '<div id="%1$s" class="footer-top-cta widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Top', 'braintech' ),
			'id'            => 'footer_top',
			'description'   => esc_html__( 'This is the footer top widget area.', 'braintech' ),
			'before_widget' => '<div id="%1$s" class="footer-top-logo widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );	
	}

	

	register_sidebar( array(
			'name' => esc_html__( 'Footer One Widget Area', 'braintech' ),
			'id' => 'footer1',
			'description' => esc_html__( 'Footer 1 widget area', 'braintech' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 		 				

	 register_sidebar( array(
			'name' => esc_html__( 'Footer Two Widget Area', 'braintech' ),
			'id' => 'footer2',
			'description' => esc_html__( 'Footer 2 widget area', 'braintech' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) ); 
	 register_sidebar( array(
			'name' => esc_html__( 'Footer Three Widget Area', 'braintech' ),
			'id' => 'footer3',
			'description' => esc_html__( 'Footer 3 widget area', 'braintech' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) );

	register_sidebar( array(
			'name' => esc_html__( 'Footer Four Widget Area', 'braintech' ),
			'id' => 'footer4',
			'description' => esc_html__( 'Footer 4 widget area', 'braintech' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="footer-title">',
			'after_title' => '</h3>'
	) );

	if (class_exists( 'ReduxFramework' )){
		register_sidebar( array(
				'name' => esc_html__( 'Copyright Right', 'braintech' ),
				'id' => 'copy_right',
				'description' => esc_html__( 'Copyright Right widget area', 'braintech' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="footer-title">',
				'after_title' => '</h3>'
		) ); 
	}

			
}
add_action( 'widgets_init', 'braintech_widgets_init' );