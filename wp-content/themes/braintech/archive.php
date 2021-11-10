<?php
get_header(); ?>

<div id="rs-blog" class="rs-blog blog-page">
   <?php
    //checking blog layout form option  
    $col         ='';
    $blog_layout =''; 
    $column      =''; 
    $blog_grid   ='';

    if(!empty($braintech_option['blog-layout']) || !is_active_sidebar( 'sidebar-1' )){
        $blog_layout = !empty($braintech_option['blog-layout']) ? $braintech_option['blog-layout'] : '';
        $blog_grid   = !empty($braintech_option['blog-grid']) ? $braintech_option['blog-grid'] : '';
        $blog_grid   = !empty($blog_grid) ? $blog_grid : '12';

        if($blog_layout == 'full' || !is_active_sidebar( 'sidebar-1' )){

            $layout ='full-layout';
            $col    = '-full';
            $column = 'sidebar-none'; 

        }          
        elseif($blog_layout == '2left'){

            $layout = 'full-layout-left';  

        }    
        elseif($blog_layout == '2right'){

            $layout = 'full-layout-right'; 

        } 
        else{

            $col = '';
            $blog_layout = ''; 

        }
    }
    else{

        $col         ='';
        $blog_layout =''; 
        $layout      ='';
        $blog_grid   ='12';
        
    }
    ?>
    <div class="container">
        <div id="content">
            <div class="row padding-<?php echo esc_attr( $layout) ?>">       
                <div class="contents-sticky col-md-12 col-lg-8<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>"> 
                   
                    <div class="row">            
                        <?php
                        if ( have_posts() ) :           
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();
                            $post_id = get_the_id();
                        ?>
                        <?php 
                        $no_thumb = "";
                            if ( !has_post_thumbnail() ) {
                              $no_thumb = "no-thumbs";
                            }
                        ?>
                        <div class="col-sm-<?php echo esc_attr($blog_grid);?> col-xs-12">
                            <article <?php post_class();?>>
                                <div class="blog-item <?php echo esc_attr($no_thumb); ?>">

                                <?php if ( has_post_thumbnail() ) {?>
                                    <div class="blog-img">
                                       <a href="<?php the_permalink();?>">
                                        <?php
                                          the_post_thumbnail();
                                        ?>
                                      </a>

                                      <?php 
                                          if(!empty($braintech_option['blog-category'])){
                                              if($braintech_option['blog-category'] == 'show'){
                                                  if(get_the_category()): 
                                          ?>                                          
                                                    <?php                                                                
                                                      echo '<div class="tag-line">';
                                                      ?>
                                                      <?php
                                                      the_category(); 
                                                      echo '</div>';
                                                    ?> 
                                        <?php endif;
                                              }
                                        }else{
                                           if(get_the_category()): ?>
                                                                                           
                                              <?php
                                                  //tag add
                                                  $seperator = ', '; // blank instead of comma
                                                  $after = '';
                                                  $before = '';
                                                  echo '<div class="tag-line">';
                                                  ?>
                                                  <?php
                                                  the_category(); 
                                                  echo '</div>';
                                                ?> 
                                          <?php
                                      endif;
                                        } ?>
                                    
                                    </div><!-- .blog-img -->
                                <?php }       
                                ?> 

                                  <div class="full-blog-content">
                                        <div class="title-wrap">                                                                      
                                          <h3 class="blog-title">
                                              <a href="<?php the_permalink();?>">
                                                  <?php the_title();?>
                                              </a>
                                          </h3>
                                          <div class="blog-meta">
                                              <ul class="btm-cate">
                                                <?php
                                                if (!empty($braintech_option['blog-date'])):
                                                    if ($braintech_option['blog-date'] == 1): ?>
                                                      <li>
                                                        <div class="blog-date">
                                                          <i class="fa fa-calendar-check-o"></i> <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                                        </div>                                              
                                                      </li>                                                   
                                                    <?php endif;
                                                else:
                                                    if (empty($braintech_option['blog-date']) == "0"):
                                                        else: ?>
                                                            <li>
                                                                <div class="blog-date">
                                                                    <i class="fa fa-calendar-check-o"></i> <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                                                </div>                                              
                                                            </li>
                                                    <?php endif; 
                                                endif; ?>
                                              

                                                 <?php if(!empty($braintech_option['blog-author-post'])){
                                                 if ($braintech_option['blog-author-post'] == 'show'): ?>
                                                  <li>
                                                      <div class="author">
                                                        <i class="fa fa-user-o"></i> <?php echo get_the_author(); ?>
                                                      </div>
                                                  </li>
                                                  <?php endif; }
                                                  else{ ?>
                                                    <li>
                                                      <div class="author">
                                                        <i class="fa fa-user-o"></i> <?php echo get_the_author(); ?>
                                                      </div>
                                                  </li>
                                                 <?php }; ?>

                                                
                                              </ul>                                                         
                                          </div>
                                      </div>

                                        <div class="blog-desc">   
                                            <?php echo braintech_custom_excerpt(30);?>                                     
                                        </div>

                                        <?php 
                                            $no_view = "";
                                            if ( !empty($braintech_option['view-comments']) && $braintech_option['view-comments'] == 'hide'){
                                                $no_view = "left-btn";
                                            }
                                            if(!empty($braintech_option['blog_readmore'])):?>
                                                <div class="blog-button <?php echo esc_attr($no_view); ?>">
                                                    <a href="<?php the_permalink();?>">
                                                        <?php echo esc_html($braintech_option['blog_readmore']); ?>
                                                    </a>
                                                </div>
                                        <?php endif; ?>

                                      <?php if(empty($braintech_option['blog_readmore'])):?>
                                          <div class="blog-button <?php echo esc_attr($no_view); ?>">
                                            <a href="<?php the_permalink();?>"><?php esc_html_e('Continue Reading', 'braintech');?></a>
                                          </div>
                                      <?php endif; ?>

                                </div>
                              </div>
                            </article>
                        </div>
                        
                        <?php  
                          endwhile;                        
                        ?>
                    </div>
                    <div class="pagination-area">
                        <?php
                            the_posts_pagination();
                        ?>
                    </div>
                    <?php
                    else :
                    get_template_part( 'template-parts/content', 'none' );
                    endif; ?> 
                </div>
            <?php if( $layout != 'full-layout' ):     
               get_sidebar();    
             endif;
            ?>
          </div>
        </div>
    </div>
</div>
<?php get_footer();