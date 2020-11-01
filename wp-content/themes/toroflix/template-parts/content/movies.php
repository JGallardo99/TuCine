<?php
/**
 * Template part for displaying movies posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroflix
 */

?>
<!--<TPostMv>-->
<li class="TPostMv">
    <article class="TPost B">
        <a href="<?php the_permalink(); ?>">
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'img-mov-md', get_the_title()); ?></figure>
                <?php toroflix_entry_header(false, false, true, false, false); ?>
            </div>
            <?php tr_title('listitle', 'Title') ?>
        </a>
        <?php if(toroflix_config('show_hover', 2)!=3){ ?>
        <div class="TPMvCn">
            <?php if(toroflix_config('show_hover_title', true)==true){ ?>
            <a href="<?php the_permalink(); ?>"><div class="Title"><?php the_title(); ?></div></a>
            <?php } ?>
            <div class="Info">
                <?php toroflix_entry_header( $show_rating=toroflix_config('show_hover_rating', true), $show_year=toroflix_config('show_hover_year', true), $show_quality=toroflix_config('show_hover_quality', true), $show_runtime=toroflix_config('show_hover_duration', true), $show_views=toroflix_config('show_hover_views', true) ); ?>
            </div>
            <div class="Description">
                <?php
                    if(toroflix_config('show_hover_description', true)==true){
                        echo'<p>'.wp_trim_words( strip_tags(get_the_content()), 40, '...' ).'</p>';
                    }
                ?>
                <?php toroflix_entry_footer($show_tags=toroflix_config('show_hover_tags', false), $limit_cast=5, $show_cat=toroflix_config('show_hover_categories', true), $show_directors=toroflix_config('show_hover_director', true), $show_cast=toroflix_config('show_hover_cast', true)); ?>
            </div>
        </div>
        <?php } ?>
    </article>
</li>
<!--</TPostMv>-->