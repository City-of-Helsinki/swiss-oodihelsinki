<?php

// create a new block object to work with
$block = new \Evermade\Swiss\Block(array(
    'scheme',
    'assets',
    'full_height',
    'vertical_alignment',
    'pin_blocks',
    'overflow_visibility',
    'minimum_height',
    'koro_position',
    'hide'
));

if(!$block->get('hide')) {

include (__DIR__.'/templates/view.php');

}

$assetsHtml = "";

if (!empty($block->get('assets'))):

    foreach($block->get('assets') as $k => $v) {
        $assetsHtml .= \Evermade\Swiss\template('_asset.php', $v);
    }

endif;
