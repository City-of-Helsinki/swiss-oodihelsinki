<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','text', 'image', 'image_alignment', 'color']);

if(!$block->get('hide')) {

if(!empty($block->get('text'))) include (__DIR__.'/templates/view.php');

}
