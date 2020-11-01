<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Toroflix
 */

get_header(); ?>
          
<!--<Main>-->
<div class="Main Container">               
    <section class="error-404 not-found AAIco-sentiment_very_dissatisfied">
        <header class="Top">
            <h1 class="Title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'toroflix' ); ?></h1>
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'toroflix' ); ?></p>
        </header><!-- .page-header -->
        <aside class="page-content">
            <?php
                get_search_form();
            ?>
            <div class="Wdgt widget_categories">
                <h2 class="Title"><?php esc_html_e( 'Most Used Categories', 'toroflix' ); ?></h2>
                <ul>
                <?php
                    wp_list_categories( array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'show_count' => 1,
                        'title_li'   => '',
                        'number'     => 10,
                    ) );
                ?>
                </ul>
            </div><!-- .widget -->
        </aside><!-- .page-content -->
    </section><!-- .error-404 -->                		    
</div>
<!--</Main>-->

<?php

get_footer();

?>