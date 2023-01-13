<?php

$tags = get_tags();

if ($tags): ?>

    <div class="c-sidebar-widget" data-scheme-target>
        <h3 class="c-sidebar-widget__title js-blog__sidebar-mobile">Tags</h3>
        <div class="c-sidebar-widget__content">
            <?php 
            $html = '<ul class="c-tags-ul">';
            foreach ( $tags as $tag ) {
                $tag_link = get_tag_link( $tag->term_id );
                        
                $html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                $html .= "{$tag->name}</a></li>";
            }
            $html .= '</ul>';
            echo $html;
            ?>
        </div>
    </div>

<?php endif; ?>