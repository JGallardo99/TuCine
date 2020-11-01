<?php 
/*Player*/
if ( ! function_exists( 'single_body_player' ) ) {
    function single_body_player($loop) { 
        global $post;
        $data_header = array('loop' => $loop, 'image' => true );
        $links = $loop->tr_links_movies(get_the_ID());
        $links['online'] = !empty($links['online']) ? $links['online'] : ''; 
        $tagiframe = 'iframe';
        if($links['online']){ ?>
            <div class="TPost A D">
                <div class="Container">
                    <div class="VideoPlayer">                     
                        <?php foreach ($links['online'] as $key => $online) { 
                            if($key == 0){ ?>
                                <div id="VideoOption01" class="Video on">
                                    <<?php echo $tagiframe; ?> src="<?php echo esc_url( home_url( '/?trembed='.$online['i'].'&trid='.$post->ID ) ).'&trtype=1';  ?>" frameborder="0" allowfullscreen></<?php echo $tagiframe; ?>>
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
                                    <li data-typ="movie" data-key="<?php echo $key; ?>" data-id="<?php echo get_The_ID(); ?>" class="OptionBx <?php if($key == 0){ echo 'on'; } ?>" data-VidOpt="VideoOption<?php echo $count; ?>">
                                        <div class="Optntl"><?php _e('Option', 'toroflix'); ?> <span><?php echo $count; ?></span></div>
                                        <p class="AAIco-language"><?php echo $lang_term->name; ?></p>
                                        <p class="AAIco-dns"><?php echo $server_term->name; ?></p>
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
                    <?php if( $loop->backdrop_tmdb(get_the_ID(), 'original') && $loop->backdrop_tmdb(get_the_ID(), 'original')!= ''){ ?>
                    <div class="Image">
                        <figure class="Objf"><?php echo $loop->backdrop_tmdb(get_the_ID(), 'original'); ?></figure>
                    </div><?php } ?>
                </div>
            </div>
        <?php } else { ?>
            <div class="MovieListSldCn">
                <article class="TPost A">
                    <?php do_action( 'header_single',$data_header ); ?>
                </article>
            </div>
       <?php }
    }
}
add_action( 'single_body', 'single_body_player', 10 );
if ( ! function_exists( 'single_body_main' ) ) {
    function single_body_main($loop) { ?>
        <div class="Main Container">
            <?php do_action( 'body_main', $loop );
                    #10: Letters A-Z
                    #20: Content movie
                    #30: Related post ?>            
        </div>
    <?php }
}
add_action( 'single_body', 'single_body_main', 20 );
if ( ! function_exists( 'body_main_AZList' ) ) {
    function body_main_AZlist($loop) {
        $alphabet = get_option('alphabet_show');
        if($alphabet){
                get_template_part('public/partials/template/letters');
            } 
     }
}
add_action( 'body_main', 'body_main_AZlist', 10 );
if ( ! function_exists( 'single_body_conTpRwCont' ) ) {
    function single_body_conTpRwCont($loop) { 
        global $post;
        $data_header = array('loop' => $loop, 'image' => false );
        $links = $loop->tr_links_movies(get_the_ID());
        $links['online'] = !empty($links['online']) ? $links['online'] : ''; 
        $links['downloads'] = !empty($links['downloads']) ? $links['downloads'] : ''; 
        $sidebar_position = TOROFLIX_Add_Theme_Support::get_position_sidebar(); ?>
        <div class="TpRwCont <?php echo $sidebar_position; ?>">
            <main>
                <?php if($links['online']){ ?>
                    <article class="TPost A">
                        <?php do_action( 'header_single', $data_header); ?>
                    </article>
                <?php } ?>
                <section>
                    <?php if($links['downloads']){ ?>
                        <div class="Top AAIco-insert_link">
                            <h2 class="Title"><?php _e('Links', 'toroflix'); ?></h2>
                        </div>
                        <ul class="MovieList Rows BX B06 C20 D03 E20">
                            <?php foreach ($links['downloads'] as $key => $download) {
                                $count = $key + 1; 
                                $count = sprintf("%02d", $count); 
                                if( $download['server'] ) {
                                $server_term = get_term( $download['server'], 'server' ); } 
                                /*$server_term->name = ''; }*/
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
                                        <a rel="nofollow" target="_blank" href="<?php echo esc_url( home_url( '/?trdownload='.$download['i'].'&trid='.$post->ID ) );  ?>" class="Button"><?php _e('Download', 'toroflix'); ?></a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </section>
                <?php comments_template(); ?>  
            </main>
            <?php get_sidebar(); ?>
        </div>
    <?php }
}
add_action( 'body_main', 'single_body_conTpRwCont', 20 );
/*Related Post*/
if ( ! function_exists( 'body_main_related_post' ) ) {
    function body_main_related_post() {
        $custom_taxterms = wp_get_object_terms( get_the_ID(), 'category', array('fields' => 'ids') );
        $args = array(
            'post_type' => 'movies',
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
            'post__not_in' => array(get_the_ID()),
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
add_action( 'body_main', 'body_main_related_post', 30 );