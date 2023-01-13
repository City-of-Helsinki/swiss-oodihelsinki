<?php get_header(); ?>
<div class="s-context">
    <div>
        <div>

            <section class="b-base b-base--no-space-top">
                <div class="b-base__container">

                    <div class="l-columns l-columns--h-center" data-column-count="1">
                        <div class="l-columns__item">
                            <?php if (have_posts()) : ?>
                                <div class="c-search-results">

                                    <div class="c-search-results__meta">
                                        <h1 class="c-search-results__title"><?php _e('Search results', 'swiss');?> (<?php global $wp_query; echo $wp_query->found_posts;?>)</h1>
                                		<p class="c-search-results__term"><?php _e('Results for search:', 'swiss');?> "<?php echo $s ?>"</p>
                                    </div>

                            		<?php while (have_posts()) : the_post(); ?>
                                        <?php include(get_template_directory().'/templates/_search-result.php'); ?>
                            		<?php endwhile; ?>

                                    <nav class="c-search-results__nav">
                                        <span class="c-search-results__nav__item"><?php echo get_next_posts_link(__('Next results &raquo;', 'swiss'));?></span>
                                		<span class="c-search-results__nav__item"><?php echo get_previous_posts_link(__('&laquo; Previous results ', 'swiss'));?></span>
                                    </nav>

                                </div>
                        	<?php else : ?>
                                <div class="c-search-results">
                                    <div class="c-search-results__meta">
                            		    <h1 class="c-search-results__title">
                                            <?php _e('No results found.', 'swiss');?>
                                        </h1>
                                        <p class="c-search-results__term"><?php _e('Please try a different search term', 'swiss');?></p>
                                    </div>
                                </div>
                        	<?php endif; ?>
                        </div>
                    </div>

                </div>
            </section>

        </div>
    </div>
</div>
<?php get_footer(); ?>
