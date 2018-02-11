<?php
/*
 * 管理画面関連
 */

/*
 * カスタマイズメニューに追加
 */
function bingwp_customize_register( $wp_customize ) {

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

?>
