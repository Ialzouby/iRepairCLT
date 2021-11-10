<?php
/* Top Header part for braintech Theme
*/

global $braintech_option;

// Header Options here
require get_parent_theme_file_path('inc/header/header-options.php');

if($rs_top_bar != 'hide'){
  if(!empty($braintech_option['show-top']) || ($rs_top_bar=='show')){
     
       if( !empty($braintech_option['welcome-text']) || !empty($braintech_option['show-social'])){?> 
          <div class="toolbar-area">
            <div class="<?php echo esc_attr($header_width);?>">
              <div class="row">
                <div class="col-lg-7">
                  <div class="toolbar-contact">
                    <ul class="rs-contact-info">                   
                       <?php if(!empty($braintech_option['welcome-text'])) { ?>
                            <li> <?php echo esc_html($braintech_option['welcome-text']); ?> </li>
                  <?php } ?> 
                  </ul>
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="toolbar-sl-share">
                    <ul class="clearfix">
                      <?php
                      if(!empty($braintech_option['show-social'])){
                        $top_social = $braintech_option['show-social']; 
                    
                          if($top_social == '1'){              
                            if(!empty($braintech_option['facebook'])) { ?>
                            <li> <a href="<?php echo esc_url($braintech_option['facebook']);?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($braintech_option['twitter'])) { ?>
                            <li> <a href="<?php echo esc_url($braintech_option['twitter']);?> " target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($braintech_option['rss'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['rss']);?> " target="_blank"><i class="fa fa-rss" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['pinterest'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['pinterest']);?> " target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['linkedin'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['linkedin']);?> " target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['google'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['google']);?> " target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['instagram'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['instagram']);?> " target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($braintech_option['vimeo'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['vimeo']);?> " target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['tumblr'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['tumblr']);?> " target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['youtube'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['youtube']);?> " target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                                    <?php if(is_active_sidebar('language-widget')){?>                                 
                                        <?php dynamic_sidebar('language-widget');?>                             
                                    <?php }?>
                                <?php }
                            }
                         ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php 
    }
  }
} ?>
