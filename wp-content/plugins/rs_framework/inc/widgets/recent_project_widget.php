<?php
/**
 * Widget RS Recent Posts
 *
 * @package rsframework
 * @author Rs Theme
 * @link http://rstheme.com
 */

// Register and load the widget
function portfolios_widget_load_widget() {
    register_widget( 'rsframework_recent_portfolios_widget' );
}
add_action( 'widgets_init', 'portfolios_widget_load_widget' );
 
// Creating the widget 
class rsframework_recent_portfolios_widget extends WP_Widget {
 
    function __construct() {
        parent::__construct(
         
        // Base ID of your widget
        'portfolios_widget', 
         
        // Widget name will appear in UI
        __('RS Portfolio Widget', 'rsframework'), 
            // Widget description
            array( 'description' => __( 'Portfolio widget with different options', 'rsframework' ), ) 
        );
    }
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
    if  ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
    extract( $args );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Portfolio','rsframework' );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		
		$show_featured_image = isset( $instance['show_featured_image'] ) ? $instance['show_featured_image'] : false;

  echo wp_kses_post($before_widget); 
    if ( $title )
  echo wp_kses_post($before_title . $title . $after_title);

		/**
		 * Filters the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_portfolios_args', array(
			'posts_per_page'      => $number,
            'post_type'           => 'portfolios',
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );?>

         
        		<?php
                if ($r->have_posts()) :              
                 
                 ?>

                    <ul class="recent-post-widgets latest_projects clearfix">
                        <?php while ( $r->have_posts() ) : $r->the_post(); ?> 
                          <li class="show-featured">
                              <span class="post-img"> 
                                  <a href="<?php the_permalink(); ?>">
                                      <?php the_post_thumbnail('blog-footer'); ?>
                                  </a> 
                              </span> 
                          </li>
                          <?php             
                          endwhile; 
                          wp_reset_query(); 
              	         ?>            
                    </ul>           
                <?php
                    // Reset the global $the_post as this query will have stomped on it
                    wp_reset_postdata();
                    endif;
                ?>
     
        
    <?php
    echo wp_kses_post($after_widget);         
}

// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_featured_image'] = isset( $new_instance['show_featured_image'] ) ? (bool) $new_instance['show_featured_image'] : false;
		return $instance;
}
         
// Widget Backend 
public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_featured_image = isset( $instance['show_featured_image'] ) ? (bool) $instance['show_featured_image'] : false;
?>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
    <?php esc_html_e( 'Title:','rsframework' ); ?>
  </label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_js($title); ?>" />
</p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
    <?php esc_html_e( 'Number of Portfolio:','rsframework' ); ?>
  </label>
  <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_js($number); ?>" size="3" />
</p>

<?php
	}

} // Class wpb_widget ends here
