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
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />
	<link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />';
}
add_action('wp_head', 'stb_dns_prefetch', 0);

//add our inits
//angular cdn: https://cdnjs.com/libraries/angular.js/1.5.11
function wpangular_init() {
	wp_enqueue_style( 'wpangular',get_stylesheet_directory_uri() . '/css/default.css', null, null, true);
	wp_register_script( 'Angular', 'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.11/angular.min.js', null, null, true );
	wp_register_script( 'AngularRouter', 'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.11/angular-route.min.js', null, null, true );
	wp_register_script( 'App', get_stylesheet_directory_uri() . '/lib/app.js', null, null, true );
	wp_enqueue_script('Angular');
	wp_enqueue_script('AngularRouter');
	wp_enqueue_script('App');
}
add_action( 'wp_enqueue_scripts', 'wpangular_init', 20 );

//add plugin requirements
require_once get_template_directory() . '/inc/TGM-Plugin-Activation-2.6.1/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'wpangular_register_required_plugins' );

function wpangular_register_required_plugins() {
	$plugins = array(
		array(
			'name'        => 'JSON Rest API v2',
			'slug'        => 'rest-api',
			'required'    => true,
		),
		array(
			'name'        => 'WP API Menus',
			'slug'        => 'wp-api-menus',
			'required'    => true,
		),
		array(
			'name'        => 'Duplicate Page',
			'slug'        => 'duplicate-page',
			'required'    => false,
		),
	);
	$config = array(
		'id'           => 'wpangular',             // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '', 
	);
	tgmpa( $plugins, $config );
}

//declare menus
function wpangularmenu_setup() {
	// This theme several wp_nav_menu()s in various locations.
	register_nav_menu( 'primary', __( 'Main Top Nav', 'wpangular' ) );
	register_nav_menu( 'footer', __( 'Footer Links', 'wpangular' ) );
	register_nav_menu( 'social', __( 'Social Links', 'wpangular' ) );
}
add_action( 'after_setup_theme', 'wpangularmenu_setup' );

function wp_menu_id_by_name( $name ) {
	//output menu id
    $theme_location = $name;
	$locations = get_nav_menu_locations();
	$menuID = $locations[$theme_location];
	return($menuID);
}
