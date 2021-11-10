<?php
    if ( class_exists( 'WooCommerce' ) && is_shop() || class_exists( 'WooCommerce' ) && is_product_tag()  || class_exists( 'WooCommerce' ) && is_product_category()  ) {
   
        $braintech_shop_id = get_option( 'woocommerce_shop_page_id' ); 
        $footer_type = get_post_meta($braintech_shop_id, 'footer_select', true);
        $header_width_meta = get_post_meta($braintech_shop_id, 'header_width_custom', true);
        if ($header_width_meta != ''){
            $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
        }else{
            $header_width = $braintech_option['header-grid'];
            $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
        }

        $footer_bg       = get_post_meta($braintech_shop_id,'footer_bg', true);
        $footer_bg_img   = get_post_meta($braintech_shop_id,'footer_bg_img', true);
        $copyright_bg    = get_post_meta($braintech_shop_id,'copyright_bg', true);
        $copyright_trans = get_post_meta($braintech_shop_id,'copyright_trans', true);
        $bg_pos          = get_post_meta($braintech_shop_id,'footer_bg_position', true);
        $copy_space      = get_post_meta($braintech_shop_id,'copyright_padding', true);
        $copy_trans      = ($copyright_trans=="yes") ? 'transparent' : '';
        $footer_bg_img   = ($footer_bg_img) ? $footer_bg_img : '';
        $footer_bg_pos   = ($bg_pos) ? $bg_pos : 'inherit';
        $footer_bg       = ($footer_bg) ? $footer_bg : '';
        $footer_select   = get_post_meta($braintech_shop_id,'footer_select', true);
        $footer_select   = ($footer_select) ? $footer_select : '';
        $footer_style   = get_post_meta($braintech_shop_id,'footer_style', true);

    } elseif (is_home() && !is_front_page() || is_home() && is_front_page()){

        $footer_type = get_post_meta(get_queried_object_id(), 'footer_select', true);
        $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
        if ($header_width_meta != ''){
            $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
        }else{
            $header_width = $braintech_option['header-grid'];
            $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
        }

        $footer_bg       = get_post_meta(get_queried_object_id(),'footer_bg', true);
        $footer_bg_img   = get_post_meta(get_queried_object_id(),'footer_bg_img', true);
        $copyright_bg    = get_post_meta(get_queried_object_id(),'copyright_bg', true);
        $copyright_trans = get_post_meta(get_queried_object_id(),'copyright_trans', true);
        $bg_pos          = get_post_meta(get_queried_object_id(),'footer_bg_position', true);
        $copy_space      = get_post_meta(get_queried_object_id(),'copyright_padding', true);
        $copy_trans      = ($copyright_trans=="yes") ? 'transparent' : '';
        $footer_bg_img   = ($footer_bg_img) ? $footer_bg_img : '';
        $footer_bg_pos   = ($bg_pos) ? $bg_pos : 'inherit';
        $footer_bg       = ($footer_bg) ? $footer_bg : '';
        $footer_select   = get_post_meta(get_queried_object_id(),'footer_select', true);
        $footer_select   = ($footer_select) ? $footer_select : '';
        $footer_style   = get_post_meta(get_queried_object_id(),'footer_style', true);

    } else {
        $footer_type = get_post_meta(get_queried_object_id(), 'footer_select', true);
        $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
        if ($header_width_meta != ''){
            $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
        }else{
            $header_width = $braintech_option['header-grid'];
            $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
        }

        $footer_bg       = get_post_meta(get_queried_object_id(),'footer_bg', true);
        $footer_bg_img   = get_post_meta(get_queried_object_id(),'footer_bg_img', true);
        $copyright_bg    = get_post_meta(get_queried_object_id(),'copyright_bg', true);
        $copyright_trans = get_post_meta(get_queried_object_id(),'copyright_trans', true);
        $bg_pos          = get_post_meta(get_queried_object_id(),'footer_bg_position', true);
        $copy_space      = get_post_meta(get_queried_object_id(),'copyright_padding', true);
        $copy_trans      = ($copyright_trans=="yes") ? 'transparent' : '';
        $footer_bg_img   = ($footer_bg_img) ? $footer_bg_img : '';
        $footer_bg_pos   = ($bg_pos) ? $bg_pos : 'inherit';
        $footer_bg       = ($footer_bg) ? $footer_bg : '';
        $footer_select   = get_post_meta(get_queried_object_id(),'footer_select', true);
        $footer_select   = ($footer_select) ? $footer_select : '';
        $footer_style   = get_post_meta(get_queried_object_id(),'footer_style', true);
}  
