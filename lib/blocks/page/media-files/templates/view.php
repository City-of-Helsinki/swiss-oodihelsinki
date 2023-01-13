<section class="b-media-files">
    <div class="b-media-files__container">
        <div class="l-columns l-columns--h-center" data-column-count="1">
            <div class="l-columns__item">
                <?php echo \Evermade\Swiss\sprint('<h2 class="b-media-files__title">%s</h2>', $block->get('title'));?>
                <?php foreach($block->get('columns') as $k => $v): ?>
                    <?php $file = \Evermade\Swiss\getFrom('file', $v); ?>
                    <div class="c-download">
                        <h3 class="c-download__title"><?php echo \Evermade\Swiss\getFrom('title', $v); ?></h3>
                        <a class="c-download__link" href="<?php echo $file['url'];?>" title="<?php _e('Download', 'swiss');?> <?php echo \Evermade\Swiss\getFrom('title', $v); ?>">
                            <?php _e('Download file', 'swiss'); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
