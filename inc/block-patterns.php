<?php
/**
 * TIGER BLOG Block Patterns
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register block patterns category
 */
function tiger_blog_register_block_patterns_category()
{
    if (function_exists('register_block_pattern_category')) {
        register_block_pattern_category(
            'tiger-blog',
            array('label' => __('TIGER BLOG', 'tiger-blog'))
        );
    }
}
add_action('init', 'tiger_blog_register_block_patterns_category');

/**
 * Register block patterns
 */
function tiger_blog_register_block_patterns()
{
    if (!function_exists('register_block_pattern')) {
        return;
    }

    // Pattern: Call to Action
    register_block_pattern(
        'tiger-blog/cta-box',
        array(
            'title' => __('Call to Action Box', 'tiger-blog'),
            'description' => __('A call to action section with heading, text, and button.', 'tiger-blog'),
            'categories' => array('tiger-blog'),
            'content' => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"3rem","right":"3rem","bottom":"3rem","left":"3rem"}},"border":{"radius":"8px"}},"backgroundColor":"light-gray","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-light-gray-background-color has-background" style="border-radius:8px;padding-top:3rem;padding-right:3rem;padding-bottom:3rem;padding-left:3rem">
    <!-- wp:heading {"textAlign":"center","level":2} -->
    <h2 class="has-text-align-center">Ready to Get Started?</h2>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center"} -->
    <p class="has-text-align-center">Join thousands of satisfied users and start your journey today.</p>
    <!-- /wp:paragraph -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
        <!-- wp:button -->
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Get Started Now</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->',
        )
    );

    // Pattern: Three Columns Features
    register_block_pattern(
        'tiger-blog/three-columns-features',
        array(
            'title' => __('Three Columns Features', 'tiger-blog'),
            'description' => __('Three columns layout for showcasing features or services.', 'tiger-blog'),
            'categories' => array('tiger-blog'),
            'content' => '<!-- wp:columns -->
<div class="wp-block-columns">
    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3,"textAlign":"center"} -->
        <h3 class="has-text-align-center">Feature One</h3>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Describe your first amazing feature here with compelling text.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3,"textAlign":"center"} -->
        <h3 class="has-text-align-center">Feature Two</h3>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Describe your second amazing feature here with compelling text.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column -->
    <div class="wp-block-column">
        <!-- wp:heading {"level":3,"textAlign":"center"} -->
        <h3 class="has-text-align-center">Feature Three</h3>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center">Describe your third amazing feature here with compelling text.</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->',
        )
    );

    // Pattern: Hero Section
    register_block_pattern(
        'tiger-blog/hero-section',
        array(
            'title' => __('Hero Section', 'tiger-blog'),
            'description' => __('A hero section with large heading and description.', 'tiger-blog'),
            'categories' => array('tiger-blog'),
            'content' => '<!-- wp:cover {"overlayColor":"black","minHeight":400,"contentPosition":"center center","isDark":false,"align":"full"} -->
<div class="wp-block-cover alignfull is-light" style="min-height:400px">
    <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-100 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontSize":"3rem"}}} -->
        <h1 class="has-text-align-center" style="font-size:3rem">Welcome to Our Blog</h1>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"1.25rem"}}} -->
        <p class="has-text-align-center" style="font-size:1.25rem">Discover amazing content and join our community</p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">
            <!-- wp:button {"backgroundColor":"white","textColor":"black"} -->
            <div class="wp-block-button"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button">Learn More</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->
    </div>
</div>
<!-- /wp:cover -->',
        )
    );

    // Pattern: Testimonial
    register_block_pattern(
        'tiger-blog/testimonial',
        array(
            'title' => __('Testimonial', 'tiger-blog'),
            'description' => __('A testimonial block with quote and author.', 'tiger-blog'),
            'categories' => array('tiger-blog'),
            'content' => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}},"border":{"left":{"color":"var:preset|color|primary","width":"4px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-left-color:var(--wp--preset--color--primary);border-left-width:4px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">
    <!-- wp:quote {"className":"is-style-plain"} -->
    <blockquote class="wp-block-quote is-style-plain">
        <p>This is an amazing product! It has completely transformed the way I work.</p>
        <cite>— John Doe, CEO</cite>
    </blockquote>
    <!-- /wp:quote -->
</div>
<!-- /wp:group -->',
        )
    );
}
add_action('init', 'tiger_blog_register_block_patterns');
