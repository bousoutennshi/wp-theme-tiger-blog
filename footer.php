<?php
/**
 * The template for displaying the footer
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */
?>

<!-- l-footer -->
<footer class="l-footer">
    <div class="container">

        <!-- pagetop -->
        <div class="pagetop">
            <a href="#" aria-label="<?php esc_attr_e('Back to top', 'tiger-blog'); ?>">
                <?php esc_html_e('PAGE TOP', 'tiger-blog'); ?>
            </a>
        </div>
        <!-- /pagetop -->

        <!-- copyright -->
        <div class="copyright">
            <p>
                <?php
                printf(
                    /* translators: %s: Copyright year and site name */
                    esc_html__('© Copyright %1$s %2$s.', 'tiger-blog'),
                    esc_html(date_i18n('Y')),
                    '<a class="copyright__link" href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>'
                );
                ?>
            </p>
            <p class="copyright__info">
                <?php
                printf(
                    /* translators: 1: Theme name, 2: WordPress */
                    esc_html__('Powered by %1$s and %2$s', 'tiger-blog'),
                    '<a href="https://github.com/yourusername/tiger-blog" target="_blank" rel="noopener">TIGER BLOG</a>',
                    '<a href="https://wordpress.org/" target="_blank" rel="noopener">WordPress</a>'
                );
                ?>
            </p>
        </div>
        <!-- /copyright -->

    </div>
</footer>
<!-- /l-footer -->

<?php wp_footer(); ?>
</body>

</html>