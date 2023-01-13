<?php global $wp_query; ?>
<section class="b-subpage-hero b-subpage-hero--blog-index">
    <div class="b-subpage-hero__container">
        <div class="b-subpage-hero__text">
            <div class="b-subpage-hero__text--inner">
                <div class="b-subpage-hero__text--inner-text">
                    <div class="c-blog-intro">
                        <div class="h-wysiwyg-html">
                            <?php the_field('blog_intro', 'option'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="b-blog b-blog--index s-context">
    <div class="b-blog__container">
        <div class="l-blog js-ajax-loadmore-content">

        </div>
    </div>
</section>
