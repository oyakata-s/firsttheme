<?php
/*
 * ショートコード関連
 */
require_once BINGWP_DIR_PATH . 'inc/utils/class-bingwallpaper-utils.php';	// 壁紙関連

/*
 * 壁紙をimgタグで出力
 */
function shortcode_bingwallpaper( $atts ) {
	$bingwp = BingWallpaperUtils::getInstance( BINGWP_CACHE_DIR_PATH );

	extract(shortcode_atts( array(
		'class' => 'bingwallpaper',
		'width' => 'auto',
		'height' => 'auto',
		'alt' => $bingwp->getCopyright()
	), $atts) );


	return '<img class="' . $class . '" src="' . BINGWP_CACHE_DIR_URL . $bingwp->getFilename() . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" "/>';
}
add_shortcode( 'bingwallpaper', 'shortcode_bingwallpaper' );

/*
 * 壁紙のURLを出力
 */
function shortcode_bingwallpaper_url() {
	$bingwp = BingWallpaperUtils::getInstance( BINGWP_CACHE_DIR_PATH );
	return BINGWP_CACHE_DIR_URL . $bingwp->getFilename();
}
add_shortcode( 'bingwallpaper_url', 'shortcode_bingwallpaper_url' );

?>
