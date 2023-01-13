<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','text', 'link_url', 'link_text']);

if(!$block->get('hide')) {

if(!empty($block->get('text'))) include (__DIR__.'/templates/view.php');

}
