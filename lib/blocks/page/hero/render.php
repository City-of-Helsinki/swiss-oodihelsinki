<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['background_image', 'text', 'video_title','video_link_text','video_link_url','video_thumbnail','opening_hours','linked_page', 'countdown']);

if(!empty($block->get('text'))) include (__DIR__.'/templates/view.php');
