<div class="c-media-object">
    <div class="c-media-object__item">
        <img src="<?php echo \Evermade\Swiss\featuredImageUrl('medium'); ?>" alt="">
    </div>
    <div class="c-media-object__body">
        <?php $obj = get_post_type_object( get_post_type() ); ?>
        <p class="c-tag"><?php echo $obj->labels->singular_name; ?></p>

        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><h2 class="h3"><?php the_title(); ?></h2></a>

        <?php if(!empty(get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true))): ?>
            <p><?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?></p>
        <?php else: ?>
            <p><?php echo  wp_strip_all_tags(\Evermade\Swiss\excerptWordBoundary(get_the_content(), 170));?></p>
        <?php endif;?>
    </div>
</div>
