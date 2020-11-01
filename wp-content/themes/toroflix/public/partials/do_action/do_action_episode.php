<?php 

/*Carousel Letter*/
if ( ! function_exists( 'episode_content_carousel' ) ) {
	function episode_content_carousel() { 
		$alphabet = get_option('alphabet_show');
        if($alphabet){
	        	get_template_part('public/partials/template/letters');
	        } 
	}
}
add_action( 'episode_content', 'episode_content_carousel', 10 );



/*Info Episode*/
if ( ! function_exists( 'episode_content_info' ) ) {
	function episode_content_info($data) { 
		$term               = $data['term']; 
		$term_id            = $data['term_id']; 
		$serie_id           = $data['serie_id']; 
		$links              = $data['links'];
		$links['downloads'] = !empty($links['downloads']) ? $links['downloads'] : ''; 
		$links['online'] = !empty($links['online']) ? $links['online'] : '';
		$season_current = TOROFLIX_Movies::number_season_term($term);
		$sidebar_position = TOROFLIX_Add_Theme_Support::get_position_sidebar();  
		$year = TOROFLIX_Movies::year_term($term);

		$director        = TOROFLIX_Movies::director_term($term);
    	$cast            = TOROFLIX_Movies::categories_term($term);
    	$genre           = TOROFLIX_Movies::casts_term($term);

		$numvote = get_term_meta( $term_id, 'numvote', true);
	    $vote = get_term_meta( $term_id, 'vote', true);
	    if(!$numvote or $numvote == 0){
	        $prom = 0;
	    } else {
	        $prom = round($vote / $numvote);
	    }   ?>
		<div class="TpRwCont <?php echo $sidebar_position; ?>">
            <main>
            	<?php if($links['online']){ ?>
	                <article class="TPost A">
	                    <header class="Top">
	                        <h1 class="Title"><?php echo get_the_title($serie_id) . ' ' . TOROFLIX_Movies::title_term($term); ?></h1>
	                        <div class="Info">
	                            <span class="Date"><?php echo $year; ?></span>
	                            <span class="Time"><?php echo TOROFLIX_Movies::duration_term($term); ?></span>
	                            <a href="<?php echo get_the_permalink($serie_id); ?>"><?php _e('All Episodes', 'toroflix'); ?></a>
	                        </div>
	                    </header>
	                    <div class="Description">
	                        <?php if(term_description( $term_id,'episodes' )) {
                                echo term_description( $term_id,'episodes' ); }
                            if($director){ ?>
                                <p class="Director"><span><?php _e('Director', 'toroflix'); ?>:</span> <?php echo $director; ?></p>
                            <?php } if($cast){ ?>
                                <p class="Genre"><span><?php _e('Genre', 'toroflix'); ?>:</span> <?php echo $cast ?></p><?php } 
                            if($genre){ ?>
                                <p class="Cast"><span><?php _e('Cast', 'toroflix'); ?>:</span>  <?php echo $genre; ?></p>
                            <?php } ?>
	                    </div>
	                    <footer>
	                        <ul class="ShareList">
	                            <li><a href="" class="fa-facebook"></a></li>
	                            <li><a href="" class="fa-twitter"></a></li>
	                        </ul>
	                    </footer>
	                </article>
	            <?php } ?>
                <section class="SeasonBx">
                    <div class="Top AAIco-playlist_play">
                        <div class="Title"><?php echo get_the_title($serie_id); ?> - <?php _e('Season', 'toroflix'); ?> <span><?php echo $season_current; ?></span></div>
                    </div>
                    <div class="TPTblCn">
                        <table>
                            <tbody>
                            	<?php $episodes = get_terms( 'episodes', array(
					                'orderby'    => 'meta_value_num',
					                'order'      => 'ASC',
					                'hide_empty' => 0,
					                'meta_query' => array(
					                    'relation' => 'AND',
					                    array(
					                        'key' => 'episode_number',
					                        'type' => 'NUMERIC',
					                    ),
					                    array(
					                        'key' => 'tr_id_post',
					                        'value' => $serie_id 
					                    ),
					                    array(
					                        'key' => 'season_number',
					                        'value' =>  (int) $season_current,
					                    )
					                )
					            ) );  
					            if($episodes){  
					            	foreach ($episodes as $key => $episode) { 
					            		$link = get_term_link( $episode );
					            		$title = TOROFLIX_Movies::title_term($episode);
					            		$date = TOROFLIX_Movies::date_term($episode); ?>
		                                <tr class="Viewed">
			                                <td><span class="Num"><?php echo TOROFLIX_Movies::number_episodes_term($episode); ?></span></td>
			                                <td class="MvTbImg B"><a href="<?php echo $link; ?>" class="MvTbImg"><?php echo TOROFLIX_Movies::image_term_episode($episode, 'w92'); ?></a></td>
			                                <td class="MvTbTtl"><a href="<?php echo $link; ?>"><?php echo $title; ?></a>
			                                	<?php if($date){ ?><span><?php echo $date; ?></span><?php } ?></td>
			                                <td class="MvTbPly"><a href="<?php echo $link; ?>" class="AAIco-play_circle_outline ClA"></a></td>
			                            </tr>
		                            <?php }
		                        } ?>
                              
                            </tbody>
                        </table>
                    </div>
                </section>
				
				<?php if($links['downloads']){  ?>
	                <section>
	                    <div class="Top AAIco-insert_link">
	                        <h2 class="Title"><?php _e('Links for The', 'toroflix'); ?> <?php echo get_the_title($serie_id); ?> - <?php _e('Season', 'toroflix'); ?> <?php echo TOROFLIX_Movies::number_season_term($term); ?> - <?php _e('Episode', 'toroflix'); ?> <?php echo TOROFLIX_Movies::number_episodes_term($term); ?></h2>
	                    </div>
	                    <ul class="MovieList Rows BX B06 C20 D03 E20">
	                    	<?php foreach ($links['downloads'] as $key => $download) {
	                    		$count = $key + 1; 
                                $count = sprintf("%02d", $count); 
                                if( $download['server']  ) {
                                $server_term = get_term( $download['server'], 'server' ); }
                                if( $download['lang'] ){
                                    $lang_term = get_term( $download['lang'], 'language' ); }
                                if($download['quality']){
                                $quality_term = get_term( $download['quality'], 'quality' ); }  ?>
		                        <li>
		                            <div class="OptionBx on">
		                                <div class="Optntl"><?php _e('Option', 'toroflix'); ?> <span><?php echo $count; ?></span></div>
		                                <p class="AAIco-language"><?php if( $download['lang'] ) { echo $lang_term->name; } else{ echo ''; } ?></p>
		                                <p class="AAIco-dns"><?php if(isset($server_term->name)){  echo $server_term->name; } ?></p>
		                                <p class="AAIco-equalizer"><?php if($download['quality']){ echo $quality_term->name; } else { echo 'HD'; } ?></p>
		                                <a rel="nofollow" target="_blank" href="<?php echo esc_url( home_url( '/?trdownload='.$download['i'].'&t=ser&trid='.$term_id ) );  ?>" class="Button"><?php _e('Download', 'toroflix'); ?></a>
		                            </div>
		                        </li>
		                    <?php } ?>
	                      
	                    </ul>
	                </section>
                <?php } ?>
                
          
                
            </main>
            <?php get_sidebar(); ?>
        </div>
	<?php }
}
add_action( 'episode_content', 'episode_content_info', 20 );





if ( ! function_exists( 'episode_content_related' ) ) {
	function episode_content_related($data) {
		$id = $data['serie_id'];
		$custom_taxterms = wp_get_object_terms( $id, 'category', array('fields' => 'ids') );
        $args = array(
            'post_type' => 'series',
		    'post_status' => 'publish',
		    'posts_per_page' => 15,
		    'orderby' => 'rand',
		    'tax_query' => array(
		        array(
		            'taxonomy' => 'category',
		            'field' => 'id',
		            'terms' => $custom_taxterms
		        )
		    ),
		    'post__not_in' => array($id),
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
add_action( 'episode_content', 'episode_content_related', 30 );