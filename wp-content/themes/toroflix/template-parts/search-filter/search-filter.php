<?php
/**
 * The template for search filter widget
 *
 * @package Toroflix
 */

get_header(); ?>
           
<!--<Main>-->
<div class="Main Container">

    <?php
    if ( have_posts() ) :

        if ( function_exists( 'tr_alphabet' ) ) :
            tr_alphabet();
        endif;
    
    ?>

    <!--<TpRwCont>-->
    <div<?php tr_content_class(); ?>>
        <!--<Main>-->
        <main>

            <!--<section>-->
            <section>
                <div class="Top AAIco-movie_filter">
                    <?php tr_title('search_filter', 'Title'); ?>
                    <?php
                    if ( function_exists( 'tr_sortby' ) ) :
                        tr_sortby();
                    endif;
                    ?>
                </div>
                <ul class="MovieList Rows AX A04 B03 C20 D03 E20 Alt">

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


        </main>
        <!--</Main>-->
        <?php get_sidebar(); ?>
    </div>
    <!--</TpRwCont>-->

    <?php
    else :

        get_template_part( 'template-parts/search-filter/none' );

    endif;
    ?>

</div>
<!--</Main>-->

<?php

get_footer();

?>