<?php /**
* Adds medvill Social Icon Widget widget
*/
class medvillsocialiconwi_Widget extends WP_Widget {

	/**
	* Register widget with WordPress
	*/
	function __construct() {
		parent::__construct(
			'medvillsocialiconwi_widget', // Base ID
			esc_html__( 'RS Social Icon Widget', 'medvill' ), // Name
			array( 'description' => esc_html__( 'RS social icon widget area', 'medvill' ), ) // Args
		);
	}

	/**
	* Widget Fields
	*/
	private $widget_fields = array(
		array(
			'label' => 'Facebook',
			'id' => 'facebook',
			'type' => 'text',
		),
		array(
			'label' => 'Twitter',
			'id' => 'twitter',
			'type' => 'text',
		),
		array(
			'label' => 'Pinterest',
			'id' => 'pinterest',
			'type' => 'text',
		),
		array(
			'label' => 'Linkedin',
			'id' => 'linkedin',
			'type' => 'text',
		),
		array(
			'label' => 'Instagram',
			'id' => 'instagram',
			'type' => 'text',
		),
		array(
			'label' => 'Youtube',
			'id' => 'youtube',
			'type' => 'text',
		),
		array(
			'label' => 'Tumblr',
			'id' => 'tumblr',
			'type' => 'text',
		),
		array(
			'label' => 'Vimeo',
			'id' => 'vimeo',
			'type' => 'text',
		),
	);

	/**
	* Front-end display of widget
	*/
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		// Output widget title
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post($args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']);
		}?>

	
		<ul class="footer_social">  
		    <?php
		    
		    if(!empty($instance['facebook'])) { ?>
		        <li> 
		        <a href="<?php echo esc_url($instance['facebook'])?>" target="_blank"><span><i class="fab fa-facebook-f" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>
		    <?php if(!empty($instance['twitter'])) { ?>
		        <li> 
		        <a href="<?php echo esc_url($instance['twitter']);?> " target="_blank"><span><i class="fab fa-twitter" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>
		    
		    <?php if (!empty($instance['pinterest'])) { ?>
		        <li> 
		        <a href="<?php  echo esc_url($instance['pinterest']);?> " target="_blank"><span><i class="fab fa-pinterest-p" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>
		    <?php if (!empty($instance['linkedin'])) { ?>
		        <li> 
		        <a href="<?php  echo esc_url($instance['linkedin']);?> " target="_blank"><span><i class="fab fa-linkedin-in" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>

		    <?php if (!empty($instance['instagram'])) { ?>
		        <li> 
		        <a href="<?php  echo esc_url($instance['instagram']);?> " target="_blank"><span><i class="fab fa-instagram" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>
		    <?php if(!empty($instance['vimeo'])) { ?>
		        <li> 
		        <a href="<?php  echo esc_url($instance['vimeo'])?> " target="_blank"><span><i class="fab fa-vimeo-v" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>
		    <?php if (!empty($instance['tumblr'])) { ?>
		        <li> 
		        <a href="<?php  echo esc_url($instance['tumblr'])?> " target="_blank"><span><i class="fab fa-tumblr" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>
		    <?php if (!empty($instance['youtube'])) { ?>
		        <li> 
		        <a href="<?php  echo esc_url($instance['youtube'])?> " target="_blank"><span><i class="fab fa-youtube" aria-hidden="true"></i></span></a> 
		        </li>
		    <?php } ?>     
		</ul><?php 
		
		echo wp_kses_post($args['after_widget']);
	}

	/**
	* Back-end widget fields
	*/
	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( isset($widget_field['default']), 'medvill' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'medvill' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'medvill' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'medvill' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	/**
	* Sanitize widget form values as they are saved
	*/
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$instance[$widget_field['id']] = $_POST[$this->get_field_id( $widget_field['id'] )];
					break;
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
} // class medvillsocialiconwi_Widget

// register medvill Social Icon Widget widget
function register_medvillsocialiconwi_widget() {
	register_widget( 'medvillsocialiconwi_Widget' );
}
add_action( 'widgets_init', 'register_medvillsocialiconwi_widget' );