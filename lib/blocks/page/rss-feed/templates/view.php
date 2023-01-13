<section class="b-rss-feed">
    <div class="b-rss-feed__container">
    <?php include get_template_directory().'/templates/_section-header.php'; ?>
        <?php include_once( ABSPATH . WPINC . '/feed.php' );
        $rss = fetch_feed( $block->get('url') );
        if ( ! is_wp_error( $rss ) ) : 
        $maxitems = $rss->get_item_quantity( 5 ); 
        $rss_items = $rss->get_items( 0, $maxitems );
        endif;
        ?>
 
        <ul class="c-rss-feed">
            <?php if ( $maxitems == 0 ) : ?>
                <li><?php _e( 'Ei tiedotteita.' ); ?></li>
            <?php else : ?>
                <?php ?>
                <?php foreach ( $rss_items as $item ) : ?>
                    <li class="c-rss-feed__item trigger-hover">
                        <div class="c-rss-feed__date-and-title">
                        <a target="_blank" href="<?php echo esc_url( $item->get_permalink() ); ?>">
                        <div class="c-rss-feed__date"><?php echo $item->get_date('j.n.Y'); ?></div>
                        <div class="c-rss-feed__title"><?php echo esc_html( $item->get_title() ); ?></div>
                        </a></div>
                        <div class="c-cta-link c-rss-feed__link">
                        <a target="_blank" href="<?php echo esc_url( $item->get_permalink() ); ?>">Lue lisää</a></div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
</section>
