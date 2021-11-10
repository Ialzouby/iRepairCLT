<?php
global $braintech_option;
?>
<nav class="nav-container mobile-menu-container mobile-menus menu-wrap-off fdgdgfdg">
    <ul class="sidenav">
        <li class='nav-link-container'> 
            <a href='#' class="nav-menu-link close-button">               
                <span class="hamburger1"></span>
                <span class="hamburger3"></span>
            </a> 
        </li>
        <li>
          <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu-single2',
                ) );
            ?>
        </li>
       
    </ul>
    <div class="social-icon-responsive">
        <?php get_template_part( 'inc/header/offcanvas-content' );?>
    </div>
</nav>