<section class="b-listing">

    <div class="b-listing__container">

        <?php include get_template_directory().'/templates/_section-header.php'; ?>

        <?php if(!empty($block->get('posts'))): ?>

            <div class="l-cards l-cards--pages">

            <?php global $post; foreach($block->get('posts') as $k => $post): setup_postdata($post); ?>

                <div class="l-cards__item">
                <div class="c-card c-card--page" data-animate="animated zoomIn">

                <a class="c-card__imagewrapper" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <div class="c-card__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('medium-large'); ?>);">
                    </div></a>

                <div class="c-card__content" data-scheme-target>

                    <h3 class="c-card__title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <div class="c-card__description">
                        <p><?php echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); ?></p>
                    </div>

                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>" class="c-btn"><?php _e('Read more', 'swiss'); ?></a>

                </div>

</div>
                </div>

            <?php endforeach; wp_reset_postdata(); ?>

            </div>

        <?php endif; ?>

    </div><!-- end of b-listing__container -->
</section><!-- end of b-listing -->
