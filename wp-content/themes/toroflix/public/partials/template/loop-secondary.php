<?php $loop = new TOROFLIX_Movies(); 
$sm = $loop->is_serie_movie(); ?>
<div class="TPostMv">
    <div class="TPost B">
        <a href="<?php the_permalink(); ?>">
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo $loop->image_lazy(get_the_ID(), 'w342') ?></figure>
                <span class="Qlty"><?php echo $sm; ?></span>
            </div>
            <h2 class="Title"><?php the_title(); ?></h2>
        </a>
    </div>
</div>