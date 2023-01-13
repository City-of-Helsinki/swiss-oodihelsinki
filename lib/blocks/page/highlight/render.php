<?php

// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(array(
    'text',
    'image',
    'see_more',
    'see_more_text',
    'see_more_url',
    'color',
    'icon',
    'hide',
    'read_more_aria_label'
));

if(!$block->get('hide')) {

    include (__DIR__.'/templates/view.php');
    
    }
    
