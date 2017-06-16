<?php
/*
 * Plugin Name: Bing Wallpaper
 * Plugin URI: http://something-25.com
 * Description: Bingから壁紙を取得して背景に設定するプラグイン
 * Version: 0.1.1
 * Author: oyakata-s
 * Author URI: http://something-25.com
 *
 * All files, unless otherwise stated, are released under the GNU General Public License
 * version 3.0 (http://www.gnu.org/licenses/gpl-3.0.html)
 */

/*
 * 初期化処理
 */
function bingwallpaper_init() {
	// ディレクトリチェック
	check_wallpaper_dir();

	// カスタマイズメニューに追加
	add_action( 'customize_register', 'bingwallpaper_customize' );

	// 多言語翻訳用
	load_plugin_textdomain( 'bingwallpaper', false, 'bingwallpaper/languages' );

	// 有効化されている場合
	if (get_option('BingWallpaper_Enable')) {
		// 壁紙を生成
		create_bingwallpaper();

		// style設定
		// 出力位置を変更
		// add_action( 'wp_print_styles', 'add_bingwallpaper_style' );
		add_action( 'wp_head', 'add_bingwallpaper_style' );
		add_action( 'wp_footer', 'add_bingwallpaper_footer_style' );
	}
}
add_action( 'plugins_loaded', 'bingwallpaper_init' );

/*
 * bingwallpaper生成
 */
function create_bingwallpaper() {
	$fileName = date_i18n('Ymd') . '.jpg';
	$dir = plugin_dir_path( __FILE__ );
	$tmpFileName = $dir . 'wallpaper/' . $fileName;
	$defFileName = $dir . 'wallpaper/today.jpg';
	$jsonFileName = $dir . 'wallpaper/result.json';

	if ( !file_exists($tmpFileName) ) {
		$locale = get_locale();
		$data = file_get_contents('http://www.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&mkt=' . $locale);
		$json = json_decode($data);
		$url = 'http://bing.com' . $json->images[0]->url;

		$imgData = @file_get_contents( $url );
		if ( $imgData ) {
			@file_put_contents( $tmpFileName, $imgData );
			copy($tmpFileName, $defFileName);
		}

		@file_put_contents( $jsonFileName, $data );

		cleanup_wallpaper_dir($fileName);
	}
}

/*
 * 壁紙のコピーライトを取得する
 */
function get_copyright() {
	$data = @file_get_contents( plugin_dir_path( __FILE__ ) . '/wallpaper/result.json' );
	$json = json_decode($data);
	return $json->images[0]->copyright;
}

/*
 * 画像を保存するディレクトリの存在をチェックする
 * 存在しなかったら作成する
 */
function check_wallpaper_dir() {
	$directory_path = plugin_dir_path( __FILE__ ) . 'wallpaper';

	if ( !file_exists($directory_path) ) {
		if ( mkdir($directory_path, 0755) ) {
			return true;
		} else {
			return false;
		}
	}

	return true;
}

/*
 * 不要な壁紙を削除
 */
function cleanup_wallpaper_dir($fileName) {
	$dir = plugin_dir_path( __FILE__ ) . 'wallpaper/';

	$list = scandir($dir);
	foreach($list as $value){
		if ($value === 'today.jpg') continue;
		if ($value === 'result.json') continue;
		if ($value === $fileName) continue;

		$file = $dir . $value;
		if(!is_file($file)) continue;

		unlink($file);
	}
}

/*
 * 管理画面カスタマイズ
 */
function bingwallpaper_customize( $wp_customize ) {

	// カスタマイズ画面にメニューを追加
	$wp_customize->add_section( 'bingwallpaper_section', array(
		'title' => 'Bing Wallpaper',
		'propaty' => 1,
		__('Setting Bing Wallpaper', 'bingwallpaper'),
	));

	// 有効化チェックボックス
	$wp_customize->add_setting('BingWallpaper_Enable', array(
		'type' => 'option',
	));
	$wp_customize->add_control('BingWallpaper_Enable', array(
		'section' => 'bingwallpaper_section',
		'settings' => 'BingWallpaper_Enable',
		'label' => __('Activate Bing Wallpaper', 'bingwallpaper'),
		'type' => 'checkbox',
	));

}

/*
 * bodyにスタイル属性追加
 */
function add_bingwallpaper_style() {
?>
<style type="text/css" id="bingwallpaper_style">
body {
	background-image: url(<?php echo plugin_dir_url( __FILE__ ); ?>wallpaper/today.jpg);
	background-position: center;
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;
}
.bing-copyright {
	position: fixed;
	bottom: 0;
	left: 0;
	z-index: -1;
	color: #fff;
	font-size: 0.8em;
	opacity: 0.3;
}
</style>
<?php
}

/*
 * footerにコピーライトを追加する
 */
function add_bingwallpaper_footer_style() {
?>
<div class="bing-copyright"><?php echo get_copyright(); ?></div>
<?php
}

?>
