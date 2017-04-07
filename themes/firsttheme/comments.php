<?php
if ( post_password_required() || (!comments_open() && get_comments_number()==0) ) {
	return;
}
?>

<div id="comments" class="entry comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf(
						__('One thought on &ldquo;%s&rdquo;', 'firsttheme'),
						get_the_title()
					);
				} else {
					printf(
						__('%1$s thoughts on &ldquo;%2$s&rdquo;', 'firsttheme'),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
				// printf(
				// 	__('Comments (%s)'),
				// 	number_format_i18n( $comments_number )
				// );
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php echo __( 'Comments are closed.' ); ?></p>
	<?php endif; ?>

	<?php
		// comment_form();
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'comment_field'      => '<p class="comment-form-comment">' .
				'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Comment', 'noun' ) .
				'"></textarea></p>',
			'fields' => array(
				'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name' ) . '</label>' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' placeholder="' . __( 'Name' ) . '" />' .
					'</p>',
				'email' =>
					'<p class="comment-form-email"><label for="email">' . __( 'Email' ) . '</label>' .
					( $req ? '<span class="required">*</span>' : '' ) .
					'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' placeholder="' . __( 'Email' ) . '"/>' .
					'</p>',
				'url' =>
					'<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
					'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" placeholder="' . __( 'Website' ) . '"/></p>',
			),
		) );
	?>

</div><!-- .comments-area -->
