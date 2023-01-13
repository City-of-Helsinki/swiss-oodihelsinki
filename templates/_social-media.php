<?php if (empty($data)) {
    return false;
} ?>

<div class="c-social-media">
    <ul class="c-social-media__list">
        <?php foreach ($data as $key => $value): ?>
            <li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['service']; ?>"><i class="fab fa-<?php echo $value['service']; ?>" aria-hidden="true"></i></a></li>
        <?php endforeach; ?>
    </ul>
</div>
