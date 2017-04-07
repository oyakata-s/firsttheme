<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<?php  if (is_first_post()) : ?>
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

			<?php if ( is_page() ) : comments_template(); endif; ?>

<?php else : ?>
			<div class="entry">
				<figure style="background-image:url(<?php echo the_post_image_src(); ?>);"></figure>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<?php the_excerpt(); ?>
				<p class="read-more">
					<a class="button" href="<?php the_permalink(); ?>"><?php echo __('Read more...'); ?></a>
				</p>
			</div>
			<!-- /.entry -->

<?php
	endif;
	endwhile;
?>

			<?php if( (get_previous_posts_link() || get_next_posts_link()) ) : ?>
			<div class="prev-next clearfix">
 				<div class="entry next">
					<?php previous_posts_link(__('Newer Entries', 'firsttheme')); ?>
				</div>
				<div class="entry prev">
					<?php next_posts_link(__('Older Entries', 'firsttheme')); ?>
				</div>
			</div>
			<?php endif; ?>

<?php endif; ?>
