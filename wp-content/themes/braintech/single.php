<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $braintech_option;
    $post_id      = get_the_id();
    $author_id    = get_post_field ('post_author', $post_id);
    $display_name = get_the_author_meta( 'display_name' , $author_id );
?>
    <div class="container"> 
        <div id="content">
            <?php
                //checking page layout 
                $page_layout = get_post_meta( $post->ID, 'layout', true );
                $col_side = '';
                $col_letf = '';
                if($page_layout == '2left'){
                    $col_side = '8';
                    $col_letf = 'left-sidebar';}
                else if($page_layout == '2right'){
                    $col_side = '8';}
                else{
                	$col_side = '12';
            	}
            ?>
          <!-- Blog Detail Start -->
            <div class="rs-blog-details pt-70 pb-70">
                <div class="row padding-<?php echo esc_attr( $col_letf) ?>">
                    <div class="col-lg-<?php echo esc_attr( $col_side). ' ' .esc_attr( $col_letf) ?>">
                        <?php
                        	while ( have_posts() ) : the_post();
                        ?>             
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <?php if(has_post_thumbnail()){ ?>
                            <div class="bs-img">
                              <?php the_post_thumbnail()?>
                            </div>
                            <?php } ?>
                            <?php if(!empty($braintech_option['blog-author']) ){ ?>
                              
                            <?php } else { ?>

                                    <ul class="single-posts-meta">
                                    <li>                                
                                        <span class="p-date">
                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <?php $post_date = get_the_date(); echo esc_attr($post_date);?>
                                        </span>
                                    </li>
                                    <li>
                                        <span class="p-user">                                        
                                            <i class="fa fa-user-o" aria-hidden="true"></i> <?php echo esc_html($display_name); ?>
                                        </span>
                                    </li>      
                                
                                    <li class="post-cate">                                                      
                                        <?php
                                            //tag add
                                            $seperator = ', '; // blank instead of comma
                                            $after = '';
                                            $before = '';
                                            echo '<div class="tag-line">';
                                            ?>
                                            <i class="fa fa-book"></i>
                                            <?php
                                            the_category(', '); 
                                            echo '</div>';
                                          ?> 
                                        </li>

                                    <li class="post-comment">
                                        <i class="fa fa-comments-o" aria-hidden="true"></i> <?php echo get_comments_number( '0', '1', '%' ); ?> 
                                    </li>
                                </ul>
                            <?php } ?>
                            <?php
                              get_template_part( 'template-parts/post/content', get_post_format() );         
                            ?>
                            <div class="clear-fix"></div> 
                                       
                        </article> 
                        
                        <?php       
                        $author_meta = get_the_author_meta('description'); 
                        if( !empty($author_meta) ){
                        ?>
                            <div class="author-block">
                              <div class="author-img"> <?php echo get_avatar(get_the_author_meta( 'ID' ), 200);?> </div>
                              <div class="author-desc">
                                <h3 class="author-title">
                                  <?php the_author();?>
                                </h3>
                                <p>
                                  <?php   
                                    echo wpautop( get_the_author_meta( 'description' ) );
                                  ?>
                                </p>
                                <a href="<?php echo esc_url(get_the_author_meta('user_url'))?>" target="_blank">
                                  <?php echo esc_url(get_the_author_meta( 'user_url'))?></a> 
                                </div>
                            </div>
                            <!-- .author-block -->
                        <?php }
                                  
                        ?>
                        <?php 
                        $blog_author = '';
                        if($blog_author == ""){
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        }
                        else
                            {
                            $blog_author = $braintech_option['blog-comments'];
                            if($blog_author == 'show'){     
                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                              comments_template();
                            endif;
                            }
                        }
                        endwhile; // End of the loop.
                        ?>
                    </div>
                  <?php
                    if( $page_layout == '2left' || $page_layout == '2right'):
                        get_sidebar('single');
                    endif; ?>
                </div>
            </div>
          <!-- Blog Detail End --> 
        </div>
    </div>
<!-- .container -->
<?php
get_footer();