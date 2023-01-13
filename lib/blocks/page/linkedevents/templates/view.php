<section class="b-linkedevents">
    <div class="b-linkedevents__container">
        <?php // Always make sure that you properly sanitize this when rendering
        echo \Evermade\Swiss\sprint('<script>var linkedeventsBlockContent = "%s";</script>', preg_replace( "/\r|\n/", "", $block->get('section_header'))); ?>
        <div data-highlighted="<?php 
            if( have_rows('highlighted_events') ):

                while( have_rows('highlighted_events') ) : the_row();
                    
                    echo get_sub_field('event_id') . ',';

                endwhile;

            endif;
        ?>" id="linkedevents"></div>
    </div>
</section>
