<?php
/**
 * TIGER BLOG Template Tags and Helper Functions
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get image logo URL
 */
function tiger_blog_get_image_logo()
{
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        return $logo[0];
    }
    return false;
}

/**
 * Get social media URLs
 */
function tiger_blog_get_social_links()
{
    $social_links = array();

    $twitter = get_option('tiger_blog_social_twitter');
    if ($twitter) {
        $social_links['twitter'] = array(
            'url' => esc_url($twitter),
            'icon' => 'icon-twitter',
            'label' => 'Twitter'
        );
    }

    $facebook = get_option('tiger_blog_social_facebook');
    if ($facebook) {
        $social_links['facebook'] = array(
            'url' => esc_url($facebook),
            'icon' => 'icon-facebook',
            'label' => 'Facebook'
        );
    }

    $instagram = get_option('tiger_blog_social_instagram');
    if ($instagram) {
        $social_links['instagram'] = array(
            'url' => esc_url($instagram),
            'icon' => 'icon-instagram',
            'label' => 'Instagram'
        );
    }

    $youtube = get_option('tiger_blog_social_youtube');
    if ($youtube) {
        $social_links['youtube'] = array(
            'url' => esc_url($youtube),
            'icon' => 'icon-youtube',
            'label' => 'YouTube'
        );
    }

    // RSS feed
    if (get_option('tiger_blog_social_rss') != 'value2') {
        $social_links['rss'] = array(
            'url' => get_bloginfo('rss2_url'),
            'icon' => 'icon-rss',
            'label' => 'RSS Feed'
        );
    }

    return $social_links;
}

/**
 * Display social media links
 */
function tiger_blog_social_links()
{
    $social_links = tiger_blog_get_social_links();

    if (empty($social_links)) {
        return;
    }

    echo '<ul class="social-links">';
    foreach ($social_links as $social) {
        echo '<li class="social-links__item">';
        echo '<a href="' . $social['url'] . '" target="_blank" rel="noopener noreferrer" aria-label="' . esc_attr($social['label']) . '">';
        echo '<span class="' . $social['icon'] . '"></span>';
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';
}

/**
 * Custom excerpt length
 */
function tiger_blog_excerpt_length($length)
{
    $custom_length = get_option('tiger_blog_archive_word', 200);
    return absint($custom_length / 5); // Rough conversion from characters to words
}
add_filter('excerpt_length', 'tiger_blog_excerpt_length', 999);

/**
 * Modify search query to respect customizer settings
 */
function tiger_blog_search_filter($query)
{
    if (!is_admin() && $query->is_search()) {
        $search_type = get_option('tiger_blog_search', 'value1');

        if ($search_type == 'value2') {
            // Posts only
            $query->set('post_type', 'post');
        } elseif ($search_type == 'value3') {
            // Pages only
            $query->set('post_type', 'page');
        }
        // value1 is default (both pages and posts)
    }
    return $query;
}
add_action('pre_get_posts', 'tiger_blog_search_filter');

/**
 * Get main class for layout control
 */
function tiger_blog_main_class()
{
    $classes = array('l-main');

    if (is_singular('post')) {
        // Single post layout
        if (get_option('tiger_blog_post_layout') == 'value2') {
            $classes[] = 'l-main-single';

            // Content width
            $width = get_option('tiger_blog_single_width', 'value1');
            if ($width == 'value2') {
                $classes[] = 'l-main-w740';
            } elseif ($width == 'value3') {
                $classes[] = 'l-main-w900';
            } elseif ($width == 'value4') {
                $classes[] = 'l-main-w100';
            }
        }
    } elseif (is_archive() || is_home()) {
        // Archive layout
        if (get_option('tiger_blog_archive_layout') == 'value2') {
            $classes[] = 'l-main-single';
        }
    }

    return implode(' ', $classes);
}

/**
 * Check if sidebar should be displayed
 */
function tiger_blog_show_sidebar()
{
    if (is_singular('post')) {
        return get_option('tiger_blog_post_layout') != 'value2';
    } elseif (is_archive() || is_home()) {
        return get_option('tiger_blog_archive_layout') != 'value2';
    }
    return true;
}
