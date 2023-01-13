<?php
// lets keep block data in class for encapsulation and stopping conflicts across blocks
$block = new \Evermade\Swiss\Block(array('hide','section_header', 'posts', 'filter_by_tag', 'see_more', 'see_more_text', 'see_more_url', 'layout'));

if(empty($block->get('posts'))){

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 20
    );

    if(!empty($block->get('filter_by_tag'))) {
        $args['tag'] = $block->get('filter_by_tag');
    }

    // if(!empty($block->get('layout'))) {
    //     $args['posts_per_page'] = 3;
    // }

    $custom_query = new \WP_Query($args);

    $block->set('posts', $custom_query->posts, 'fields');

}

if(!$block->get('hide')) {

include(__DIR__.'/templates/view.php');

}
