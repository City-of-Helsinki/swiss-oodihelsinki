<section class="b-downloads">
    <div class="b-downloads__container">
        <div class="l-columns l-columns--h-center" data-column-count="1">
            <div class="l-columns__item">
                <?php echo \Evermade\Swiss\sprint('<h2 class="b-downloads__title">%s</h2>', $block->get('title'));?>
                <?php foreach($block->get('downloads') as $k => $p): ?>
                    <div class="c-download">
                        <h3 class="c-download__title"><?php echo $p['title'];?></h3>
                        <a class="c-download__link" href="<?php $p['download']['url'];?>" title="<?php _e('Download', 'swiss');?> <?php echo $p['title']; ?>">
                            <?php _e('Download file', 'swiss'); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
