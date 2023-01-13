<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','section_header', 'items']);

if(!$block->get('hide')) {

if(!empty($block->get('items'))) include (__DIR__.'/templates/view.php');

}
