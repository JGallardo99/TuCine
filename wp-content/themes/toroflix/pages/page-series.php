<?php /*
template name: Page Series
*/

get_header(); ?>
<div class="Body">
    <div class="Main Container">
        <?php $alphabet = get_option('alphabet_show');
        if($alphabet){
	        	get_template_part('public/partials/template/letters');
	        } ?>
        <div class="TpRwCont">
            <main>
		        <section>
		            <div class="Top AAIco-movie_filter">
		                <h2 class="Title"><?php the_title(); ?></h2>
		            </div>
		            <?php $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	            	$args = array(
						'post_type'           => 'series',
						'paged'               => $paged,
						'posts_per_page'      => get_option( 'posts_per_page' ),
						'post_status'         => 'publish',
	            	); 
	            	$wp_query = new WP_Query( $args );
	            	if ( $wp_query->have_posts() ) : ?>
			            <ul class="MovieList Rows AX A04 B03 C20 D03 E20 Alt">
			            	<?php 
		            	    while ( $wp_query->have_posts() ) : $wp_query->the_post();
		            	        get_template_part("public/partials/template/loop-principal");
		            	    endwhile; ?>
			            </ul>
			            <nav class="wp-pagenavi">
							<?php echo TOROFLIX_Add_Theme_Support::toroflix_pagination(); ?>
						</nav>
					<?php endif; wp_reset_query();  ?>
		        </section>                
            </main>
            <?php get_sidebar(); ?>
        </div>
	</div>
</div>
<?php get_footer(); ?>