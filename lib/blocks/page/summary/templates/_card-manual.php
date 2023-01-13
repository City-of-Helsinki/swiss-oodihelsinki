<div data-animate="animated zoomIn" class="c-card c-card--tall c-card--default trigger-hover">
    <a class="c-card__imagewrapper" href="<?php echo $event['link']; ?>" title="<?php echo $event['title']; ?>">
        <div class="c-card__image" style="background-image:url(<?php echo $event['image']['sizes']['medium-large']; ?>);">
            <div class="c-card__meta c-card__meta--event">
                <?php echo $event['date']; ?>
            </div>
        </div>
    </a>

    <div class="c-card__content">
        <h4 class="c-card__title"><a href="<?php echo $event['link']; ?>" title="<?php echo $event['title']; ?>"><?php echo $event['title']; ?></a></h4>
        <div class="c-card__event-fields">
            <div class="c-card__event-time"><i class="c-icon c-icon__clock"></i><?php echo $event['start_time']; ?> &ndash; <?php echo $event['end_time']; ?></div>
            <div class="c-card__event-location"><i class="c-icon c-icon__marker"></i><?php echo $event['location']; ?></div>
        </div>
    </div>

    <div class="c-card__readmore">
        <a href="<?php echo $event['link']; ?>" title="<?php echo $event['title']; ?>" aria-label="<?php echo $event['title']; ?>" class="c-cta-link">
            <?php _e('Read more', 'swiss'); ?>
        </a>
    </div>

</div>
