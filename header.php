<?php
/**
 * The template for displaying the header
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>


    <!-- l-header -->
    <header class="l-header">

        <!-- l-hMain -->
        <div class="l-hMain">
            <div class="container">

                <div class="siteTitle">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id):
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        if ($logo):
                            $src = $logo[0];
                            $width = $logo[1];
                            $height = $logo[2];
                            ?>
                            <?php if (is_home()): ?>
                                <h1<?php else: ?><p<?php endif; ?> class="siteTitle__logo">
                                <a class="siteTitle__link" href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo esc_url($src); ?>" alt="<?php bloginfo('name'); ?>"
                                        width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>">
                                </a>
                                <?php if (is_home()): ?></h1><?php else: ?></p><?php endif; ?>
                                <?php
                        endif;
                    else:
                        ?>
                            <?php if (is_home()): ?>
                                <h1<?php else: ?><p<?php endif; ?> class="siteTitle__big">
                                <a class="siteTitle__link" href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php bloginfo('name'); ?>
                                </a>
                                <?php if (is_home()): ?></h1><?php else: ?></p><?php endif; ?>

                                <?php if (get_bloginfo('description')): ?>
                                    <?php if (is_home()): ?>
                                        <h2<?php else: ?><p<?php endif; ?> class="siteTitle__small">
                                        <?php bloginfo('description'); ?>
                                        <?php if (is_home()): ?></h2><?php else: ?></p><?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                </div>

            </div>
        </div>
        <!-- /l-hMain -->

        <?php if (get_header_image()): ?>
            <!-- Header Image -->
            <div class="header-image">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>"
                        height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
        <?php endif; ?>

        <!-- l-hMain (Nav) -->
        <div class="l-hMain">
            <div class="container">

                <nav class="globalNavi">
                    <input class="globalNavi__toggle" id="globalNavi__toggle" type="checkbox" value="none">
                    <label class="globalNavi__switch" for="globalNavi__toggle"></label>
                    <?php
                    if (has_nav_menu('header_menu')):
                        wp_nav_menu(array(
                            'theme_location' => 'header_menu',
                            'items_wrap' => '<ul class="globalNavi__list" aria-expanded="false">%3$s</ul>',
                            'container' => false,
                        ));
                    else:
                        ?>
                        <ul class="globalNavi__list" aria-expanded="false">
                            <?php wp_list_pages('title_li='); ?>
                        </ul>
                    <?php endif; ?>
                </nav>

            </div>
        </div>
        <!-- /l-hMain -->

    </header>
    <!--/l-header-->