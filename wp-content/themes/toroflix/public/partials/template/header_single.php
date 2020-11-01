<?php
if ( ! function_exists( 'header_single_template' ) ) {
    function header_single_template($data) { 
        $trailer = get_post_meta( get_the_ID(), 'field_trailer', true );
        $loop  = $data['loop'];
        $quality = $loop->get_quality();
        $image = $data['image']; 
        $like_vote   = get_post_meta(get_the_ID(), 'like_flix', true);
        if(!$like_vote)
            $like_vote = 0;
        $unlike_vote = get_post_meta(get_the_ID(), 'unlike_flix', true);
        if(!$unlike_vote)
            $unlike_vote = 0;
        $sum = $like_vote + $unlike_vote;
        if($sum == 0) {
            $prom = 0;
        } else {
            $prom = round( ($like_vote / $sum), 1 ) * 5;
        }   

        ?>
        <header class="Container">
            <div class="TPMvCn">
                <a href="javascript:void(0)"><h1 class="Title"><?php the_title(); ?></h1></a>
                    <ul class="ShareList">
                        <li><a href="javascript:void(0)" onclick="window.open ('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" class="fa-facebook"></a></li>
                        <li><a href="javascript:void(0)" onclick="javascript:window.open('https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" class="fa-twitter"></a></li>
                    </ul>
                <div class="Info">
                    <div class="Vote">
                        <div class="post-ratings">
                            <img src="<?php echo TOROFLIX_DIR_URI; ?>public/img/cnt/rating_on.gif" alt="img"><span style="font-size: 12px;"><?php echo $prom; ?></span>
                        </div>
                    </div>
                    <span class="Date"><?php echo $loop->year(); ?></span>
                    <?php if($quality){ ?>
                        <?php echo $quality ?><?php } ?>
                    <span class="Time"><?php echo $loop->duration(); ?></span>
                    <span class="Views AAIco-remove_red_eye"><?php echo $loop->views(); ?></span>
                </div>
                <div class="Description">
                    <?php the_content(); ?>
                    <?php if($loop->director()){ ?>
                    <p class="Director"><span><?php _e('Director', 'toroflix'); ?>:</span> <?php echo $loop->director(); ?></p><?php } ?>
                    <p class="Genre"><span><?php _e('Genre', 'toroflix'); ?>:</span> <?php echo $loop->get_categories(); ?></p>
                    <?php if($loop->casts()){ ?>
                    <p class="Cast Cast-sh oh"><span><?php _e('Cast', 'toroflix'); ?>:</span> <?php echo $loop->casts(); ?></p><?php } ?>
                </div>
                <?php if($trailer){ ?>
                    <a data-trailer="<?php echo get_the_ID(); ?>" href="javascript:void(0)" id="watch-trailer" class="Button TPlay AAIco-play_circle_outline"><strong><?php _e('Watch Trailer', 'toroflix'); ?></strong></a>
                <?php } ?>
                <div class="rating-content">
                    <button data-id="<?php the_ID(); ?>" data-like="like" class="like-mov"><i class="fa-heart Clra"></i> <span class="vot_cl"><?php echo $like_vote; ?></span></button>
                    <button data-id="<?php the_ID(); ?>" data-like="unlike" class="like-mov"><i class="fa-heartbeat Clra"></i> <span class="vot_cu"><?php echo $unlike_vote; ?></span></button>
                </div>
            </div>
            <?php if($image){ ?>
                <div class="Image">
                    <figure class="Objf"><?php echo $loop->backdrop_tmdb(get_the_ID(), 'original') ?></figure>
                </div>
            <?php } ?>
        </header>
    <?php }
}
add_action( 'header_single', 'header_single_template', 10 );