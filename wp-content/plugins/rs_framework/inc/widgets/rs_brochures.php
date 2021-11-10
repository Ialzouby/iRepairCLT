<?php 
// Register and load the widget
function rsframework_brochures_widget() {
    register_widget( 'brochures_widget' );
}
add_action( 'widgets_init', 'rsframework_brochures_widget' );

//Contact info Widget 
class brochures_widget extends WP_Widget {
 
   /** constructor */
   function __construct() {
    parent::__construct(
      'brochures_widget', 
      __('RS Brochures', 'rsframework'),
      array( 'description' => __( 'Display your brochures!', 'rsframework' ), )
    );
  }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) { 
        extract( $args );
        $image_src = '';
        $title    = apply_filters('widget_title', $instance['title']);     
        $address2  = isset($instance['address2']) ? $instance['address2'] : '' ;     
        $phone   = $instance['phone'];
        $app   = $instance['app'];
      
        
  
 
    if (!empty($title) || !empty($address2)){ ?>
    <!-- Contact Info Widget -->
        <div class="brochures-widget">
            <div class="container">
                <div class="title-brochures">
                    <h2 class="widget-title"><?php echo wp_kses_post($title); ?></h2> 
                    <?php echo '<p class="brochures-txt">'. nl2br($address2) .'</p>'; ?>                  
                    <?php         
                        if (!empty($phone)){
                            echo '<a class="brochures-button readon" href="'. esc_attr(str_replace(" ","", ($app))) .'">'. esc_html($phone) .' <i class="fa fa fa-file-pdf-o"></i></a>';
                        }
                    ?>                    
                </div>
            </div>
        </div>
    <?php } ?>    

    
    <?php
    }
 
  /** @see WP_Widget::update  */
  function update($new_instance, $old_instance) {   
        $instance            = $old_instance;
        $instance['title']   = strip_tags($new_instance['title']);
        $instance['phone']   = strip_tags($new_instance['phone']);
        $instance['app']     = wp_kses_post($new_instance['app']); 
        $instance['address2'] = wp_kses_post($new_instance['address2']);  
        $instance['url']     = strip_tags($new_instance['url']);      
        return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) {  

       $title   = (isset($instance['title']))? $instance['title'] : ''; 
       $address2 = (isset($instance['address2']))? $instance['address2'] :'';      
       $phone   = (isset($instance['phone']))? $instance['phone'] : '';
       $app     = (isset($instance['app']))? $instance['app'] : '';       

     ?>  

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'rsframework'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_js( $title); ?>" />
        </p> 

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('address2')); ?>"><?php esc_html_e('Text:', 'rsframework'); ?></label>

          <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address2')); ?>" name="<?php echo esc_attr($this->get_field_name('address2')); ?>">
               <?php echo wp_kses_post($address2); ?>
          </textarea>
        </p>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Button:', 'rsframework'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_js($phone); ?>" />
        </p>
        

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('app')); ?>"><?php esc_html_e('Link:', 'rsframework'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('app')); ?>" name="<?php echo esc_attr($this->get_field_name('app')); ?>" type="text" value="<?php echo esc_js($app); ?>" />
        </p>     
       
        <?php 
    }

 
} // end class
