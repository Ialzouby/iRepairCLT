<?php

/*
Header Style 3
*/
global $braintech_option;
$sticky = $braintech_option['off_sticky']; 
$sticky_menu = ($sticky == 1) ? ' menu-sticky' : '';

// Header Options here
require get_parent_theme_file_path('inc/header/header-options.php');
?>
<?php 
    //off convas here
    get_template_part('inc/header/off-canvas');
?> 


<!-- Mobile Menu Start -->
    <div class="responsive-menus"><?php require get_parent_theme_file_path('inc/header/responsive-menu.php');?></div>
<!-- Mobile Menu End -->

<header id="rs-header" class="header-style-3 header-style-three mainsmenu<?php echo esc_attr($main_menu_hides);?> <?php echo esc_attr($main_menu_icon);?>">
    <?php 
      //include sticky search here
      get_template_part('inc/header/search');
    ?> 
    <div class="header-inner<?php echo esc_attr($sticky_menu);?>">
        <!-- Toolbar Start -->
        <?php          
            get_template_part('inc/header/top-head/top-head','two');
        ?>
        <!-- Toolbar End -->

       <!-- Header Menu Start -->  
       <?php
        $menu_bg_color = !empty($menu_bg) ? 'style=background:'.$menu_bg.'' : '';
        ?>
        <div class="box-layout <?php echo esc_attr($header_width);?>" <?php echo wp_kses($menu_bg_color, 'braintech');?>>
        <div class="row-table"> 
            <div class="col-cell">
                <?php  get_template_part('inc/header/logo'); ?>
            </div>
            <div class="menu-area col-cell menu_type_<?php echo esc_attr($main_menu_type);?>">
                <div class="<?php echo esc_attr($header_width);?>">
                    <div class="menu_one">
                        <div class="row-table">               
                            <div class="col-cell menu-responsive">  
                                <?php                  
                                    if(is_page_template('page-single.php')){
                                        require get_parent_theme_file_path('inc/header/menu-single.php'); 
                                    }else{
                                        require get_parent_theme_file_path('inc/header/menu.php'); 
                                    }               
                                ?>
                            </div> 

                            <?php
                            if(!empty($braintech_option['quote'])):   
                              $quote_menu = $braintech_option['quote'];                        
                            endif;        
                            ?>

                            <div class="col-cell header-quote">                         
                                <?php
                                    //include Cart here 
                                if($rs_show_cart != 'hide'){
                                  if(!empty($braintech_option['wc_cart_icon']) || ($rs_show_cart == 'show') ) {
                                    get_template_part('inc/header/cart');
                                  }
                                } 
                                ?>                         

                                <?php 

                                if($rs_offcanvas != 'hide'):
                                  if(!empty($braintech_option['off_canvas']) || ($rs_offcanvas == 'show') ): ?>
                                  <div class="sidebarmenu-area text-right">
                                    <?php if(!empty($braintech_option['off_canvas']) || ($rs_offcanvas == 'show') ){
                                            $off = $braintech_option['off_canvas'];
                                            if( ($off == 1) || ($rs_offcanvas == 'show') ){
                                       ?>
                                        <ul class="offcanvas-icon">
                                            <li class="nav-link-container"> 
                                                <a href='#' class="nav-menu-link menu-button" id="open-button2">
                                                    <span class="dot1"></span>
                                                    <span class="dot2"></span>
                                                    <span class="dot3"></span>
                                                    <span class="dot4"></span>
                                                    <span class="dot5"></span>
                                                    <span class="dot6"></span>
                                                    <span class="dot7"></span>
                                                    <span class="dot8"></span>
                                                    <span class="dot9"></span>
                                                </a> 
                                            </li>
                                        </ul>
                                        <?php } 
                                    }?> 
                                  </div>
                                <?php endif; endif; ?>

                                <div class="sidebarmenu-area text-right mobilehum">                                    
                                    <ul class="offcanvas-icon">
                                        <li class="nav-link-container"> 
                                            <a href='#' class="nav-menu-link menu-button">
                                                <span class="dot1"></span>
                                                <span class="dot2"></span>
                                                <span class="dot3"></span>
                                                <span class="dot4"></span>
                                                <span class="dot5"></span>
                                                <span class="dot6"></span>
                                                <span class="dot7"></span>
                                                <span class="dot8"></span>
                                                <span class="dot9"></span>
                                            </a> 
                                        </li>
                                    </ul>                                       
                                </div>
                                <?php if(!empty($braintech_option['phone'])) { ?>              
                                <div class="rs-contact-location">
                                    <i class="phone-icon flaticon-call"></i>                        
                                    <span class="contact-inf">
                                        <a href="tel:+<?php echo esc_attr(str_replace(" ","",($braintech_option['phone'])))?>"> <?php echo esc_html($braintech_option['phone'])?></a>
                                    </span>
                                </div>
                                <?php } ?>

                            </div> 
                        </div>
                    </div>
                </div>    
            </div>
        </div>
      <!-- Header Menu End --> 
      </div>
    </div>
  <?php 
      get_template_part( 'inc/breadcrumbs' );
  ?>
    <!-- Slider Start Here -->
    <?php  get_template_part('inc/header/slider/slider'); ?>
</header>
