<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

			<div class="entry recent">

			<?php if ( has_recent_figure() ) : recent_figure(); ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php else : ?>
				<h2 class="nothumbnail"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

				<?php post_categories_list(); ?>

				<div class="content clearfix">
					<?php the_content(); ?>
				</div>

			</div>
			<!-- /.entry -->

<?php
	endwhile;
	endif;
?>
