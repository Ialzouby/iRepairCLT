<?php
/* Top Header part for braintech Theme
*/
global $braintech_option;

// Header Options here
require get_parent_theme_file_path('inc/header/header-options.php');

if($rs_top_bar != 'hide'){
  if(!empty($braintech_option['show-top']) || ($rs_top_bar == 'show')){
       if( !empty($braintech_option['top-email']) || !empty($braintech_option['phone']) || !empty($braintech_option['show-social'])){?> 

          <div class="toolbar-area">
            <div class="<?php echo esc_attr($header_width);?>">
              <div class="row">
                <div class="col-lg-8">
                  <div class="toolbar-contact">
                    <ul class="rs-contact-info">                        

                        <?php if(!empty($braintech_option['top-email'])) { ?>
                        <li class="rs-contact-email">
                            <i class="glyph-icon flaticon-email"></i>                  
                            <a href="mailto:<?php echo esc_attr($braintech_option['top-email'])?>"><?php echo esc_html($braintech_option['top-email'])?></a>                
                        </li>
                        <?php } ?>

                        <?php if(!empty($braintech_option['phone'])) { ?>
                        <li class="rs-contact-phone">
                          <i class="fa flaticon-call"></i>                                      
                              <a href="tel:<?php echo esc_attr(str_replace(" ","",($braintech_option['phone'])))?>"> <?php echo esc_html($braintech_option['phone']); ?></a>                   
                        </li>
                        <?php } ?> 

                        <?php if(!empty($braintech_option['top_address'])) { ?>
                            <li class="rs-hours rs-contact-email">
                                <i class="glyph-icon flaticon-location"></i> 
                                <?php echo esc_html($braintech_option['top_address'])?>
                            </li>  
                        <?php } ?>                    
                       
                  </ul>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="toolbar-sl-share">
                    <ul class="clearfix">
                      <?php
                      if(!empty($braintech_option['open_hours'])):
                        $open_hours = $braintech_option['open_hours']; ?>
                         <li class="opening"> <em><i class="glyph-icon flaticon-clock"></i> <?php echo esc_html($open_hours); ?></em> </li>

                    <?php
                      endif;

                      if(!empty($braintech_option['show-social'])){
                        $top_social = $braintech_option['show-social']; 
                        if($top_social == '1'){ 
                                          
                            if(!empty($braintech_option['facebook'])) { ?>
                            <li> <a href="<?php echo esc_url($braintech_option['facebook']);?>" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($braintech_option['twitter'])) { ?>
                            <li> <a href="<?php echo esc_url($braintech_option['twitter']);?> " target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if(!empty($braintech_option['rss'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['rss']);?> " target="_blank"><i class="fas fa-rss" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['pinterest'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['pinterest']);?> " target="_blank"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['linkedin'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['linkedin']);?> " target="_blank"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a> </li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['instagram'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['instagram']);?> " target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if(!empty($braintech_option['vimeo'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['vimeo']);?> " target="_blank"><i class="fab fa-vimeo-v" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['tumblr'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['tumblr']);?> " target="_blank"><i class="fab fa-tumblr" aria-hidden="true"></i></a></li>
                            <?php } ?>
                            <?php if (!empty($braintech_option['youtube'])) { ?>
                            <li> <a href="<?php  echo esc_url($braintech_option['youtube']);?> " target="_blank"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                            <?php } ?>
                                   
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