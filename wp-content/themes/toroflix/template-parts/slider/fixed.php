<?php
/**
 * Carrousel
 *
 * @package Toroflix
 */
    if ( false === ( $trsliderfixed_query_results = get_transient( 'trsliderfixed_query_results' ) ) ) {
        
        if(toroflix_config('carrousel_orderby', 1)==1){
        
            $args=array(

                'posts_per_page'=> toroflix_config('posts_per_carrousel', 12),
                'orderby' => 'rand',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post'

            );
            
        }elseif(toroflix_config('carrousel_orderby', 1)==2){
            
            $args=array(

                'posts_per_page'=> toroflix_config('posts_per_carrousel', 12),
                'orderby' => 'desc',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post'

            );
            
        }elseif(toroflix_config('carrousel_orderby', 1)==3){
            
            $args=array( 
                'meta_key' => 'ratings_average',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post',
                'posts_per_page'=> toroflix_config('posts_per_carrousel', 12),
            );
            
        }elseif(toroflix_config('carrousel_orderby', 1)==4){
            
            $args=array( 
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post',
                'posts_per_page'=> toroflix_config('posts_per_carrousel', 12),
            );
            
        }elseif(toroflix_config('carrousel_orderby', 1)==5){
            
            $sticky = get_option( 'sticky_posts' );
            
            $args=array(
                'post__in' => $sticky,
                'ignore_sticky_posts'=> 1,
                'post_type' => 'post',
                'posts_per_page'=> toroflix_config('posts_per_carrousel', 12),                
            );
            
        }
        
        // The Query
        $trsliderfixed_query_results = new WP_Query( $args );
        set_transient( 'trsliderfixed_query_results', $trsliderfixed_query_results, 12 * HOUR_IN_SECONDS );
    }

    // The Loop  
    if ($trsliderfixed_query_results->have_posts() ) :

?>
<!--<section>-->
<section>
    <div class="Top AAIco-star_border">
        <?php tr_title('carrousel', 'Title'); ?>
    </div>
    <div class="MovieListTop owl-carousel" data-autoplay="<?php echo toroflix_config('carrousel_autoplay', false); ?>">
        <?php
            while( $trsliderfixed_query_results->have_posts() ) {		
                $trsliderfixed_query_results->the_post();
        ?>
        <!--<TPostMv>-->
        <div class="TPostMv">
            <div class="TPost B">
                <a href="<?php the_permalink(); ?>">
                    <div class="Image">
                        <figure class="Objf TpMvPlay AAIco-play_arrow"><?php echo tr_theme_img(get_the_ID(), 'img-mov-md', get_the_title()); ?></figure>
                        <?php toroflix_entry_header(false, false, toroflix_config('show_quality_carrousel', true), false, false); ?>
                    </div>
                    <div class="Title"><?php the_title(); ?></div>
                </a>
            </div>
        </div>
        <!--</TPostMv>-->
        <?php } ?>
    </div>
</section>
<!--</section>-->
<?php
	/* Restore original Post Data */
    wp_reset_postdata();
                
    endif;
?>