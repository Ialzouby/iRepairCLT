<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="entry-content">
    <?php		
	the_content();
	wp_link_pages( array(
		'before' => '<div class="page-links"> <div class="pagination-pages">' . esc_html__( 'Pages:', 'braintech' ),
		'after'  => '</div></div>',
		'link_before' => '<span class="page-number">',
		'link_after'  => '</span>',
	) );


		// If comments are open and there is at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}?> 
  </div>
  <!-- .entry-content -->
  
  <?php if ( get_edit_post_link() ) : ?>
  <div class="entry-footer">
    <?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'braintech' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
  </div>
  <!-- .entry-footer -->
  <?php endif; ?>
</article>
<!-- #post-<?php the_ID(); ?> --> 
