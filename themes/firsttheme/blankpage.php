<?php
/*
 * Template Name: ブランクページテンプレート
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<?php
	remove_action('wp_enqueue_scripts', 'ft_enqueue_scripts');
	remove_action( 'wp_print_styles', 'ft_print_styles' );
	wp_head();
?>

</head>

<body>

<?php
	if ( have_posts() ) : while ( have_posts() ) : the_post();

	remove_filter ('the_content', 'wpautop');
	remove_filter( 'the_content', 'wptexturize' );
	the_content();

	endwhile;
	endif;
?>

<?php wp_footer(); ?>
</body>

</html>
