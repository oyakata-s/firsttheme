<?php get_header(); ?>

	<div class="wrapper clearfix">
		<article id="contents">
			<?php get_template_part( 'parts/loop', 'single' ); ?>
		</article>
		<!-- /#contents -->

		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>
