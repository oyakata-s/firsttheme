<?php

/*
 * テーマのセットアップ
 */
function firsttheme_setup() {

	// カスタムヘッダー有効化
	$custom_header_defaults = array(
		'width'				=> 690,
		'height'			=> 400,
		'flex-width'		=> true,
		'flex-height'		=> true,
		'header-text'            => false,	//ヘッダー画像上にテキストをかぶせる
	);
	add_theme_support('custom-header', $custom_header_defaults);

	// カスタムロゴ有効化
	$custom_logo_defaults = array(
		'height'	=> 100,
		'width'		=> 500,
		'flex-width' => true,
		'flex-height' => true,
	);
	add_theme_support('custom-logo', $custom_logo_defaults);

	$custom_background_defaults = array(
		'default-color'	=> 'fffafa',
	);
	add_theme_support('custom-background', $custom_background_defaults);

	// アイキャッチ画像有効化
	add_theme_support('post-thumbnails');

	// フォームのHTML5
	add_theme_support( 'html5', array( 'search-form', 'comment-form' ) );

	// タイトルタグ
	add_theme_support( 'title-tag' );

	// RSSフィード
	add_theme_support( 'automatic-feed-links' );

	// 多言語翻訳用
	load_theme_textdomain( 'firsttheme', get_template_directory() . '/languages');

	// wp_headの不要なタグ削除
	remove_action('wp_head', 'wp_generator');						// wordpressのバージョン
	remove_action('wp_head', 'rsd_link');							// 外部編集用
	remove_action('wp_head', 'wlwmanifest_link');					// Windows Live Writer編集用
	remove_action('wp_head', 'wp_shortlink_wp_head');				// 短縮リンク表示
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');	// 前へリンク、次へリンク
	remove_action('wp_head', 'feed_links_extra', 3);				//
	remove_action('wp_head', 'print_emoji_detection_script', 7);	// 絵文字
	remove_action('wp_print_styles', 'print_emoji_styles');			// 絵文字
	remove_action('wp_head', 'rel_canonical');						// canonical表示
	remove_action('wp_head','rest_output_link_wp_head');			// embed
	remove_action('wp_head','wp_oembed_add_discovery_links');		// embed
	remove_action('wp_head','wp_oembed_add_host_js');				// embed
}
add_action('after_setup_theme', 'firsttheme_setup');


/*
 * jqueryの読み込み
 * wordpress標準を無効にし、cdnを利用する
 */
function ft_enqueue_jquery() {
	/*
	 * 管理画面ではなにもしない
	 */
	if ( is_admin() ) {
		return;
	}

	// wordpress標準のjqueryを無効にし
	// cdnのjqueryを有効化
	wp_deregister_script('jquery');
	wp_register_script('jquery',
		'http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
		array(), '1.11.3');
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'ft_enqueue_jquery');

/*
 * js読み込み
 */
function ft_enqueue_scripts() {
	/*
	 * 管理画面ではなにもしない
	 */
	if ( is_admin() ) {
		return;
	}

	// 登録
	wp_register_script('theme-common',
		get_template_directory_uri() . '/js/common.js', array(), '0.1');

	// 適用
	wp_enqueue_script('theme-common');
}
add_action('wp_enqueue_scripts', 'ft_enqueue_scripts');

/* 
 * css適用
 */
function ft_print_styles() {

	// 登録
	wp_register_style('fontawesome',
		'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
		array(), null, 'all');
	wp_register_style('materialicon',
		'https://fonts.googleapis.com/icon?family=Material+Icons',
		array(), null, 'all');
	wp_register_style('theme-base',
		get_template_directory_uri() . '/css/base.css', array(), null, 'all');

	// 適用
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('theme-base');

	// 個別投稿、固定ページ（フロントページ除く）はコメント用を設定
	if (is_single() || (is_page() && !is_front_page())) {
		wp_enqueue_style('theme-comment', get_template_directory_uri() . '/css/comment.css', array(), null, 'all');
	}
}
add_action('wp_print_styles', 'ft_print_styles');

/*
 * html5shiv
 */
function add_ie_html5shiv() {
	$tag =<<< TAG
<!--[if lt IE9]>
<script src="http://oss.maxcdn.com/libs/html5shiv/3.7.2/htmlshiv-printshiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
TAG;
	echo $tag;
}
add_action('wp_head', 'add_ie_html5shiv');

?>
