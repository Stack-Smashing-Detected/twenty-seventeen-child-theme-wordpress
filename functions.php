<?php

//*********Instead of @import Use enqueue ad recommended by WordPress Codex **********
/**
 * Enqueues Styles and Scripts
 * @return void
 */
function my_child_theme_enqueue_styles()
{
    $parent_style = 'twentyseventeen-style'; // This is 'twentyseventeen-style' for the Twenty Seventeen theme.
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array($parent_style),
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'my_child_theme_enqueue_styles');

/**
 * Modify the post on the homepage which should be the 'home' post.
 *
 * @param $post
 * @return void
 */
function modify_homepage_post_action($post): void
{
    // get the post on the home page and modify it.
    if(is_page('home')) {
        add_filter('the_title', function($title) use ($post) {
            if(in_the_loop() && is_main_query() && $post->post_title == 'Home'){
                return 'Welcome!';
            }
            return $title;
        });
        add_filter('the_content', function($content) use ($post) {
            if(in_the_loop() && is_main_query() && $post->post_title == 'Home'){
                return 'This is my developer site, feel free to check out my content or contact me via email or social media.';
            }

            if($post->post_title == 'About'){
                return 'You can write a description about yourself and what you do as a software developer';
            }
            return $content;
        });
    }
}
add_action('the_post', 'modify_homepage_post_action');

