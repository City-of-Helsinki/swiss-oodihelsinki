<section class="b-summary">
    <div class="b-summary__container">

        <div class="l-column-split">

            <div class="l-column-split__item l-column-split__item--narrow">
                <?php if(is_array($block->get('opening_times'))):?>
                    <div class="c-timetable">
                        <?php foreach($block->get('opening_times') as $openingTime): ?>
                            <div class="c-timetable__row">
                                <div class="c-timetable__day">
                                    <?php echo \Evermade\Swiss\getFrom('day', $openingTime); ?>
                                </div>
                                <div class="c-timetable__times">
                                    <?php echo \Evermade\Swiss\getFrom('times', $openingTime); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="h-wysiwyg-html">
                    <?php echo \Evermade\Swiss\sprint('<p>%s</p>', $block->get('exceptions')); ?>
                    <?php echo \Evermade\Swiss\sprint('<a href="%s" class="c-btn c-btn--arrow">%s</a>', array($block->get('link_to_all'), $block->get('link_to_all_text'))); ?>
                    <?php echo \Evermade\Swiss\sprint('<h3>%s</h3>', $block->get('intro_title')); ?>
                    <?php echo \Evermade\Swiss\sprint('<p>%s</p>', $block->get('intro_text')); ?>
                    <?php $intro_link_aria = ($block->get('intro_link_aria')) ? $block->get('intro_link_aria') : ' '; ?>
                    <?php echo \Evermade\Swiss\sprint('<a href="%s" class="c-btn c-btn--arrow" aria-label="%s">%s</a>', array($block->get('intro_link'), $intro_link_aria, $block->get('intro_link_text'))); ?>
                </div>
            </div>

            <?php
                // Establish counts of both types of content.
                // If eventCount == 1, then we should only display the first post (as we are displaying the manual event as the other).
                // If eventCount > 1, then we should not display any posts because manual events take precedent
                $postCount = (!empty($block->get('posts_to_display'))) ? count($block->get('posts_to_display')) : 0;
                $eventCount = (!empty($block->get('manual_event_entries'))) ? count($block->get('manual_event_entries')) : 0;
                $firstPost = "";
                if($postCount){
                    $firstPost = current($block->get('posts_to_display'));
                }
                $postsToDisplay = ($eventCount == 0) ? $block->get('posts_to_display') : array($firstPost);
                $classSingleItem = ($eventCount + $postCount <= 1) ? 'c-card__image--single' : "";
            ?>

            <?php if ($eventCount <= 1): ?>
            <?php foreach($postsToDisplay as $post): ?>
                <div class="l-column-split__item">
                    
                    <?php setup_postdata($post); ?>
                    <?php include(get_template_directory().'/lib/blocks/page/summary/templates/_card.php');?>
                </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
            <?php endif; ?>

            <?php if($eventCount > 0): ?>
                <?php foreach($block->get('manual_event_entries') as $event): ?>
                    <div class="l-column-split__item">
                        <?php include(get_template_directory().'/lib/blocks/page/summary/templates/_card-manual.php');?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>
