<?php

//clean up header
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script' );
remove_action('admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
add_filter('emoji_svg_url', '__return_false');
remove_action( 'wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head', 'rest_output_link_wp_head', 10);

function my_deregister_scripts(){wp_deregister_script( 'wp-embed' );}
add_action( 'wp_footer', 'my_deregister_scripts' );

function remove_generator() {return '';}
add_filter('the_generator', 'remove_generator');

//* Adding DNS Prefetching for CDN stuff
function stb_dns_prefetch() {
	echo '<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />';
	
}
add_action('wp_head', 'stb_dns_prefetch', 0);

//add our inits
function wpangular_init() {
	wp_enqueue_style( 'wpangular',get_stylesheet_directory_uri() . '/css/default.css', null, null, true);
	wp_register_script( 'Angular', 'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.11/angular.min.js', null, null, true );
	wp_register_script( 'App', get_stylesheet_directory_uri() . '/lib/app.js', null, null, true );
	wp_enqueue_script('Angular');
	wp_enqueue_script('App');
}
add_action( 'wp_enqueue_scripts', 'wpangular_init', 20 );

