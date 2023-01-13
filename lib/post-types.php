<?php
namespace Evermade\Swiss\PostTypes;

/*
 * -----------------------------------------------------
 * EXAMPLE POST TYPE
 * -----------------------------------------------------
 */
/*
function serviceSetup()
{
    $labels = array(
        'name'                  => _x('Services', 'post type general name', 'swiss'),
        'singular_name'         => _x('Service', 'post type singular name', 'swiss'),
        'add_new'               => _x('Add New Service', 'the add new post text', 'swiss'),
        'add_new_item'          => _x('Add New Service', 'the add new post text', 'swiss'),
        'edit_item'             => _x('Edit Service', 'the edit post text', 'swiss'),
        'new_item'              => _x('New Service', 'add new post text', 'swiss'),
        'all_items'             => _x('All Services', 'String for the submenu', 'swiss'),
        'view_item'             => _x('View Service', 'view post text', 'swiss'),
        'search_items'          => _x('Search Services', 'search post text', 'swiss'),
        'not_found'             => _x('No Services found', 'not found post text', 'swiss'),
        'not_found_in_trash'    => _x('No Services found in the Trash', 'not found trash post text', 'swiss'),
        'parent_item_colon'     => '',
        'menu_name'             => _x('Services', 'post type general name for menu', 'swiss')
    );

    $args = array(
        'labels'                => $labels,
        'description'           => _x('Services', 'post type description', 'swiss'),
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array( 'title','thumbnail' ),
        'taxonomies'            => array( '' ),
        'has_archive'           => false,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'query_var'             => true,
        'menu_icon'             => 'dashicons-star-filled',
        'rewrite'               => array(
            'slug' => _x('service', 'URL slug', 'swiss')
        )
    );

    register_post_type('service', $args);
}
*/

function noticeSetup()
{
    $labels = array(
        'name'                  => _x('Notices', 'post type general name', 'swiss'),
        'singular_name'         => _x('Notice', 'post type singular name', 'swiss'),
        'add_new'               => _x('Add New Notice', 'the add new post text', 'swiss'),
        'add_new_item'          => _x('Add New Notice', 'the add new post text', 'swiss'),
        'edit_item'             => _x('Edit Notice', 'the edit post text', 'swiss'),
        'new_item'              => _x('New Notice', 'add new post text', 'swiss'),
        'all_items'             => _x('All Notices', 'String for the submenu', 'swiss'),
        'view_item'             => _x('View Notice', 'view post text', 'swiss'),
        'search_items'          => _x('Search Notices', 'search post text', 'swiss'),
        'not_found'             => _x('No Notices found', 'not found post text', 'swiss'),
        'not_found_in_trash'    => _x('No Notices found in the Trash', 'not found trash post text', 'swiss'),
        'parent_item_colon'     => '',
        'menu_name'             => _x('Notices', 'post type general name for menu', 'swiss')
    );

    $args = array(
        'labels'                => $labels,
        'description'           => _x('Notices', 'post type description', 'swiss'),
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array( 'title','thumbnail','editor'),
        'taxonomies'            => array( '' ),
        'has_archive'           => false,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'query_var'             => true,
        'menu_icon'             => 'dashicons-warning',
        'rewrite'               => array(
            'slug' => _x('notice', 'URL slug', 'swiss')
        )
    );

    register_post_type('notice', $args);
}

function featuredActivitySetup()
{
    $labels = array(
        'name'                  => _x('Featured activities', 'post type general name', 'swiss'),
        'singular_name'         => _x('Featured activity', 'post type singular name', 'swiss'),
        'add_new'               => _x('Add New Featured activity', 'the add new post text', 'swiss'),
        'add_new_item'          => _x('Add New Featured activity', 'the add new post text', 'swiss'),
        'edit_item'             => _x('Edit Featured activity', 'the edit post text', 'swiss'),
        'new_item'              => _x('New Featured activity', 'add new post text', 'swiss'),
        'all_items'             => _x('All Featured activities', 'String for the submenu', 'swiss'),
        'view_item'             => _x('View Featured activity', 'view post text', 'swiss'),
        'search_items'          => _x('Search Featured activities', 'search post text', 'swiss'),
        'not_found'             => _x('No Featured activities found', 'not found post text', 'swiss'),
        'not_found_in_trash'    => _x('No Featured activities found in the Trash', 'not found trash post text', 'swiss'),
        'parent_item_colon'     => '',
        'menu_name'             => _x('Featured activities', 'post type general name for menu', 'swiss')
    );

    $args = array(
        'labels'                => $labels,
        'description'           => _x('Featured activities', 'post type description', 'swiss'),
        'public'                => true,
        'menu_position'         => 5,
        'supports'              => array( 'title' ),
        'taxonomies'            => array( 'featured_activity_date', 'featured_activity_type', 'featured_activity_location' ),
        'has_archive'           => false,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'query_var'             => true,
        'menu_icon'             => 'dashicons-tickets-alt',
        'rewrite'               => array(
            'slug' => _x('featured-activity', 'URL slug', 'swiss')
        )
    );

    register_post_type('featured_activity', $args);
}

/*
 * -----------------------------------------------------
 * ENABLE/DISABLE CUSTOM POST TYPES
 * -----------------------------------------------------
 */

function setCustomTypes()
{
    //serviceSetup();
    noticeSetup();
    featuredActivitySetup();
}

add_action('init', 'Evermade\Swiss\PostTypes\setCustomTypes');
