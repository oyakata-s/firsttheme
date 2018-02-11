<?php
/*
 * Plugin Name: Bing Wallpaper
 * Plugin URI: https://github.com/oyakata-s/firsttheme
 * Description: You can set wallpaper as background by Bing.
 * Version: 0.2
 * Author: oyakata-s
 * Author URI: https://something-25.com
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bingwallpaper
 */

/*
 * 定数定義
 */
define( 'BINGWP_DIR_PATH', plugin_dir_path( __FILE__ ) );	// プラグインディレクトリへのパス
define( 'BINGWP_DIR_URL', plugin_dir_url( __FILE__ ) );		// プラグインディレクトリへのURL
define( 'BINGWP_TEXTDOMAIN', 'bingwallpaper' );				// テキストドメイン

define( 'BINGWP_CACHE_DIR_PATH', BINGWP_DIR_PATH . 'cache/' );	// キャッシュ用ディレクトリパス
define( 'BINGWP_CACHE_DIR_URL', BINGWP_DIR_URL . 'cache/' );	// キャッシュ用ディレクトリURL

/*
 * ライブラリ読込
 */
require_once ABSPATH . 'wp-admin/includes/file.php';		// WP_Filesystem使用
require_once BINGWP_DIR_PATH . 'inc/init.php';				// 初期化関連
require_once BINGWP_DIR_PATH . 'inc/admin.php';				// 管理画面関連
require_once BINGWP_DIR_PATH . 'inc/shortcodes.php';		// ショートコード関連


require_once BINGWP_DIR_PATH . 'inc/utils/class-ft-base.php';		// 
class BingWallpaper extends FtBase {

	/* 
	 * 初期化
	 */
	public function __construct() {

		/* 
		 * ベースクラスのコンストラクタ呼び出し
		 */
		try {
			parent::__construct( __FILE__ );
		} catch ( Exception $e ) {
			throw $e;
		}

		// 多言語翻訳用
		load_plugin_textdomain( 'bingwallpaper', false, 'bingwallpaper/languages' );

		/*
		 * プラグイン有効化時
		 */
		register_activation_hook( __FILE__, 'bingwp_activation' );

		/*
		 * プラグイン無効化時
		 */
		register_deactivation_hook( __FILE__, 'bingwp_deactivation' );

		/*
		 * プラグインロード
		 */
		add_action( 'plugins_loaded', 'bingwp_loaded' );

		/*
		 * CSS&JS出力
		 */
		add_action( 'wp_head', 'bingwp_header_style' );
		add_action( 'wp_footer', 'bingwp_footer_style' );

		/*
		 * 壁紙の反映
		 */
		add_filter( 'body_class', 'add_bingwp_class' );

		/*
		 * 設定メニュー追加
		 */
		add_action( 'customize_register', 'bingwp_customize_register' );

	}

}

$bingwallpaper = new BingWallpaper();

?>
