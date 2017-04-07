<?php

/*
 * ショートコード定義
 */

/*
 * permalinkを出力する
 * [permalink]
 */
function shortcode_permalink( $atts ) {
	extract(shortcode_atts(array(
		'id' => get_the_ID(),
	), $atts));
	return get_permalink( $id );
}
add_shortcode('permalink', 'shortcode_permalink');

/*
 * サイトのURLを出力
 * [url]
 */
function shortcode_url() {
	return get_bloginfo('url');
}
add_shortcode('url', 'shortcode_url');

/*
 * テンプレートディレクトリへのパス
 * [template]
 */
function shortcode_tp() {
	return get_template_directory_uri();
}
add_shortcode('template', 'shortcode_tp');

/*
 * アップロードディレクトリへのパス
 * [uploads]
 */
function shortcode_up() {
	$upload_dir = wp_upload_dir();
	return $upload_dir['baseurl'];
}
add_shortcode('uploads', 'shortcode_up');

/*
 * wordpressをインストールしたディレクトリ
 * [wpurl]
 */
add_shortcode('wpurl', 'shortcode_wpurl');
	function shortcode_wpurl() {
	return get_bloginfo('wpurl');
}

?>
