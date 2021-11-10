<?php
if(is_page()){
	$rs_slider = get_post_meta($post->ID, 'rs_rev_slider', true); //in case it is a post/page option 
	 
if(shortcode_exists("rev_slider") && !empty($rs_slider))
	{ 
		putRevSlider( $rs_slider );
	}
}
?>