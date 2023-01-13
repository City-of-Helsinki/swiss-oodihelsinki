<?php
// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(array('hide','section_header', 'posts', 'number_of_posts'));

if(!$block->get('hide')) {

include(__DIR__.'/templates/view.php');

}
