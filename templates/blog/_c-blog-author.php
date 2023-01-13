<?php if (is_single()) {
    ?>

    <div class="c-blog-author">
        <div class="c-blog-author__avatar">
            <?php $image=get_field('blog_author_avatar'); echo wp_get_attachment_image( $image, 'thumbnail' ); ?>
        </div>
        <div class="c-blog-author__text" data-scheme-target>
            <?php echo get_field('blog_author_name'); ?><br>
            <?php echo get_field('blog_author_title'); ?>
        </div>

        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'), get_the_author_meta('user_nicename')); ?>" class="c-blog-author__link"></a>
    </div>

<?php
} ?>
