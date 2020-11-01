<?php get_header();
	global $post;
	if(have_posts()) : while(have_posts()) : the_post();
		$loop = new TOROFLIX_Movies(); ?>
        <div class="Body">
        	<?php do_action( 'single_body', $loop ); ?>
		</div>
	<?php endwhile; endif;
get_footer(); ?>


<div class="Modal-Box Ttrailer">
    <div class="Modal-Content">
        <span class="Modal-Close Button AAIco-clear"></span>
    </div>
    <i class="AAOverlay"></i>
</div>