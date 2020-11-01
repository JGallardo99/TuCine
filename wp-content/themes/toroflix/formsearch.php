<?php
/**
 * Template for displaying search forms in Toroflix
 *
 * @package Toroflix
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off">
    <input autocomplete="off" type="search" placeholder="<?php _e('Pesquisar Filmes', 'toroflix'); ?>" value="<?php echo get_search_query(); ?>" name="s" id="tr_live_search">
    <span class="SearchBtn TrCloseLive">
        <label for="tr_live_search" class="fa-search AATggl" data-tggl="HdTop"></label>
        <i><button type="button" class="AAIco-clear AATggl" data-tggl="HdTop"></button></i>
    </span>
    <div class="Result anmt OptionBx" id="tr_live_search_content"><p class="trloading"><i class="fa-spinner fa-spin"></i><?php _e('Loading', 'toroflix'); ?></p></div>
</form>