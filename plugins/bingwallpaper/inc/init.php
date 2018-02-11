<?php
/*
 * 初期化関連
 */
require_once BINGWP_DIR_PATH . 'inc/utils/class-bingwallpaper-utils.php';	// 壁紙関連

/*
 * プラグイン有効化
 */
function bingwp_activation() {
	// キャッシュディレクトリの準備
	bingwp_check_dir( BINGWP_CACHE_DIR_PATH );
}

/*
 * プラグイン無効化
 */
function bingwp_deactivation() {
	// キャッシュディレクトリの削除
	bingwp_remove_dir( BINGWP_CACHE_DIR_PATH );
}

/*
 * プラグインロード時
 */
function bingwp_loaded() {
	global $bingwallpaper;
	$bingwallpaper->setOptions( array(
		'bingwallpaper_enable_option' => false
	) );

	// 壁紙の準備
	$bingwp = BingWallpaperUtils::getInstance( BINGWP_CACHE_DIR_PATH );
}

/*
 * headにタグを出力
 */
function bingwp_header_style() {
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
 * footerにタグを出力
 */
function bingwp_footer_style() {
	$bingwp = BingWallpaperUtils::getInstance( BINGWP_CACHE_DIR_PATH );
?>
<div class="bing-copyright"><?php echo $bingwp->getCopyright(); ?></div>
<?php
}

/*
 * bodyのclassに設定値を反映
 */
function add_bingwp_class( $classes = '' ) {
	global $bingwallpaper;
	if ( $bingwallpaper->getOption( 'bingwp_enable_option' ) ) {
		$classes[] = 'bingwallpaper';
	}
	return $classes;
}

/*
 * ディレクトリの存在をチェックする
 * 存在しなかったら作成する
 */
function bingwp_check_dir( $dir ) {
	if ( ! file_exists( $dir ) ) {
		return wp_mkdir_p( $dir );
	}

	return false;
}

/*
 * 指定したディレクトリが存在したら削除する
 */
function bingwp_remove_dir( $dir ) {
	if ( file_exists( $dir ) ) {
		if ( WP_Filesystem() ) {
			global $wp_filesystem;
			return $wp_filesystem->delete( $dir, true );
		}
	}

	return false;
}

?>
