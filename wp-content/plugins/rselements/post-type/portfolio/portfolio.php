<?php
/**
 * Team custom post type
 * This file is the basic custom post type for use any where in theme.
 * 
 * @author RS Theme
 * @link http://www.rstheme.com
 */
?>
<?php
class Rsaddon_Elementor_pro_Portfolio{	

	public function __construct() {
		add_action( 'init', array( $this, 'rs_portfolio_register_post_type' ) );		
		add_action( 'init', array( $this, 'tr_create_portfolio' ) );		
		add_action( 'admin_menu', array( $this, 'rs_portfolio_meta_box' ) );		
		add_action( 'save_post', array( $this, 'save_rs_portfolio_social_meta' ) );
	}


	// Register Portfolio Post Type
	function rs_portfolio_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Portfolio', 'rsaddons'),
			'singular_name'      => esc_html__( 'Portfolio', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Portfolio', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Portfolio', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Portfolio', 'rsaddons'),
			'new_item'           => esc_html__( 'New Portfolio', 'rsaddons'),
			'all_items'          => esc_html__( 'All Portfolio', 'rsaddons'),
			'view_item'          => esc_html__( 'View Portfolio', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Portfolio', 'rsaddons'),
			'not_found'          => esc_html__( 'No Portfolio found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Portfolio found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Portfolio:', 'rsaddons'),
			'menu_name'          => esc_html__( 'Portfolio', 'rsaddons'),
		);
		global $braintech_option;
		$portfolio_slug = (!empty($braintech_option['portfolio_slug']))? $braintech_option['portfolio_slug'] :'portfolios';
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,	
			'rewrite' => 		 array('slug' => $portfolio_slug,'with_front' => false),	
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail','editor' ),		
		);
		register_post_type( 'portfolios', $args );
	}

	function tr_create_portfolio() {	
		global $braintech_option;
		$portfolio_slug_cat = (!empty($braintech_option['portfolio_cat_slug']))? $braintech_option['portfolio_cat_slug'] :'portfolio-category';
		$portfolio_level = (!empty($braintech_option['portfolio_level']))? $braintech_option['portfolio_level'] :'Portfolio Categories';	

		register_taxonomy(
			'portfolio-category',
			'portfolios',
			array(
				'label' => $portfolio_level,			
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite' =>  array('slug' => $portfolio_slug_cat,'with_front' => false),
			)
		);
	}


	// Meta Box

	/*--------------------------------------------------------------
	*			Portfolio info
	*-------------------------------------------------------------*/
	function rs_portfolio_meta_box() {
		add_meta_box(
			'member_info_meta',
			esc_html__( 'Portfolio Info', 'rsaddon' ),
			array( $this, 'rs_portfolio_member_info_meta_callback' ),
			array( 'portfolios', 'advanced', 'high', 1 )
		);		
	}
	

	// member info callback
	function rs_portfolio_member_info_meta_callback( $portfolio_info ) {
		wp_nonce_field( 'portfolio_metabox', 'portfolio_metabox' ); ?>
			<div class="rs-admin-input">
			<label for="client_name">
				<?php $client_name = get_post_meta( $portfolio_info->ID, 'client_name', true ); 
				if($client_name =="")
				{
					$client_name = 'Client:';
				}
			?>
			<input type="text" name="client_name" id="client_name" class="client_name" value="<?php echo esc_html($client_name); ?>"/>
			</label>
			<?php $client = get_post_meta( $portfolio_info->ID, 'client', true ); ?>
			<input type="text" name="client" id="client" class="client" value="<?php echo esc_html($client); ?>"/>
		</div>

		<div class="rs-admin-input">
			<label for="location_name">
				<?php $location_name = get_post_meta( $portfolio_info->ID, 'location_name', true ); 
				if($location_name =="")
				{
					$location_name = 'Location:';
				}
			?>
			<input type="text" name="location_name" id="location_name" class="location_name" value="<?php echo esc_html($location_name); ?>"/>
			</label>
			<?php $location = get_post_meta( $portfolio_info->ID, 'location', true ); ?>
			<input type="text" name="location" id="location" class="location" value="<?php echo esc_html($location); ?>"/>
		</div>

		<div class="rs-admin-input">
			<label for="surface_area_title">
				<?php $surface_area_title = get_post_meta( $portfolio_info->ID, 'surface_area_title', true ); 
				if($surface_area_title =="")
				{
					$surface_area_title = 'Surface Area: ';
				}
			?>
			<input type="text" name="surface_area_title" id="surface_area_title" class="surface_area_title" value="<?php echo esc_html($surface_area_title); ?>"/>
			</label>
			<?php $surface_area = get_post_meta( $portfolio_info->ID, 'surface_area', true ); ?>
			<input type="text" name="surface_area" id="surface_area" class="surface_area" value="<?php echo esc_html($surface_area); ?>"/>
		</div>

		

		<div class="rs-admin-input">
			<label for ="created_title">
				<?php $created_title = get_post_meta( $portfolio_info->ID, 'created_title', true ); 
				if($created_title =="")
				{
					$created_title = 'Architect:';
				}
			?>
				<input type="text" name="created_title" id="created_title" class="created_title" value="<?php echo esc_html($created_title); ?>"/>
			</label>
		
			<?php $created = get_post_meta( $portfolio_info->ID, 'created', true ); ?>
			<input type="text" name="created" id="created" class="created" value="<?php echo esc_html($created); ?>"/>
		</div>

		<div class="rs-admin-input">
			<label for="complete_title">
				<?php $complete_title = get_post_meta( $portfolio_info->ID, 'complete_title', true ); 
				if($complete_title =="")
				{
					$complete_title = 'Year Of Complited: ';
				}
			?>
			<input type="text" name="complete_title" id="complete_title" class="complete_title" value="<?php echo esc_html($complete_title); ?>"/>
			</label>
		
			<?php $date = get_post_meta( $portfolio_info->ID, 'date', true ); ?>
			<input type="text" name="date" id="date" class="date" value="<?php echo esc_html($date); ?>"/>
		</div>

		<div class="rs-admin-input">
			<label for="project_value_title">
				<?php $project_value_title = get_post_meta( $portfolio_info->ID, 'project_value_title', true ); 
				if($project_value_title =="")
				{
					$project_value_title = 'Project Value: ';
				}
			?>
			<input type="text" name="project_value_title" id="project_value_title" class="project_value_title" value="<?php echo esc_html($project_value_title); ?>"/>
			</label>
			<?php $project_value = get_post_meta( $portfolio_info->ID, 'project_value', true ); ?>
			<input type="text" name="project_value" id="project_value" class="project_value" value="<?php echo esc_html($project_value); ?>"/>
		</div>
	<?php }
	/*--------------------------------------------------------------
	 *			Save meta
	*-------------------------------------------------------------*/
	function save_rs_portfolio_social_meta( $post_id ) {
		if ( ! isset( $_POST['portfolio_metabox'] ) ) {
			return $post_id;
		}
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		if ( 'portfolios' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}
		$mymeta = array( 'tagline','client_name','location_name','surface_area_title','complete_title','created_title','created','date','project_value_title','location','client','surface_area','project_value' );
		foreach ( $mymeta as $keys ) {

			if ( is_array( sanitize_text_field($_POST[ $keys ] )) ) {

				$data = array();

				$project_info = sanitize_text_field($_POST[ $keys ]);

				foreach ( $project_info as $key => $value ) {

					$data[] = $value;

				}
			} else {
				$data = sanitize_text_field( $_POST[ $keys ] );
			}		
			update_post_meta( $post_id, $keys, $data );
		}
	}

}
new Rsaddon_Elementor_pro_Portfolio();