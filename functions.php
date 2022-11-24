<?php
/**
 * Underscores Bootstrap functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Underscores_Bootstrap
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function underscores_bootstrap_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Underscores Bootstrap, use a find and replace
		* to change 'underscores-bootstrap' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'underscores-bootstrap', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'underscores-bootstrap' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'underscores_bootstrap_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'underscores_bootstrap_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function underscores_bootstrap_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'underscores_bootstrap_content_width', 640 );
}
add_action( 'after_setup_theme', 'underscores_bootstrap_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function underscores_bootstrap_widgets_init() {
	// https://developer.wordpress.org/reference/functions/register_sidebar/
	// register_sidebar( array|string $args = array() )
	// Builds the definition for a single sidebar and returns the ID.
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar aside', 'underscores_bootstrap' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'underscores_bootstrap' ),
			'before_widget' => '<div class="card m-3"><section id="%1$s" class="widget %2$s"><div class="card-body">',
			'after_widget'  => '</div></section></div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3></div><div class="card-body">',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar footer', 'underscores_bootstrap' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here.', 'underscores_bootstrap' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h6 class="widget-title">',
			'after_title'   => '</h6>',
		)
	);
}
add_action( 'widgets_init', 'underscores_bootstrap_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function underscores_bootstrap_scripts() {
    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
    // wp_enqueue_style( string $handle, string $src = '', string[] $deps = array(), string|bool|null $ver = false, string $media = 'all' )
    // Enqueue a CSS stylesheet.
    wp_enqueue_style('boostrap-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', []);	
    // https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
    // do_action( 'wp_enqueue_scripts' )
    // Fires when scripts and styles are enqueued.
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', [], false, true);

	wp_enqueue_style( 'underscores-bootstrap-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'underscores-bootstrap-style', 'rtl', 'replace' );

	wp_enqueue_script( 'underscores-bootstrap-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscores_bootstrap_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register Custom Navigation Walker
 * 
 * @return void
 *
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Edit comment form fields
 * 
 * https://www.youtube.com/watch?v=r1pZElaM9cc
 *
 * @return void
 */
function underscores_bootstrap_comment_fields ( $fields ) {
	# https://developer.wordpress.org/reference/hooks/comment_form_default_fields/
	# apply_filters( 'comment_form_default_fields', string[] $fields )
	# Filters the default comment form fields.
	#var_dump($fields);
	$fields['author'] = '<div class="form-group mb-3"><label for="author">Auteur</label><input type="text" class="form-control" name="author"></div>';
	$fields['email'] = '<div class="form-group mb-3"><label for="email">Email</label><input type="email" class="form-control" name="email"></div>';
	$fields['url'] = '<div class="form-group mb-3"><label for="url">Site Web</label><input type="url" class="form-control" name="url"></div>';
	return($fields);
}
add_filter( 'comment_form_default_fields', 'underscores_bootstrap_comment_fields' );

/**
 * https://www.youtube.com/watch?v=0q7oxrq1isI
 * Add underscores pagination
 * 
 * @return void
 */
function underscores_pagination () {
	$pages = paginate_links( ['type' => 'array'] );
	if ( $pages === null ) {
		return;
	};
	echo '<nav aria-label="Pagination" class="m-3">';
	echo '<ul class="pagination">';
	foreach ( $pages as $page )  {
		$active = strpos( $page, 'current' ) !== false;
		$class = 'page-item';
		if ( $active ) {
			$class .= ' active';
		};
		echo '<li class="' . $class . '">';
		echo str_replace('page-numbers', 'page-link', $page );
		echo '</li>';
	};
	#var_dump( $pages );
	echo '</ul>';
	echo '</nav>';
};

/**
 * Load custom post type ( formation ).
 */
require get_template_directory() . '/post-types/formation.php';

/**
 * Load custom post type ( realisation ).
 */
require get_template_directory() . '/post-types/realisation.php';

### Fin