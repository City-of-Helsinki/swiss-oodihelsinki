<section class="b-navbar js-navbar js-sticky" role="navigation">
    <div class="b-navbar__container">
        <a tabindex="-1" class="b-navbar__logo js-navbar-logo" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"></a>

        <div class="b-navbar__navigation">
            <?php
            /**
             * Add primary navigation using our custom primary navigation walker
             */
            wp_nav_menu(array(
                'theme_location' => 'header-navigation',
                'walker'  => new \Evermade\Swiss\Subnav_Walker_Nav_Menu(),
                'container' => 'nav',
                'container_class' => 'c-primary-navigation',
                'menu_class' => 'c-primary-navigation__items',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
            ));
            ?>
        </div>

        <div class="b-navbar__extras">
            <button class="c-search-toggle js-site-search-toggle" aria-expanded="false" aria-label="<?php _e('Toggle the website search feature', 'swiss');?>">
                <?php _ex('Search', 'The act of searching', 'swiss');?> <i class="fa fa-search"></i>
            </button>
        </div>

        <div aria-label="Open mobile menu" role="button" aria-pressed="false" class="c-mobile-toggle" tabindex="0">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="b-navbar__mobile-wrapper js-navbar-mobile-wrapper">
        <div class="b-navbar__mobile-wrapper__container">

            <div class="b-navbar__mobile-wrapper__content">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-navigation',
                    'walker'  => new \Evermade\Swiss\Subnav_Walker_Nav_Menu(),
                    'container' => 'nav',
                    'container_class' => 'c-primary-navigation',
                    'menu_class' => 'c-primary-navigation__items',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                ));
                ?>
            </div>

            <div class="b-navbar__mobile-wrapper__footer">
                <?php echo \Evermade\Swiss\wpmlLanguageSwitcher(); ?>
                <?php echo \Evermade\Swiss\template('_social-media.php', $app->get('opt_social_media')); ?>
                <img src="
                <?php
                global $sitepress;
                $logo = $sitepress->get_current_language() == 'sv' ? 'helsingfors_logo.svg' : 'helsinki-logo2.svg';
                echo get_template_directory_uri() . '/assets/img/' . $logo;
                ?>"
                alt="<?php bloginfo('name'); ?>">
            </div>

        </div>
    </div>

    <div class="c-site-search js-site-search">
        <div class="c-site-search__container">
            <?php echo get_search_form(); ?>
            <button aria-label="<?php _e('Close the search', 'swiss');?>" class="c-site-search__close js-site-search-close"><?php _e('Close the search', 'swiss');?></button>
        </div>
    </div>
</section>

<?php include(get_template_directory().'/templates/_notices.php'); ?>
