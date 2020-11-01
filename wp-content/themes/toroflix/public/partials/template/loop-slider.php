<?php $loop = new TOROFLIX_Movies(); ?>
<div class="TPostMv">
    <article class="TPost A">
        <header class="Container">
            <div class="TPMvCn">
                <a href="<?php the_permalink(); ?>"><div class="Title"><?php the_title(); ?></div></a>
                <div class="Info">
                    <div class="Vote">
                        <div class="post-ratings">
                            <img src="<?php echo TOROFLIX_DIR_URI; ?>public/img/cnt/rating_on.gif" alt="img">
                            <span style="font-size: 12px; line-height: 1.1rem;"><?php if(get_post_meta( get_the_ID(), 'vote', true )){ echo get_post_meta( get_the_ID(), 'vote', true ); } else { echo '0'; } ?></span>
                        </div>
                    </div>
                    <span class="Date"><?php echo $loop->year(); ?></span>
                    <span class="Qlty"><?php echo $loop->is_serie_movie(); ?></span>
                    <span class="Time"><?php echo $loop->duration(); ?></span>
                    <span class="Views AAIco-remove_red_eye"><?php echo $loop->views(); ?></span>
                </div>
                <div class="Description">
                    <?php echo get_excerpt(220); ?>
                    <?php if($loop->director_unique()){ ?>
                    <p class="Director"><span><?php _e('Director', 'toroflix'); ?>:</span> <?php echo $loop->director_unique(); ?></p><?php } ?>
                    <p class="Genre"><span><?php _e('Genre', 'toroflix'); ?>:</span> <?php echo $loop->get_categories(); ?></p>
                    <?php if($loop->get_cast_by_2()){ ?>
                    <p class="Cast"><span><?php _e('Cast', 'toroflix'); ?>:</span> <?php echo $loop->get_cast_by_2(); ?></p><?php } ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="Button TPlay AAIco-play_circle_outline"><strong><?php _e('Watch Now', 'toroflix'); ?></strong></a>
            </div>
            <div class="Image">
                <figure class="Objf"><?php echo $loop->backdrop_lazy(get_the_ID(), 'original'); ?></figure>
            </div>
        </header>
    </article>
</div>