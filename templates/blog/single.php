<?php get_header(); ?>

<div>

    <?php if (have_posts()) : global $post; while (have_posts()) : the_post(); $my_post = new \Evermade\Swiss\Post($post); ?>

    <?php $isEvent = get_field('event_starts'); ?>

    <section class="b-subpage-hero <?php if ($isEvent) :?>b-subpage-hero--event<?php endif;?>">
        <div class="b-subpage-hero__container">
            <div class="b-subpage-hero__text">
                <div class="b-subpage-hero__text--inner b-subpage-hero__text--inner-blog">
                    <div class="b-subpage-hero__blog-main">
                        <div class="h-wysiwyg-html">
                            <a class="b-subpage-hero__back" href="<?php echo get_post_type_archive_link('post');?>"><i class="fas fa-arrow-left"></i><?php _e('Back to article listing', 'swiss'); ?></a>

                            <h1><?php the_title(); ?></h1>
                            <?php if (!$isEvent) :?>
                                <div class="b-subpage-hero__extra">

                                          <div class="c-event-meta">
                                              <?php echo \Evermade\Swiss\sprint('<p class="c-event-header__datetime">%s</p>', get_the_date()); ?>
                                              <?php echo \Evermade\Swiss\sprint('<p class="c-event-header__location">%s</p>', get_field('blog_author_name')); ?>
                                          </div>

                                </div>
                            <?php endif;?>
                        </div>
                    </div>

                    <div class="b-subpage-hero__blog-meta">
                        <?php if ($isEvent) :?>
                            <div class="b-blog__event-fields">
                                <div class="b-blog__event-time"><i class="c-icon c-icon__clock"></i><?php echo get_field('event_starts');?> -
                                <?php echo get_field('event_ends');?></div>
                                <div class="b-blog__event-time"><i class="c-icon c-icon__marker"></i><?php echo get_field('location');?></div>
                            </div>
                        <?php endif;?>

                        <div class="b-blog__single-meta">
                            <?php $post_tags = wp_get_post_tags($post->ID);
                                if ($post_tags) : ?>
                                <div class="c-blog-taxonomy__item">
                                    <ul class="c-tags-ul">
                                        <?php echo get_the_term_list($post->ID, 'post_tag', '', ', '); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="b-subpage-hero__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('hero-extra-large'); ?>)"></div>
    </section>
</div>


<section class="b-blog b-blog--single">
    <div class="b-blog__container">
        <div class="l-blog l-blog--single">

            <div class="l-blog__content">
                <div class="h-wysiwyg-html">
                    <article class="c-article" data-scheme-target>
                        <?php the_content(); ?>
                    </article>
                </div>
            </div>

            <div class="l-blog__sidebar">
                <div class="l-blog__sidebar__sticky">
                    <div class="c-event-sidebar h-wysiwyg-html">
                        <div class="c-event-sidebar__section">
                            <?php echo \Evermade\Swiss\sprint('<h3>%s</h3>', __('Share the article', 'swiss')); ?>
                            <?php echo Evermade\Swiss\sharePage(get_template_directory().'/templates/_share-blog.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <?php endwhile; else: ?>

    <p><?php _e('Sorry, no posts matched your criteria.', 'swiss'); ?></p>

    <?php endif; ?>


    <section class="b-blog__bottom <?php if ($isEvent) : ?>b-blog__bottom--event<?php endif;?>">
        <?php

        // amount of items pulled. Also sets the layout with data-column-count
        $amountOfPosts = 4;

        // Pulls posts according to the logic from lib/functions/blog.php
        $moreposts = \Evermade\Swiss\Blog\getPostsReadMore($amountOfPosts, $post->ID);

        ?>

        <div class="b-blog__moreposts">

            <h2 class="b-blog__moreposts-title">
                <?php _e('Read next', 'swiss'); ?>
                <a class="b-blog__moreposts-link c-btn c-btn--arrow" href="<?php echo get_post_type_archive_link('post'); ?>"><?php _e('See all articles', 'swiss'); ?></a>
            </h2>


            <div class="l-cards l-cards--blog-single">

            <?php foreach ($moreposts as $post) {
            $my_post = new \Evermade\Swiss\Post($post); ?>

                <?php $isEvent = get_field('event_starts'); ?>

                        <div class="l-cards__item">
                            <div data-animate="animated zoomIn" class="c-card <?php if ($isEvent) : ?>c-card--event<?php else: ?>c-card--default<?php endif; ?> trigger-hover">
                            <a class="c-card__imagewrapper" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div class="c-card__image" style="background-image:url(<?php echo \Evermade\Swiss\featuredImageUrl('hero-extra-large'); ?>);">
                            </div></a>
                            <div class="c-card__content">
                                <p><?php echo get_the_date();?></p>
                            <h4 class="c-card__title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                                <?php if ($isEvent) : ?>
                                <div class="c-card__event-fields">
                                <?php if (get_field('event_starts')) : ?><div class="c-card__event-time"><i class="c-icon c-icon__clock"></i><?php echo get_field('event_starts') ?><?php endif; ?>

                                <?php if (get_field('location')) : ?><div class="c-card__event-location"><i class="c-icon c-icon__marker"></i><?php echo get_field('location') ?></div><?php endif; ?>
                                </div></div>
                                <?php endif; ?>

                                <div class="c-card__readmore"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" aria-label="<?php the_title(); ?>" class="c-btn c-btn--arrow"><?php _e('Read more', 'swiss'); ?></a></div>

                            </div>

                        </div>

                        </div>

                    <?php
        } ?>

                </div>
        </div>
    </section>

<?php get_footer();
