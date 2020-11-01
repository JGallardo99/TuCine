<?php $loop = new TOROFLIX_Movies(); 
$year       = $loop->year();
$duration   = $loop->duration();
$views      = $loop->views(); 
$director   = $loop->director_unique();
$categories = $loop->get_categories();
$cast       = $loop->casts();
$quality    = $loop->get_quality(); 
$lang       = $loop->get_lang();
$option     = get_option( 'poster_option_views', array() );

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
<li id="post-<?php the_ID(); ?>" <?php post_class('TPostMv'); ?>>
    <article class="TPost B">
        <a href="<?php the_permalink(); ?>">
            <div class="Image">
                <figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo $loop->image_pglazy(get_the_ID(), 'thumbnail') ?></figure>
                <span class="MvIC">
                    <?php if (in_array('qual', $option)) {  if ( 'movies' == get_post_type(get_the_ID()) && $quality ) { echo $quality; } } ?>
                    <?php if (in_array('lang', $option)) { if($lang){  ?><span class="Qlty Lg"><?php echo $lang; ?></span><?php } } ?>
                    <?php if (in_array('year', $option)) { if($year){  ?><span class="Qlty Yr"><?php echo $year; ?></span><?php } } ?>
                </span>                
            </div>
            <h2 class="Title"><?php the_title(); ?></h2>
        </a>
        <div class="TPMvCn">
            <a href="<?php the_permalink(); ?>"><div class="Title"><?php the_title(); ?></div></a>
            <div class="Info">
                <div class="Vote">
                   
                    <div class="post-ratings">
                        <img src="<?php echo TOROFLIX_DIR_URI; ?>public/img/cnt/rating_on.gif" alt="img"><span style="font-size: 12px;"><?php echo $prom; ?></span>
                    </div>
                  
                </div>
                <?php if($year){ ?><span class="Date"><?php echo $year; ?></span><?php } ?>
                <?php if ($quality) { ?>
                   <?php echo $quality; ?>
                <?php } ?>
                <?php if($duration){ ?><span class="Time"><?php echo $duration; ?></span><?php } ?>
                <?php if($views){ ?><span class="Views AAIco-remove_red_eye"><?php echo $views; ?></span><?php } ?>
            </div>
            <div class="Description">
                <?php the_excerpt(); ?>
                <?php if($director){ ?><p class="Director"><span><?php _e('Director', 'toroflix'); ?>:</span> <?php echo $director; ?></p><?php } ?>
                <p class="Genre"><span><?php _e('Genre', 'toroflix'); ?>:</span> <?php echo $categories; ?></p>
                 <?php if($cast){ ?><p class="Cast"><span><?php _e('Cast', 'toroflix'); ?>:</span> <?php echo $cast; ?></p><?php } ?>
            </div>
            <a href="<?php the_permalink(); ?>" class="TPlay AAIco-play_circle_outline"><strong><?php _e('Watch Now', 'toroflix'); ?></strong></a>
        </div>
    </article>
</li>