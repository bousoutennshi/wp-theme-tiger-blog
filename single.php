<?php
/**
 * The template for displaying single posts
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

                    <!-- heading-dateList -->
                    <h1 class="heading heading-primary">
                        <?php the_title(); ?>
                    </h1>

                    <ul class="dateList dateList-single">
                        <li class="dateList__item icon-calendar">
                            <?php echo get_the_date('Y.m.d'); ?>
                        </li>
                        <li class="dateList__item icon-folder">
                            <?php the_category(' '); ?>
                        </li>
                        <?php if (has_tag()): ?>
                            <li class="dateList__item icon-tag">
                                <?php the_tags(''); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <!-- /heading-dateList -->

                    <?php if (has_post_thumbnail()): ?>
                        <!-- アイキャッチ -->
                        <div class="eyecatch eyecatch-single">
                            <?php the_post_thumbnail('icatch', array('alt' => get_the_title())); ?>
                        </div>
                        <!-- /アイキャッチ -->
                    <?php endif; ?>

                    <?php if (is_active_sidebar('post-top')): ?>
                        <!-- 記事上エリア[widget] -->
                        <aside class="widgetPost widgetPost-top">
                            <?php dynamic_sidebar('post-top'); ?>
                        </aside>
                        <!-- /記事上エリア[widget] -->
                    <?php endif; ?>

                    <!-- post-content -->
                    <div class="content">
                        <?php the_content(); ?>
                    </div>
                    <!-- /post-content -->

                    <?php
                    // ページリンク
                    wp_link_pages(array(
                        'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'tiger-blog') . '</span>',
                        'after' => '</div>',
                        'link_before' => '<span>',
                        'link_after' => '</span>',
                    ));
                    ?>

                    <?php if (is_active_sidebar('post-bottom')): ?>
                        <!-- 記事下エリア[widget] -->
                        <aside class="widgetPost widgetPost-bottom">
                            <?php dynamic_sidebar('post-bottom'); ?>
                        </aside>
                        <!-- /記事下エリア[widget] -->
                    <?php endif; ?>

                    <!-- post-meta -->
                    <div class="post-meta">
                        <?php
                        // タグ表示
                        if (has_tag()) {
                            the_tags('<div class="post-tags"><span class="icon-tag"></span>', '', '</div>');
                        }
                        ?>
                    </div>
                    <!-- /post-meta -->

                </article>

                <?php
                // 前後の記事ナビゲーション
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                if ($prev_post || $next_post):
                    ?>
                    <nav class="post-pagination">
                        <?php if ($prev_post): ?>
                            <div class="post-pagination__prev">
                                <a href="<?php echo get_permalink($prev_post->ID); ?>" rel="prev">
                                    <span class="post-pagination__label">&laquo;
                                        <?php esc_html_e('Previous Post', 'tiger-blog'); ?>
                                    </span>
                                    <span class="post-pagination__title">
                                        <?php echo esc_html(get_the_title($prev_post->ID)); ?>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($next_post): ?>
                            <div class="post-pagination__next">
                                <a href="<?php echo get_permalink($next_post->ID); ?>" rel="next">
                                    <span class="post-pagination__label">
                                        <?php esc_html_e('Next Post', 'tiger-blog'); ?> &raquo;
                                    </span>
                                    <span class="post-pagination__title">
                                        <?php echo esc_html(get_the_title($next_post->ID)); ?>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>

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