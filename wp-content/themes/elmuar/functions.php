<?php
/**
 * Elisa Murcia Artengo functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elisa_Murcia_Artengo
 */
require_once('inc/Mobile_Detect.php');
require_once( 'inc/jrltt-functions.php' );

/**
* Thumbnail images for child theme
*/
if ( function_exists( 'add_image_size' ) ) {
	add_image_size('pub-index', 381, 560, false);
}

/**
 * Add custom post types
 */
add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {
	$labels = array(
		"name" => __( 'Projects', 'elmuar' ),
		"singular_name" => __( 'Project', 'elmuar' ),
		"menu_name" => __( 'Projects', 'elmuar' ),
		"all_items" => __( 'All Projects', 'elmuar' ),
		"add_new" => __( 'Add New', 'elmuar' ),
		"add_new_item" => __( 'Add New Project', 'elmuar' ),
		"edit_item" => __( 'Edit Project', 'elmuar' ),
		"new_item" => __( 'New Project', 'elmuar' ),
		"view_item" => __( 'View Project', 'elmuar' ),
		"search_items" => __( 'Search Project', 'elmuar' ),
		"not_found" => __( 'No Projects found', 'elmuar' ),
		"not_found_in_trash" => __( 'No Projects found in trash', 'elmuar' ),
		"parent" => __( 'Parent Project', 'elmuar' ),
		"featured_image" => __( 'Featured image for this Project', 'elmuar' ),
		"set_featured_image" => __( 'Set featured image for this Project', 'elmuar' ),
		"remove_featured_image" => __( 'Remove featured image for this Project', 'elmuar' ),
		"use_featured_image" => __( 'Use as featured image for this Project', 'elmuar' ),
		"archives" => __( 'Projects Archives', 'elmuar' ),
		"insert_into_item" => __( 'Insert into Project', 'elmuar' ),
		"uploaded_to_this_item" => __( 'Uploaded to this Project', 'elmuar' ),
		"filter_items_list" => __( 'Filter Projects list', 'elmuar' ),
		"items_list_navigation" => __( 'Projects list navigation', 'elmuar' ),
		"items_list" => __( 'Projects list', 'elmuar' ),
		);

	$args = array(
		"label" => __( 'Projects', 'elmuar' ),
		"labels" => $labels,
		"description" => "Single projects",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "project", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 6,"menu_icon" => "dashicons-admin-page",		
		"supports" => array( "title", "editor", "thumbnail", "custom-fields", "page-attributes", "post-formats" ),		
		"taxonomies" => array( "category" ),		
	);
	register_post_type( "project", $args );

	$labels = array(
		"name" => __( 'Publications', 'elmuar' ),
		"singular_name" => __( 'Publication', 'elmuar' ),
		"menu_name" => __( 'Publications', 'elmuar' ),
		"all_items" => __( 'All Publications', 'elmuar' ),
		"add_new" => __( 'Add New', 'elmuar' ),
		"add_new_item" => __( 'Add New Publication', 'elmuar' ),
		"edit_item" => __( 'Edit Publication', 'elmuar' ),
		"new_item" => __( 'New Publication', 'elmuar' ),
		"view_item" => __( 'View Publicaiton', 'elmuar' ),
		"search_items" => __( 'Search Publication', 'elmuar' ),
		"not_found" => __( 'No Publication found', 'elmuar' ),
		"not_found_in_trash" => __( 'No Publication found on trash', 'elmuar' ),
		"parent" => __( 'Parent Publication', 'elmuar' ),
		"featured_image" => __( 'Featured image for publication', 'elmuar' ),
		"set_featured_image" => __( 'Set featured image for this publication', 'elmuar' ),
		"remove_featured_image" => __( 'Remove featured image for this publication', 'elmuar' ),
		"use_featured_image" => __( 'Use as featured image for this publication', 'elmuar' ),
		"archives" => __( 'Publications archive', 'elmuar' ),
		"insert_into_item" => __( 'Insert into publication', 'elmuar' ),
		"uploaded_to_this_item" => __( 'Uploaded to this pubication', 'elmuar' ),
		"filter_items_list" => __( 'Filter Publication list', 'elmuar' ),
		"items_list_navigation" => __( 'Publications list navigation', 'elmuar' ),
		"items_list" => __( 'Publications list', 'elmuar' ),
		);

	$args = array(
		"label" => __( 'Publications', 'elmuar' ),
		"labels" => $labels,
		"description" => "Publications",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "publication", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 7,"menu_icon" => "dashicons-book",		
		"supports" => array( "title", "editor", "thumbnail", "excerpt", "custom-fields" ),		
		"taxonomies" => array( "category" ),		
	);
	register_post_type( "publication", $args );

	$labels = array(
		"name" => __( 'Ed Trompeloeil', 'elmuar' ),
		"singular_name" => __( 'Ed Trompeloeil', 'elmuar' ),
		"menu_name" => __( 'Ed Trompeloeil', 'elmuar' ),
		"all_items" => __( 'All Ed Trompeloeil', 'elmuar' ),
		"add_new" => __( 'Add new', 'elmuar' ),
		"add_new_item" => __( 'Add new Ed Trompeloeil', 'elmuar' ),
		"edit_item" => __( 'Edit Ed Trompeloeil', 'elmuar' ),
		"new_item" => __( 'New Ed Trompeloeil', 'elmuar' ),
		"view_item" => __( 'View Ed Trompeloeil', 'elmuar' ),
		"search_items" => __( 'Search Ed Trompeloeil', 'elmuar' ),
		"not_found" => __( 'No Ed Trompeloeil found', 'elmuar' ),
		"not_found_in_trash" => __( 'No Ed Trompeloeil found in trash', 'elmuar' ),
		"parent" => __( 'Parent Ed Trompeloeil', 'elmuar' ),
		"featured_image" => __( 'Featured image for this Ed Trompeloeil', 'elmuar' ),
		"set_featured_image" => __( 'Set featured image for this Ed Trompeloeil', 'elmuar' ),
		"remove_featured_image" => __( 'Remove featured image for this Ed Trompeloeil', 'elmuar' ),
		"use_featured_image" => __( 'User as featured imaged for Ed Trompeloeil', 'elmuar' ),
		"archives" => __( 'Ed Trompeloeil archives', 'elmuar' ),
		"insert_into_item" => __( 'Insert into Ed Trompeloeil', 'elmuar' ),
		"uploaded_to_this_item" => __( 'Uploaded to this Ed Trompeloeil', 'elmuar' ),
		"filter_items_list" => __( 'Filter Ed Trompeloeil list', 'elmuar' ),
		"items_list_navigation" => __( 'Ed Trompeloeil list navigation', 'elmuar' ),
		"items_list" => __( 'Ed Trompeloeil list', 'elmuar' ),
		);

	$args = array(
		"label" => __( 'Ed Trompeloeil', 'elmuar' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "editions-trompeloeil", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 8, "menu_icon" => "dashicons-admin-page",		
		"supports" => array( "title", "editor", "thumbnail", "custom-fields" ),				
	);
	register_post_type( "edtromp", $args );

	$labels = array(
		"name" => __( 'Comissions', 'elmuar' ),
		"singular_name" => __( 'Comission', 'elmuar' ),
		"menu_name" => __( 'Comissions', 'elmuar' ),
		"all_items" => __( 'All Comissions', 'elmuar' ),
		"add_new" => __( 'Add new', 'elmuar' ),
		"add_new_item" => __( 'Add new Comission', 'elmuar' ),
		"edit_item" => __( 'Edit Comission', 'elmuar' ),
		"new_item" => __( 'New Comission', 'elmuar' ),
		"view_item" => __( 'View Comission', 'elmuar' ),
		"search_items" => __( 'Search Comission', 'elmuar' ),
		"not_found" => __( 'No Comission found', 'elmuar' ),
		"not_found_in_trash" => __( 'No Comission found in trash', 'elmuar' ),
		"parent" => __( 'Parent Comission', 'elmuar' ),
		"featured_image" => __( 'Featured image for this Comission', 'elmuar' ),
		"set_featured_image" => __( 'Set featured image for this Comission', 'elmuar' ),
		"remove_featured_image" => __( 'Remove featured image for this Comission', 'elmuar' ),
		"use_featured_image" => __( 'User as featured imaged for Comission', 'elmuar' ),
		"archives" => __( 'Comission archives', 'elmuar' ),
		"insert_into_item" => __( 'Insert into Comission', 'elmuar' ),
		"uploaded_to_this_item" => __( 'Uploaded to this Comission', 'elmuar' ),
		"filter_items_list" => __( 'Filter Comission list', 'elmuar' ),
		"items_list_navigation" => __( 'Comission list navigation', 'elmuar' ),
		"items_list" => __( 'Comission list', 'elmuar' ),
		);

	$args = array(
		"label" => __( 'Comissions', 'elmuar' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "comission", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 8,"menu_icon" => "dashicons-admin-page",		
		"supports" => array( "title", "editor", "thumbnail", "custom-fields" ),				
	);
	register_post_type( "comission", $args );
// End of cptui_register_my_cpts()
}

if ( ! function_exists( 'elmuar_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function elmuar_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Elisa Murcia Artengo, use a find and replace
	 * to change 'elmuar' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'elmuar', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'elmuar' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'elmuar_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'elmuar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elmuar_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'elmuar_content_width', 640 );
}
add_action( 'after_setup_theme', 'elmuar_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elmuar_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'elmuar' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'elmuar' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'elmuar_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function elmuar_scripts() {
	wp_enqueue_style( 'elmuar-style', get_stylesheet_uri() );

	wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array(), '20151215', true );
	
	wp_enqueue_script( 'elmuar-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'elmuar-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'elmuar-behavior', get_template_directory_uri() . '/js/behavior.js', array(), '20151215', true );

	wp_enqueue_script( 'elmuar-flickity', get_template_directory_uri() . '/js/flickity.pkgd.min.js', array(), '20160110', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elmuar_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Disabled Contact form 7 load css & js
 */
// add_filter( 'wpcf7_load_js', '__return_false' );
// add_filter( 'wpcf7_load_css', '__return_false' );