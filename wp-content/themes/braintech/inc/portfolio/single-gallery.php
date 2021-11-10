<?php 
    /**
    * Sample template tag function for outputting a cmb2 file_list
    *
    * @param  string  $file_list_meta_key The field meta key. ('wiki_test_file_list')
    * @param  string  $img_size           Size of image to show
    */
    

    function cmb2_output_file_list( $file_list_meta_key, $img_size = 'medium' ) {

        // Get the list of files
        $files = get_post_meta( get_the_ID(), $file_list_meta_key, 1 );
        echo '<div class="file-list-wrap row">';

        // Loop through them and output an image
        foreach ( (array) $files as $attachment_id => $attachment_url ) {
            echo '<div class="col-lg-4 col-md-6"><div class="file-list-image">';
            echo wp_get_attachment_image( $attachment_id, $img_size );
            echo '<a class="image-popup p-zoom" href="'.$attachment_url.'"><i class="fa fa-search"></i></a>';
            echo '</div></div>';
        }
        echo '</div>';
    }   
?>
<!-- Portfolio Detail Start -->
<div class="container">
    <div id="content">
    <!-- Portfolio Detail Start -->
    <div class="rs-porfolio-details project-gallery">
    <div class="container">
        <?php while ( have_posts() ) : the_post();
            $post_client        = get_post_meta( get_the_ID(), 'client', true );
            $post_location      = get_post_meta( get_the_ID(), 'location', true );
            $post_surface_area  = get_post_meta( get_the_ID(), 'surface_area', true );
            $post_date          = get_post_meta( get_the_ID(), 'date', true );
            $post_project_value = get_post_meta( get_the_ID(), 'project_value', true );
            $post_created       = get_post_meta( get_the_ID(), 'created', true );
        ?>
           
        <div class="row">
            <div class="col-lg-8">
                <div class="project-desc"> 
                  <?php  if(has_post_thumbnail()){ ?>
                        <div class="project-img"><?php the_post_thumbnail(); ?></div>
                     <?php  } ?>
                   <?php 
                    the_content(); ?>
                </div>                
            </div>
            <div class="col-lg-4">   
                <?php            
                if($post_created || $post_date || $post_client || $post_location || $post_surface_area || $post_project_value){ ?>
                <div class="ps-informations">
                    <h3 class="info-title"><?php esc_html_e('Project Details','braintech');                  
                    ?></h3>                    
                    <ul>
                      <li>
                        <span><?php esc_html_e('Category:', 'braintech');?></span>
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
                      <li><span><?php esc_html_e('Client:','braintech');?>  </span><?php   echo esc_html($post_client); ?></li>
                      <?php }?>

                      <?php if($post_location){?>
                      <li><span><?php esc_html_e('Location:','braintech');?> </span><?php echo esc_html($post_location); ?></li>
                      <?php }?>

                      <?php if($post_date){?>
                      <li><span><?php esc_html_e('Completed Date:','braintech');?>  </span><?php   echo esc_html($post_date); ?></li>
                      <?php }?>
                      
                      <?php if($post_project_value){?>
                      <li><span><?php esc_html_e('Project Value:','braintech');?>  </span><?php  echo esc_html($post_project_value); ?></li>
                      <?php }?>
                       <?php if($post_surface_area){?>
                      <li><span><?php esc_html_e('Mananer:','braintech');?> </span><?php echo esc_html($post_surface_area); ?></li>
                      <?php }?>

                      <?php if($post_created){?>
                      <li><span><?php esc_html_e('Designer:','braintech');?> </span><?php echo esc_html($post_created); ?></li>
                      <?php }?>

                    </ul>
                </div>

                <?php } ?>
                <div class="information-sidebar">
                    <?php dynamic_sidebar('project-1'); ?>
                </div>                
            </div>
        </div>
        
        <div class="ps-image-wrap clearfix">
            <h3 class="p-gallery-title"><?php esc_html_e('Project Gallery', 'braintech') ?></h3>
            <?php cmb2_output_file_list( 'Screenshot', 'small' ); ?>
        </div>

      <?php endwhile;
      wp_reset_query(); ?>     
 
      </div>
      </div>
    </div>
</div>
<!-- Portfolio Detail End -->