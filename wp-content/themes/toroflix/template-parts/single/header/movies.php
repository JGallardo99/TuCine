<?php
/**
 * The template for post information in movies
 * @package Toroflix
 */
?>
<!--<TPost>-->
<div class="TPost A D" style="position: unset;">
    <div class="Container">
        <?php tr_banners('ads_hd_bt'); ?>
        <div class="VideoPlayer">
            <?php tr_links($type=1, $mode=2); ?>
        </div>
        <div class="Image">
            <figure class="Objf"><?php tr_backdrop(); ?></figure>
        </div>
    </div>
</div>
<!--</TPost>-->