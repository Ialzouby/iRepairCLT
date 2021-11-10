<?php

function rs_header_bg( $post ) {
    wp_nonce_field( 'rs_header_bg_submit', 'rs_header_bg_nonce' );   
   if(shortcode_exists("rev_slider")){ 
   echo '<select name="rs_rev_slider" id="rs_rev_slider">';
   echo $meta = get_post_meta($post->ID, 'rs_rev_slider', true); //in case it is a post/page option
  
   $slider = new RevSlider();
   $revolution_sliders = $slider->getArrSliders();
   
   echo "<option value=''>--- Select Your Revolution Sliders ---</option>";
   foreach ( $revolution_sliders as $revolution_slider ) {
         $checked="";
         $alias = $revolution_slider->getAlias();
         $title = $revolution_slider->getTitle();
         if($alias==$meta) $checked="selected";
         echo "<option value='".$alias."' $checked>".$title."</option>";
   }   
   echo '</select>';
  }  

}

/**
 * Add Header background image metabox to the back end for pages
 */

function rs_add_meta_boxes() {
    add_meta_box( 'case-study-bg', esc_html__('Slider Settings', 'brickx'), 'rs_header_bg', 'page', 'normal', 'high' );    

}
add_action( 'add_meta_boxes', 'rs_add_meta_boxes' );

/**
 * Save background image metabox for header banner
 */

function save_slider_meta_box( $post_id ) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'header_bg_bg_nonce' ] ) && wp_verify_nonce( $_POST[ 'header_bg_bg_nonce' ], 'header_bg_bg_submit' ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce  ) {
        return;
    }

   //Save Value
  
  if( isset( $_POST[ 'rs_rev_slider' ] ) ) {
        update_post_meta( $post_id, 'rs_rev_slider', sanitize_text_field( $_POST[ 'rs_rev_slider' ]));
    }
   
}
add_action( 'save_post', 'save_slider_meta_box' );


//metabox for page & posts sidebar
/* Define the custom box */
 
add_action( 'add_meta_boxes', 'add_sidebar_metabox' );
add_action( 'save_post', 'save_sidebar_postdata' );
 
/* Adds a box to the side column on the Post and Page edit screens */
function add_sidebar_metabox()
{
    add_meta_box( 
        'custom_sidebar',
        esc_html__( 'Post Sidebar Setting', 'brickx' ),
        'custom_sidebar_callback',
        'post',
        'side'
    );
    add_meta_box( 
        'custom_sidebar',
        esc_html__( 'Page Sidebar Setting', 'brickx' ),
        'custom_sidebar_callback',
        'page',
        'side'
    );
}

/* Prints the box content */
function custom_sidebar_callback( $post ){
    global $wp_registered_sidebars;     
    $custom = get_post_custom($post->ID);     
    if(isset($custom['custom_sidebar']))
      $val = $custom['custom_sidebar'][0];
    else
      $val = "Sidebar"; 
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' ); 
    // The actual fields for data entry
  	$left_check='';	
  	$right_check='';
  	$full_check='';
  	$lcalss='';
  	$rcalss='';
  	$fcalss='';
	
  	$page_layout = get_post_meta( $post->ID, 'layout', true );
  	if($page_layout == '2left'){
  		$left_check= 'checked="checked"';
  		$lcalss = 'active';
  	}
  	else if($page_layout == '2right'){
  		$right_check = 'checked="checked"';
  		$rcalss = 'active';		
  	}
  	
  	else{
  		$full_check = 'checked="checked"';
  		$fcalss = 'active';
  	}
	
	  $directory = get_template_directory_uri();	 
	  $output1 = '<div class="radio-select"><p><label for="myplugin_layout">'.esc_html__("Choose Layout", 'brickx' ).'</label></p>';
	  $output1 .='<input id="2left" type="radio" name="layout" value="2left" '.esc_attr($left_check).'><label for="2left" class="'.esc_attr($lcalss).'"><img src="'.esc_url($directory).'/assets/images/2cl.png" /></label>';
	  $output1 .='<input id="2right" type="radio" name="layout" value="2right" '.esc_attr($right_check).'><label for="2right" class="'.esc_attr($rcalss).'"><img src="'.esc_url($directory).'/assets/images/2cr.png" /></label>';
	  $output1 .='<input id="full" type="radio" name="layout" value="full" '.esc_attr($full_check).'><label for="full" class="full '.$fcalss.'"><img src="'.esc_url($directory).'/assets/images/1c.png" /></label></div>';
	  echo ($output1);
	
	  $output = '<p><label for="myplugin_new_field">'.esc_html__("Choose a sidebar to display", 'brickx' ).'</label></p>';    
    $output .= "<select name='custom_sidebar'>";
 
    // Add a default option
	  $themename = '';
    $output .= "<option";
    if($val == "default")
      $output .= " selected='selected'";
      $output .= " value='default'>".esc_html__('Select Sidebar','brickx')."</option>";
     
    // Fill the select element with all registered sidebars
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar_id == $val)
        $output .= " selected='selected'";
        $output .= " value='".$sidebar_id."'>".$sidebar['name']."</option>";
    }     
    $output .= "</select>";       
    echo $output;
  }

/* When the post is saved, saves our custom data */
function save_sidebar_postdata( $post_id )
{
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
 
    // verify this came from our screen and with proper authorization,
    // because save_post can be triggered at other times
	
	  $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'custom_sidebar_nonce' ] ) && wp_verify_nonce( $_POST[ 'custom_sidebar_nonce' ], 'custom_sidebar_nonce' ) ) ? 'true' : 'false';
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce  ) {
        return;
    }
 
    /*if ( !wp_verify_nonce( $_POST['custom_sidebar_nonce'], plugin_basename( __FILE__ ) ) )
      return;*/
 
    if ( !current_user_can( 'edit_page', $post_id ) )
        return;
 
    if( isset( $_POST[ 'custom_sidebar' ] ) ) {
        update_post_meta( $post_id, 'custom_sidebar', sanitize_text_field($_POST[ 'custom_sidebar' ]) );
    }
	
  	if( isset( $_POST[ 'layout' ] ) ) {
        update_post_meta( $post_id, 'layout', sanitize_text_field($_POST[ 'layout' ]) );
    }

}


