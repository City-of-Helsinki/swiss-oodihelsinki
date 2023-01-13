<form role="search" method="get" class="search-form c-site-search__form" action="<?php echo home_url('/'); ?>">
    <label for="site-search" class="h-visibly-hidden"><?php _e('Search', 'swiss');?>:</label>
    <input id="site-search" type="text" class="c-site-search__input js-site-search-input search-form__field" placeholder="<?php _e('Search', 'swiss');?>" value="" name="s" minlength="2" required/>
    <input type="submit" class="search-form__submit c-site-search__button" value="<?php _e('Search', 'swiss');?>" />
</form>
