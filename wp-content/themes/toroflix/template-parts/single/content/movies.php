<?php
/**
 * The template for post content in movies
 * @package Toroflix
 */
?>
<!--<TPost>-->
<?php tr_related('top'); ?>

<article class="TPost A Single">
    <figure class="Image Auto"><?php echo tr_theme_img(get_the_ID(), 'img-mov-md', get_the_title()); ?></figure>
    <header class="Top">
        <?php tr_title('single_movies', 'Title'); ?>
        <div class="Info">
            <?php toroflix_entry_header(); ?>
        </div>
    </header>
    <div class="Description">
        <?php the_content(); ?>
        <?php toroflix_entry_footer(); ?>
    </div>
    <footer>
        <?php
        $trailer_field = stripslashes(get_post_meta(get_the_ID(), TR_MOVIES_FIELD_TRAILER, true));
        if($trailer_field){
        ?>
        <button type="button" class="Button TPlay AAIco-play_circle_outline" data-trailer="<?php echo htmlentities($trailer_field); ?>"><?php printf( __('Assistir Trailer', 'toroflix'), '<strong>', '</strong>' ); ?></button>
        <?php } ?>
        <ul class="ShareList Count">
            <li class="trfb"><a rel="nofollow" onclick="window.open ('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>/&title=<?php the_title(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-facebook"></a></li>
            <li class="trtw"><a rel="nofollow" onclick="window.open ('http://twitter.com/intent/tweet?status=<?php the_title(); ?>+<?php the_permalink(); ?>/', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" href="javascript: void(0);" class="fa-twitter"></a></li>
        </ul>
    </footer>
</article>

<!--</TPost>-->

<?php tr_links($type=1, $mode=1); ?>

<?php tr_related('bottom'); ?>