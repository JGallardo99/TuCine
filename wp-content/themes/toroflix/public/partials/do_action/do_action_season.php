<?php 

/*Carousel Letter*/
if ( ! function_exists( 'season_content_carousel' ) ) {
	function season_content_carousel() { 
		$alphabet = get_option('alphabet_show');
        if($alphabet){
	        	get_template_part('public/partials/template/letters');
	        }
	}
}
add_action( 'season_content', 'season_content_carousel', 10 );



/*Info Episode*/
if ( ! function_exists( 'season_content_info' ) ) {
	function season_content_info($data) { 
		$term     = $data['term']; 
		$url = get_term_link( $term );
		$term_id  = $data['term_id']; 
		$serie_id = $data['serie_id'];
		$director = TOROFLIX_Movies::director_term($term);
		$cast = TOROFLIX_Movies::casts_term($term);
		$genre = TOROFLIX_Movies::categories_term($term);
		$season_current = TOROFLIX_Movies::number_season_term($term);
		$sidebar_position = TOROFLIX_Add_Theme_Support::get_position_sidebar();  
		$year = TOROFLIX_Movies::year_term($term); ?>
		<div class="TpRwCont <?php echo $sidebar_position; ?>">
            <main>
                <article class="TPost A">
                    <header class="Top">
                        <h1 class="Title"><?php echo get_the_title($serie_id) . ' ' . TOROFLIX_Movies::title_term($term); ?></h1>
                    </header>
                    <div class="Description">
               			<?php if($director){ ?>
                        	<p class="Director"><span><?php _e('Director', 'toroflix'); ?>:</span> <?php echo $director; ?></p>
                    	<?php } if($genre){ ?>
                        <p class="Genre"><span><?php _e('Genre', 'toroflix'); ?>:</span> <?php echo $genre; ?></p>
                    	<?php } if($cast){ ?>
                        	<p class="Cast"><span><?php _e('Cast', 'toroflix'); ?>:</span>  <?php echo $cast; ?></p>
                        <?php } ?>
                    </div>
                    <footer>
                        <ul class="ShareList">
                            <li><a ref="javascript:void(0)" onclick="window.open ('http://www.facebook.com/sharer.php?u=<?php echo $url; ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" class="fa-facebook"></a></li>
                            <li><a onclick="javascript:window.open('https://twitter.com/intent/tweet?original_referer=<?php echo $url; ?>&amp;text=<?php echo $term->name; ?>&amp;tw_p=tweetbutton&amp;url=<?php echo $url; ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" class="fa-twitter"></a></li>
                        </ul>
                    </footer>
                </article>
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
										$link  = get_term_link( $episode );
										$title = TOROFLIX_Movies::title_term($episode);
										$date  = TOROFLIX_Movies::date_term($episode); ?>
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
		         
                
            </main>
            <?php get_sidebar(); ?>
        </div>
	<?php }
}
add_action( 'season_content', 'season_content_info', 20 );





if ( ! function_exists( 'season_content_related' ) ) {
	function season_content_related($data) {
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
add_action( 'season_content', 'season_content_related', 30 );