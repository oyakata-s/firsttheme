<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

			<div class="entry">
				<figure style="background-image:url(<?php echo the_post_image_src(); ?>);"></figure>

				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<?php the_excerpt(); ?>
				<p class="read-more">
					<a class="button" href="<?php the_permalink(); ?>"><?php echo __('Read more...'); ?></a>
				</p>
			</div>
			<!-- /.entry -->

<?php endwhile; ?>

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

<?php else : ?>

			<?php if ( is_search() ) : ?>
			<div class="entry">
				<figure style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/noresults.jpg);"></figure>

				<h2><?php
					printf(
						__('Search Results for: &ldquo;%s&rdquo;', 'firsttheme'),
						get_search_query()
					);
				?></h2>

				<p><?php _e('Sorry, but nothing matched your search terms.', 'firsttheme') ?></p>
			</div>
			<!-- /.entry -->
			<?php endif; ?>

<?php endif; ?>
