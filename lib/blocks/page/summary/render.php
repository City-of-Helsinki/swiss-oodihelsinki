<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','opening_times', 'exceptions', 'link_to_all', 'link_to_all_text', 'intro_title', 'intro_text', 'intro_link', 'intro_link_text', 'intro_link_aria', 'posts_to_display', 'manual_event_entries']);

if(!$block->get('hide')) {

if(!empty($block->get('opening_times'))) include (__DIR__.'/templates/view.php');

}
