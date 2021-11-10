<?php if ( class_exists( 'WooCommerce' ) ) {?>
	<div class="menu-cart-area">
		<a href="<?php echo esc_url( wc_get_cart_url() );?>"><i class="fa fa-shopping-bag"></i></a>
		<div class="cart-icon-total-products">
			<?php the_widget( 'WC_Widget_Cart' ); ?>
		</div>
	</div>
<?php } ?>