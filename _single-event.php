<?php
/*
  Template Name: Single event
*/

use Spatie\CalendarLinks\Link;

// Get store details from LinkedEvents
$linkedEvents = new \Evermade\LinkedEvents\LinkedEvents();
$event = $linkedEvents->getStore(get_query_var('store_id'));


if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
    switch (ICL_LANGUAGE_CODE) {
    case 'fi':
        $name = $event->name->fi;
        $desc = $event->description->fi;
        $short_desc = $event->short_description->fi;
        $info_url = $event->info_url != null ? $event->info_url->fi : '';
        $location_name = $event->location->name->fi;
        $location_address = $event->location->street_address->fi;
        $location_extra = $event->location_extra_info != null ? $event->location_extra_info->fi : '';
        break;
    case 'en':
        $name = $event->name->en;
        $desc = $event->description->en;
        $short_desc = $event->short_description->en;
        $info_url = $event->info_url != null ? $event->info_url->en : '';
        $location_name = $event->location->name->en;
        $location_address = $event->location->street_address->en;
        $location_extra = $event->location_extra_info != null ? $event->location_extra_info->en : '';
        break;
    case 'sv':
        $name = $event->name->sv;
        $desc = $event->description->sv;
        $short_desc = $event->short_description->sv;
        $info_url = $event->info_url != null ? $event->info_url->sv : '';
        $location_name = $event->location->name->sv;
        $location_address = $event->location->street_address->sv;
        $location_extra = $event->location_extra_info != null ? $event->location_extra_info->sv : '';
        break;
    default:
        $name = $event->name->fi;
        $desc = $event->description->fi;
        $short_desc = $event->short_description->fi;
        $info_url = $event->info_url != null ? $event->info_url->fi : '';
        $location_name = $event->location->name->fi;
        $location_address = $event->location->street_address->fi;
        $location_extra = $event->location_extra_info != null ? $event->location_extra_info->fi : '';
        break;
    }
}

// Set default timezone to Finnish timezone
date_default_timezone_set('Europe/Helsinki');
$tz = new DateTimeZone( 'Europe/Helsinki' );

$event_datetime = new DateTime($event->start_time);
$event_datetime = $event_datetime->setTimezone($tz);

// Use CalendarLinks package to generate calendar links (duh)
$calendar_title = $name;
$calendar_description = $short_desc;
// TODO: Make an extra request for each event to get the address
$calendar_address = $location_address;
$calendar_from = DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $event->start_time);
$calendar_to = DateTime::createFromFormat('Y-m-d\TH:i:s\Z', $event->end_time);

// If we can't actually format the dates...? TODO: Investigate why not?
// Are the source strings in different formats?
if ($calendar_from !== false && $calendar_to !== false) {
    $calendar_link = Link::create($calendar_title, $calendar_from, $calendar_to)
                   ->description($calendar_description)
                   ->address($calendar_address);

    // Generate a link to create an event on Google calendar
    $calendar_google = $calendar_link->google();

    // Generate a link to create an event on Yahoo calendar
    // echo $link->yahoo();

    // Generate a data uri for an ics file (for iCal & Outlook)
    $calendar_ics = $calendar_link->ics();
}


// Set globals to be used in our Yoast hooks
if ($event) {
    $GLOBALS['api_item_title'] = $name;
    $GLOBALS['api_item_description'] = $desc;
    $GLOBALS['api_item_image'] = $event->images[0]->url;
    if (isset($event->permalink)) $GLOBALS['api_item_url'] = $event->permalink;
}

get_header();

if ($event) {
    include(get_template_directory().'/templates/api/event.php');
} else {
    include(get_template_directory().'/404.php');
}

get_footer();
