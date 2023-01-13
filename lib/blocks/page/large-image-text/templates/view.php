<section class="b-large-image-text <?php echo \Evermade\Swiss\sprint('b-large-image-text--%s', $block->get('image_alignment'));?> <?php echo \Evermade\Swiss\sprint('b-large-image-text--%s', $block->get('color'));?> ">
    <div class="b-large-image-text__container">

        <div class="b-large-image-text__image-wrapper">

            <div class="b-large-image-text__text">
                <div class="b-large-image-text__text__content">
                    <div class="h-wysiwyg-html">
                        <?php echo $block->get('text'); ?>
                    </div>
                </div>
            </div>

            <div class="b-large-image-text__image" <?php echo \Evermade\Swiss\sprint( 'style="background-image:url(%s)"', $block->getImageUrl('hero-extra-large', 'image'));?>></div>

        </div>

    </div>
</section>
