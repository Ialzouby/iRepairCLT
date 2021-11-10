
<?php
    global $braintech_option; 
    $header_grid2 = "";
    
    $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom2', true);
    $footer_type       = get_post_meta(get_queried_object_id(), 'footer_select', true);
    
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
       
        $header_width = !empty($braintech_option['header-grid2']) ? $braintech_option['header-grid2'] : '' ;
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
    $footer_logo_size = !empty($braintech_option['footer-logo-height']) ? 'style="height: '.$braintech_option['footer-logo-height'].'"' : '';
    if (   is_active_sidebar( 'footer_top'  )): ?>

        <?php if ( class_exists( 'ReduxFramework' ) ) {?>
            <div class="footer-subscribe">
                <div class="container subscribe-bg">
                    
                      <?php dynamic_sidebar('footer_top');?>   
                </div>
            </div>
        <?php } ?>
    <?php endif; ?>