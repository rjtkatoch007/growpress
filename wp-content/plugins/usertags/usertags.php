<?php
/*
Plugin Name: User Tags
Plugin URI: http://wordpress.org/plugins
Description: This plugin add user tags.
Author: rjtdev007
Version: 0.0.1
Author URI: https://growquest.io
License: GPLv2 or later
Text Domain: usertags
*/
// Register Custom Taxonomy
function custom_taxonomy()
{

    $labels = array(
        'name' => _x('User tags', 'User tags Name', 'text_domain'),
        'singular_name' => _x('User tag', 'User tag Name', 'text_domain'),
        'menu_name' => __('User tags', 'text_domain'),
        'all_items' => __('All User tags', 'text_domain'),
        'parent_item' => __('Parent User tag', 'text_domain'),
        'parent_item_colon' => __('Parent User tag:', 'text_domain'),
        'new_item_name' => __('New User tags Name', 'text_domain'),
        'add_new_item' => __('Add User tags', 'text_domain'),
        'edit_item' => __('Edit User tags', 'text_domain'),
        'update_item' => __('Update User tags', 'text_domain'),
        'view_item' => __('View User tags', 'text_domain'),
        'separate_items_with_commas' => __('Separate user tags with commas', 'text_domain'),
        'add_or_remove_items' => __('Add or remove user tags', 'text_domain'),
        'choose_from_most_used' => __('Choose from the most used', 'text_domain'),
        'popular_items' => __('Popular User tags', 'text_domain'),
        'search_items' => __('Search User tags', 'text_domain'),
        'not_found' => __('Not Found', 'text_domain'),
        'no_terms' => __('No User tags', 'text_domain'),
        'items_list' => __('User tags list', 'text_domain'),
        'items_list_navigation' => __('User tags list navigation', 'text_domain'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('user_tags', 'user', $args);

}
add_action('init', 'custom_taxonomy', 0);