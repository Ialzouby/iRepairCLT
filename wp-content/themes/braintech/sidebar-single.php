<?php
/**
 * @author  rs-theme
 * @since   1.0
 * @version 1.0 
 */

if ( !is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
if(is_home()){?>
	<div class="col-lg-4 sticky-sidebar">
    <aside id="secondary" class="widget-area">
      <div class="bs-sidebar dynamic-sidebar">
        <?php		
             dynamic_sidebar('sidebar-1');
        ?>
      </div>
    </aside>
</div>
<?php }
else{ 
	$page_layout = get_post_meta( $post->ID, 'layout', true );
	if($page_layout=='2left' || $page_layout=='2right'){	
	?>
		<div class="col-lg-4 sticky-sidebar">
		  <aside id="secondary" class="widget-area">
		    <div class="bs-sidebar dynamic-sidebar">
		      <?php
				$page_sidebar = get_post_meta( $post->ID, 'custom_sidebar', true );
				if( 'default' != $page_sidebar):
			        	dynamic_sidebar($page_sidebar);
			        else:		        	
			        	dynamic_sidebar('sidebar-1');			        	
			    	endif;
		      ?>
		    </div>
		  </aside>
		  <!-- #secondary --> 
		</div>
	<?php
	}
	elseif(is_active_sidebar( 'sidebar-1' )){ ?>
		<div class="col-lg-4 sticky-sidebar">
		    <aside id="secondary" class="widget-area">
		      <div class="bs-sidebar dynamic-sidebar">
		        <?php		
		             dynamic_sidebar('sidebar-1');
		        ?>
		      </div>
		    </aside>
		</div> <?php
	}
}?>
