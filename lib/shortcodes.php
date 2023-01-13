<?php
namespace Evermade\Swiss\Shortcodes;

function button($atts)
{
    extract(shortcode_atts(array(
        'class' => '',
        'text' => 'Submit',
        'url' => '#',
        'aria_label' => ''
    ), $atts));

    return sprintf('<p><a href="%s" class="c-btn %s" aria-label="%s">%s</a></p>', $url, $class, $aria_label, $text);
}

function liveImage($atts)
{
    extract(shortcode_atts(array(
        'url' => 'http://83.145.211.25/record/current.jpg'
    ), $atts));

    return sprintf('<img class="c-live-image js-live-image" src="%s" alt="" />', $url);
}

add_shortcode('button', 'Evermade\Swiss\Shortcodes\button');
add_shortcode('live-image', 'Evermade\Swiss\Shortcodes\liveImage');
