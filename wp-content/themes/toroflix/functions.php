<?php

define('DT_VERSION', '1.1.7');
define	('dbmurl','https://1rge.dbmovies.org/');
define	('dbmur','http://1rge.dbmovies.org/');
define	('dbmcdn', 'https://cdn.dbmovies.org/v2/');
define	('tmdburl','https://api.themoviedb.org/3/');
define	('imdbdata','https://1rge.dbmovies.org/dooplay/');
																						   
define	('apigoorec','https://www.google.com/recaptcha/api/siteverify');
define	('dbmskey', get_option('dbmovies_access_key'));
define	('tmdbkey', get_option('dt_api_key', '6b4357c41d9c606e4d7ebe2f4a8850ea'));
define	('tmdblang', get_option('dt_api_language', 'en-US'));
define('DT_DIR_URI', get_template_directory_uri());
define('DT_DIR', get_template_directory());
													
													 


function _d( $text ){
echo translate($text , 'mtms');
}

# Codestar Framework
if(!function_exists('cs_framework_init') && !class_exists('CSFramework')) {
    get_template_part('inc/core/doothemes/codestar/cs-framework');
}

#Version
define( 'TOROFLIX_VERSION',  '2.1'  );

$dir_path = ( substr( get_template_directory(),     -1 ) === '/' ) ? get_template_directory()     : get_template_directory()     . '/';
$dir_uri  = ( substr( get_template_directory_uri(), -1 ) === '/' ) ? get_template_directory_uri() : get_template_directory_uri() . '/';


/* Return Translated Text
-------------------------------------------------------------------------------
*/
function __d( $text ) {
return translate($text, 'mtms');
}
function dt_http_api( $api ) {
$url = wp_remote_retrieve_body( wp_remote_get( $api ) );
return $url; 
}
function dbmupdate($data) {
$option = get_option("wp_app_dbmkey");
return $option[$data];
}
/**
 * Toroflix functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Toroflix
 * By ToroThemes.com
 */

define ( 'TR_THEMEVERSION', '1.0');
define( 'TR_MOVIES_MOVIES', 1 ); // Activate module movies

if(is_admin()){
    $tfserial=unserialize(get_option('tflicense'));
    $my_theme = wp_get_theme();
    if(isset($tfserial['serial'])){
        require get_template_directory().'/inc/update.php';
        $tf_update = new TFUpdateChecker(
            'toroflix',
            'http://toroflix.ml/?trapi=3&trproduct='.$my_theme->get('Name').'&trserial='.$tfserial['serial']
        );
    }
}

if ( ! function_exists( 'toroflix_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function toroflix_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Toroflix, use a find and replace
		 * to change 'tr_themename' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'toroflix', get_template_directory() . '/languages' );

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
        set_post_thumbnail_size( 160,230 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'toroflix' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'toroflix_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 40,
			'width'       => 145,
			'flex-width'  => true,
			'flex-height' => true,
		) );
        
        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style( array( 'css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'toroflix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function toroflix_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'toroflix_content_width', 1640 );
}
add_action( 'after_setup_theme', 'toroflix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function toroflix_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'toroflix' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'toroflix' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title">',
		'after_title'   => '</div>',
	) );
    
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Footer', 'toroflix' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'toroflix' ),
		'before_widget' => '<div id="%1$s" class="Wdgt %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="Title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'toroflix_widgets_init' );

