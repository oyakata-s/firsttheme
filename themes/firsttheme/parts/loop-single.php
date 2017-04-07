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

				<div class="postinfo">
					<?php
						$archive_year  = get_the_time( 'Y' );
						$archive_month = get_the_time( 'm' );
						$archive_day   = get_the_time( 'd' );
					?>
					<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php the_date();?></a>&nbsp;<?php the_time(); ?> /
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
				</div>
			</div>
			<!-- /.entry -->

			<?php comments_template(); ?>

			<?php if( (get_previous_post() || get_next_post()) ) : ?>
			<div class="prev-next clearfix">
				<?php next_post_link('<div class="entry next">%link</div>'); ?>
				<?php previous_post_link('<div class="entry prev">%link</div>'); ?>
			</div>
			<?php endif; ?>
<?php
	endwhile;
	endif;
?>
