<?php $isEvent = get_field('event_starts', $post); ?>

<a data-animate="animated zoomIn" href="<?php echo get_the_permalink($post->ID); ?>" aria-label="<?php echo get_the_title($post); ?>" title="<?php echo get_the_title($post->ID); ?>" class="c-card <?php if ($isEvent) : ?>c-card--event<?php else: ?>c-card--default<?php endif; ?> trigger-hover">
    <div class="c-card__imagewrapper">
        <div class="c-card__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('hero-extra-large'); ?>);">
            <div class="c-card__meta">
            <?php
                if ($isEvent) {
                    echo 'Tapahtuma';
                } else {
                    echo get_the_date('', $post->ID);
                } ?>
            </div>
        </div>
    </div>
    <div class="c-card__content">
        <h4 class="c-card__title">
            <div><?php echo get_the_title($post->ID); ?></div>
        </h4>
        <?php if ($isEvent) : ?>
            <div class="c-card__event-fields">
                <?php if (get_field('event_starts')) : ?><div class="c-card__event-time"><i class="c-icon c-icon__clock"></i><?php echo get_field('event_starts') ?><?php endif; ?>

                    <?php if (get_field('location')) : ?><div class="c-card__event-location"><i class="c-icon c-icon__marker"></i><?php echo get_field('location') ?></div><?php endif; ?>
                </div></div>
        <?php endif; ?>

        <div class="c-card__readmore"><div class="c-cta-link"><?php _e('Read more', 'swiss'); ?></div></div>

  </div>

</a>
