<?php

/*
 * ウィジェット設定
 */
function theme_widgets_customize() {

	// サイドバー登録
	register_sidebar(array(
		'id' => 'side-bar',
		'name' => 'サイドバー',
		'before_widget' => '<section class="widget">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	// フッターエリア
	register_sidebar(array(
		'id' => 'foot-area',
		'name' => 'フッターエリア',
		'before_widget' => '<section class="widget">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_widget('Ft_Widget_Recent_Posts');
	register_widget('Ft_Widget_Archives');
	register_widget('Ft_Widget_RSS');

	// カテゴリーリスト出力カスタマイズ
	add_filter( 'wp_list_categories', 'ft_list_categories', 10, 2 );
	add_filter( 'wp_dropdown_cats', 'ft_dropdown_categories');
	add_filter( 'ft_get_archives', 'ft_get_archives', 10);
}
add_action( 'widgets_init', 'theme_widgets_customize' );

/*
 * functions
 */
function ft_get_archives( $output ) {
	$replaced_text = preg_replace('/<\/a>&nbsp;\(([0-9,]*)\)/', ' <span class="count">${1}</span></a>', $output);
	if($replaced_text != NULL) {
		return $replaced_text;
	} else {
		return $output;
	}
}

function ft_dropdown_categories( $output ) {
	$text = '<div class="dropdown-wrap">' . $output . '</div>';
	return $text;
}

function ft_list_categories( $output, $args ) {
	$replaced_text = preg_replace('/<\/a> \(([0-9,]*)\)/', ' <span class="count">${1}</span></a>', $output);
	if($replaced_text != NULL) {
		return $replaced_text;
	} else {
		return $output;
	}
}

?>
