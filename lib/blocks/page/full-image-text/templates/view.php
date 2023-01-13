<section class="b-full-image-text <?php echo \Evermade\Swiss\sprint('b-full-image-text--%s', $block->get('color'));?>">
    <div class="b-full-image-text__image" <?php echo \Evermade\Swiss\sprint( 'style="background-image:url(%s)"', $block->getImageUrl('hero-extra-large', 'image'));?>></div>
    <div class="b-full-image-text__container">
        <div class="b-full-image-text__text b-full-image-text__text--<?php echo $textAlignClass; ?>">
            <div class="b-full-image-text__text__content">
                <?php echo $block->get('text'); ?>
            </div>
        </div>
    </div>    
</section>
