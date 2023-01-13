<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','text', 'image', 'video_id', 'wide_video']);

if(!$block->get('hide')) {

include (__DIR__.'/templates/view.php');

}
