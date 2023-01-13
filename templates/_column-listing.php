<div class="c-column-listing  c-column-listing--circle">

    <div class="c-column-listing__image">
        <div class="c-column-listing__image__inner" style="background-image: url(<?php echo \Evermade\Swiss\Acf\getImageUrl('medium-large', \Evermade\Swiss\getFrom('image', $v)); ?>)"></div>
    </div>

    <h5 class="c-column-listing__title"><?php echo \Evermade\Swiss\getFrom('title', $v); ?></h5>

    <?php echo \Evermade\Swiss\sprint('<div class="c-column-listing__text"><div class="h-wysiwyg-html">%s</div></div>', \Evermade\Swiss\getFrom('text', $v)); ?>

</div>
