<?php
/*
 * 設定関連
 */

require_once BINGWP_DIR_PATH . 'inc/base/class-ft-setting.php';			// 設定ベースクラス

class BingWallpaperSetting extends  FtSetting {

	/*
	 * 初期化
	 */
	public function __construct() {

		try {
			parent::__construct(
				'bingwallpaper',
				array(
					'bingwallpaper_enable_option' => true
				) );
		} catch ( Exception $e ) {
			throw $e;
		}

		add_action( 'customize_register', array( $this, 'addCustomize' ) );
	}

	/*
	 * カスタマイズメニューに追加
	 */
	function addCustomize( $wp_customize ) {

		// カスタマイズ画面にメニューを追加
		$wp_customize->add_section( 'bingwallpaper_section', array(
			'title' => __( 'Bing Wallpaper', 'bingwallpaper' ),
			'propaty' => 1,
			__( 'Setting Bing Wallpaper', 'bingwallpaper' ),
		));

		// 有効化チェックボックス
		$wp_customize->add_setting( 'bingwp_enable_option', array(
			'default' => false,
			'type' => 'option',
		));
		$wp_customize->add_control( 'bingwp_enable_option', array(
			'section' => 'bingwallpaper_section',
			'settings' => 'bingwp_enable_option',
			'label' => __( 'Activate Bing Wallpaper', 'bingwallpaper' ),
			'type' => 'checkbox',
		));

	}

}

?>
