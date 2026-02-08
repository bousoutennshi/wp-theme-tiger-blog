<?php
/**
 * TIGER BLOG Block Styles
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom block styles
 */
function tiger_blog_register_block_styles()
{
    if (!function_exists('register_block_style')) {
        return;
    }

    // Button Styles
    register_block_style(
        'core/button',
        array(
            'name' => 'rounded',
            'label' => __('Rounded', 'tiger-blog'),
        )
    );

    register_block_style(
        'core/button',
        array(
            'name' => 'outline',
            'label' => __('Outline', 'tiger-blog'),
        )
    );

    // Heading Styles
    register_block_style(
        'core/heading',
        array(
            'name' => 'bordered',
            'label' => __('Bordered', 'tiger-blog'),
        )
    );

    register_block_style(
        'core/heading',
        array(
            'name' => 'underline',
            'label' => __('Underline', 'tiger-blog'),
        )
    );

    // Paragraph Styles
    register_block_style(
        'core/paragraph',
        array(
            'name' => 'highlight',
            'label' => __('Highlight', 'tiger-blog'),
        )
    );

    // Quote Styles
    register_block_style(
        'core/quote',
        array(
            'name' => 'border-accent',
            'label' => __('Border Accent', 'tiger-blog'),
        )
    );

    // List Styles
    register_block_style(
        'core/list',
        array(
            'name' => 'checkmark',
            'label' => __('Checkmark', 'tiger-blog'),
        )
    );
}
add_action('init', 'tiger_blog_register_block_styles');
