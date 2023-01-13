<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','video_id', 'wide_video', 'koro_color', 'koro_position']);

if(!$block->get('hide')) {

include (__DIR__.'/templates/view.php');

}
