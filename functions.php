<?php
/**
 * WC Preso functions and definitions
 *
 * @package wp-presenter
 */

if (!isset($content_width)) {
	$content_width = 640;/* pixels */
}

if (!function_exists('wc_preso_setup')):

function wc_preso_setup() {
	load_theme_textdomain('wp-presenter', get_template_directory().'/languages');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
}
endif;// ts_setup
add_action('after_setup_theme', 'wc_preso_setup');

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function wc_preso_scripts() {
	$theme = get_theme_mod( 'select_theme');
	wp_enqueue_style('reveal-core', get_template_directory_uri() .'/assets/reveal/css/reveal.css', array(), '', false );
	wp_enqueue_style('reveal-theme', get_template_directory_uri() . '/assets/reveal/css/theme/' . $theme . '.css', array(), '', false );
	wp_enqueue_style('reveal-zenburn', get_template_directory_uri() . '/assets/reveal/lib/css/zenburn.css', array(), '');
	wp_enqueue_script('reveal-head-js', get_template_directory_uri() . '/assets/reveal/lib/js/head.min.js', array(), '', true );
	wp_enqueue_script('reveal-core-js', get_template_directory_uri().'/assets/reveal/js/reveal.js', array(), '', true );
}
	add_action( 'wp_enqueue_scripts', 'wc_preso_scripts' );




wp_enqueue_script( 'html5shiv', '//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.js', array(), '3.7.2', false );
add_filter( 'script_loader_tag', function( $tag, $handle ) {
	if ( $handle === 'html5shiv' ) {
		$tag = "<!--[if lt IE 9]>$tag<![endif]-->";
	}
	return $tag;
}, 10, 2 );

function load_custom_wp_admin_style() {
	wp_enqueue_style('customize-preview-style', get_template_directory_uri().'/assets/css/admin.css');
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';
/**
 * Customizer additions.
 */

require get_template_directory().'/inc/cmb/custom-meta-boxes.php';
require get_template_directory().'/inc/customizer.php';
require get_template_directory().'/inc/reveal-settings.php';
require get_template_directory().'/inc/post-type.php';
require get_template_directory().'/inc/meta-functions.php';
require get_template_directory().'/inc/custom-controls/kirki.php';
require get_template_directory().'/inc/kirki.php';
