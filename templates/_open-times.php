<?php
    function getSchedule() {
        $today = new DateTime("now", new DateTimeZone('Europe/Helsinki'));
        $today_date = $today->format('Y-m-d');

        if (false === ($openTimes = get_transient('open_times_' . $today_date))) {
            $librarySchedule = wp_remote_get('https://api.kirjastot.fi/v4/schedules?library=86476');
            
            if (is_wp_error($librarySchedule)) {
                // Handle error here
                return false;
            }

            $libraryScheduleData = json_decode($librarySchedule['body']);

            if (isset($libraryScheduleData->items[0]->times[0]) && $libraryScheduleData->items[0]->date === $today_date) {
                $from = $libraryScheduleData->items[0]->times[0]->from;
                $to = $libraryScheduleData->items[0]->times[0]->to;

                $openTimes = $from . ' - ' . $to;
            } else {
                $openTimes = '';
            }

            $tomorrow = new DateTime("tomorrow", new DateTimeZone('Europe/Helsinki'));
            $tomorrow->setTime(0, 0, 0); // Set time to the beginning of the day
            $expires_in = $tomorrow->getTimestamp() - $today->getTimestamp();
            
            set_transient('open_times_' . $today_date, $openTimes, $expires_in);
        }

        return $openTimes;
    }
    
    $schedule = getSchedule();

    if( $schedule || get_field('opt_opening_times_link', 'option') ): ?>
        <div class="b-site-header__opening-times-wrapper">
            <div class="b-site-header__opening-times-wrapper__clock">
                <i class="c-icon c-icon__clock"></i>
            </div>
            <div class="b-site-header__opening-times-wrapper__content">
                <?php if( $schedule ){ ?>
                    <div class="b-site-header__opening-times-wrapper__content__time">
                        <?php if (get_field('opt_opening_times_hide_time', 'option')):?>
                            <?php if (get_field('opt_opening_times_text', 'option')) { echo get_field('opt_opening_times_text', 'option'); }?>
                        <?php else:?>
                            <?php echo (get_field('opt_opening_times_text', 'option') ? get_field('opt_opening_times_text', 'option') . ' ' : '') . $schedule;?>
                        <?php endif;?>
                    </div>
                <?php } ?>                    
                <?php if( get_field('opt_opening_times_link', 'option') ){ ?>
                    <div class="b-site-header__opening-times-wrapper__content__link">
                        <a href="<?php echo get_field('opt_opening_times_link', 'option'); ?>"><?php _e('All opening times', 'swiss'); ?> <i class="fa fa-arrow-right"></i></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php endif;
?>