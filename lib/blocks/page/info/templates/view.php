<section class="b-info">
    <div class="b-info__container">
        <div class="l-cards l-cards--info">
        <?php foreach ($block->get('info_columns') as $k => $c): ?>
            <div class="l-cards__item">
                <div class="c-info-item <?php echo \Evermade\Swiss\sprint('c-info-item--%s', $c['color']); ?>">
                    <?php $iconFile = file_get_contents(get_template_directory().'/assets/img/oodi-icons/'.$c["icon"].'.svg'); ?>
                    <?php echo \Evermade\Swiss\sprint('<div class="c-info-item__icon">%s</div>', $iconFile); ?>
                    <?php echo \Evermade\Swiss\sprint('<h2 class="c-info-item__number">%s</h2>', $c['number']); ?>
                    <?php echo \Evermade\Swiss\sprint('<p class="c-info-item__text">%s</p>', $c['text']); ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>
