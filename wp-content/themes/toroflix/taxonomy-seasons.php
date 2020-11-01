<?php get_header();
    $term_id  = get_queried_object_id();
    $serie_id = get_term_meta( $term_id, 'tr_id_post', true );
    $term     = get_term_by('id', $term_id, 'seasons');
    $slug     = $term->slug;
    $data     = array( 'serie_id' => $serie_id, 'term' => $term, 'slug' => $slug, 'term_id' => $term_id); ?>
    <div class="Body">
        <div class="Main Container">
            <?php do_action( 'season_content', $data );
                    #10: Carousel letter
                    #20: Info
                    #30: Related ?>
        </div>
    </div>
<?php get_footer(); ?>