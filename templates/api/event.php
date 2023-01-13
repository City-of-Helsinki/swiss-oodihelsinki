<?php // \Evermade\Swiss\debug($event); ?>

<section class="b-subpage-hero <?php if ($isEvent) :?>b-subpage-hero--event<?php endif;?>">
    <div class="b-subpage-hero__container">
        <div class="b-subpage-hero__text">
            <div class="b-subpage-hero__text--inner b-subpage-hero__text--inner-blog">

                <div class="b-subpage-hero__blog-main">
                    <div class="c-event-header">
                        <?php echo \Evermade\Swiss\sprint('<h1 class="c-event-header__title">%s</h1>', $name); ?>
                        <div class="c-event-meta">
                            <?php echo \Evermade\Swiss\sprint('<p class="c-event-header__peruttu"><b> %s</b></p> ', $event_status); ?>
                            <?php echo \Evermade\Swiss\sprint('<p class="c-event-header__datetime"><i class="c-icon c-icon__clock"></i> %s</p>', $event_datetime->format('j.n.Y H:i')); ?>
                            <div class="c-event-header__location-info">
                            <?php echo \Evermade\Swiss\sprint('<p class="c-event-header__location"><i class="c-icon c-icon__marker"></i> %s</p>', $location_name); ?>
                            <?php echo \Evermade\Swiss\sprint('<span class="c-event-header__location_extra">%s</span>', $location_extra); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php $imageUrl = (isset($event->images[0]) && !empty($event->images[0])) ? $event->images[0]->url : 'https://placehold.it/800/500'; ?>
    <div class="b-subpage-hero__image" style="background-image:url(<?php echo $imageUrl;?>)"></div>
</section>


<section class="b-event">
    <div class="b-event__container">
        <div class="l-event">

            <div class="l-event__content">
                <div class="h-wysiwyg-html">
                    <article class="c-article" data-scheme-target>
                        <?php if ($desc) : ?>
                            <div class="c-store-content__description h-wysiwyg-html">
                                <?php echo wpautop($desc); ?>

                                <?php if (isset($event->images[0]->photographer_name) && !empty($event->images[0]->photographer_name)) : ?>
                                    <?php \Evermade\Swiss\sprint('<p>%s: %s</p>', array(__('Photographer', 'swiss'), $event->images[0]->photographer_name)); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
            </div>

            <?php $iconEarthFile = file_get_contents(get_template_directory().'/assets/img/oodi-icons/maapallo.svg'); ?>
            <?php $iconHeartFile = file_get_contents(get_template_directory().'/assets/img/oodi-icons/sydan.svg'); ?>

            <div class="l-event__sidebar">
                <div class="c-event-sidebar h-wysiwyg-html">
                    <div class="c-event-sidebar__section">
                        <?php echo \Evermade\Swiss\sprint('<h3>%s</h3>', __('Add to your calendar', 'swiss')); ?>
                        <ul>
                            <?php echo \Evermade\Swiss\sprint('<li><a class="c-event-sidebar__calendar-link" href="%s" target="_blank">%s %s</a></li>', array($calendar_google, $iconHeartFile, __('Add to Google Calendar', 'swiss'))); ?>
                            <?php echo \Evermade\Swiss\sprint('<li><a class="c-event-sidebar__calendar-link" href="%s" target="_blank">%s %s</a></li>', array($calendar_ics, $iconHeartFile, __('Add to iCal', 'swiss'))); ?>
                            <?php echo \Evermade\Swiss\sprint('<li><a class="c-event-sidebar__calendar-link" href="%s" target="_blank">%s %s</a></li>', array($calendar_ics, $iconHeartFile, __('Add to Outlook', 'swiss'))); ?>
                        </ul>
                    </div>

                    <?php if ( isset($info_url) && !empty($info_url) ) : ?>
                    <div class="c-event-sidebar__section">
                        <?php echo \Evermade\Swiss\sprint('<h3>%s</h3>', __('Extra information', 'swiss')); ?>
                        <?php echo \Evermade\Swiss\sprint('<a class="c-event-sidebar__extra-link" href="%s" target="_blank">%s %s</a>', array($info_url, $iconEarthFile, __('Event website', 'swiss'))); ?>
                    </div>
                    <?php endif; ?>

                    <div class="c-event-sidebar__section">
                        <?php echo \Evermade\Swiss\sprint('<h3>%s</h3>', __('Share the event', 'swiss')); ?>
                        <?php echo Evermade\Swiss\sharePage(get_template_directory().'/templates/_share-event.php'); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<div class="s-context">
    <div>
        <div>
            <?php \Evermade\Swiss\Acf\postBlocks(); ?>
        </div>
    </div>
</div>
