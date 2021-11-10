<?php
get_header(); ?>

   <div class="rselements-porfolio-details">
 
        <?php while ( have_posts() ) : the_post();
            $post_client        = get_post_meta( get_the_ID(), 'client', true );
            $post_location      = get_post_meta( get_the_ID(), 'location', true );
            $post_surface_area  = get_post_meta( get_the_ID(), 'surface_area', true );
            $post_date          = get_post_meta( get_the_ID(), 'date', true );
            $post_project_value = get_post_meta( get_the_ID(), 'project_value', true );
            $post_created       = get_post_meta( get_the_ID(), 'created', true );
        ?>
           
        <div class="row">
            <div class="col-lg-7">
                <div class="project-desc"> 
                    <?php if(has_post_thumbnail()){ ?>
                      <div class="project-img"><?php the_post_thumbnail(); ?></div>
                   <?php  } 
                     ?>
                </div>                
            </div>
            <div class="col-lg-5">              
                <?php if($post_created || $post_date || $post_client || $post_location || $post_surface_area || $post_project_value){ ?>
                    <div class="ps-informations">                 
                        <ul>
                          <li>
                            <span><?php esc_html_e('Category:', 'kaouwa');?></span>
                            <?php 
                                if ( is_singular('portfolios') ) {
                                    $terms = get_the_terms($post->ID, 'portfolio-category');
                                    foreach ($terms as $term) {
                                        $term_link = get_term_link($term, 'portfolio-category');
                                        if (is_wp_error($term_link))
                                            continue;
                                        echo esc_html($term->name) ;
                                    }
                                }
                            ?>
                          </li>
                          <?php if($post_client){?>
                          <li><span><?php esc_html_e('Client:','kaouwa');?>  </span><?php   echo esc_html($post_client); ?></li>
                          <?php }?>

                          <?php if($post_location){?>
                          <li><span><?php esc_html_e('Location:','kaouwa');?> </span><?php echo esc_html($post_location); ?></li>
                          <?php }?>

                          <?php if($post_surface_area){?>
                          <li><span><?php esc_html_e('Surface Area:','kaouwa');?> </span><?php echo esc_html($post_surface_area).' m'; ?><sup><?php esc_html_e('2', 'kaouwa'); ?></sup></li>
                          <?php }?>

                          <?php if($post_date){?>
                          <li><span><?php esc_html_e('Completed Date:','kaouwa');?>  </span><?php   echo esc_html($post_date); ?></li>
                          <?php }?>
                          
                          <?php if($post_project_value){?>
                          <li><span><?php esc_html_e('Project Value:','kaouwa');?>  </span><?php  echo esc_html($post_project_value); ?></li>
                          <?php }?>

                          <?php if($post_created){?>
                          <li><span><?php esc_html_e('Architect:','kaouwa');?> </span><?php echo esc_html($post_created); ?></li>
                          <?php }?>

                        </ul>
                    </div>
                <?php } ?>                           
            </div>
            <div class="col-lg-12">
                <?php the_content(); ?>
            </div>
        </div>
<?php endwhile;
wp_reset_query();
get_footer();