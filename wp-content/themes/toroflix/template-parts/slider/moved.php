<?php
/**
 * Slider
 *
 * @package Toroflix
 */
    if(is_front_page() and is_home() and !is_paged() and !isset($_GET['r_sortby']) and !isset($_GET['v_sortby']) and toroflix_config('show_slider', 1)==1){
    if ( false === ( $trslidermoved_query_results = get_transient( 'trslidermoved_query_results' ) ) ) {
        
        if(toroflix_config('slider_orderby', 1)==1){
        
            $args=array(

                'posts_per_page'=> toroflix_config('posts_per_slider', 4),
                'orderby' => 'rand',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post'

            );
            
        }elseif(toroflix_config('slider_orderby', 1)==2){
            
            $args=array(

                'posts_per_page'=> toroflix_config('posts_per_slider', 4),
                'orderby' => 'desc',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post'

            );
            
        }elseif(toroflix_config('slider_orderby', 1)==3){
            
            $args=array( 
                'meta_key' => 'ratings_average',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post',
                'posts_per_page'=> toroflix_config('posts_per_slider', 4),
            );
            
        }elseif(toroflix_config('slider_orderby', 1)==4){
            
            $args=array( 
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post',
                'posts_per_page'=> toroflix_config('posts_per_slider', 4),
            );
            
        }elseif(toroflix_config('slider_orderby', 1)==5){
            
            $sticky = get_option( 'sticky_posts' );
            
            $args=array(
                'post__in' => $sticky,
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post',
                'posts_per_page'=> toroflix_config('posts_per_slider', 4),                
            );
            
        }
        
        // The Query
        $trslidermoved_query_results = new WP_Query( $args );
        set_transient( 'trslidermoved_query_results', $trslidermoved_query_results, 12 * HOUR_IN_SECONDS );
    }

    // The Loop
    if ($trslidermoved_query_results->have_posts() ) :

?>
<!--<MovieListSld>-->
<div class="MovieListSldCn">
    <div class="MovieListSld owl-carousel" data-autoplay="<?php echo toroflix_config('slider_autoplay', false); ?>">
        <?php
            while( $trslidermoved_query_results->have_posts() ) {	
                $trslidermoved_query_results->the_post();
        ?>
        <!--<TPostMv>-->
        <div class="TPostMv">
            <article class="TPost A">
                <header class="Container">
                    <div class="TPMvCn">
                        <a href="<?php the_permalink(); ?>"><div class="Title"><?php the_title(); ?></div></a>
                        <div class="Info">
                            <?php toroflix_entry_header($show_rating=toroflix_config('show_rating_slider', true), $show_year=toroflix_config('show_year_slider', true), $show_quality=toroflix_config('show_quality_slider', true), $show_runtime=toroflix_config('show_duration_slider', true), $show_views=toroflix_config('show_views_slider', true)); ?>
                        </div>
                        <div class="Description">
                            <?php
                                if(toroflix_config('show_description_slider', true)){
                                    echo'<p>'.wp_trim_words( strip_tags(get_the_content()), 40, '...' ).'</p>';
                                }
                            ?>
                            <?php toroflix_entry_footer($show_tags=toroflix_config('show_tag_slider', false), $limit_cast=5, $show_cat=toroflix_config('show_geners_slider', true), $show_directors=toroflix_config('show_directors_slider', true), $show_cast=toroflix_config('show_cast_slider', true)); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="Button TPlay AAIco-play_circle_outline">
                            <?php
                            if(tr_check_type($post->ID)==2){
                                printf( __('Assistir Filme', 'toroflix'), '<strong>', '</strong>' );
                            }else{
                                printf( __('Assistir Filme', 'toroflix'), '<strong>', '</strong>' );
                            }
                            ?>
                        </a>
                    </div>
                    <div class="Image">
                        <figure class="Objf"><?php tr_backdrop(); ?></figure>
                    </div>
                </header>
            </article>
        </div>
        <!--</TPostMv>-->
        <?php } ?>
    </div>
</div>
<!--</MovieListSld>-->
<?php
	/* Restore original Post Data */
    wp_reset_postdata();

    endif;
    }
?>