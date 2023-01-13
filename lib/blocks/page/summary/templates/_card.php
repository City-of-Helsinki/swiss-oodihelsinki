<?php $isEvent = get_field('event_starts', $post); ?>


<?php 
    $bgImage = get_the_post_thumbnail_url($post->ID) ? get_the_post_thumbnail_url($post->ID, 'medium-large') : \Evermade\Swiss\featuredImageUrl('medium-large');
?>

<a href="<?php echo get_the_permalink($post); ?>" title="<?php echo get_the_title($post); ?>" aria-label="<?php echo get_the_title($post); ?>" data-animate="animated zoomIn" class="c-card c-card--tall <?php if ($isEvent) : ?>c-card--event<?php else: ?>c-card--default<?php endif; ?> trigger-hover">
    <div class="c-card__imagewrapper">
        <div class="c-card__image <?php echo $classSingleItem; ?>" style="background-image:url( <?php echo $bgImage; ?> );"></div>
        
    </div>
    <div class="c-card__content">
        <p><?php echo get_the_date('', $post->ID);?></p>

        <h4 class="c-card__title"><div><?php echo get_the_title($post->ID); ?></div></h4>
        <?php if ($isEvent) : ?>
            <div class="c-card__event-fields">
                <?php if (get_field('event_starts')) : ?><div class="c-card__event-time"><i class="c-icon c-icon__clock"></i><?php echo get_field('event_starts') ?><?php endif; ?>

                    <?php if (get_field('location')) : ?><div class="c-card__event-location"><i class="c-icon c-icon__marker"></i><?php echo get_field('location') ?></div><?php endif; ?>
                </div></div>
        <?php endif; ?>

        <div class="c-card__readmore">
            <div class="c-cta-link">
                <?php _e('Read more', 'swiss'); ?>
            </div>
        </div>

  </div>

</a>
