<?php

// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(array(
    'layout',
    'text',
    'image',
    'hide'
));


$imageAreaCSS = "";

$imageCSS = "";


// set image
$imageAreaCSS = "background-image: url(".\Evermade\Swiss\Acf\getImageUrl('large', $block->get('image')).");";

if(!$block->get('hide')) {

include(__DIR__.'/templates/view.php');

}
