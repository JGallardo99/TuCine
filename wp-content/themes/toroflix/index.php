<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Toroflix
 */

get_header(); ?>
           
<?php get_template_part( 'template-parts/slider/moved' ); ?>

<!--<Main>-->
<div class="Main Container">
    
    <?php
    
    tr_banners('ads_hd_bt');
    
    if ( have_posts() ) :

        if ( function_exists( 'tr_alphabet' ) ) :
            tr_alphabet();
        endif;

    ?>

    <?php get_template_part( 'template-parts/slider/fixed' ); ?>

    <!--<TpRwCont>-->
    <div<?php tr_content_class(); ?>>
        <!--<Main>-->
        <main>
                        
            <?php tr_seo_text('top'); ?>

            <?php tr_banners('ads_top_list'); ?>
                
            <!--<section>-->
            <section>
                <div class="Top AAIco-movie_filter">
                    <?php tr_title('list', 'Title'); ?>
                    <?php
                    if ( function_exists( 'tr_sortby' ) ) :
                        tr_sortby();
                    endif;
                    ?>
                </div>
                <ul<?php tr_content_class($type='ul'); ?>>

                    <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();

                            /*
                             * Include the template for the content.
                             */
                            get_template_part( 'template-parts/content/movies' );

                        endwhile;
                    ?>

                </ul>

            </section>
            <!--</section>-->
            
            <?php
                if(function_exists('tr_pagination')) :
                    tr_pagination();
                endif;
            ?>

            <?php tr_banners('bottom_list'); ?>
            
            <?php tr_seo_text('bottom'); ?>

        </main>
        <!--</Main>-->
        <?php get_sidebar(); ?>
    </div>
    <!--</TpRwCont>-->

    <?php
    else :

        get_template_part( 'template-parts/content/none' );

    endif;
    ?>

</div>
<!--</Main>-->   

<?php get_footer(); ?>