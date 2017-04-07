		<aside id="side-menu">
			<div class="wrap clearfix">
<?php
	if ( is_active_sidebar( 'side-bar' ) ) :
		dynamic_sidebar('side-bar');
	else :
?>
				<section class="widget about">
					<h3>ABOUT</h3>
					<p><?php _e('If the widget is not set, this will be displayed.', 'firsttheme'); ?></p>
				</section>
<?php endif; ?>
			</div>
		</aside>
		<!-- /#side-menu -->
