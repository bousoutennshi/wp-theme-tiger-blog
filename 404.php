<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

get_header();
?>

<!-- l-wrapper -->
<div class="l-wrapper">

    <!-- l-main -->
    <main class="l-main">

        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="heading heading-primary">
                    <?php esc_html_e('404 - Page Not Found', 'tiger-blog'); ?>
                </h1>
            </header>

            <div class="page-content">
                <p>
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'tiger-blog'); ?>
                </p>

                <div class="error-404-search">
                    <h2>
                        <?php esc_html_e('Try searching for what you need:', 'tiger-blog'); ?>
                    </h2>
                    <?php get_search_form(); ?>
                </div>

                <div class="error-404-links">
                    <h2>
                        <?php esc_html_e('Or go to:', 'tiger-blog'); ?>
                    </h2>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php esc_html_e('Home Page', 'tiger-blog'); ?>
                            </a></li>
                        <?php
                        // 最新の投稿を数件表示
                        $recent_posts = wp_get_recent_posts(array(
                            'numberposts' => 5,
                            'post_status' => 'publish'
                        ));
                        foreach ($recent_posts as $post): ?>
                            <li>
                                <a href="<?php echo get_permalink($post['ID']); ?>">
                                    <?php echo esc_html($post['post_title']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

    </main>
    <!-- /l-main -->

    <!-- l-sidebar -->
    <?php get_sidebar(); ?>
    <!-- /l-sidebar -->

</div>
<!-- /l-wrapper -->

<?php get_footer(); ?>