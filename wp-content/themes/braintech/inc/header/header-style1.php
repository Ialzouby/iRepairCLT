<?php

/*
Header Style 1
*/

global $braintech_option;
$sticky = !empty($braintech_option['off_sticky']) ? $braintech_option['off_sticky'] : ''; 
$sticky_menu = ($sticky == 1) ? ' menu-sticky stuck' : '';

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

<header id="rs-header" class="single-header header-style1 mainsmenu<?php echo esc_attr($main_menu_hides);?> <?php echo esc_attr($main_menu_center);?> <?php echo esc_attr($main_menu_icon);?>">
    <?php 
      //include sticky search here
      get_template_part('inc/header/search');
    ?>
    <div class="header-inner <?php echo esc_attr($sticky_menu);?>">
        <!-- Toolbar Start -->
        <?php       
           get_template_part('inc/header/top-head/top-head','two');
        ?>
        <!-- Toolbar End -->
        
        <!-- Header Menu Start -->
        <?php
        $menu_bg_color = !empty($menu_bg) ? 'style=background:'.$menu_bg.'' : '';
        ?>
        <div class="menu-area menu_type_<?php echo esc_attr($main_menu_type);?>" <?php echo wp_kses($menu_bg_color, 'braintech');?>>
            <div class="<?php echo esc_attr($header_width);?>">
                <div class="row-table">
                    <div class="col-cell header-logo">
                    <?php get_template_part('inc/header/logo');  ?>
                    </div>
                    <div class="col-cell menu-responsive">  
                        <?php              
                        if(is_page_template('page-single.php')){
                            require get_parent_theme_file_path('inc/header/menu-single.php'); 
                        }
                        elseif (is_page_template('page-single2.php')){
                            require get_parent_theme_file_path('inc/header/menu-single2.php'); 
                        }
                        else{
                            require get_parent_theme_file_path('inc/header/menu.php'); 
                        } ?>
                    </div>

                    <div class="col-cell header-quote">     
                        <?php 
                     
                        if($rs_top_search != 'hide'){
                            if(!empty($braintech_option['off_search'])): ?>
                                <div class="sidebarmenu-search text-right">
                                    <div class="sidebarmenu-search">
                                        <div class="sticky_search"> 
                                          <i class="flaticon-search"></i> 
                                        </div>
                                    </div>
                                </div>                        
                            <?php endif; 
                        }

                        //include Cart here
                        if($rs_show_cart != 'hide'){
                            if(!empty($braintech_option['wc_cart_icon'])) { ?>
                            <?php  get_template_part('inc/header/cart'); ?>
                        <?php } }              
                        
                        if($rs_show_quote != 'hide'){
                            if(!empty($braintech_option['quote_btns']) || ($rs_show_quote == 'show') ){ ?>
                            <div class="btn_quote"><a href="<?php echo esc_url($braintech_option['quote_link']); ?>" class="quote-button"><?php  echo esc_html($braintech_option['quote']); ?></a></div>
                        <?php } }
                        
                        if($rs_offcanvas != 'hide'):
                        if(!empty($braintech_option['off_canvas']) || ($rs_offcanvas == 'show') ): ?>
                            <div class="sidebarmenu-area text-right">
                                <?php if(!empty($braintech_option['off_canvas']) || ($rs_offcanvas == 'show') ){
                                        $off = $braintech_option['off_canvas'];
                                        if( ($off == 1) || ($rs_offcanvas == 'show') ){
                                   ?>
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
                                    <?php } 
                                } ?> 
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
                    </div>
                </div>
            </div> 
        </div>
        <!-- Header Menu End -->
    </div>
     <!-- End Slider area  -->
   <?php 
    get_template_part( 'inc/breadcrumbs' );
  ?>
</header>

<?php  
    get_template_part('inc/header/slider/slider');
?>
