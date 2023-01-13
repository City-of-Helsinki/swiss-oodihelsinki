<?php
namespace Evermade\Swiss\Assets;

function publicScriptsAndStyles()
{

    // de-register jquery, since we are manually adding it
    wp_deregister_script('jquery');

    // let's get a specific version of jquery
    wp_enqueue_script('jquery', '//code.jquery.com/jquery-3.5.1.min.js', array(), null, false);

    // scripts
    wp_enqueue_script('modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js');

    wp_enqueue_script('swiss-js', get_template_directory_uri().'/assets/dist/js/bundle.'.filemtime(get_stylesheet_directory() . '/assets/dist/js/bundle.js').'.js', array(), null, true);

    // fonts
    // wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:400,400italic,300,100italic,100,300italic,500,500italic,700,700italic,900,900italic');
    wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css');

    // styles
    wp_enqueue_style('swiss-css', get_template_directory_uri().'/assets/dist/css/bundle.'.filemtime(get_stylesheet_directory() . '/assets/dist/css/bundle.css').'.css');

    // localization of swiss-js, accessible under global swissLocalization js object
    $translation_array = array(
        'show_more' => __('Show more', 'swiss'),
        'filter' => __('Filter', 'swiss'),
        'remove_filters' => __('Remove filters', 'swiss'),
        'read_more' => __('Read more', 'swiss'),
        'choose' => __('Choose', 'swiss'),
        'event' => __('Event', 'swiss'),
        'event_status' => __('Event Cancelled', 'swiss'),
        'today' => __('Today', 'swiss'),
        'tomorrow' => __('Tomorrow', 'swiss'),
        'choose_the_dates' => __('Choose the dates', 'swiss'),
        'no_events_found' => __('No events found for chosen time frame', 'swiss'),
        'space_size' => __('Space size', 'swiss'),
        'space_type' => __('Space type', 'swiss'),
        'space_capacity_at_least' => __('Space capacity at least', 'swiss'),
        'what_kind_of_space' => __('What kind of space?', 'swiss'),
        'extra_info_and_reserve' => __('Extra info and reservation', 'swiss'),
        'day' => __('Day', 'swiss'),
        'type' => __('Type', 'swiss'),
        'floor' => __('Floor', 'swiss'),
        'time' => __('Time', 'swiss'),
        'programme' => __('Programme', 'swiss'),
        'information' => __('Information', 'swiss'),
        'location' => __('Location', 'swiss'),
        'no_activities_found' => __('No activities found with given search terms', 'swiss'),
        'open_today' => __('Open today', 'swiss'),
        'all_opening_times' => __('All opening times', 'swiss'),
        'calendar_date_aria_explanation' => __('Calendarview for filtering event results by date'),
        'startdate_dd_mm_yyyy' => __('Start date dd.mm.yyyy'),
        'enddate_dd_mm_yyyy' => __('End date dd.mm.yyyy'),
        'startdate_label_dd_mm_yyyy' => __('Eventfilter startdate in the format dd.mm.yyyy'),
        'enddate_label_dd_mm_yyyy' => __('Eventfilter enddate in the format dd.mm.yyyy'),
    );
    wp_localize_script('swiss-js', 'swissLocalization', $translation_array);
}

add_action('wp_enqueue_scripts', 'Evermade\Swiss\Assets\publicScriptsAndStyles');

function admin_scripts_and_styles()
{
    wp_enqueue_script('swiss-acf', get_template_directory_uri().'/assets/admin/js/acf.'.filemtime(get_stylesheet_directory() . '/assets/admin/js/acf.js').'.js', array(), null, true);
}

add_action('admin_enqueue_scripts', 'Evermade\Swiss\Assets\admin_scripts_and_styles');
