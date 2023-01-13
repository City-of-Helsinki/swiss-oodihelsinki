<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(['hide','url','section_header']);


if(!$block->get('hide')) {

include (__DIR__.'/templates/view.php');

}
