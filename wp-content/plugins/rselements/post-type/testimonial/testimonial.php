<?php
class Rsaddon_Testimonial_pro_Post_Type{
	public function __construct() {
		add_action( 'init', array( $this, 'rsaddon_testimonial_register_post_type' ) );		
		add_action( 'init', array( $this, 'rsaddon_testimoanl_create_taxonomy' ) );		
		add_action( 'admin_menu', array( $this, 'rsaddon_testimonials_meta_box' ) );		
		add_action( 'save_post', array( $this, 'rsaddon_save_testimonials_meta' ) );
	}

	function rsaddon_testimonial_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Testimonial', 'rsaddon'),
			'singular_name'      => esc_html__( 'Testimonial', 'rsaddon'),
			'add_new'            => esc_html__( 'Add New Testimonial', 'rsaddon'),
			'add_new_item'       => esc_html__( 'Add New Testimonial', 'rsaddon'),
			'edit_item'          => esc_html__( 'Edit Testimonial', 'rsaddon'),
			'new_item'           => esc_html__( 'New Testimonial', 'rsaddon'),
			'all_items'          => esc_html__( 'All Testimonial', 'rsaddon'),
			'view_item'          => esc_html__( 'View Testimonial', 'rsaddon'),
			'search_items'       => esc_html__( 'Search Testimonials', 'rsaddon'),
			'not_found'          => esc_html__( 'No Testimonials found', 'rsaddon'),
			'not_found_in_trash' => esc_html__( 'No Testimonials found in Trash', 'rsaddon'),
			'parent_item_colon'  => esc_html__( 'Parent Testimonial:', 'rsaddon'),
			'featured_image'     => esc_html__('Author Image'),
			'set_featured_image' => esc_html__('Upload Author Image'),
			'menu_name'          => esc_html__( 'Testimonials', 'rsaddon'),
		);	
		
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail', 'editor' )
		);
		register_post_type( 'testimonials', $args );
	}

	function rsaddon_testimoanl_create_taxonomy() {
		
		register_taxonomy(
			'testimonial-category',
			'testimonials',
			array(
				'label'             => esc_html__( 'Testimonial Categories','rsaddon'),			
				'hierarchical'      => true,
				'show_admin_column' => true,		
			)
		);
	}

	//registering metabox

	function rsaddon_testimonials_meta_box() {
		add_meta_box(
			'testimonial_info_meta',
			esc_html__( 'Author Info', 'rsaddon' ),
			array( $this, 'rsaddon_testimonials_meta_callback' ),
			array( 'testimonials', 'advanced', 'high', 1 )
		);		
	}

	// testimonial info callback
	function rsaddon_testimonials_meta_callback( $testimonial_info ) {
		wp_nonce_field( 'testimonial_social_metabox', 'testimonial_social_metabox_nonce' ); ?>
		<div class="rs-admin-input"><label for="designation"><?php esc_html_e( 'Designation', 'cl-testimonial' ) ?></label>
		<?php $designation = get_post_meta( $testimonial_info->ID, 'designation', true ); ?>

		<input type="text" name="designation" id="designation" class="designation" value="<?php echo esc_html($designation); ?>"/>
		</div>

	    <div class="rs-admin-input">
	    <label for="ratings"><?php esc_html_e( 'Select Ratings', 'cl-testimonial') ?></label>
        <?php 
	      	$ratings_cl = get_post_meta( $testimonial_info->ID, 'ratings', true ); 
		  	if($ratings_cl !='' ){
			  	$rating_style = $ratings_cl;
		  	}
		  	else{
			   $rating_style = 'Select Ratings';
		  	}
	    ?>          
	    <select name="ratings">
			<option selected="selected" value="<?php echo esc_html($rating_style);?>"><?php echo esc_html($rating_style);?></option>
			<option value="Select Ratings"><?php echo esc_html__('Select Ratings','rsaddon');?></option>
			<option value="1"><?php echo esc_html__('1','rsaddon');?></option>
			<option value="1.5"><?php echo esc_html__('1.5','rsaddon');?></option>
			<option value="2"><?php echo esc_html__('2','rsaddon');?></option>
			<option value="2.5"><?php echo esc_html__('2.5','rsaddon');?></option>
			<option value="3"><?php echo esc_html__('2','rsaddon');?></option>
			<option value="3.5"><?php echo esc_html__('3.5','rsaddon');?></option>
			<option value="4"><?php echo esc_html__('4','rsaddon');?></option>
			<option value="4.5"><?php echo esc_html__('4.5','rsaddon');?></option>
			<option value="5"><?php echo esc_html__('5','rsaddon');?></option>
	    </select>	       
	   </div>
	<?php }

	/*--------------------------------------------------------------
	 *			Save testimonial social meta
	*-------------------------------------------------------------*/
	function rsaddon_save_testimonials_meta( $post_id ) {
		if ( ! isset( $_POST['testimonial_social_metabox_nonce'] ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if ( 'clt_testimonials' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		 if( isset ($_POST[ 'designation' ] ) ) {
	        update_post_meta( $post_id, 'designation', sanitize_text_field($_POST[ 'designation' ] ));
	    }
	  	if( isset( $_POST[ 'ratings' ] ) ) {
	        update_post_meta( $post_id, 'ratings', sanitize_text_field($_POST[ 'ratings' ] ));
	    }
	}

}
new Rsaddon_Testimonial_pro_Post_Type();