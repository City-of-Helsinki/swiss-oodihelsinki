<?php
    // TODO: Create a function that returns these instead of having logic in templates
    $noticePosts = get_field('opt_notices', 'option');
    if($noticePosts):
?>

    <div class="js-notice js-sticky b-notice is-hidden" role="dialog" aria-labelledby="notice-title" aria-describedby="notice-content">
        <div class="b-notice__container">
            <?php // TODO: Figure out good way to allow aria-describedby without IDs :thinking:
            // Perhaps we could loop these differently altogether while we do UI work, and then generate an unique ID for each
            // notice rather than having the wrapper be separate?

            global $post; foreach($noticePosts as $k => $post): setup_postdata($post); ?>
                <div class="b-notice__item">
                    <h3 id="notice-title"><?php the_title(); ?></h3>
                    <div class="b-notice__item__content" id="notice-content">
                        <?php the_content(); ?>
                    </div>

                    <button data-notice-id="notice<?php echo get_the_ID();?>" type="button" class="js-close-notice c-btn" aria-label="<?php _e('Dismiss notification', 'swiss');?>"><?php _e('Close', 'swiss');?></button>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>

        </div><!-- end of b-listing__container -->
    </div><!-- end of b-listing -->

<?php endif;?>
