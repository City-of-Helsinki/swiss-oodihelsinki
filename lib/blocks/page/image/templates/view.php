<!-- section starts in block/index.php -->

<?php
    $koroClass = $block->get('koro_color') ? $block->get('koro_color') : '';
?>

<div class="b-image__image-wrapper b-image__image-wrapper--<?php echo $koroClass; ?> <?php echo $imageWrapperClass; ?>" style="<?php echo $imageWrapperCSS; ?>">
    <div class="b-image__image" style="<?php echo $imageCSS; ?>"></div>
</div>

<!-- section ends in block/index.php -->
