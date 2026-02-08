<?php
/**
 * TIGER BLOG Custom Widgets
 *
 * @package TIGER_BLOG
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Popular Posts Widget (Ranking)
 * Displays most viewed posts based on post_views_count meta
 */
class Tiger_Blog_Popular_Posts extends WP_Widget
{
    function __construct()
    {
        $widget_option = array(
            'description' => __('Displays popular posts ranked by view count', 'tiger-blog')
        );
        parent::__construct(false, $name = __('[TIGER BLOG] Popular Posts', 'tiger-blog'), $widget_option);
    }

    // Settings form
    function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:', 'tiger-blog'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>" type="text"
                value="<?php echo esc_attr(@$instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
                <?php _e('Number of posts:', 'tiger-blog'); ?>
            </label>
            <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>"
                type="number" value="<?php echo esc_attr(@$instance['number'] ? $instance['number'] : 5); ?>" size="3" />
        </p>
        <p>
            <input id="<?php echo $this->get_field_id('time'); ?>" name="<?php echo $this->get_field_name('time'); ?>"
                type="checkbox" <?php checked(@$instance['time'], 'on'); ?> />
            <label for="<?php echo $this->get_field_id('time'); ?>">
                <?php _e('Show post date', 'tiger-blog'); ?>
            </label>
        </p>
        <?php
    }

    // Save settings
    function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;
        $instance['time'] = (!empty($new_instance['time'])) ? $new_instance['time'] : '';
        return $instance;
    }

    // Display widget
    function widget($args, $instance)
    {
        extract($args);
        echo $before_widget;

        $title = NULL;
        if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', $instance['title']);
        }

        if ($title) {
            echo $before_title . $title . $after_title;
        } else {
            echo '<h2 class="heading heading-widget">RANKING</h2>';
        }

        $number = !empty($instance['number']) ? $instance['number'] : 5;

        get_the_ID();
        $query_args = array(
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'ignore_sticky_posts' => '1',
            'posts_per_page' => $number
        );
        $my_query = new WP_Query($query_args);
        ?>
        <ol class="rankListWidget">
            <?php while ($my_query->have_posts()):
                $my_query->the_post(); ?>
                <li
                    class="rankListWidget__item<?php if (get_option('tiger_blog_post_eyecatch') == 'value2'): ?> rankListWidget__item-noeye<?php endif; ?>">
                    <?php if (get_option('tiger_blog_post_eyecatch') != 'value2'): ?>
                        <div class="eyecatch eyecatch-widget u-txtShdw">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail('icatch');
                                } else {
                                    echo '<img src="' . get_template_directory_uri() . '/img/img_no.gif" alt="NO IMAGE"/>';
                                } ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <h3 class="rankListWidget__title"><a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a></h3>
                    <div
                        class="dateList dateList-widget<?php if (get_option('tiger_blog_post_eyecatch') == 'value2'): ?> dateList-noeye<?php endif; ?>">
                        <?php if (!empty($instance['time'])): ?><span class="dateList__item icon-calendar">
                                <?php the_time('Y.m.d'); ?>
                            </span>
                        <?php endif; ?>
                        <span class="dateList__item icon-folder">
                            <?php the_category(' '); ?>
                        </span>
                    </div>
                </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ol>
        <?php
        echo $after_widget;
    }
}

/**
 * Advertisement Widget
 * Displays ad code or any custom HTML
 */
class Tiger_Blog_Ad_Widget extends WP_Widget
{
    function __construct()
    {
        $widget_option = array(
            'description' => __('Display advertisement or custom HTML', 'tiger-blog')
        );
        parent::__construct(false, $name = __('[TIGER BLOG] Advertisement', 'tiger-blog'), $widget_option);
    }

    // Display widget
    function widget($args, $instance)
    {
        extract($args);

        echo $before_widget;
        echo '<div class="adWidget">';

        // Get body content
        $body = $instance['body'];
        if ($body != '') {
            echo $body;
        }

        echo '<h2>Advertisement</h2></div>';
        echo $after_widget;
    }

    // Save settings
    function update($new_instance, $old_instance)
    {
        return $new_instance;
    }

    // Settings form
    function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('body'); ?>">
                <?php _e('Ad Code:', 'tiger-blog'); ?>
            </label>
            <textarea class="widefat" rows="8" id="<?php echo $this->get_field_id('body'); ?>"
                name="<?php echo $this->get_field_name('body'); ?>"><?php echo @$instance['body']; ?></textarea>
        </p>
        <?php
    }
}

/**
 * Register custom widgets
 */
function tiger_blog_register_widgets()
{
    register_widget('Tiger_Blog_Popular_Posts');
    register_widget('Tiger_Blog_Ad_Widget');
}
add_action('widgets_init', 'tiger_blog_register_widgets');
