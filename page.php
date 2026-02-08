<?php
/**
 * The template for displaying pages
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

        <?php if (have_posts()):
            while (have_posts()):
                the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <h1 class="heading heading-primary">
                        <?php the_title(); ?>
                    </h1>

                    <?php if (has_post_thumbnail()): ?>
                        <div class="eyecatch eyecatch-page">
                            <?php the_post_thumbnail('icatch', array('alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>

                    <div class="content">
                        <?php the_content(); ?>
                    </div>

                    <?php
                    // ページリンク
                    wp_link_pages(array(
                        'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'tiger-blog') . '</span>',
                        'after' => '</div>',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    ));
                    ?>

                </article>

                <?php
                // コメントテンプレート
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>

            <?php endwhile; endif; ?>

    </main>
    <!-- /l-main -->

    <!-- l-sidebar -->
    <?php get_sidebar(); ?>
    <!-- /l-sidebar -->

</div>
<!-- /l-wrapper -->

<?php get_footer(); ?>