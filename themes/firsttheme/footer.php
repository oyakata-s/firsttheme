	<footer id="footer">
		<aside id="foot-menu" class="wrapper clearfix">
<?php
	if ( is_active_sidebar( 'foot-area' ) ) :
		dynamic_sidebar('foot-area');
	else :
?>
			<section class="widget about">
				<h3>ABOUT</h3>
				<p><?php _e('If the widget is not set, this will be displayed.', 'firsttheme'); ?></p>
			</section>
<?php endif; ?>
		</aside>

		<small class="copyright">&copy; <?php bloginfo('name'); ?></small>
	</footer>

<?php wp_footer(); ?>
</body>

</html>
