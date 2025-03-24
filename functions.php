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
 * Child widget generator
 */
function my_child_theme_widget_init(){
    register_sidebar( array(
        'name' => 'New Custom Widget Area',
        'id' => 'new_custom_widget_area',
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'my_child_theme_widget_init');

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
                return 'This is a template for a developer website, you can change this content
                using functions.php with "the_post" action hook in combination with "the_content" filter.';
            }
            return $content;
        });
    }
}
add_action('the_post', 'modify_homepage_post_action');

/**
 * Modifies the content of posts that are loaded on the other pages (i.e. About, Contact, etc)
 * @return void
 */
function modify_post_on_template_load(){
    global $post;
    if(is_singular()){
        add_filter('the_content', function($content) use ($post) {
           if($post->post_title == 'About'){
               return 'Introduce yourself, write about what you do as a developer and what your goal is as a developer';
           }
           if($post->post_title == 'Contact'){
               return 'Show your contact information here, you may also include information 
               about how others may get in contact with you, maybe add a contact form that links to your email address';
           }
           return $content;
        });
    }
}
add_action('template_redirect', 'modify_post_on_template_load');