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

/**
 * Admin page for the 'user_tags' taxonomy
 */
function add_user_tags_taxonomy_admin_page()
{

    $tax = get_taxonomy('user_tags');

    add_users_page(
        esc_attr($tax->labels->menu_name),
        esc_attr($tax->labels->menu_name),
        $tax->cap->manage_terms,
        'edit-tags.php?taxonomy=' . $tax->name
    );

}
add_action('admin_menu', 'add_user_tags_taxonomy_admin_page');

/**
 * Unsets the 'posts' column and adds a 'users' column on the manage user_tags admin page.
 */
function manage_user_tags_user_column($columns)
{

    unset($columns['posts']);

    $columns['users'] = __('Users');

    return $columns;
}
add_filter('manage_edit-user_tags_columns', 'manage_user_tags_user_column');

/**
 * @param string $display WP just passes an empty string here.
 * @param string $column The name of the custom column.
 * @param int $term_id The ID of the term being displayed in the table.
 */
function manage_user_tags_column($display, $column, $term_id)
{

    if ('users' === $column) {
        $term = get_term($term_id, 'user_tags');
        echo $term->count;
    }
}
add_filter('manage_user_tags_custom_column', 'manage_user_tags_column', 10, 3);

/**
 * @param object $user The user object currently being edited.
 */
function edit_user_user_tags_section($user)
{
    global $pagenow;

    $tax = get_taxonomy('user_tags');

    /* Make sure the user can assign terms of the user tags taxonomy before proceeding. */
    if (!current_user_can($tax->cap->assign_terms))
        return;

    /* Get the terms of the 'user tags' taxonomy. */
    $terms = get_terms('user_tags', array('hide_empty' => false)); ?>

    <h3><?php _e('User tags'); ?></h3>

    <table class="form-table">

        <tr>
            <th><label for="user_tags"><?php _e('Allocated User tags'); ?></label></th>

            <td><?php

            /* If there are any user tags terms, loop through them and display checkboxes. */
            if (!empty($terms)) {

                echo custom_form_field('user_tags', $terms, $user->ID, 'dropdown');
            }

            /* If there are no user tags terms, display a message. */ else {
                _e('There are no user tags available.');
            }

            ?></td>
        </tr>

    </table>
<?php }

add_action('show_user_profile', 'edit_user_user_tags_section');
add_action('edit_user_profile', 'edit_user_user_tags_section');
add_action('user_new_form', 'edit_user_user_tags_section');

/**
 * return field as dropdown or checkbox, by default checkbox if no field type given
 * @param: name = taxonomy, options = terms avaliable, userId = user id to get linked terms
 */

function custom_form_field($name, $options, $userId, $type = 'checkbox')
{
    global $pagenow;
    switch ($type) {
        case 'checkbox':
            foreach ($options as $term):
                ?>
                <label for="user_tags-<?php echo esc_attr($term->slug); ?>">
                    <input type="checkbox" name="user_tags[]" id="user_tags-<?php echo esc_attr($term->slug); ?>"
                        value="<?php echo $term->slug; ?>" <?php if ($pagenow !== 'user-new.php')
                               checked(true, is_object_in_term($userId, 'user_tags', $term->slug)); ?>>
                    <?php echo $term->name; ?>
                </label><br />
                <?php
            endforeach;
            break;
        case 'dropdown':
            $selectTerms = [];
            foreach ($options as $term) {
                $selectTerms[$term->term_id] = $term->name;
            }

            // get all terms linked with the user
            $usrTerms = get_the_terms($userId, 'user_tags');
            $usrTermsArr = [];
            if (!empty($usrTerms)) {
                foreach ($usrTerms as $term) {
                    $usrTermsArr[] = (int) $term->term_id;
                }
            }
            // Dropdown
            echo "<select name='{$name}' id='dpts'>";
            echo "<option value=''>-Select-</option>";
            foreach ($selectTerms as $options_value => $options_label) {
                $selected = (in_array($options_value, array_values($usrTermsArr))) ? " selected='selected'" : "";
                echo "<option value='{$options_value}' {$selected}>{$options_label}</option>";
            }
            echo "</select>";
            break;
    }
}
/**
 * @param int $user_id The ID of the user to save the terms for.
 */
function save_user_user_tags_terms($user_id)
{

    $tax = get_taxonomy('user_tags');

    /* Make sure the current user can edit the user and assign terms before proceeding. */
    if (!current_user_can('edit_user', $user_id) && current_user_can($tax->cap->assign_terms))
        return false;

    $term = $_POST['user_tags'];
    $terms = is_array($term) ? $term : (int) $term; // fix for checkbox and select input field

    /* Sets the terms (we're just using a single term) for the user. */
    wp_set_object_terms($user_id, $terms, 'user_tags', false);

    clean_object_term_cache($user_id, 'user_tags');
}

add_action('personal_options_update', 'save_user_user_tags_terms');
add_action('edit_user_profile_update', 'save_user_user_tags_terms');
add_action('user_register', 'save_user_user_tags_terms');

/**
 * @param string $username The username of the user before registration is complete.
 */
function disable_user_tags_username($username)
{

    if ('user_tags' === $username)
        $username = '';

    return $username;
}
add_filter('sanitize_user', 'disable_user_tags_username');

/**
 * Update parent file name to fix the selected menu issue
 */
function change_parent_file($parent_file)
{
    global $submenu_file;

    if (
        isset($_GET['taxonomy']) &&
        $_GET['taxonomy'] == 'user_tags' &&
        $submenu_file == 'edit-tags.php?taxonomy=user_tags'
    )
        $parent_file = 'users.php';

    return $parent_file;
}
add_filter('parent_file', 'change_parent_file');