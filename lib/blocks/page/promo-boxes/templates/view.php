<section class="b-promo-boxes">
    <div class="b-promo-boxes__container">

        <div class="b-promo-boxes__intro">
            <div class="h-wysiwyg-html">
                <?php echo \Evermade\Swiss\sprint('%s', $block->get('section_header')); ?>
            </div>
        </div>


        <div class="b-promo-boxes__items">
            <div class="l-cards">
                <?php foreach ( $block->get('items') as $k => $item ) : ?>
                    <?php $image = $item['image']; ?>
                    <?php $params = '?space_purpose=' . $item['purpose']; ?>

                    <div class="l-cards__item">
                        <a href="<?php echo $item['page_link'] . $params; ?>" class="c-promo-box">
                            <div class="c-promo-box__image" style="<?php echo \Evermade\Swiss\sprint('background-image:url(%s);', $image['sizes']['medium-large']);?>"></div>
                            <div class="c-promo-box__title-area c-promo-box__title-area--<?php echo $item['color']; ?>">
                                <?php echo \Evermade\Swiss\sprint('<h4 class="c-promo-box__secondary-title">%s</h4>', $item['secondary_title']);?>
                                <?php echo \Evermade\Swiss\sprint('<h3 class="c-promo-box__title">%s</h3>', $item['title']);?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>
