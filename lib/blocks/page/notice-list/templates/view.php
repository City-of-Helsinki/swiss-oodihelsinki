<div class="js-notice b-notice">

    <div class="b-notice__container">

        <?php include get_template_directory().'/templates/_section-header.php'; ?>

        <?php if(!empty($block->get('posts'))): ?>

            <?php global $post; foreach($block->get('posts') as $k => $post): setup_postdata($post); ?>

            <div class="b-notice__item">

                <?php the_title(); ?>
                <?php the_content(); ?>
                <button class="js-close-notice c-btn">Sulje</button>
            
</div>

            <?php endforeach; wp_reset_postdata(); ?>

        <?php endif; ?>

        <?php if($block->get('see_more')): ?>
            <div class="b-listing__see-more">
                <a href="<?php echo $block->get('see_more_url'); ?>" class="c-btn"><?php echo $block->get('see_more_text'); ?></a>
            </div>
        <?php endif; ?>

    </div><!-- end of b-listing__container -->
</div><!-- end of b-listing -->
