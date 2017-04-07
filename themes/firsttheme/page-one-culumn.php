<?php
/*
 * Template Name: 1カラム（サイドバーなし）テンプレート
 */
?>
<?php get_header(); ?>

	<div class="wrapper clearfix">
		<article id="contents" class="one-culumn">
			<?php get_template_part( 'parts/loop' ); ?>
		</article>
		<!-- /#contents -->

	</div>

<?php get_footer(); ?>
