<?php

/*
Header Style 4
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

<header id="rs-header" class="header-style-4 mainsmenu<?php echo esc_attr($main_menu_hides);?> <?php echo esc_attr($main_menu_center);?> <?php echo esc_attr($main_menu_icon);?>">
    <?php 
      //include sticky search here
      get_template_part('inc/header/search');
    ?>
    <div class="header-inner<?php echo esc_attr($sticky_menu);?>">
       <!-- Toolbar Start -->
       <?php          
          get_template_part('inc/header/top-head/top-head','three');
        ?>
      <!-- Toolbar End -->

      <!-- Header Menu Start -->  
      <?php
        $menu_bg_color = !empty($menu_bg) ? 'style=background:'.$menu_bg.'' : '';
        ?>
        <div class="menu-area menu_type_<?php echo esc_attr($main_menu_type);?>" <?php echo wp_kses($menu_bg_color, 'braintech');?>>
            <div class="<?php echo esc_attr($header_width);?>">
                <div class="menu_one">
                        <div class="row-table"> 
                                     
                            <div class="col-cell menu-responsive">  
                                <?php                  
                                    if(is_page_template('page-single.php')){
                                        require get_parent_theme_file_path('inc/header/menu-single.php'); 
                                    }else{
                                        require get_parent_theme_file_path('inc/header/menu-left.php'); 
                                    }               
                                ?>
                            </div>

                            <div class="col-cell header-logo">
                                <?php  get_template_part('inc/header/logo'); ?>
                            </div> 

                            <div class="col-cell menu-responsive menu-responsive-one-page">  
                                <?php                  
                                    if(is_page_template('page-single.php')){
                                        require get_parent_theme_file_path('inc/header/menu-single.php'); 
                                    }else{
                                        require get_parent_theme_file_path('inc/header/menu-right.php'); 
                                    }               
                                ?>
                            </div>
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
    </div>
  <?php 
      get_template_part( 'inc/breadcrumbs' );
  ?>
    <!-- Slider Start Here -->
    <?php  get_template_part('inc/header/slider/slider'); ?>
</header>
