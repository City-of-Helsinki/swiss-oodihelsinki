<section class="b-highlight <?php echo \Evermade\Swiss\sprint(' b-highlight--%s', $block->get('color'));?>">

    <div class="b-highlight__container">
        <div class="b-highlight__main">
            <div class="b-highlight__image">
                <?php if ($block->getImage('thumbnail', 'image')): ?>
                    <?php echo $block->getImage('thumbnail', 'image'); ?>
                <?php else : ?>
                    <?php $iconFile = file_get_contents(get_template_directory().'/assets/img/oodi-icons/'.$block->get('icon').'.svg'); ?>
                    <?php echo \Evermade\Swiss\sprint('<div class="b-highlight__icon">%s</div>', $iconFile); ?>
                <?php endif; ?>
            </div>
            <div class="b-highlight__text">
                <div class="h-wysiwyg-html" data-scheme-target><?php echo $block->get('text'); ?></div>
            </div>
        </div>
        <?php if($block->get('see_more')):?>
            <div class="b-highlight__readmore">
                <a class="c-btn" href="<?php echo $block->get('see_more_url'); ?>" aria-label="<?php echo $block->get('read_more_aria_label'); ?>"><?php echo $block->get('see_more_text'); ?></a>
            </div>
        <?php endif;?>
    </div><!-- end of wrapper -->

</section>
