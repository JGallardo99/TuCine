<?php get_header();
    $term_id         = get_queried_object_id();
    $links           = TOROFLIX_Movies::tr_links_episodes($term_id);
    $links['online'] = !empty($links['online']) ? $links['online'] : '';
    $serie_id        = get_term_meta( $term_id, 'tr_id_post', true );
    $term            = get_term_by('id', $term_id, 'episodes');
    $slug            = $term->slug;
    $data            = array('links' => $links, 'serie_id' => $serie_id, 'term' => $term, 'slug' => $slug, 'term_id' => $term_id);
    $director        = TOROFLIX_Movies::director_term($term);
    $cast            = TOROFLIX_Movies::categories_term($term);
    $genre           = TOROFLIX_Movies::casts_term($term);
    $numvote         = get_term_meta( $term_id, 'numvote', true);
    $vote            = get_term_meta( $term_id, 'vote', true);
    $loop            = new TOROFLIX_Movies();
    if(!$numvote or $numvote == 0){
        $prom = 0;
    } else {
        $prom = round($vote / $numvote);
    } ?>
    <div class="Body">
        <?php if($links['online']){ ?>
            <div class="TPost A D">
                <div class="Container">
                    <div class="VideoPlayer">
                        <?php 
                        foreach ($links['online'] as $key => $online) { 
                            if($key == 0){ ?>
                                <div id="VideoOption01" class="Video on">
                                    <?php $tagiframe = 'iframe'; ?>
                                    <<?php echo $tagiframe; ?> src="<?php echo esc_url( home_url( '/?trembed='.$online['i'].'&trid='.$term_id ) ).'&trtype=2';  ?>" allowfullscreen frameborder="0"></<?php echo $tagiframe; ?>>
                                </div>
                            <?php } 
                        } ?>
                        <section id="VidOpt" class="VideoOptions">
                            <div class="Top AAIco-list">
                                <div class="Title"><?php _e('Options', 'toroflix'); ?></div>
                            </div>
                            <ul class="ListOptions">
                                <?php foreach ($links['online'] as $key => $online) { 
                                    $count = $key + 1; 
                                    $count = sprintf("%02d", $count);
                                    //Server
                                    if($online['server']){
                                        $server_term = get_term( $online['server'], 'server' ); } 

                                    // lang
                                    if($online['lang']){
                                    $lang_term = get_term( $online['lang'], 'language' ); }  else { $lang_term->name = ''; }
                                    // quality
                                    if($online['quality']){
                                    $quality_term = get_term( $online['quality'], 'quality' ); }  else { $quality_term->name = 'HD'; } ?>
                                    <li data-typ="episode" data-key="<?php echo $key; ?>" data-id="<?php echo $term_id; ?>" class="OptionBx <?php if($key == 0){ echo 'on'; } ?>" data-VidOpt="VideoOption<?php echo $count; ?>">
                                        <div class="Optntl">Option <span><?php echo $count; ?></span></div>
                                        <p class="AAIco-language"><?php echo $lang_term->name; ?></p>
                                        <p class="AAIco-dns"><?php if(isset($server_term->name)){ echo $server_term->name; } else {echo 'Server';} ?></p>
                                        <p class="AAIco-equalizer"><?php echo $quality_term->name; ?></p>
                                        <span class="Button"><?php _e('WATCH ONLINE', 'toroflix'); ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                        </section>
                        <span class="BtnOptions AAIco-list AATggl" data-tggl="VidOpt"><i class="AAIco-clear"></i></span>
                        <span class="BtnLight AAIco-lightbulb_outline lgtbx-lnk"></span>
                        <span class="lgtbx"></span>
                    </div>
                    <div class="Image">
                         <figure class="Objf"><?php echo $loop->backdrop_tmdb($serie_id, 'original'); ?></figure>
                    </div>
                </div>
            </div>
        <?php } else{ ?>
            <div class="MovieListSldCn">
                <article class="TPost A">
                    <header class="Container">
                        <div class="TPMvCn">
                            <a href="javascript:void(0)">
                                <h1 class="Title"><?php echo get_the_title($serie_id) . ' ' . TOROFLIX_Movies::title_term($term); ?></h1>
                            </a>
                            <div class="Info">
                                <span class="Date"><?php echo TOROFLIX_Movies::year_term($term); ?></span>
                                <span class="Time"><?php echo TOROFLIX_Movies::duration_term($term); ?></span>
                                <a href="<?php echo get_the_permalink($serie_id); ?>"><?php _e('All Episodes', 'toroflix'); ?></a>
                            </div>
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
                            <ul class="ShareList">
                                <li><a href="javascript:void(0)" onclick="window.open ('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>', 'Facebook', 'toolbar=0, status=0, width=650, height=450');" class="fa-facebook"></a></li>
                                <li><a href="javascript:void(0)" onclick="javascript:window.open('https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?>', 'Twitter', 'toolbar=0, status=0, width=650, height=450');" class="fa-twitter"></a></li>
                            </ul>
                        </div>
                        <div class="Image">
                            <figure class="Objf"><?php echo TOROFLIX_Movies::image_term_episode($term, 'full'); ?></figure>
                        </div>
                    </header>
                </article>
            </div>
        <?php } ?>
        <div class="Main Container">
            <?php do_action( 'episode_content', $data );
                    #10: Carousel letter
                    #20: Info
                    #30: Related ?>
        </div>
    </div>
<?php get_footer(); ?>