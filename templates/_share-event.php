<div class="c-share c-share--vertical">
    <ul class="c-share__list">
        <?php foreach ($services as $key => $value): ?>
            <li>
                <a href="<?php echo $value['url'];?>" title="<?php _e('Share on ', 'swiss'); echo ucfirst($key);?>" class="<?php echo $key; ?>">
                    <i class="<?php echo $value['icon'];?>"></i> <?php echo ucfirst($key); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
