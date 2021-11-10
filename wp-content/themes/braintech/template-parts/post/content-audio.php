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
    <div class="bs-desc">
    <?php
        the_content();

        wp_link_pages( array(
          'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'braintech' ),
          'after'       => '</div>',
          'link_before' => '<span class="page-number">',
          'link_after'  => '</span>',
        ) );
      ?>
    </div>
     <?php 
        if(has_tag()){ ?>
        <div class="bs-info single-page-info tags">
        <?php
          //tag add
          $seperator = ''; // blank instead of comma
          $after = '';
          echo esc_html__( 'Tags: ', 'braintech' );
          the_tags( '', $seperator, $after );
        ?>             
         </div> 
       <?php } ?> 
</div>