<?php 
/** Added all post type
*/
class Rsaddon_pro_Post_Type{
	public function __construct(){
		$this->load_post_type();
	}

	public function load_post_type(){
		require plugin_dir_path( __FILE__ ). '/team/team.php';		
		require plugin_dir_path( __FILE__ ). '/portfolio/portfolio.php';
		require plugin_dir_path( __FILE__ ). '/testimonial/testimonial.php';
	}
	
}
new Rsaddon_pro_Post_Type();
