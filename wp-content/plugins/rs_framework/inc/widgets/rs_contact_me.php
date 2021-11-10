<?php 
// Register and load the widget
function rsframework_contact_me_widget() {
    register_widget( 'contact_me_widget' );
}
add_action( 'widgets_init', 'rsframework_contact_me_widget' );

//Contact info Widget 
class contact_me_widget extends WP_Widget {
 
   /** constructor */
   function __construct() {
    parent::__construct(
      'contact_me_widget', 
      __('RS Contact Me', 'rsframework'),
      array( 'description' => __( 'Display your contact me!', 'rsframework' ), )
    );
  }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) { 
        extract( $args );
        $image_src = '';
        $title    = apply_filters('widget_title', $instance['title']);     
        $address2  = isset($instance['address2']) ? $instance['address2'] : '' ;     
        $phone   = $instance['phone'];
      
 
        if (!empty($title) || !empty($address2)){ ?>
        <!-- Contact Info Widget -->
            <div class="contact-me-widget">
                <div class="rs-contact-box">
                    <div class="address-item vertical boxstyle1">
                        <div class="address-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <h3 class="sidebar_question"><?php echo nl2br($address2); ?></h3>
                        <h3 class="sidebar_number"> <?php echo '<a href="tel:'. esc_attr(str_replace(" ","", ($phone))) .'">'. esc_html($phone) .'</a>'; ?></h3>
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
        $instance['address2'] = wp_kses_post($new_instance['address2']);  
        $instance['url']     = strip_tags($new_instance['url']);      
        return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) {  

       $title   = (isset($instance['title']))? $instance['title'] : ''; 
       $address2 = (isset($instance['address2']))? $instance['address2'] :'';      
       $phone   = (isset($instance['phone']))? $instance['phone'] : '';      

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
          <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'rsframework'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_js($phone); ?>" />
        </p>   
       
        <?php 
    }

 
} // end class
