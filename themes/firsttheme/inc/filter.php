<?php

/*
 * フィルター定義
 */

/*
 * 抜粋の文字数変更
 */
function ft_excerpt_length( $length ) {
     return 70;
}
add_filter( 'excerpt_length', 'ft_excerpt_length', 999 );

/*
 * 続きを読むの修正
 */
function ft_read_more_link() {
	return '<p class="read-more"><a class="button" href="' . get_permalink() . '">' . __('Read more...') . '</a></p>';
}
add_filter('the_content_more_link', 'ft_read_more_link');

/*
 * 続きを読むの修正
 */
function ft_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'ft_excerpt_more');

/*
 * wp_mail用from設定
 * [ブログ名<postmaster@ホスト名>]
 */
function ft_mail_from( $email ) {
	$url = parse_url(get_bloginfo('url'));
	return 'postmaster@' . $url['host'];
}
function ft_mail_from_name( $email_from ) {
	return get_bloginfo('name');
}
// 無効化
// add_filter( 'wp_mail_from', 'ft_mail_from' );
// add_filter( 'wp_mail_from_name', 'ft_mail_from_name' );

?>
