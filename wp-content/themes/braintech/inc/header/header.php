<?php
/*
Header Style
*/
global $braintech_option;
$post_meta_header = '';
	 //check individual header 
if(is_page() || is_single()){
	$post_meta_header = get_post_meta(get_the_ID(), 'header_select', true);
	
}elseif(is_home() && !is_front_page() || is_home() && is_front_page()){
	$post_meta_header = get_post_meta(get_queried_object_id(), 'header_select', true);
}
elseif(function_exists('woocommerce')){
	if(is_shop()):
		$your_shop_page = get_post( wc_get_page_id( 'shop' ) );
		$post_meta_header = get_post_meta($your_shop_page->ID, 'header_select', true);
	endif;	
}

if($post_meta_header!=''){		 	
	if($post_meta_header == 'header1'){		 
		get_template_part('inc/header/header-style1');				
	}
	if($post_meta_header == 'header2'){		 
		get_template_part('inc/header/header-style2');		
	}
	if($post_meta_header == 'header3'){		
		get_template_part('inc/header/header-style3');       
	}	 
	if($post_meta_header == 'header4'){		
		get_template_part('inc/header/header-style4');       
	}	
	if($post_meta_header == 'header5'){		
		get_template_part('inc/header/header-style5');       
	}		
	if($post_meta_header == 'header6'){		
		get_template_part('inc/header/header-style6');       
	}	  		
	if($post_meta_header == 'header7'){		
		get_template_part('inc/header/header-style7');       
	}	  		
	if($post_meta_header == 'header8'){		
		get_template_part('inc/header/header-style8');       
	}	  
}
elseif(!empty($braintech_option['header_layout'])){		
	   
	$header_style = $braintech_option['header_layout'];

	if($header_style == 'style1'){		 
		get_template_part('inc/header/header-style1');		
	}
	if($header_style == 'style2'){		 
		get_template_part('inc/header/header-style2');		
	}
	if($header_style == 'style3'){		
		get_template_part('inc/header/header-style3');       
	}	 
	if($header_style == 'style4'){		
		get_template_part('inc/header/header-style4');       
	} 	
	if($header_style == 'style5'){		
		get_template_part('inc/header/header-style5');       
	} 	
	if($header_style == 'style6'){		
		get_template_part('inc/header/header-style6');       
	} 	
	if($header_style == 'style7'){		
		get_template_part('inc/header/header-style7');       
	} 	
	if($header_style == 'style8'){		
		get_template_part('inc/header/header-style8');       
	} 	   
}
	
else{
	get_template_part('inc/header/header-style8'); 
}	 

$rs_mouse_pointer="";
$rs_mouse_pointer  = get_post_meta(get_queried_object_id(), 'mouse-pointer', true);
if($rs_mouse_pointer != 'hide'){
	if(!empty($braintech_option['show_pointer']) || ($rs_mouse_pointer == 'show') ){
	    $pointer_localize_data = array(
	        'pointer_border' => $braintech_option['pointer_border'],
	        'border_width'   => $braintech_option['border_width'],
	        'pointer_bg'     => $braintech_option['pointer_bg'],
	        'diameter'       => $braintech_option['diameter'],
	        'scale'          => $braintech_option['scale'],
	        'speed'          => $braintech_option['speed'],     
	    );
	    wp_localize_script( 'braintech-main', 'pointer_data', $pointer_localize_data );
	}
}