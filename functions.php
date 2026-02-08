<?php
/**
 * TIGER BLOG functions and definitions
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme version
 */
define('TIGER_BLOG_VERSION', '1.2.2');

/**
 * Include customizer settings
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Include template tags and helper functions
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Include block patterns
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Include block styles
 */
require get_template_directory() . '/inc/block-styles.php';

/**
 * Include custom widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Theme setup
 */
function tiger_blog_setup()
{
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Enable support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Styles
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Enqueue editor styles
    add_editor_style('style-editor.css');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height' => 800,
        'width' => 800,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Add support for custom header
    add_theme_support('custom-header', array(
        'width' => 1100,
        'height' => 200,
        'flex-width' => true,
        'flex-height' => true,
        'header-text' => false,
    ));

    // Register navigation menu
    register_nav_menus(array(
        'header_menu' => __('Header Menu', 'tiger-blog'),
    ));

    // Add image sizes
    add_image_size('icatch', 890, 500, true);
}
add_action('after_setup_theme', 'tiger_blog_setup');

/**
 * Enqueue scripts and styles
 */
function tiger_blog_enqueue_assets()
{
    // Theme stylesheet (header only, main styles from Vite)
    wp_enqueue_style(
        'tiger-blog-style',
        get_stylesheet_uri(),
        array(),
        TIGER_BLOG_VERSION
    );

    // LION BLOG legacy CSS files
    wp_enqueue_style(
        'tiger-blog-content',
        get_template_directory_uri() . '/css/content.css',
        array(),
        TIGER_BLOG_VERSION
    );

    wp_enqueue_style(
        'tiger-blog-icon',
        get_template_directory_uri() . '/css/icon.css',
        array(),
        TIGER_BLOG_VERSION
    );

    wp_enqueue_style(
        'tiger-blog-blocks',
        get_template_directory_uri() . '/css/blocks.css',
        array(),
        TIGER_BLOG_VERSION
    );

    // Check if Vite build assets exist
    $main_css = get_template_directory() . '/assets/main.css';
    $main_js = get_template_directory() . '/assets/main.js';

    // Enqueue Vite built CSS
    if (file_exists($main_css)) {
        wp_enqueue_style(
            'tiger-blog-main',
            get_template_directory_uri() . '/assets/main.css',
            array(),
            filemtime($main_css)
        );
    }

    // Enqueue Vite built JavaScript
    if (file_exists($main_js)) {
        wp_enqueue_script(
            'tiger-blog-main',
            get_template_directory_uri() . '/assets/main.js',
            array(),
            filemtime($main_js),
            true // Load in footer
        );
    }
}
add_action('wp_enqueue_scripts', 'tiger_blog_enqueue_assets');

/**
 * Register widget areas
 */
function tiger_blog_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'tiger-blog'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'tiger-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Post Top', 'tiger-blog'),
        'id' => 'post-top',
        'description' => __('Widgets in this area will be shown above post content.', 'tiger-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Post Bottom', 'tiger-blog'),
        'id' => 'post-bottom',
        'description' => __('Widgets in this area will be shown below post content.', 'tiger-blog'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'tiger_blog_widgets_init');

/**
 * Set content width
 */
if (!isset($content_width)) {
    $content_width = 820;
}

/**
 * TODO: Additional features to be implemented
 * - Customizer settings (from LION BLOG)
 * - Breadcrumb navigation
 * - Social media integration
 * - SEO features (schema.org, OGP)
 * - Related posts
 * - Custom widgets
 */
