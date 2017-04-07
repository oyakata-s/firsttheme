<?php

/*
 * メニュー設定
 */
function theme_menus_customize() {

	// トップメニュー登録
	register_nav_menu('topmenu', 'トップメニュー');

	// SNSアイコンメニュー
	register_nav_menu('iconmenu', 'アイコンメニュー');

}
add_action('after_setup_theme', 'theme_menus_customize');

?>
