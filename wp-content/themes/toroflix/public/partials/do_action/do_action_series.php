<?php 
/*Title of serie*/
if ( ! function_exists( 'series_info_title' ) ) {
	function series_info_title() { ?>
		<h1 class="Title"><?php the_title(); ?></h1>
	<?php }
}
add_action( 'series_info', 'series_info_title', 10 );
/*Seasons and Episodes by serie*/
if ( ! function_exists( 'series_info_subtitle' ) ) {
	function series_info_subtitle($data) {
		$seasons  = $data['seasons'];
		$episodes = $data['episodes']; ?>
		<p class="SubTitle"><span><?php echo $seasons; ?></span> <?php _e('Seasons', 'toroflix'); ?> - <span><?php echo $episodes; ?></span> <?php _e('Episodes', 'toroflix'); ?></p>
	<?php }
}
add_action( 'series_info', 'series_info_subtitle', 20 );
/*Meta Serie: year, duration && views*/
if ( ! function_exists( 'series_info_info' ) ) {
	function series_info_info($data) {
		$year     = $data['year'];
		$duration = $data['duration'];
		$views    = $data['views'];
		$production = get_post_meta( get_the_ID(), 'field_inproduction', true );
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
        } ?>
		<div class="Info">
            <div class="Vote">
                <div class="post-ratings">
                    <img src="<?php echo TOROFLIX_DIR_URI; ?>public/img/cnt/rating_on.gif" alt="img"><span style="font-size: 12px;"><?php echo $prom; ?></span>
                </div>
            </div>
            <?php if($year){ ?><span class="Date"><?php echo $year; ?></span><?php } ?>
            <span class="Qlty"><?php if($production == 1){ _e('ON AIR', 'toroflix'); } else { _e('ENDED', 'toroflix'); } ?></span>
            <?php if($duration){ ?><span class="Time"><?php echo $duration; ?></span><?php } ?>
            <?php if($views){ ?><span class="Views AAIco-remove_red_eye"><?php echo $views; ?></span><?php } ?>
        </div>
	<?php }
}
add_action( 'series_info', 'series_info_info', 30 );
/*Meta serie: director, categories && cast*/
if ( ! function_exists( 'series_info_description' ) ) {
	function series_info_description($data) {
		$director   = $data['director'];
		$categories = $data['categories'];
		$cast       = $data['cast']; ?>
		<div class="Description">
            <?php the_content(); ?>
            <?php if($director){ ?><p class="Director"><span><?php _e('Director', 'toroflix'); ?>:</span> <?php echo $director; ?></p><?php } ?>
            <?php if($categories){ ?><p class="Genre"><span><?php _e('Genre', 'toroflix'); ?>:</span> <?php echo $categories; ?></p><?php } ?>
            <?php if($cast){ ?><p class="Cast"><span><?php _e('Cast', 'toroflix'); ?>:</span> <?php echo $cast; ?></p><?php } ?>
        </div>
	<?php }
}
add_action( 'series_info', 'series_info_description', 40 );
/*Share Serie*/
if ( ! function_exists( 'series_info_sharelist' ) ) {
	function series_info_sharelist() { 
		$like_vote   = get_post_meta(get_the_ID(), 'like_flix', true);
        if(!$like_vote)
            $like_vote = 0;
        $unlike_vote = get_post_meta(get_the_ID(), 'unlike_flix', true);
        if(!$unlike_vote)
            $unlike_vote = 0; ?>
		<ul class="ShareList">
            <li><a href="javascript:void(0)" onclick="window.open ('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" class="fa-facebook"></a></li>
            <li><a href="javascript:void(0)" onclick="javascript:window.open('https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" class="fa-twitter"></a></li>
        </ul>
        <div class="rating-content">
            <button data-id="<?php the_ID(); ?>" data-like="like" class="like-mov"><i class="fa-heart Clra"></i> <span class="vot_cl"><?php echo $like_vote; ?></span></button>
            <button data-id="<?php the_ID(); ?>" data-like="unlike" class="like-mov"><i class="fa-heartbeat Clra"></i> <span class="vot_cu"><?php echo $unlike_vote; ?></span></button>
        </div>
	<?php }
}
add_action( 'series_info', 'series_info_sharelist', 50 );
/*Carousel of letters*/
if ( ! function_exists( 'series_extra_carousel_letter' ) ) {
	function series_extra_carousel_letter() {
		$alphabet = get_option('alphabet_show');
        if($alphabet){
	        	get_template_part('public/partials/template/letters');
	        }
	}
}
add_action( 'series_extra', 'series_extra_carousel_letter', 10 );
if ( ! function_exists( 'series_extra_content_serie' ) ) {
	function series_extra_content_serie($data) { ?>
		<div class="TpRwCont"><!-- Poner la class "TpLCol" para sidebar a la Izquierda y "NoSdbr" cuando no hay sidebar-->
		    <main>
		    	<?php $seasons = get_terms( array(
					'taxonomy'   => 'seasons',
					'meta_key'   => 'tr_id_post',
					'meta_value' => get_the_ID(),
					'orderby'    => 'meta_value_num',
					'order'      => 'ASC',
					'meta_query' => array(
		                array(
		                    'key' => 'season_number',
		                    'type' => 'NUMERIC',
		                ),  
		            )
				) ); 
				if($seasons){
					foreach ($seasons as $key => $season) { ?>
				        <section class="SeasonBx AACrdn">
				            <div data-post="<?php the_ID(); ?>" data-season="<?php echo TOROFLIX_Movies::number_season_term($season); ?>" class="Top AAIco-playlist_play AALink episodes-view episodes-load">
				                <div class="Title"><a href="<?php echo get_term_link( $season ); ?>"><?php _e('Season', 'toroflix'); ?> <span><?php echo TOROFLIX_Movies::number_season_term($season); ?></span></a></div>
				            </div>
				            <div class="episode-list TPTblCn AAcont"></div>
				        </section>
		        	<?php }
		        }
		        comments_template(); ?>
		    </main>
		    <?php get_sidebar(); ?>
		</div>
	<?php }
}
add_action( 'series_extra', 'series_extra_content_serie', 20 );
/*Related Post*/
if ( ! function_exists( 'series_extra_related' ) ) {
	function series_extra_related() { 
		global $post;
		$custom_taxterms = wp_get_object_terms( $post->ID, 'category', array('fields' => 'ids') );
        $args = array(
			'post_type'      => 'series',
			'post_status'    => 'publish',
			'posts_per_page' => 15,
			'orderby'        => 'rand',
			'tax_query'      => array(
		        array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $custom_taxterms
		        )
		    ),
		    'post__not_in' => array( $post->ID ),
        ); 
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) : ?>
			<section>
			    <div class="Top AAIco-movie_filter">
			        <div class="Title"><?php _e('More titles like this', 'toroflix'); ?></div>
			    </div>
			    <div class="MovieListTop owl-carousel Serie">
			        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); 
			        	get_template_part('public/partials/template/loop', 'secondary');
			        endwhile; ?>
			    </div>
			</section>
		<?php endif; wp_reset_query();
	}
}
add_action( 'series_extra', 'series_extra_related', 30 );