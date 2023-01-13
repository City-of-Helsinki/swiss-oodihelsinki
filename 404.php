<?php

get_header(); ?>

</div>



<section class="b-base">

    <div class="b-container">
        <div class="h-wysiwyg-html text-center">

            <?php the_field('error_page_content', 'option'); ?>

        </div>
    </div>

</section>



<?php get_footer();
