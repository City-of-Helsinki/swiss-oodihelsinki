<?php
namespace Evermade\Swiss\RestApi;

function featuredActivities ( $request )
{
    // Request language, if set, is used to query content by WPML language
    $lang = $request['lang'];

    // Separate categories and posts for easier usage. They will always be used
    // together so we lump everything into one for easier access and fewer HTTP
    // requests. This way we also filter them in a way that ensures we only end
    // up using the categories that are actually used.
    $json = array(
        'posts' => array(),
        'taxonomies' => array()
    );

    // TODO: See if there is anything saner than what WPML support suggests:
    // Save current language before switching.
    global $sitepress;
    $current_lang = $sitepress->get_current_language();
    $sitepress->switch_lang($lang);

    $args = array(
        'post_type' => 'featured_activity',
        'posts_per_page' => -1,
        'suppress_filters' => false
    );

    $query = new \WP_Query($args);

    global $post;

    if (!empty($query->posts)) {

        // Hold our custom taxonomy entries
        $typeArray = array();
        $locationArray = array();
        $dateArray = array();

        foreach ($query->posts as $post) {
            $featuredActivityTypes = wp_get_post_terms( $post->ID, 'featured_activity_type' );
            $post->activity_types = array();

            if (!empty($featuredActivityTypes)) {
                $post->activity_types = $featuredActivityTypes;

                // ..and add to our taxonomy array if not already present
                foreach ($featuredActivityTypes as $tax) {
                    if (!in_array($tax, $typeArray)) {
                        $typeArray[]=$tax;
                    }
                }
            } else {
                continue;
            }


            $featuredActivityLocations = wp_get_post_terms( $post->ID, 'featured_activity_location' );
            if (!empty($featuredActivityLocations)) {
                $post->activity_locations = $featuredActivityLocations;
                // ..and add to our taxonomy array if not already present
                foreach ($featuredActivityLocations as $tax) {
                    if (!in_array($tax, $locationArray)) {
                        $locationArray[]=$tax;
                    }
                }
            } else {
                continue;
            }

            $featuredActivityDates = wp_get_post_terms( $post->ID, 'featured_activity_date' );
            if (!empty($featuredActivityDates)) {
                $post->activity_dates = $featuredActivityDates;
                // ..and add to our taxonomy array if not already present
                foreach ($featuredActivityDates as $tax) {
                    if (!in_array($tax, $dateArray)) {
                        $dateArray[]=$tax;
                    }
                }
            } else {
                continue;
            }

            if(get_field('time',$post->ID)) {
                $featuredActivityTime = get_field('time',$post->ID);
                $post->activity_time = $featuredActivityTime;
            }

            if(get_field('end_time',$post->ID)) {
                $featuredActivityEndTime = get_field('end_time',$post->ID);
                $post->activity_end_time = $featuredActivityEndTime;
            }

            if(get_field('specific_location',$post->ID)) {
                $featuredActivitySpecificLocation = get_field('specific_location',$post->ID);
                $post->specific_location = $featuredActivitySpecificLocation;
            }

            if(get_field('description',$post->ID)) {
                $featuredActivityDescription = get_field('description',$post->ID);
                $post->description = $featuredActivityDescription;
            }

            // Push resulting posts to the posts array
            array_push($json['posts'], $post);
        }

        // Push custom taxonomy as part of
        $json['taxonomies']['dates']=$dateArray;
        $json['taxonomies']['types']=$typeArray;
        $json['taxonomies']['locations']=$locationArray;
    }

    // Restore language
    $sitepress->switch_lang($current_lang);

    return $json;
}

function myAwesomePosts()
{

    $json = array();

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
    );

    $query = new \WP_Query($args);

    global $post;

    if (!empty($query->posts)) {
        foreach ($query->posts as $post) {

            $featured_img_url = get_the_post_thumbnail_url($post->ID, 'medium-large');
            $permalink = get_permalink($post->ID);
            $tags = wp_get_post_tags($post->ID);
            $date = get_the_date('j.n.Y',$post->ID);

            $post->post_date = $date;
            $post->post_image = $featured_img_url;
            $post->post_permalink = $permalink;

            if($featured_img_url) {
                $post->post_image = $featured_img_url;
            }
            else {
                $post->post_image = get_template_directory_uri() . '/assets/img/oodi-default-img.png';
            }

            if($tags){
                $post->post_tags = $tags;
            }
            if(get_field('location',$post->ID)) {
                $event_location = get_field('location',$post->ID);
                $post->event_location = $event_location;
            }
            if(get_field('event_starts',$post->ID)) {
                $event_starts = get_field('event_starts',$post->ID);
                $post->event_starts = $event_starts;
                $post->custom_class = "c-card--event";
            }
            if(get_field('event_ends',$post->ID)) {
                $event_ends = get_field('event_ends',$post->ID);
                $post->event_ends = $event_ends;
            }

            array_push($json, $post);
        }
    }

    return $json;
}


function openingTimesURL() {
    $json = array();

    $openingTimesURL = get_field('opt_opening_times_link', 'option');
    if (isset($openingTimesURL) && !empty($openingTimesURL)) {
        array_push($json, $openingTimesURL);
    }

    return $json;
}

 add_action('rest_api_init', function()
 {
     register_rest_route('swiss/v1', '/posts', array(
        'methods' => 'GET',
        'callback' => '\Evermade\Swiss\RestApi\myAwesomePosts'
     ));
     register_rest_route('swiss/v1', '/opening-times-url', array(
         'methods' => 'GET',
         'callback' => '\Evermade\Swiss\RestApi\openingTimesURL'
     ));
     register_rest_route('swiss/v1', '/featured-activities', array(
         'methods' => 'GET',
         'callback' => '\Evermade\Swiss\RestApi\featuredActivities'
     ));

 });
