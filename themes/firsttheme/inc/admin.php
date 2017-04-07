<?php

/*
 * 管理画面設定
 */
add_action( 'admin_print_styles', 'ft_admin_print_styles' );

/*
 * 管理画面のみスタイル追加
 */
function ft_admin_print_styles() {
	wp_enqueue_style('theme-admin', get_template_directory_uri() . '/css/admin.css', array(), null, 'all');
}

?>
