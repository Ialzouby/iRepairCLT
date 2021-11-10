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
                    'menu_id'        => 'primary-menu-single',
                ) );
            ?>
        </div>
    </nav>
    <?php
}
?>