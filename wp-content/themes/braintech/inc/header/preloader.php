<?php 
global $braintech_option;
$preloader_img = "";

if(!empty($braintech_option['show_preloader']))
  {
    $loading = $braintech_option['show_preloader'];
    if(!empty($braintech_option['preloader_img'])){
      $preloader_img = $braintech_option['preloader_img'];
    }
    if($loading == 1){
      if(empty($preloader_img['url'])):
      ?> 

      <div id="braintech-load">
        <div class="loader-braintech">
          <div id="medvill-load">             
                <div class="spinner_inner">
                  <div class="spinner"></div>
              </div>
              </div>
        </div>
      </div>  

      
        
      <?php else: ?>
          <div id="braintech-load">
              <img src="<?php echo esc_url($preloader_img['url']);?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
          </div>
      <?php endif; ?>
  <?php }
}?>

<?php if(!empty($braintech_option['off_sticky'])):   
    $sticky = $braintech_option['off_sticky'];         
    if($sticky == 1):
     $sticky_menu ='menu-sticky';        
    endif;
   else:
   $sticky_menu ='';
endif;

if( is_page() ){
 $post_meta_header = get_post_meta($post->ID, 'trans_header', true);  

     if($post_meta_header == 'Default Header'){       
        $header_style = 'default_header';             
     }
     else{
        $header_style = 'transparent_header';
    }
 }
 else{
    $header_style = 'transparent_header';
 }


 ?>   