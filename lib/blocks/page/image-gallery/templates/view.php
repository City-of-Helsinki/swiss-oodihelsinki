<section class="b-image-gallery">

    <div class="b-image-gallery__container">
        <div class="b-image-gallery__intro">
            <div class="h-wysiwyg-html"><?php echo $block->get('section_header');?></div>
        </div>

        <div class="b-image-gallery__gallery">
            <div class="l-image-gallery">
                <?php foreach($block->get('columns') as $k => $v): ?>

                    <div class="l-image-gallery__item">
                        <div class="c-image-gallery-item">
                            <a class="c-image-gallery-item__image" <?php echo \Evermade\Swiss\sprint('data-extra-content="%s"', \Evermade\Swiss\getFrom('title', $v)); ?> href="<?php echo \Evermade\Swiss\Acf\getImageUrl('hero-large', \Evermade\Swiss\getFrom('image', $v)); ?>" style="background-image:url(<?php echo \Evermade\Swiss\Acf\getImageUrl('medium-large', \Evermade\Swiss\getFrom('image', $v)); ?>);" data-swiss-modal-namespace="image-gallery" data-swiss-modal="image"><span><?php _e('Enlarge image', 'swiss'); ?></span></a>
                            <?php echo \Evermade\Swiss\sprint('<p class="c-image-gallery-item__title">%s</p>', \Evermade\Swiss\getFrom('title', $v)); ?>
                            <a class="c-image-gallery-item__download" aria-hidden="true" target="_blank" href="<?php echo $v['image']['url']; ?>"><?php _e('Download the image', 'swiss'); ?></a>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
