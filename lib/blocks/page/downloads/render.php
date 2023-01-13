<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['title', 'downloads']);

if(!empty($block->get('downloads'))) include (__DIR__.'/templates/view.php');
