<?php
/*
 * Plugin Name: Bing Wallpaper
 * Plugin URI: https://github.com/oyakata-s/firsttheme
 * Description: You can set wallpaper as background by Bing.
 * Version: 0.2.2
 * Author: oyakata-s
 * Author URI: https://something-25.com
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bingwallpaper
 */

/*
 * 定数定義
 */
define( 'BINGWP_FILE', __FILE__ );							// プラグインファイルへのパス
define( 'BINGWP_DIR_PATH', plugin_dir_path( __FILE__ ) );	// プラグインディレクトリへのパス
define( 'BINGWP_DIR_URL', plugin_dir_url( __FILE__ ) );		// プラグインディレクトリへのURL
define( 'BINGWP_TEXTDOMAIN', 'bingwallpaper' );				// テキストドメイン

define( 'BINGWP_CACHE_DIR_PATH', BINGWP_DIR_PATH . 'cache/' );	// キャッシュ用ディレクトリパス
define( 'BINGWP_CACHE_DIR_URL', BINGWP_DIR_URL . 'cache/' );	// キャッシュ用ディレクトリURL

/*
 * ライブラリ読込
 */
require_once ABSPATH . 'wp-admin/includes/file.php';		// WP_Filesystem使用
require_once BINGWP_DIR_PATH . 'inc/setting.php';			// 設定関連
require_once BINGWP_DIR_PATH . 'inc/shortcodes.php';		// ショートコード関連

require_once BINGWP_DIR_PATH . 'inc/base/class-ft-base.php';		// 
require_once BINGWP_DIR_PATH . 'inc/base/class-ft-utils.php';		// 

class BingWallpaper extends FtBase {

	/* 
	 * 初期化
	 */
	public function __construct() {

		/* 
		 * ベースクラスのコンストラクタ呼び出し
		 */
		try {
			parent::__construct( BINGWP_FILE );
		} catch ( Exception $e ) {
			throw $e;
		}

		// 多言語翻訳用
		load_plugin_textdomain( 'bingwallpaper', false, 'bingwallpaper/languages' );

		// 設定
		$this->setting = new BingWallpaperSetting();

		register_activation_hook( BINGWP_FILE, array( $this, 'activation' ) );
		register_deactivation_hook( BINGWP_FILE, array( $this, 'deactivation' ) );
		add_action( 'plugins_loaded', array( $this, 'loaded' ) );

		add_action( 'wp_head', array( $this, 'addHead' ) );
		add_action( 'wp_footer', array( $this, 'addFooter' ) );

		add_filter( 'body_class', function( $classes = '' ) {
			if ( $this->getOption( 'bingwp_enable_option' ) ) {
				$classes[] = 'bingwallpaper';
			}
			return $classes;
		} );
	}

	/* 
	 * プラグインロード時
	 */
	public function loaded() {
		// 壁紙の準備
		$bingwp = BingWallpaperUtils::getInstance( BINGWP_CACHE_DIR_PATH );
	}

	/* 
	 * プラグイン有効化
	 */
	public function activation() {
		// キャッシュディレクトリの準備
		FtUtils::checkDirectory( BINGWP_CACHE_DIR_PATH );
	}

	/* 
	 * プラグイン無効化
	 */
	public function deactivation() {
		// キャッシュディレクトリの準備
		FtUtils::removeDirectory( BINGWP_CACHE_DIR_PATH );
	}

	/* 
	 * head追加
	 */
	public function addHead() {
		$bingwp = BingWallpaperUtils::getInstance( BINGWP_CACHE_DIR_PATH );
?>
<style type="text/css" id="bingwallpaper_style">
body.bingwallpaper {
	background-image: url(<?php echo BINGWP_CACHE_DIR_URL . $bingwp->getFilename(); ?>);
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
	 * footer追加
	 */
	public function addFooter() {
		$bingwp = BingWallpaperUtils::getInstance( BINGWP_CACHE_DIR_PATH );
		echo '<div class="bing-copyright">' . $bingwp->getCopyright() . '</div>';
	}

}

$bingwallpaper = new BingWallpaper();

?>
