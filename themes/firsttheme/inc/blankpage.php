<?php

/*
 * ブランクページテンプレート関連
 */
add_action( 'wp_head', 'blankpage_head');
add_action( 'load-post.php', 'disable_visual_editor_in_page_template' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page_template' );
add_action( 'add_meta_boxes', 'add_blankpage_head' );
add_action( 'save_post', 'save_blankpage_head' );

/*
 * カスタムフィールドを
 * スタイルシートまたはjavascriptを定義するタグ
 * にショートコードを使って変換する
 * （未使用）
 */
function blankpage_enqueue_scripts() {
	global $post;
	if ( is_page_template('blankpage.php') ) {
		$custom_field = get_post_meta( $post->ID, 'blankpagehead', true);
		$scripts = preg_split('/[\s,]+/', $custom_field);
		foreach( $scripts as $script ) {
			// echo $script . '\n';
			do_shortcode( $script );
		}
	}
}

function blankpage_head() {
	global $post;
	if ( is_page_template('blankpage.php') ) {
		$custom_field = get_post_meta( $post->ID, 'blankpagehead', true);
		echo $custom_field;
	}
}

/*
 * 編集画面でビジュアルエディタを非表示
 */
function disable_visual_editor_in_page_template() {
	if ( is_editor_for_blankpage_template() ) {
		add_filter('user_can_richedit', 'disable_visual_editor_filter' );
	}
}
function disable_visual_editor_filter(){
	return false;
}

/*
 * 編集画面にカスタムフィールドを追加
 */
function add_blankpage_head() {
	if ( is_editor_for_blankpage_template() ) {
		add_meta_box('blankpage-head', '追加head', 'print_blankpage_head', 'page', 'advanced');
	}
}
function print_blankpage_head() {
	global $post;
	wp_nonce_field(wp_create_nonce(__FILE__), 'blankpagehead_nonce');
	echo '<label class="hidden" for="blankpagehead">blankpagehead</label>';
	echo '<textarea name="blankpagehead" style="width: 100%; height: 200px;">'.get_post_meta($post->ID, 'blankpagehead', true).'</textarea>';
	echo '<p>追加するheadタグの内容を記述してください。</p>';
	// echo '<p>CSSおよびjavascriptを追加で読み込むためのタグを<br>';
	// echo '以下のショートコードで記述してください</p>';
	// echo '<p><code>[csslink][/csslink],[jslink][/jslink]</code></p>';
}

/*
 * カスタムフィールドを保存
 */
function save_blankpage_head( $post_id ) {
	$blankpagehead_nonce = isset( $_POST['blankpagehead_nonce'] ) ? $_POST['blankpagehead_nonce'] : null;
	if ( !wp_verify_nonce( $blankpagehead_nonce, wp_create_nonce(__FILE__)) ) {
		return $post_id;
	}

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) { return $post_id; }
	if ( !current_user_can('edit_post', $post_id) ) { return $post_id; }

	$data = $_POST['blankpagehead'];

	if ( get_post_meta($post_id, 'blankpagehead') == "" ) {
		add_post_meta($post_id, 'blankpagehead', $data, true);
	} elseif ( $data != get_post_meta($post_id, 'blankpagehead', true) ) {
		update_post_meta($post_id, 'blankpagehead', $data);
	} elseif ( $data == "" ) {
		delete_post_meta($post_id, 'blankpagehead', get_post_meta($post_id, 'blankpagehead', true));
	}
}

/*
 * CSSとかリソースがあるディレクトリのURI
 * （未使用）
 */
function get_blankpage_resource_uri() {
	global $post;
	$path = get_template_directory_uri() . '/';
	return $path . $post->post_name . '/';
}

/*
 * ブランクページテンプレートの管理画面かどうか
 */
function is_editor_for_blankpage_template() {
	global $typenow;
	if (isset($_GET['post'])) {
		$template_name = basename( get_page_template_slug( $_GET['post'] ), '.php' );
	} else {
		$template_name = null;
	}

	if( $typenow == 'page' and (!is_null($template_name) && $template_name == 'blankpage') ){
		return true;
	} else {
		return false;
	}
}

/*
 * ショートコード定義
 */
$csshandle_txt = 'ft-css-';
$jshandle_txt = 'ft-js-';
$csshandle_cnt = 0;
$jshandle_cnt = 0;

/*
 * linkタグ stylesheetを出力する
 * [csslink]
 */
function shortcode_csslink( $atts, $content = null) {
	global $csshandle_txt, $csshandle_cnt;
	extract(shortcode_atts(array(
		'path' => get_template_directory_uri() . '/',
		'output' => false,
	), $atts));

	if (0 === preg_match("/^http/", $content) ) {
		$content = $path . $content;
	}

	if (!$output) {
		$handle = $csshandle_txt . (++$csshandle_cnt);
		wp_enqueue_style($handle, $content, array(), null, 'all');
	} else {
		return '<link rel="stylesheet" href="' . $content . '">';
	}
}
add_shortcode('csslink', 'shortcode_csslink');

/*
 * scriptタグ javascriptを出力する
 * [jslink]
 */
function shortcode_jslink( $atts, $content = null) {
	global $jshandle_txt, $jshandle_cnt;
	extract(shortcode_atts(array(
		'path' => get_template_directory_uri() . '/',
		'output' => false,
	), $atts));

	if (0 === preg_match("/^http/", $content) ) {
		$content = $path . $content;
	}

	if (!$output) {
		$handle = $jshandle_txt . (++$jshandle_cnt);
		wp_enqueue_script($handle, $content);
	} else {
		return '<script type="text/javascript" src="' . $content . '"></script>';
	}
}
add_shortcode('jslink', 'shortcode_jslink');

?>
