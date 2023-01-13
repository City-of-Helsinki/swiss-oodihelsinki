<section class="b-respa">
    <?php // Always make sure that you properly sanitize this when rendering
    echo \Evermade\Swiss\sprint('<script>var respaBlockContent = "%s";</script>', preg_replace( "/\r|\n/", "", $block->get('section_header'))); ?>
    <div id="respa"></div>
</section>
