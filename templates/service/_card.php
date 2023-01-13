<div class="c-card c-card--shadow" data-animate="animated zoomIn">

    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="c-card__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>);"></div></a>

    <div class="c-card__content">

        <h3 class="c-card__title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>

        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="c-card__read-more"><?php _e('Read more', 'swiss'); ?></a>

    </div>

</div>
