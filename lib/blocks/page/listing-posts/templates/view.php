<?php /* So this file is a real mess, sorry. Didn't have time to fix this properly. */ ?>

<section class="b-listing">

    <div class="b-listing__container">

        <?php include get_template_directory().'/templates/_section-header.php'; ?>

        <?php if(!empty($block->get('posts'))): ?>
        <?php if($block->get('see_more')): ?>
            <div class="b-listing__see-more">
                <a href="<?php echo $block->get('see_more_url'); ?>" class="c-btn c-btn--arrow"><?php echo $block->get('see_more_text'); ?></a>
            </div>
        <?php endif; ?>
            <div class="c-post-slider js-post-slider">
                <?php global $post; foreach($block->get('posts') as $k => $post): setup_postdata($post); ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>" class="c-post-slider__slide js-post-slider-slide">
                        <div data-animate="animated zoomIn" class="c-card <?php if(isset($isEvent) && $isEvent) : ?>c-card--event<?php else: ?>c-card--default<?php endif; ?> trigger-hover">
                            <div class="c-card__imagewrapper">
                                <div class="c-card__image" style="background-image:url(
                                    <?php
                                    if($block->get('layout')) {
                                        echo \Evermade\Swiss\featuredImageUrl('large');
                                    }
                                    else {
                                        echo \Evermade\Swiss\featuredImageUrl('medium-large');
                                    }
                                    ?>);">
                                </div>
                            </div>

                            <div class="c-card__content">
                                <p><?php echo get_the_date(); ?></p>
                                <?php $post_tags = get_the_tags();
                                if($post_tags) {
                                    foreach( $post_tags as $tag) {
                                        echo '<span class="c-card__tag">' . $tag->name . '</span>';
                                    } // end foreach
                                } // end if ?>
                                <h4 class="c-card__title">
                                    <div><?php the_title(); ?></div>
                                </h4>

                                <div class="c-card__readmore">
                                    <div class="c-btn c-btn--arrow">
                                        <?php _e('Read more', 'swiss'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>

        <?php endif; ?>


    </div><!-- end of b-listing__container -->
</section><!-- end of b-listing -->
