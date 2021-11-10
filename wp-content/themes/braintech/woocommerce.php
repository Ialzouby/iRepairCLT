<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

get_header();
global $braintech_option;

// Layout class
$mevim_layout_class = 'col-sm-12 col-xs-12';
if(!empty( $braintech_option['shop-layout'])) {
	if ( !empty($braintech_option['shop-layout']) && $braintech_option['shop-layout'] == 'full' ) {
		$mevim_layout_class = 'col-sm-12 col-xs-12';
	}
	elseif( $braintech_option['shop-layout'] == 'left-col' || $braintech_option['shop-layout'] == 'right-col'){
		$mevim_layout_class = 'col-md-8 col-xs-12';
	}
	else{
		$mevim_layout_class = 'col-sm-12 col-xs-12';
	}
}

?>
<div class="container">
	<div id="content" class="site-content">		
		<div class="row">
			<?php
				if(!empty($braintech_option['disable-sidebar']) && is_product()){
					?>
					<div class="col-sm-12 col-xs-12">
					    <?php					
							woocommerce_content();						
						?>
					</div>
					<?php
				}else{				
					if ( !empty($braintech_option['shop-layout']) && $braintech_option['shop-layout'] == 'left-col'  ) {
						get_sidebar('woocommerce');
					}
					?>    			
				    <div class="<?php echo esc_attr($mevim_layout_class);?>">
					    <?php					
							woocommerce_content();						
		   				 ?>
				    </div>
					<?php
					if ( !empty($braintech_option['shop-layout']) && $braintech_option['shop-layout'] == 'right-col'  ) {
						get_sidebar('woocommerce');
					}	
				}
			?>
		</div>
	</div>
</div>
<?php
get_footer();

