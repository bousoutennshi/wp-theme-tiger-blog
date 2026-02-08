<?php
/**
 * The template for displaying search forms
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */
?>

<form role="search" method="get" class="searchBox__form" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" class="searchBox__input"
        placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'tiger-blog'); ?>"
        value="<?php echo get_search_query(); ?>" name="s" />
    <button type="submit" class="searchBox__submit">
        <span class="icon-search"></span>
        <span class="screen-reader-text">
            <?php echo esc_html_x('Search', 'submit button', 'tiger-blog'); ?>
        </span>
    </button>
</form>