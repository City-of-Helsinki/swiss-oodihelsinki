<?php
    $wideClass = $block->get('wide_video') ? 'c-background-video--ratio-wide' : 'c-background-video--ratio-normal';
    $koroClass =  $block->get('koro_color') ? $block->get('koro_color') : 'solid';
    $koroPositionClass = $block->get('koro_position') ? $block->get('koro_position') : 'none';
?>

<section class="b-full-video c-koro c-koro--<?php echo $koroClass; ?> c-koro--<?php echo $koroPositionClass; ?>">
    <div class="c-background-video <?php echo $wideClass; ?>">
        <?php echo \Evermade\Swiss\sprint('<iframe src="https://player.vimeo.com/video/%s?background=0&autoplay=1&loop=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>',  $block->get('video_id')); ?>   
    </div>
</section>
