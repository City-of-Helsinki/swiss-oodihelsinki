<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','info_columns']);

if(!$block->get('hide')) {

if(!empty($block->get('info_columns'))) include (__DIR__.'/templates/view.php');

}
