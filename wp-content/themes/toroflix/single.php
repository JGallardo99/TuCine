<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Toroflix
 */

get_header(); ?>

<?php get_template_part( 'template-parts/single/header/movies' ); ?>

<!--<Main>-->
<div class="Main Container">
    
    <!--<TpRwCont>-->
    <div<?php tr_content_class(); ?>>
        <!--<Main>-->
        <main>

		<?php
            
        tr_banners('single_top');
            
		while ( have_posts() ) : the_post();
            
            get_template_part( 'template-parts/single/content/movies' );
            
            tr_banners('single_bottom');    
        ?>            
            
            <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
            
		endwhile; // End of the loop.  
        ?>

        </main>
        <!--</Main>-->
        <?php get_sidebar(); ?>
    </div>
    <!--</TpRwCont>-->

</div>
<!--</Main>-->   

<?php get_footer(); ?>