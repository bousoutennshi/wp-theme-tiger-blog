<?php
/**
 * The main template file
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

        <?php if (have_posts()): ?>

            <?php while (have_posts()):
                the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('archiveList'); ?>>

                    <?php if (has_post_thumbnail()): ?>
                        <div class="eyecatch">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('icatch'); ?>
                            </a>
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)):
                                ?>
                                <div class="eyecatch__cat">
                                    <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                                        <?php echo esc_html($categories[0]->name); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="archiveList__text">
                        <h2 class="heading heading-primary">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <ul class="dateList">
                            <li class="dateList__item icon-calendar">
                                <?php echo get_the_date('Y.m.d'); ?>
                            </li>
                            <li class="dateList__item icon-folder">
                                <?php the_category(' '); ?>
                            </li>
                        </ul>

                        <p>
                            <?php echo esc_html(wp_trim_words(get_the_excerpt(), 50)); ?>
                        </p>
                    </div>

                </article>

            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>

        <?php else: ?>

            <p>
                <?php esc_html_e('No posts found.', 'tiger-blog'); ?>
            </p>

        <?php endif; ?>

    </main>
    <!-- /l-main -->

    <!-- l-sidebar -->
    <?php get_sidebar(); ?>
    <!-- /l-sidebar -->

</div>
<!-- /l-wrapper -->

<?php get_footer(); ?>