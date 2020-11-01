<form  method="get" action="<?php echo home_url( '/' ); ?>">
    <input id="Tf-Search" type="text" placeholder="<?php _e('Search movies', 'toroflix'); ?>" name="s">
    <label for="Tf-Search" class="SearchBtn fa-search AATggl" data-tggl="HdTop"><i class="AAIco-clear"></i></label>
    <div style="width: 100%;" class="Result anmt OptionBx widget_categories" id="tr_live_search_content">
        <p class="trloading"><i class="fa-spinner fa-spin"></i> <?php _e('Loading', 'toroflix'); ?></p>
        <ul class="ResultList"></ul>
        <a href="#" class="Button"><?php _e('Show More Results', 'toroflix'); ?></a>
    </div>
</form>