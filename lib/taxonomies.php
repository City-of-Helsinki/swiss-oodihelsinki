<?php
namespace Evermade\Swiss\Taxonomies;

function setupFeaturedActivityDate ()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x('Featured activity dates', 'taxonomy general name', 'swiss'),
        'singular_name'     => _x('Featured activity date', 'taxonomy singular name', 'swiss'),
        'search_items'      => __('Search Featured activity dates', 'swiss'),
        'all_items'         => __('All Featured activity dates', 'swiss'),
        'parent_item'       => __('Parent Featured activity date', 'swiss'),
        'parent_item_colon' => __('Parent Featured activity date:', 'swiss'),
        'edit_item'         => __('Edit Featured activity date', 'swiss'),
        'update_item'       => __('Update Featured activity date', 'swiss'),
        'add_new_item'      => __('Add New Featured activity date', 'swiss'),
        'new_item_name'     => __('New Featured activity date', 'swiss'),
        'menu_name'         => __('Featured activity dates', 'swiss'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'featured-activity-date' ),
    );

    register_taxonomy('featured_activity_date', array( 'featured_activity' ), $args);
}

function setupFeaturedActivityLocation ()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x('Featured activity locations', 'taxonomy general name', 'swiss'),
        'singular_name'     => _x('Featured activity location', 'taxonomy singular name', 'swiss'),
        'search_items'      => __('Search Featured activity locations', 'swiss'),
        'all_items'         => __('All Featured activity locations', 'swiss'),
        'parent_item'       => __('Parent Featured activity location', 'swiss'),
        'parent_item_colon' => __('Parent Featured activity location:', 'swiss'),
        'edit_item'         => __('Edit Featured activity location', 'swiss'),
        'uplocation_item'       => __('Uplocation Featured activity location', 'swiss'),
        'add_new_item'      => __('Add New Featured activity location', 'swiss'),
        'new_item_name'     => __('New Featured activity location', 'swiss'),
        'menu_name'         => __('Featured activity locations', 'swiss'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'featured-activity-location' ),
    );

    register_taxonomy('featured_activity_location', array( 'featured_activity' ), $args);
}

function setupFeaturedActivityType ()
{
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x('Featured activity types', 'taxonomy general name', 'swiss'),
        'singular_name'     => _x('Featured activity type', 'taxonomy singular name', 'swiss'),
        'search_items'      => __('Search Featured activity types', 'swiss'),
        'all_items'         => __('All Featured activity types', 'swiss'),
        'parent_item'       => __('Parent Featured activity type', 'swiss'),
        'parent_item_colon' => __('Parent Featured activity type:', 'swiss'),
        'edit_item'         => __('Edit Featured activity type', 'swiss'),
        'uptype_item'       => __('Uptype Featured activity type', 'swiss'),
        'add_new_item'      => __('Add New Featured activity type', 'swiss'),
        'new_item_name'     => __('New Featured activity type', 'swiss'),
        'menu_name'         => __('Featured activity types', 'swiss'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'featured-activity-type' ),
    );

    register_taxonomy('featured_activity_type', array( 'featured_activity' ), $args);
}


/*
 * -----------------------------------------------------
 * ENABLE/DISABLE CUSTOM TAXONOMIES
 * -----------------------------------------------------
 */

function setCustomTaxonomies()
{
    setupFeaturedActivityDate();
    setupFeaturedActivityLocation();
    setupFeaturedActivityType();
}

add_action('init', __NAMESPACE__.'\setCustomTaxonomies');
