<?php

add_action('wp_enqueue_scripts', 'parent_enqueue_styles');
add_action('wp_enqueue_scripts', 'child_enqueue_styles');

function parent_enqueue_styles()
{
    $parent_handle = 'twentytwentytwo-style';
    $theme = wp_get_theme();

    wp_enqueue_style(
        $parent_handle,
        get_template_directory_uri() . '/style.css',
        array(),
        $theme->parent()->get('Version')
    );

    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array($parenthandle),
        $theme->get('Version')
    );
}
function child_enqueue_styles()
{

    wp_enqueue_style(
        'custom-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        false,
        '1.0',
        'all'
    );
}

// widget
function custom_widget_test($folders)
{
    $folders[] = get_stylesheet_directory() . '/widgets/';
    return $folders;
}
add_action('siteorigin_widgets_widget_folders', 'custom_widget_test');
