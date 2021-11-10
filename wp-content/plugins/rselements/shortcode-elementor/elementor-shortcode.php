<?php
define( 'RSElements__FILE__', __FILE__ );
define( 'RSElements_PLUGIN_BASE', plugin_basename( RSElements__FILE__ ) );
define( 'RSElements_URL', plugins_url( '/', RSElements__FILE__ ) );
define( 'RSElements_PATH', plugin_dir_path( RSElements__FILE__ ) );
define( 'RSElements_ASSETS_URL', RSElements_URL . 'includes/assets/' );

require_once( RSElements_PATH . 'includes/post-type.php' );
require_once( RSElements_PATH . 'includes/settings.php' );


class RSElements_Pro_Elementor_Shortcode{

	function __construct(){
		add_action( 'manage_rselements_pro_posts_custom_column' , array( $this, 'rselements_pro_rs_global_templates_columns' ), 10, 2);
		add_filter( 'manage_rselements_pro_posts_columns', array($this,'rselements_pro_custom_edit_global_templates_posts_columns' ));		
	}

	function rselements_pro_custom_edit_global_templates_posts_columns($columns) {		
		$columns['rspro_shortcode_column'] = esc_html__( 'Shortcode', 'rsaddon' );
		return $columns;
	}


	function rselements_pro_rs_global_templates_columns( $column, $post_id ) {

		switch ( $column ) {

			case 'rspro_shortcode_column' :
				echo '<input type=\'text\' class=\'widefat\' value=\'[SHORTCODE_ELEMENTOR id="'.$post_id.'"]\' readonly="">';
				break;
		}
	}
	
}
new RSElements_Pro_Elementor_Shortcode();