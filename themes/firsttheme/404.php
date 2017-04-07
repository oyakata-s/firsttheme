<?php header("HTTP/1.1 404 Not Found"); ?>
<?php get_header(); ?>

	<div class="wrapper clearfix">
		<article id="contents">

			<div class="entry recent">

				<h2 class="nothumbnail"><?php _e('Page Not Found.', 'firsttheme'); ?></h2>

				<div class="content clearfix">
					<p><?php _e('Page Not Found.', 'firsttheme'); ?></p>
					<p><?php _e('I\'ll move to a top page 5 seconds later.', 'firsttheme'); ?></p>
				</div>

			</div>
			<!-- /.entry -->

		</article>
		<!-- /#contents -->

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
