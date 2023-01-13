<section class="b-juicer" aria-hidden="true">
    <div class="b-juicer__container">

        <?php include get_template_directory().'/templates/_section-header.php'; ?>

        <ul class="juicer-feed" data-feed-id="<?php echo $block->get('feed'); ?>" data-per="<?php echo $block->get('how_many_posts'); ?>" data-gutter="25"></ul>
    </div>
</section>
