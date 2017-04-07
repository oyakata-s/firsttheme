<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ( is_404() ) : ?>
<meta http-equiv="refresh" content="5;URL=<?php bloginfo('url'); ?>">
<?php endif; ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<header id="header">
		<div class="wrapper">
			<p class="description"><?php bloginfo('description'); ?></p>
			<h1>
<?php if (has_custom_logo()) : the_custom_logo(); else : ?>
				<a class="no-custom-logo" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
<?php endif; ?>
			</h1>
			<a href="#" class="menu-btn"></a>
<?php
	wp_nav_menu(array(
		'theme_location'	=> 'iconmenu',
		'menu'				=> 'sns-menu',
		'container'			=> 'nav',
		'container_class'	=> 'sns-menu',
		'menu_class'		=> '',
		'items_wrap'		=> '<ul>%3$s</ul>',
	));
?>
		</div>

	</header>
	<!-- /#header -->

	<div id="top-menu">
		<div class="wrapper clearfix">
<?php
	wp_nav_menu(array(
		'theme_location'	=> 'topmenu',
		'menu'				=> 'main-menu',
		'container'			=> 'nav',
		'container_class'	=> 'main-menu',
		'items_wrap'		=> '<ul>%3$s</ul>',
	));
?>

			<aside class="foot-menu">
<?php
	if ( is_active_sidebar( 'foot-area' ) ) :
		dynamic_sidebar('foot-area');
	else :
?>
				<section class="widget about">
					<h3>ABOUT</h3>
					<p><?php _e('If the widget is not set, this will be displayed.', 'firsttheme'); ?></p>
				</section>
<?php endif; ?>
			</aside>

			<a href="#" class="close-btn"><i class="fa fa-times" aria-hidden="true"></i><?php _e('Close'); ?></a>
		</div>
	</div>
	<!-- /#top-menu -->
