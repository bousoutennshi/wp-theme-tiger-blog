<?php
/**
 * The template for displaying comments
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()): ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            printf(
                /* translators: %s: number of comments */
                _n(
                    '%s Comment',
                    '%s Comments',
                    $comments_number,
                    'tiger-blog'
                ),
                number_format_i18n($comments_number)
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

        <?php
        // コメントナビゲーション
        the_comments_navigation(array(
            'prev_text' => __('&laquo; Older Comments', 'tiger-blog'),
            'next_text' => __('Newer Comments &raquo;', 'tiger-blog'),
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments">
            <?php esc_html_e('Comments are closed.', 'tiger-blog'); ?>
        </p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
        'title_reply_after' => '</h2>',
    ));
    ?>

</div>