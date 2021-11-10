<?php
 get_header();
 ?>
<div class="rselements-single-member">  
    <div class="row single-member-details">
        <?php while ( have_posts() ) : the_post();
            $designation  = get_post_meta(get_the_ID(), 'designation', true);
            $member_image = get_the_post_thumbnail_url( get_the_ID() );
            $link         = get_the_permalink();
            $title        = get_the_title();
            $facebook     = get_post_meta( get_the_ID(), 'facebook', true );    
            $twitter      = get_post_meta( get_the_ID(), 'twitter', true );    
            $google_plus  = get_post_meta( get_the_ID(), 'google_plus', true );    
            $linkedin     = get_post_meta( get_the_ID(), 'linkedin', true );    
            $cl_phone     = get_post_meta( get_the_ID(), 'phone', true);
            $cl_email     = get_post_meta( get_the_ID(), 'email', true);          
        ?>
        <?php if(has_post_thumbnail()) : ?>
            <div class="col-md-5 col-lg-4 col-sm-12">  
                <?php the_post_thumbnail(); ?>
            </div>
        <?php endif ;?>
        <div class="col-md-7 col-lg-8 col-sm-12">
            <div class="description">
              	<div class="left-part">
                	<div class="single-member-title">
    	               <h2><?php the_title();?></h2>
    	                <?php if(!empty( $designation )):?>
    	                    <span><?php echo esc_html($designation); ?></span> 
    	                <?php endif; ?>
    	            </div>

    	            <?php if(!empty($member_social)):?>
                        <div class="social-icons">
                            <?php foreach ( $member_social as $team_social ) {
                                    $s_title = $team_social['social_title'];
                                    $s_link  = $team_social['social_url'];
                                    $s_icon  = $team_social['social_class'];?>                                                 
                                    <a href="<?php echo esc_url($s_link);?> " class="social-icon" target="_blank"><i class="fa <?php echo esc_attr($s_icon); ?>"></i>
                                    </a>        
                            <?php } ?>
                        </div>
                    <?php endif; ?> 
                </div>
                <div class="right-part">
                	<?php if( !empty($cl_phone) || !empty($cl_email)  ){?> 
                            <div class="contact-info">
                              <ul>
                                    <?php if($cl_email): ?>
                                         <li><i class="fa fa-envelope-o"></i><span><a href="mailto:<?php echo esc_attr($cl_email);?>"><?php echo esc_html($cl_email);?></a></span> </li>
                                     <?php endif;?>                               

                                     <?php if($cl_phone): ?>
                                         <li><i class="fa fa-phone"></i><span><?php echo esc_html($cl_phone);?></span></li>
                                     <?php endif; ?>                                                             
                                
                                </ul>
                            </div>
                    <?php } ?>
                </div>
                <?php  
               if( get_the_content()):?>
                    <div class="single-member-bio">
                      <?php the_content(); ?>
                    </div>

                <?php endif;?>                   
            </div>
            <?php if( $facebook || $twitter || $linkedin || $google_plus ) { ?>
                <ul class="team-elements-social">
                    <?php if( $facebook ) : ?>
                        <li><a href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li>
                    <?php endif ;?>
                    <?php if( $twitter ) : ?>
                        <li><a href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li>
                    <?php endif ;?>
                    <?php if( $linkedin ) : ?>
                        <li><a href="<?php echo esc_url($linkedin);?>"><i class="fa fa-linkedin"></i></a></li>
                    <?php endif ;?>
                    <?php if( $google_plus ) : ?>
                        <li><a href="<?php echo esc_url($google_plus);?>"><i class="fa fa-google-plus"></i></a></li>
                    <?php endif ;?>                                      
                </ul>
            <?php } ?>

        </div>
    <?php endwhile; ?>
    </div>    
</div>

<?php
get_footer();