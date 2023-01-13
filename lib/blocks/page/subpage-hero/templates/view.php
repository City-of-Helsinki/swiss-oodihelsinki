<section class="b-subpage-hero">
    
    <div class="b-subpage-hero__container">
        <div class="b-subpage-hero__text">
            <div class="b-subpage-hero__text--inner">
                <div class="b-subpage-hero__text--inner-text">

                    <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb('<div class="c-breadcrumb">','</div>');
                        }
                    ?>

                    <div class="h-wysiwyg-html">
                        <?php echo $block->get('text'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if($block->get('image')): ?>
    <div class="b-subpage-hero__image" style="background-image:url(<?php echo $block->getImageUrl('hero-extra-large', 'image'); ?>)"></div>
<?php endif;?>
</section>
