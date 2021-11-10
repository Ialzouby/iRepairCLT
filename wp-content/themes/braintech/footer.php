<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
?>
     
</div><!-- .main-container -->
<?php
global $braintech_option;
$hide_footer ='';
$hide_footer =  get_post_meta(get_queried_object_id(), 'hide_footer', true);
if($hide_footer != 'yes'):
// Footer Options here
require get_parent_theme_file_path('inc/footer/footer-options.php');

if( empty($braintech_option['enable_global'])) {
    if(!empty( $footer_bg_img)):?>
        <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" style="background-image: url('<?php echo esc_url($footer_bg_img); ?>'); background-position: <?php echo esc_attr($footer_bg_pos); ?>; <?php if (!empty($footer_bg)): ?> background-color: <?php echo esc_attr($footer_bg) ?> <?php endif; ?>">

    <?php elseif(!empty( $footer_bg)):?>
        <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" style="background: <?php echo esc_attr($footer_bg);?>; background-position: <?php echo esc_attr($footer_bg_pos); ?>">

    <?php elseif( !empty( $braintech_option['footer_bg_image']['url'])):?>
        <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" style="background-image: url('<?php echo esc_url($braintech_option['footer_bg_image']['url']);?>'); background-position: <?php echo esc_attr($footer_bg_pos); ?>">
        <?php else:?>
            <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" >
    <?php endif;
    } else {
       if( !empty( $braintech_option['footer_bg_image']['url'])):?>
        <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" style="background-image: url('<?php echo esc_url($braintech_option['footer_bg_image']['url']);?>'); background-position: <?php echo esc_attr($footer_bg_pos); ?>">
        <?php else:?>
            <footer id="rs-footer" class="<?php echo esc_attr($footer_select);?> rs-footer footer-style-1" >
    <?php endif;
}


if($hide_footer_subscribe != 'yes'):
 get_template_part( 'inc/footer/footer','subscribe' ); 
 endif; 
 get_template_part( 'inc/footer/footer','top' ); 
?>
<div class="footer-bottom" <?php if(!empty( $copyright_bg)): ?> style="background: <?php echo esc_attr($copyright_bg); ?> !important;" <?php elseif(!empty( $copy_trans)): ?> style="background: <?php echo esc_attr($copy_trans); ?> !important;" <?php endif; ?>>
    <div class="<?php echo esc_attr($header_width);?>">
        <div class="row">  
            <?php if(is_active_sidebar( 'copy_right'  )): ?>                      
                <div class="col-md-6 col-sm-12 copy1">
                    <div class="copyright text-left" <?php if(!empty( $copy_space)): ?> style="padding: <?php echo esc_attr($copy_space); ?>" <?php endif; ?> >
                        <?php if(!empty($braintech_option['copyright'])){?>
                        <p><?php echo wp_kses($braintech_option['copyright'], 'braintech'); ?></p>
                        <?php }
                         else{
                            ?>
                        <p><?php echo esc_html('&copy;')?> <?php echo date("Y");?>. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
                        </p>
                        <?php
                         }   
                        ?>
                    </div>
                </div>            
                <div class="col-md-6 col-sm-12 copy2">
                    <div class="copyright-widget text-right" <?php if(!empty( $copy_space)): ?> style="padding: <?php echo esc_attr($copy_space); ?>" <?php endif; ?> >
                        <?php dynamic_sidebar( 'copy_right'); ?>
                    </div>
                </div>
            <?php else:?>
                <div class="col-md-12 col-sm-12">
                    <div class="copyright text-center" <?php if(!empty( $copy_space)): ?> style="padding: <?php echo esc_attr($copy_space); ?>" <?php endif; ?> >
                        <?php if(!empty($braintech_option['copyright'])){?>
                        <p><?php echo wp_kses($braintech_option['copyright'], 'braintech'); ?></p>
                        <?php }
                         else{
                            ?>
                        <p><?php echo esc_html('&copy;')?> <?php echo date("Y");?>. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
                        </p>
                        <?php
                         }   
                        ?>
                    </div>
                </div> 
            <?php endif ?>
        </div>
    </div>
</div>
</footer>
<?php endif; ?>
</div><!-- #page -->
<?php 
if(!empty($braintech_option['show_top_bottom'])){
?>
 <!-- start scrollUp  -->
<div id="scrollUp">
    <i class="fa fa-angle-up"></i>
</div>   
<?php } 
 wp_footer(); ?>
  </body>
</html>
