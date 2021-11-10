<?php
    if ( class_exists( 'WooCommerce' ) && is_shop() || class_exists( 'WooCommerce' ) && is_product_tag()  || class_exists( 'WooCommerce' ) && is_product_category()  ) {
   
        $braintech_shop_id   = get_option( 'woocommerce_shop_page_id' ); 
        $header_width_meta = get_post_meta($braintech_shop_id, 'header_width_custom', true);
        $main_menu_hides   = !empty(get_post_meta($braintech_shop_id, 'menu-hides', true)) ? get_post_meta($braintech_shop_id, 'menu-hides', true) : '';
        $main_menu_type    = !empty(get_post_meta($braintech_shop_id, 'menu-type', true)) ? get_post_meta($braintech_shop_id, 'menu-type', true) : '';
        $rs_top_search     = get_post_meta($braintech_shop_id, 'select-search', true);
        $rs_show_cart      = get_post_meta($braintech_shop_id, 'show-cart-icon', true);
        $rs_offcanvas      = get_post_meta($braintech_shop_id, 'show-off-canvas', true);
        $rs_phoneicon      = get_post_meta($braintech_shop_id, 'show-off-phoneicon', true);
        $rs_show_quote     = get_post_meta($braintech_shop_id, 'show-quote', true); 
        $menu_bg           = get_post_meta($braintech_shop_id, 'menu-type-bg', true); 
        $menu_center_page  = get_post_meta($braintech_shop_id, 'center-menus', true);
        $quote_btn_texts   = get_post_meta($braintech_shop_id, 'quote_btn_text', true);

        //Topbar 
        $rs_top_bar = get_post_meta($braintech_shop_id, 'select-top', true);

    } elseif (is_home() && !is_front_page() || is_home() && is_front_page()){
        $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
        $main_menu_hides   = !empty(get_post_meta(get_queried_object_id(), 'menu-hides', true)) ? get_post_meta(get_queried_object_id(), 'menu-hides', true) : '';
        $main_menu_type    = !empty(get_post_meta(get_queried_object_id(), 'menu-type', true)) ? get_post_meta(get_queried_object_id(), 'menu-type', true) : '';
        $rs_top_search     = get_post_meta(get_queried_object_id(), 'select-search', true);
        $rs_show_cart      = get_post_meta(get_queried_object_id(), 'show-cart-icon', true);
        $rs_offcanvas      = get_post_meta(get_queried_object_id(), 'show-off-canvas', true);
        $rs_phoneicon      = get_post_meta(get_queried_object_id(), 'show-off-phoneicon', true);
        $rs_show_quote     = get_post_meta(get_queried_object_id(), 'show-quote', true);
        $menu_bg           = get_post_meta(get_queried_object_id(), 'menu-type-bg', true);
        $menu_center_page  = get_post_meta(get_queried_object_id(), 'center-menus', true);
        $quote_btn_texts   = get_post_meta(get_queried_object_id(), 'quote_btn_text', true);

        //Topbar 
        $rs_top_bar = get_post_meta(get_queried_object_id(), 'select-top', true);

    } else {
        $header_width_meta = get_post_meta(get_queried_object_id(), 'header_width_custom', true);
        $main_menu_hides   = !empty(get_post_meta(get_queried_object_id(), 'menu-hides', true)) ? get_post_meta(get_queried_object_id(), 'menu-hides', true) : '';
        $main_menu_type    = !empty(get_post_meta(get_queried_object_id(), 'menu-type', true)) ? get_post_meta(get_queried_object_id(), 'menu-type', true) : '';
        $rs_top_search     = get_post_meta(get_queried_object_id(), 'select-search', true);
        $rs_show_cart      = get_post_meta(get_queried_object_id(), 'show-cart-icon', true);
        $rs_offcanvas      = get_post_meta(get_queried_object_id(), 'show-off-canvas', true);
        $rs_phoneicon      = get_post_meta(get_queried_object_id(), 'show-off-phoneicon', true);
        $rs_show_quote     = get_post_meta(get_queried_object_id(), 'show-quote', true);
        $menu_bg           = get_post_meta(get_queried_object_id(), 'menu-type-bg', true);
        $menu_center_page = get_post_meta(get_queried_object_id(), 'center-menus', true);
        $quote_btn_texts = get_post_meta(get_queried_object_id(), 'quote_btn_text', true);

        //Topbar 
        $rs_top_bar = get_post_meta(get_queried_object_id(), 'select-top', true);
}  

$main_menu_center = (!empty($braintech_option['main_menu_center'])) || ($menu_center_page == 'yes')  ? 'main-menu-center' : '';


$main_menu_icon = (!empty($braintech_option['main_menu_icon'])) ? 'main-menu-icon-hide' : '';

if ($header_width_meta != ''){
    $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
}else{
    $header_width = !empty($braintech_option['header-grid']) ? $braintech_option['header-grid'] : '';
    $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
}
