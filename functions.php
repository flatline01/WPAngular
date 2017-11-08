<?php

//clean up header
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
add_filter('emoji_svg_url', '__return_false');

function remove_generator() {return '';}
add_filter('the_generator', 'remove_generator');

//* Adding DNS Prefetching for google stuff
function stb_dns_prefetch() {
	echo '<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />';
}
add_action('wp_head', 'stb_dns_prefetch', 0);

//add our inits
function header_init() {
	wp_enqueue_style( get_template_directory_uri() . '/style.css' );
	
}
add_action( 'wp_enqueue_scripts', 'header_init', 20 );