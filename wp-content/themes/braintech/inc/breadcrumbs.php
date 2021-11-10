<?php
global $braintech_option;  
	if(is_page()){
		get_template_part( 'inc/page-header/breadcrumbs' );
	}

	$show_team_banner = !empty( $braintech_option['show-team-banner']) ? $braintech_option['show-team-banner'] : '';
	$banner_hide = get_post_meta(get_queried_object_id(), 'banner_hide', true);

	if( $banner_hide != 'hide'){
		if( $show_team_banner == 1){
			if(is_singular('teams')){
				get_template_part( 'inc/page-header/breadcrumbs-team' );
			}
		}
	}	

	if(is_singular('portfolios')){
		get_template_part( 'inc/page-header/breadcrumbs-portfolio' );
	}	
	
	if(is_singular('services')){
		get_template_part( 'inc/page-header/breadcrumbs-service');
	}

	if(is_singular('post')){
		get_template_part( 'inc/page-header/breadcrumbs-single' );
	}

	if(is_home() && !is_front_page() || is_home() && is_front_page()){
		get_template_part( 'inc/page-header/breadcrumbs-blog' );
	}

	if(is_archive()){	
		if ( class_exists( 'WooCommerce' ) ) {	
			if(is_shop() || is_product_category() || is_product_tag()){	
						
			}
			else{
				get_template_part( 'inc/page-header/breadcrumbs-archive');
			}	
		}else{
			get_template_part( 'inc/page-header/breadcrumbs-archive');
		}	
	}	

	if(is_search()){
		get_template_part( 'inc/page-header/breadcrumbs-search');
	}

	if ( class_exists( 'WooCommerce' ) ) {
		if(is_shop() || is_product_category() || is_product_tag()){
			get_template_part( 'inc/page-header/breadcrumbs-shop');
		}
		if(is_product('product')){
			get_template_part( 'inc/page-header/breadcrumbs-shop-single' );
		}	
	}	
?>