if ( ! function_exists( 'toroflix_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function toroflix_scripts() {
    
    wp_enqueue_style( 'toroflix-style', get_stylesheet_uri(), array(), TR_THEMEVERSION );

    wp_enqueue_style( 'toroflix-fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array(), TR_THEMEVERSION );
    
    wp_enqueue_style( 'toroflix-material', get_template_directory_uri() . '/css/material.css', array(), TR_THEMEVERSION );

    //wp_enqueue_style( 'toroflix-color', get_stylesheet_directory_uri() . '/css/color-default.css', array(), TR_THEMEVERSION );

    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700', array(), TR_THEMEVERSION);

    wp_enqueue_script( 'toroflix-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), TR_THEMEVERSION, true );
    
    if ( !is_tax('letters') and is_active_widget(false,false,'tr-search') and !is_404() ) {
        $myvars_sol = array( 
            'error' => __('No Results', 'toroflix'),
            'placeholder' => __('Click here to search', 'toroflix'),
        );
        wp_enqueue_script('trsol', get_template_directory_uri().'/js/sol.js',array('jquery'), TR_THEMEVERSION,true);
        wp_localize_script( 'trsol', 'trsol', $myvars_sol );
    }

    if(is_single()){
        wp_enqueue_script( 'toroflix-sharecount', get_template_directory_uri() . '/js/jquery.sharecount.js', array('jquery'), TR_THEMEVERSION, true );
    }
        
    $myvars_livesearch = array( 
        'url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce( 'tr-livesearch' ),
        'action' => 'tr_livearch',
        'loading' => __('Loading', 'toroflix')
    );
    wp_enqueue_script('trlivesearch', get_template_directory_uri().'/js/ajaxlivesearch.min.js',array('jquery'), TR_THEMEVERSION,true);
    wp_localize_script( 'trlivesearch', 'trlivesearch', $myvars_livesearch );
    
    wp_enqueue_script( 'toroflix-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), TR_THEMEVERSION, true );

    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
            
    wp_dequeue_style('wp-postratings');
    wp_dequeue_style('wp-postratings-rtl');
}
endif;
add_action( 'wp_enqueue_scripts', 'toroflix_scripts' );


function prefix_change_cpt_archive_per_page( $query ) {
    //* for cpt or any post type main archive
    if ( $query->is_main_query() && ! is_admin() && is_page_template( 'pages/page-movies.php' ) ) {
        $query->set( 'posts_per_page', '2' );
    }
}
add_action( 'pre_get_posts', 'prefix_change_cpt_archive_per_page' );


load_theme_textdomain( 'toroflix', get_template_directory() . '/languages' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Optimization.
 */
require get_template_directory() . '/inc/optimization.php';

/**
 * Implement Ads.
 */
require get_template_directory() . '/inc/admin_ads.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Filter Search
 */
require get_template_directory() . '/inc/filter-search.php';

/**
 * Customizer Colors.
 */
require get_template_directory() . '/inc/colors.php';

/**
 * Functions TGM Plugin Activation
 */
require get_template_directory() . '/inc/tgm.php';

/**
 * Widgets custom
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Custom fields to menu
 */
require get_template_directory() . '/inc/menu-custom-fields.php';

/**
 * Admin
 */
require get_template_directory() . '/inc/admin.php';

/**
 * TinyMCE Category Description
 */
require get_template_directory() . '/inc/tinymce-category-description.php';
//require_once( DT_DIR . '/inc/dt_init.php');
require_once( DT_DIR . '/inc/api/dbmovies.php');
//require_once( DT_DIR . '/inc/dt_init.php');
require_once( DT_DIR . '/inc/core/dbmvs/init.php');
/* API upload image
-------------------------------------------------------------------------------
*/
function dt_upload_image( $image_url, $post_id  ){
	$option = get_option('dt_api_upload_poster');
	global $wp_filesystem;
	if($option == 'true') {
		WP_Filesystem();
		$upload_dir		= wp_upload_dir();
		$imagex			= wp_remote_get($image_url);
		$image_data		= wp_remote_retrieve_body($imagex);
		$filename		= wp_basename($image_url);
		if(wp_mkdir_p($upload_dir['path']))    
			$file = $upload_dir['path'] . '/' . $filename;
		else                          
			$file = $upload_dir['basedir'] . '/' . $filename;
			$wp_filesystem->put_contents($file, $image_data, FS_CHMOD_FILE);
			$wp_filetype = wp_check_filetype($filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_title' => sanitize_file_name($filename),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment($attachment, $file, $post_id);
		require_once( ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata($attach_id, $file);
		$res1= wp_update_attachment_metadata($attach_id, $attach_data );
		$res2= set_post_thumbnail($post_id, $attach_id);
	}
}
function dt_clear($text) {
	return wp_strip_all_tags(html_entity_decode($text));
}
										  
?>

