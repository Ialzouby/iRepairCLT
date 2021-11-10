<?php
if ( has_nav_menu( 'menu-3' ) ) {
    // User has assigned menu to this location;
    // output it
    ?>
<nav class="nav navbar">
    <div class="navbar-menu">
        <?php
			wp_nav_menu( array(
				'theme_location' => 'menu-3',
				'menu_id'        => 'single-menu',
                 'walker'        => ''
			) );
		?>
    </div>
    <div class='nav-link-container mobile-menu-link'> 
        <a href='#' class="nav-menu-link">              
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
    </div>
</nav>
<?php } 

?>
<nav class="nav-container mobile-menu-container">
    <ul class="sidenav">
        <li class='nav-link-container'> 
            <a href='#' class="nav-menu-link">              
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
        <li>
          <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-3',
                    'menu_id'        => 'mobile-single-menu',
                     'walker'        => ''
                ) );
            ?>
        </li>
    </ul>
</nav>