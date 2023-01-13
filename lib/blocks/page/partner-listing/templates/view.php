<section class="b-partner-listing">

    <div class="b-partner-listing__container">

        <?php include get_template_directory().'/templates/_section-header.php'; ?>

        <div class="b-partner-listing__links">
        <?php foreach($block->get('columns') as $k => $v): ?>
        <div class="b-partner-listing__item">
            <a target="_blank" title="<?php echo \Evermade\Swiss\getFrom('name', $v); ?>" href="<?php echo \Evermade\Swiss\getFrom('link', $v); ?>" class="c-partner-listing-item" style="background-image: url(<?php echo \Evermade\Swiss\Acf\getImageUrl('medium-large', \Evermade\Swiss\getFrom('image', $v)); ?>)"></a>
</div>
        <?php endforeach; ?>
        </div>

    </div><!-- end of b-listing__container -->

</section><!-- end of b-listing -->
