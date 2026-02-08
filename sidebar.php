<?php
/**
 * The sidebar containing the main widget area
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside class="l-sidebar">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>