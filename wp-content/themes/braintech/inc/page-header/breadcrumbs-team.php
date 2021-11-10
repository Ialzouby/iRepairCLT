<?php
    global $braintech_option;    
    $header_width_meta = get_post_meta(get_the_ID(), 'header_width_custom', true);
    if ($header_width_meta != ''){
        $header_width = ( $header_width_meta == 'full' ) ? 'container-fluid': 'container';
    }else{
        $header_width = $braintech_option['header-grid'];
        $header_width = ( $header_width == 'full' ) ? 'container-fluid': 'container';
    }
?>
<?php 
    
    $post_meta_data = get_post_meta(get_the_ID(), 'banner_image', true);
    $post_menu_type = get_post_meta(get_the_ID(), 'menu-type', true); 
    $content_banner = get_post_meta(get_the_ID(), 'content_banner', true); 
?>


<div class="rs-breadcrumbs  porfolio-details">
<?php if($post_meta_data !='') { ?>
    <div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $post_meta_data );?>')">
        <div class="<?php echo esc_attr($header_width);?>">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                    <h1 class="page-title">
                        <?php if($content_banner !=''){
                            echo esc_html($content_banner);
                            }else{
                               the_title();
                            }
                        ?>
                    </h1>
                    <?php } 
                   if(!empty($braintech_option['off_breadcrumb'])){
                        $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                        if( $rs_breadcrumbs != 'hide' ):        
                        if(function_exists('bcn_display')){?>
                            <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                        <?php } 
                        endif;
                    }
                ?>    
              </div>
            </div>
          </div>
        </div>
    </div>
<?php }

elseif (!empty($braintech_option['team_single_image']['url'])) {?>
<div class="breadcrumbs-single" style="background-image: url('<?php echo esc_url( $braintech_option['team_single_image']['url'] );?>')">
    <div class="<?php echo esc_attr($header_width);?>">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>"> 
            <?php 
                $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                <?php if( $post_meta_title != 'hide' ){             
                ?>
                <h1 class="page-title">
                    <?php if($content_banner !=''){
                       echo esc_html($content_banner);
                    } else {
                       the_title();
                    }
                    ?>
                </h1>
                <?php } 
               if(!empty($braintech_option['off_breadcrumb'])){
                    $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                    if( $rs_breadcrumbs != 'hide' ):        
                    if(function_exists('bcn_display')){?>
                        <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                    <?php } 
                    endif;
                }
            ?>
          </div>
        </div>
      </div>
    </div>
</div>
    
<?php }else{?>
    <div class="rs-breadcrumbs-inner">
          <div class="<?php echo esc_attr($header_width);?>">
            <div class="row">
              <div class="col-md-12 text-center">
                <div class="breadcrumbs-inner bread-<?php echo esc_attr($post_menu_type); ?>">
                <?php 
                    $post_meta_title = get_post_meta(get_the_ID(), 'select-title', true);?>
                    <?php if( $post_meta_title != 'hide' ){             
                    ?>
                        <h1 class="page-title">
                            <?php if($content_banner !=''){
                               echo esc_html($content_banner);
                            } else {
                               the_title();
                            }
                            ?>
                        </h1>
                    <?php } 
                    if(!empty($braintech_option['off_breadcrumb'])){
                        $rs_breadcrumbs = get_post_meta(get_the_ID(), 'select-bread', true);
                        if( $rs_breadcrumbs != 'hide' ):        
                        if(function_exists('bcn_display')){?>
                            <div class="breadcrumbs-title"> <?php  bcn_display();?></div>
                        <?php } 
                        endif;
                    }
                ?>             
                </div>
              </div>
            </div>
          </div>
    </div>
<?php } ?>
</div>