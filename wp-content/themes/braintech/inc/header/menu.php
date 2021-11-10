<?php
if ( has_nav_menu( 'menu-1' ) ) {
    // User has assigned menu to this location;
    // output it
    ?>
    <nav class="nav navbar">
        <div class="navbar-menu">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu-single',
                     'walker'        => ''
                ) );
            ?>
        </div>
    </nav>
    <?php
}
?>