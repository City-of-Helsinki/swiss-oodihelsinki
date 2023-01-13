<section class="b-faq">

<div class="b-faq__container">
        <?php include get_template_directory().'/templates/_section-header.php'; ?>
</div>
        <?php foreach($block->get('columns') as $k => $v): ?>
        <div class="b-faq__item">
        <div class="b-faq__container">
            <div class="b-faq__question"><h3><?php echo \Evermade\Swiss\getFrom('title', $v); ?></h3></div>
            <div class="b-faq__answer"><?php echo \Evermade\Swiss\getFrom('text', $v); ?></div>
        </div>
</div>
        <?php endforeach; ?>


</section><!-- end of b-faq -->
