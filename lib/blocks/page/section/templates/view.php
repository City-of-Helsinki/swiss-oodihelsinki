</div> <!-- close our last b-section__blocks -->
</div><!-- close our last b-section__content -->
</div><!-- close our last b-section -->

<?php $koroPositionClass = $block->get('koro_position') ? $block->get('koro_position') : 'none' ?>

<div class="b-section s-context s-context--<?php echo $block->get('scheme'); ?> c-koro--<?php echo $block->get('scheme'); ?> c-koro--<?php echo $koroPositionClass; ?> c-koro--reverse" <?php if($block->get('minimum_height')){?> style="min-height:<?php echo $block->get('minimum_height');?>px"<?php } ?>><!-- open our new scheme context -->
<?php include(__DIR__.'/assets.php'); ?>
    <div class="b-section__content" <?php if($block->get('pin_blocks') == "enabled"){?>data-swiss-sticky="parent"<?php } ?>>
        <div class="b-section__blocks">
