<?php get_header(); ?>
<div class="Body">
    <div class="Main Container">
        <?php get_template_part('public/partials/template/letters'); ?>
        <div class="TpRwCont">
            <main>
		        <section>
		            <div class="Top AAIco-movie_filter">
		                <h2 class="Title">
		                	<?php if(isset($_GET['genre']) or isset($_GET['years'])){
								echo 'Filter';
		                	} else {
		                		echo get_search_query();
		                	} ?>
		                </h2>
		            </div>
		            <ul class="MovieList Rows AX A04 B03 C20 D03 E20 Alt">
		            	<?php if(isset($_GET['genre']) or isset($_GET['years'])){ ?>
		            		<?php $args = array(
		            		    'post_type'           => array('movies', 'series'),
		            		    'posts_per_page'      => get_option( 'posts_per_page' ),
		            		    'post_status'         => 'publish',
		            		    'no_found_rows'       => true,
		            		    'ignore_sticky_posts' => true,
		            		); 
		            		if( isset( $_GET['genre'] ) && $_GET['genre'] != '' ){
				                $args['tax_query'][] = array(
				                    'taxonomy' => 'category',
									'field'    => 'term_id',
									'terms'    => $_GET['genre']
				                );
				            }
				            if( isset( $_GET['years'] ) && $_GET['years'] != '' ){
				                $args['tax_query'][] = array(
				                    'taxonomy' => 'annee',
									'field'    => 'term_id',
									'terms'    => $_GET['years']
				                );
				            }
		            		$the_query = new WP_Query( $args );
		            		if ( $the_query->have_posts() ) :
		            		    while ( $the_query->have_posts() ) : $the_query->the_post();
		            		        get_template_part("public/partials/template/loop-principal");
		            		    endwhile;
		            		endif; wp_reset_query(); ?>
		            	<?php } else{
			            	if(have_posts()) : 
			            		while(have_posts()) : the_post();
			            			get_template_part("public/partials/template/loop-principal");
			            		endwhile; ?> 
			            	<?php else: ?>
			            		<div>
			            			<?php _e('There are no articles', 'toroflix'); ?>
			            		</div>
			            	<?php endif;
			            } ?>
		            </ul>
		        </section>                
            </main>
            <?php get_sidebar(  ); ?>
        </div>
	</div>
</div>
<?php get_footer(); ?>