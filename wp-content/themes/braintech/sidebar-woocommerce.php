<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

if ( ! is_active_sidebar( 'sidebar_shop' ) ) {
  return;}
?>
<div class="col-md-4 sidebar-gap">
  <aside id="secondary" class="widget-area">
    <div class="bs-sidebar dynamic-sidebar">
      <?php
        dynamic_sidebar( 'sidebar_shop' );
      ?>
    </div>
  </aside>
  <!-- #secondary --> 
</div>
<?php
?>
