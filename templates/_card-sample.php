<a class="c-card c-card--shadow" data-animate="animated zoomIn" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

    <div><div class="c-card__image c-card__image--skewed" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>);"></div></div>

    <div class="c-card__content">

        <div class="c-card__icon"></div>

        <p class="c-card__meta"><?php the_date(); ?></p>

        <h3 class="c-card__title"><div><?php the_title(); ?></div></h3>

        <div class="c-card__read-more"><?php _e('Read more', 'swiss'); ?></div>

    </div>

</a>
