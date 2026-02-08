<?php
/**
 * TIGER BLOG Customizer Settings
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sanitize functions for customizer
 */

// Checkbox sanitize
function tiger_blog_sanitize_checkbox($checked)
{
    return ((isset($checked) && true == $checked) ? true : false);
}

// Radio/Select sanitize
function tiger_blog_sanitize_select($input, $setting)
{
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

// Number range sanitize
function tiger_blog_sanitize_number_range($number, $setting)
{
    $number = absint($number);
    $atts = $setting->manager->get_control($setting->id)->input_attrs;
    $min = (isset($atts['min']) ? $atts['min'] : $number);
    $max = (isset($atts['max']) ? $atts['max'] : $number);
    $step = (isset($atts['step']) ? $atts['step'] : 1);
    return ($min <= $number && $number <= $max && is_int($number / $step) ? $number : $setting->default);
}

// Image uploader sanitize
function tiger_blog_sanitize_image($image, $setting)
{
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif' => 'image/gif',
        'png' => 'image/png',
        'bmp' => 'image/bmp',
        'tif|tiff' => 'image/tiff',
        'ico' => 'image/x-icon'
    );
    $file = wp_check_filetype($image, $mimes);
    return ($file['ext'] ? $image : $setting->default);
}

/**
 * Theme Customizer - Basic Settings
 */
function tiger_blog_theme_customizer($wp_customize)
{
    // Section
    $wp_customize->add_section('tiger_blog_theme_section', array(
        'title' => __('Basic Settings [TIGER BLOG]', 'tiger-blog'),
        'priority' => 1,
    ));

    // Search target
    $wp_customize->add_setting('tiger_blog_search', array(
        'default' => 'value1',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_select',
    ));
    $wp_customize->add_control('tiger_blog_search', array(
        'section' => 'tiger_blog_theme_section',
        'settings' => 'tiger_blog_search',
        'label' => __('Search Target', 'tiger-blog'),
        'description' => __('Select what to include in search results', 'tiger-blog'),
        'type' => 'select',
        'choices' => array(
            'value1' => __('Pages and Posts (default)', 'tiger-blog'),
            'value2' => __('Posts only', 'tiger-blog'),
            'value3' => __('Pages only', 'tiger-blog'),
        ),
    ));

    // Archive excerpt length
    $wp_customize->add_setting('tiger_blog_archive_word', array(
        'default' => '200',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_number_range',
    ));
    $wp_customize->add_control('tiger_blog_archive_word', array(
        'section' => 'tiger_blog_theme_section',
        'settings' => 'tiger_blog_archive_word',
        'label' => __('Archive Excerpt Length', 'tiger-blog'),
        'description' => __('Number of characters to display in archive pages', 'tiger-blog'),
        'type' => 'number',
        'input_attrs' => array(
            'min' => 0,
            'max' => 500,
            'step' => 10,
        ),
    ));

    // Archive layout
    $wp_customize->add_setting('tiger_blog_archive_layout', array(
        'default' => 'value1',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_select',
    ));
    $wp_customize->add_control('tiger_blog_archive_layout', array(
        'section' => 'tiger_blog_theme_section',
        'settings' => 'tiger_blog_archive_layout',
        'label' => __('Archive Layout', 'tiger-blog'),
        'type' => 'select',
        'choices' => array(
            'value1' => __('2 columns (default)', 'tiger-blog'),
            'value2' => __('1 column (no sidebar)', 'tiger-blog'),
        ),
    ));

    // Post layout
    $wp_customize->add_setting('tiger_blog_post_layout', array(
        'default' => 'value1',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_select',
    ));
    $wp_customize->add_control('tiger_blog_post_layout', array(
        'section' => 'tiger_blog_theme_section',
        'settings' => 'tiger_blog_post_layout',
        'label' => __('Single Post Layout', 'tiger-blog'),
        'type' => 'select',
        'choices' => array(
            'value1' => __('2 columns (default)', 'tiger-blog'),
            'value2' => __('1 column (no sidebar)', 'tiger-blog'),
        ),
    ));

    // Post content width
    $wp_customize->add_setting('tiger_blog_single_width', array(
        'default' => 'value1',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_select',
    ));
    $wp_customize->add_control('tiger_blog_single_width', array(
        'section' => 'tiger_blog_theme_section',
        'settings' => 'tiger_blog_single_width',
        'label' => __('Single Post Content Width', 'tiger-blog'),
        'type' => 'select',
        'choices' => array(
            'value1' => __('Default', 'tiger-blog'),
            'value2' => __('740px', 'tiger-blog'),
            'value3' => __('900px', 'tiger-blog'),
            'value4' => __('100% (full width)', 'tiger-blog'),
        ),
    ));
}
add_action('customize_register', 'tiger_blog_theme_customizer');

