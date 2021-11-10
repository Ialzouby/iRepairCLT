<?php
function rselements_pro_shortcode_register_post_type() {
    $labels = array(
        'name'               => esc_html__( 'RS Global Shortcodes', 'rsaddon'),
        'singular_name'      => esc_html__( 'Elementor Shortcodes', 'rsaddon'),
        'add_new'            => esc_html_x( 'Add New Shorcode', 'rsaddon'),
        'add_new_item'       => esc_html__( 'Add New Shorcode', 'rsaddon'),
        'edit_item'          => esc_html__( 'Edit Element', 'rsaddon'),
        'new_item'           => esc_html__( 'New Shortcode', 'rsaddon'),
        'all_items'          => esc_html__( 'All Shorcodes', 'rsaddon'),
        'view_item'          => esc_html__( 'View Elements', 'rsaddon'),    
        'not_found'          => esc_html__( 'No Elements found', 'rsaddon'),
        'not_found_in_trash' => esc_html__( 'No Elements found in Trash', 'rsaddon'),
        'parent_item_colon'  => esc_html__( 'Parent Team:', 'rsaddon'),
        'menu_name'          => esc_html__( 'RS Elements', 'rsaddon'),
    );  
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'can_export'         => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,     
        'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
        'supports'           => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
    );
    register_post_type( 'rselements_pro', $args );
}
add_action( 'init', 'rselements_pro_shortcode_register_post_type' );



function rselements_pro_add_meta_box(){
    add_meta_box('rs-shortcode-box','Elements Shortcode','rselemetns_pro_shortcode_box','rselements_pro','side','high');
}
add_action("add_meta_boxes", "rselements_pro_add_meta_box");


function rselemetns_pro_shortcode_box($post){
    ?>
    <h4><?php echo esc_html('Shortcode','rselements');?></h4>
    <input type='text' class='widefat' value='[SHORTCODE_ELEMENTOR id="<?php echo esc_attr($post->ID); ?>"]' readonly="">

     <h4><?php echo esc_html('PHP Code','rselements');?></h4>
    <input type='text' class='widefat' value="&lt;?php echo do_shortcode('[SHORTCODE_ELEMENTOR id=&quot;<?php echo esc_attr($post->ID); ?>&quot;]'); ?&gt;" readonly="">
    <?php
}