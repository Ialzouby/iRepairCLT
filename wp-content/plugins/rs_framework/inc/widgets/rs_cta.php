<?php 
// Register and load the widget
function rsframework_cta_widget() {
    register_widget( 'cta_widget' );
}
add_action( 'widgets_init', 'rsframework_cta_widget' );

//Contact info Widget 
class cta_widget extends WP_Widget {
 
   /** constructor */
   function __construct() {
    parent::__construct(
      'cta_widget', 
      __('RS CTA Info', 'rsframework'),
      array( 'description' => __( 'Display your cta info!', 'rsframework' ), )
    );
  }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) { 
        extract( $args );
        $image_src = '';
        $title    = apply_filters('widget_title', $instance['title']);        
        $phone   = $instance['phone'];
        $app   = $instance['app'];
      
        
  
 
    if (!empty($intro) || !empty($phone)){ ?>
    <!-- Contact Info Widget -->
        <div class="cta-widget">
            <div class="container">
                <div class="title-cta">
                    <h2><?php echo wp_kses_post($title); ?></h2>                    
                    <?php         
                        if (!empty($phone)){
                            echo '<a class="cta-button" href="'. esc_attr(str_replace(" ","", ($app))) .'">'. esc_html($phone) .'</a>';
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
     
      $instance['url']     = strip_tags($new_instance['url']);      
      return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) {  

       $title   = (isset($instance['title']))? $instance['title'] : '';      
       $phone   = (isset($instance['phone']))? $instance['phone'] : '';
       $app     = (isset($instance['app']))? $instance['app'] : '';       

     ?>  

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'rsframework'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_js( $title); ?>" />
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
