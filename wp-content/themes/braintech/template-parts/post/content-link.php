<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

?>
<?php if(has_post_thumbnail()){
?>
<?php //header style; ?>

<div class="bs-img">
  <?php the_post_thumbnail()?>
</div>
<?php
 }?>
 
<div class="single-content-full">
<?php
	$link = get_post_meta( get_the_ID(), 'l_url', true );
	if ( is_single() ) :
		the_title( sprintf( '<h3 class="bs-title"><a href="%s">', $link ), '</a></h3>' );
	else :
		the_title( sprintf( '<h3 class="bs-title"><a href="%s">', $link ), '</a></h3>' );
	endif;
?>

  <div class="bs-desc">
  <?php 
  //post content
    the_content();

    wp_link_pages( array(
      'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'braintech' ),
      'after'       => '</div>',
      'link_before' => '<span class="page-number">',
      'link_after'  => '</span>',
    ) );
  ?>
  </div>
</div>
