<?php get_header(); ?>
<!--<Body>-->
<div class="Body">
    <!--abecedario y post-->
    <div class="Main Container">
       <?php $alphabet = get_option('alphabet_show');
        if($alphabet){
	        	get_template_part('public/partials/template/letters');
	        } ?>
	            
               	        
        <!--<post - sidebar>-->
        <div class="TpRwCont"><!-- Poner la class "TpLCol" para sidebar a la Izquierda y "NoSdbr" cuando no hay sidebar-->
            <!--<contenido principal>-->
            <main>
            	<!--<Latest movies>-->
		        <section>
		            <div class="Top AAIco-movie_filter">
		                <h2 class="Title"><?php single_cat_title(); ?></h2>
		                <div class="SrtdBy AADrpd">
		                    <i class="AALink"></i>
		                    <span><?php _e('Sorted by:', 'toroflix'); ?></span>
		                    <ul class="List AACont">
		                        <li class="on"><a class="fa-check" href="#Latest"><?php _e('Latest', 'toroflix'); ?></a></li>
		                        <li><a class="AAIco-check" href="#Popular"><?php _e('Popular', 'toroflix'); ?></a></li>
		                        <li><a class="AAIco-check" href="#Views"><?php _e('Views', 'toroflix'); ?></a></li>
		                    </ul>
		                </div>
		            </div>
		            <ul class="MovieList Rows AX A04 B03 C20 D03 E20 Alt"> <!-- Agregar la class "Alt" para poner el tooltip como toroplay  -->
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
		        </section>                
            </main>
                        
            <?php get_sidebar(  ); ?>
        </div>
        <!--</TpRwCont>-->
	    
	</div>
   	       
</div>
<!--</Body>-->

<?php get_footer(); ?>