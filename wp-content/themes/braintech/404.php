<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */
get_header('404');

global $braintech_option;
$error_bg = !empty($braintech_option['error_bg']) ? 'style="background:url('.$braintech_option['error_bg']['url'].')"': '';?>
<div class="page-error <?php if($braintech_option){
    echo esc_attr('not-found-bg');
}?>" <?php echo wp_kses_post( $error_bg ); ?>>
    <div class="container">
        <div id="content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">    
                    <section class="error-404 not-found">    
                        <div class="page-content">
                            <h2>
                                <span>
                                    
                                    <?php
                                        if(!empty($braintech_option['title_404'])){
                                            echo esc_html($braintech_option['title_404']);
                                        }
                                        else{
                                            echo esc_html__( '404', 'braintech' ); 
                                        }
                                    ?>
                                </span>                      
                                <?php

                                 if(!empty($braintech_option['text_404'])){
                                      echo esc_html($braintech_option['text_404']);
                                 }
                                 else{
                                  echo esc_html__( 'oops! page not found', 'braintech' ); }
                                 ?>
                            </h2>
                            <a class="readon" href="<?php echo esc_url( home_url('/') ); ?>">
                                <?php
                                 if(!empty($braintech_option['back_home'])){
                                     echo esc_html($braintech_option['back_home']);
                                 }
                                 else{
                                     esc_html_e('Or back to homepage', 'braintech'); 
                                  }
                                ?>
                            </a>
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->    
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>   
</div> <!-- .page-error -->
<?php
get_footer('404');