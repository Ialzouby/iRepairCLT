<?php 
    $cat = $settings['portfolio_category'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],								
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'portfolios',
				'posts_per_page' => $settings['per_page'],				
				'tax_query'      => array(
			        array(
						'taxonomy' => 'portfolio-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
			        ),
			    )
		));	  
    }

	while($best_wp->have_posts()): $best_wp->the_post();

		$termsArray  = get_the_terms( $best_wp->ID, "portfolio-category" );  //Get the terms for this particular item
		$termsString = ""; //initialize the string that will contain the terms
		$termsSlug   = "";

		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= $term->name;
		}
		
		$cats_show = get_the_term_list( $best_wp->ID, 'portfolio-category', ' ', '<span class="separator">,</span> ');	
	?>	
	<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-6 grid-item <?php echo $termsString;?>">
			<div class="portfolio-item content-overlay">
				<?php if(has_post_thumbnail()): ?>
                    <div class="portfolio-img">
                    	<a href="<?php the_permalink();?>"><?php  the_post_thumbnail($settings['thumbnail_size']);?></a>
                    </div>
                <?php endif;?>
                <div class="portfolio-content">
                    <div class="portfolio-inner">
                    	<?php if(get_the_title()):?>
                    		<h4 class="p-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    	<?php endif;?>
                    	<p class="p-category"><?php echo wp_kses_post($cats_show); ?></p>

                    	<?php if(!empty($settings['selected_icon'])) : ?>
                    	<a href="<?php the_permalink(); ?>" >
				    		<i class="fa <?php echo esc_html( $settings['selected_icon'] );?>"></i>
                    	</a>
                    	<?php endif; ?>
                    	
                    </div>
                </div>
            </div>
		</div>
	<?php	
	endwhile;
	wp_reset_query();