/**
 * Post Customizer - Post Settings
 */
function tiger_blog_post_customizer($wp_customize)
{
    // Section
    $wp_customize->add_section('tiger_blog_post_section', array(
        'title' => __('Post Settings [TIGER BLOG]', 'tiger-blog'),
        'priority' => 2,
    ));

    // Show/Hide post time
    $wp_customize->add_setting('tiger_blog_post_time', array(
        'default' => 'value1',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_select',
    ));
    $wp_customize->add_control('tiger_blog_post_time', array(
        'section' => 'tiger_blog_post_section',
        'settings' => 'tiger_blog_post_time',
        'label' => __('Display Post Date', 'tiger-blog'),
        'type' => 'select',
        'choices' => array(
            'value1' => __('Show (default)', 'tiger-blog'),
            'value2' => __('Hide', 'tiger-blog'),
        ),
    ));

    // Show/Hide featured image on single post
    $wp_customize->add_setting('tiger_blog_post_eyecatch', array(
        'default' => 'value1',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_select',
    ));
    $wp_customize->add_control('tiger_blog_post_eyecatch', array(
        'section' => 'tiger_blog_post_section',
        'settings' => 'tiger_blog_post_eyecatch',
        'label' => __('Display Featured Image on Single Post', 'tiger-blog'),
        'type' => 'select',
        'choices' => array(
            'value1' => __('Show (default)', 'tiger-blog'),
            'value2' => __('Hide', 'tiger-blog'),
        ),
    ));
}
add_action('customize_register', 'tiger_blog_post_customizer');

/**
 * Social Media Customizer
 */
function tiger_blog_social_customizer($wp_customize)
{
    // Section
    $wp_customize->add_section('tiger_blog_social_section', array(
        'title' => __('Social Media [TIGER BLOG]', 'tiger-blog'),
        'priority' => 3,
    ));

    // Twitter URL
    $wp_customize->add_setting('tiger_blog_social_twitter', array(
        'type' => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('tiger_blog_social_twitter', array(
        'section' => 'tiger_blog_social_section',
        'settings' => 'tiger_blog_social_twitter',
        'label' => __('Twitter URL', 'tiger-blog'),
        'type' => 'url',
    ));

    // Facebook URL
    $wp_customize->add_setting('tiger_blog_social_facebook', array(
        'type' => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('tiger_blog_social_facebook', array(
        'section' => 'tiger_blog_social_section',
        'settings' => 'tiger_blog_social_facebook',
        'label' => __('Facebook URL', 'tiger-blog'),
        'type' => 'url',
    ));

    // Instagram URL
    $wp_customize->add_setting('tiger_blog_social_instagram', array(
        'type' => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('tiger_blog_social_instagram', array(
        'section' => 'tiger_blog_social_section',
        'settings' => 'tiger_blog_social_instagram',
        'label' => __('Instagram URL', 'tiger-blog'),
        'type' => 'url',
    ));

    // YouTube URL
    $wp_customize->add_setting('tiger_blog_social_youtube', array(
        'type' => 'option',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('tiger_blog_social_youtube', array(
        'section' => 'tiger_blog_social_section',
        'settings' => 'tiger_blog_social_youtube',
        'label' => __('YouTube URL', 'tiger-blog'),
        'type' => 'url',
    ));

    // RSS Feed
    $wp_customize->add_setting('tiger_blog_social_rss', array(
        'default' => 'value1',
        'type' => 'option',
        'sanitize_callback' => 'tiger_blog_sanitize_select',
    ));
    $wp_customize->add_control('tiger_blog_social_rss', array(
        'section' => 'tiger_blog_social_section',
        'settings' => 'tiger_blog_social_rss',
        'label' => __('RSS Feed Display', 'tiger-blog'),
        'type' => 'select',
        'choices' => array(
            'value1' => __('Show (default)', 'tiger-blog'),
            'value2' => __('Hide', 'tiger-blog'),
        ),
    ));
}
add_action('customize_register', 'tiger_blog_social_customizer');
