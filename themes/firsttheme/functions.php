<?php

require_once locate_template('inc/classes.php');	// 拡張クラス関連
require_once locate_template('inc/widgets.php');	// ウィジェット関連
require_once locate_template('inc/menus.php');		// メニュー関連
require_once locate_template('inc/filter.php');		// フィルター関連
require_once locate_template('inc/shortcodes.php');		// ショートコード関連
require_once locate_template('inc/init.php');		// 初期設定関数
require_once locate_template('inc/admin.php');		// 管理画面関連
require_once locate_template('inc/blankpage.php');		// ブランクページ関数

/*
 * 投稿に以下があるかどうか
 *  アイキャッチ画像
 *  または　ヘッダー画像（フロントページまたは固定ページの場合）
 */
function has_recent_figure() {
	if ( has_post_thumbnail() ) {
		return true;
	} elseif ( get_header_image() &&
		( is_front_page() || is_page() ) ) {
		return true;
	} else {
		return false;
	}
}

/*
 * 投稿に以下があれば<figure>タグで囲んで出力
 *  アイキャッチ画像
 *  または　ヘッダー画像（フロントページまたは固定ページの場合）
 */
function recent_figure() {
	if ( has_post_thumbnail() ) {
		echo '<figure>' . get_the_post_thumbnail() . '</figure>';
	} elseif ( get_header_image() &&
		( is_front_page() || is_page() ) ) {
		echo '<figure><img src="' . get_header_image() . '" alt=""></figure>';
	}
}

/*
 * ループの最初の投稿か否かを判定する
 */
function is_first_post( $query = null ) {
	global $wp_query;
	if ( is_null($query) ) {
		$query = $wp_query;
	}

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	return (($query->current_post === 0) && ($paged === 1));
}

/*
 * 投稿の属するカテゴリーをリストタグで出力
 * ループ内でのみ使用可
 */
function post_categories_list() {
	echo '<ul class="categories">';
	$cats = get_the_category();
	foreach ((array)$cats as $cat) {
		$cat_link = get_category_link($cat -> cat_ID);
		echo '<li><a class="button" href="' . $cat_link . '">' . $cat -> name . '</a></li>';
	}
	echo '</ul>';
}

/*
 * 投稿に以下があればimgタグを出力
 * 　アイキャッチ画像
 * 　または　添付された画像
 * 　または　本文からマッチしたimgタグ
 */
function the_post_image() {
	echo '<img src="' . the_post_image_src() . '">';
}

/*
 * 投稿に以下があればurlを出力
 * 　アイキャッチ画像
 * 　または　添付された画像
 * 　または　本文からマッチしたimgタグ
 */
function the_post_image_src() {
	if (has_post_thumbnail()) {
		$thumbnail_id = get_post_thumbnail_id();
		$eye_img = wp_get_attachment_image_src( $thumbnail_id , 'full' );
		return $eye_img[0];
	} else {
		$args = array(
			'post_mime_type' => 'image',
			'post_parent' => get_the_ID(),
			'post_type' => 'attachment',
			'numberposts' => 1,
		);
		$image = get_children($args);
		if (!empty($image)) {
			$post_img = wp_get_attachment_image_src( key($image) , 'full' );
			return $post_img[0];
		} else {
			// echo get_template_directory_uri() . '/img/noimage.jpg';
			return get_content_imgsrc();
		}
	}
}

/*
 * 投稿本文にimgタグがあればurlを返す
 */
function get_content_imgsrc() {
	global $post, $posts;
	$imgsrc = '';
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post -> post_content, $matches);
	$imgsrc = $matches[1][0];

	if (empty($imgsrc)) {//Defines a default image
		$imgsrc = get_template_directory_uri() . "/img/noimage.jpg";
	}
	return $imgsrc;
}

?>
