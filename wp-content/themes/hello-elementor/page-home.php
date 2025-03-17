<?php
/*
Template Name: Home Page
*/
get_header();
$authors = get_users(array(
    'role__not_in' => array('Subscriber', 'Administrator'),
    //if you do not want to list the admins and subscribers
    'orderby' => array(
        'post_count' => 'DESC',
        //order users by post count (how many posts they have)
    )
));

foreach ($authors as &$author) {
    //loop through the users
    $user_info = get_userdata($author->ID);
    $user_link = get_author_posts_url($author->ID);

    ?>
    <a href="<?php echo $user_link; ?>" style="display:block;">
        <?php echo $user_info->first_name . ' ' . $user_info->last_name; ?>
    </a>
    <?php
}
/* function nopio_show_authors_in_categories()
{
    $categories = get_terms(array(
        'taxonomy' => USER_CATEGORY_NAME,
        'hide_empty' => true
    ));

    echo '<ul>';
    foreach ($categories as $category) {
        echo '<li>';
        echo $category->name;
        echo " (#{$category->count})";
        $args = array(
            'role' => array('Author', 'subscriber'),
            'meta_key' => USER_CATEGORY_META_KEY,
            'meta_value' => '"' . $category->term_id . '"',
            'meta_compare' => 'LIKE'
        );

        $authors = new WP_User_Query($args);

        echo '<ul>';
        foreach ($authors->results as $author) {
            echo '<li>';
            echo $author->display_name;
            echo '</li>';
        }
        echo '</ul>';

        echo '</li>';
    }
    echo '</ul>';
} */
get_footer();