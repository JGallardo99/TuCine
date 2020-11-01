<?php get_header(); ?>
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
		                <h2 class="Title"><?php _e('Archive', 'toroflix'); ?></h2>
		            </div>
		            <ul class="MovieList Rows AX A04 B03 C20 D03 E20 Alt">
		            	<?php if(have_posts()) : 
		            		while(have_posts()) : the_post();?>
		            			<?php get_template_part("public/partials/template/loop-principal"); ?>
		            		<?php endwhile; ?> 
		            	<?php else: ?>
		            		<div>
		            			<?php _e('There are no articles', 'toroflix'); ?>
		            		</div>
		            	<?php endif; ?>
		            </ul>
		            <nav class="wp-pagenavi">
						<?php echo TOROFLIX_Add_Theme_Support::toroflix_pagination(); ?>
					</nav>
		        </section>                
            </main>
            <?php get_sidebar(); ?>
        </div>
	</div>
</div>
<?php get_footer(); ?>