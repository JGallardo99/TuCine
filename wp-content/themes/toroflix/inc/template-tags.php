<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Toroflix
 */

if ( ! function_exists( 'toroflix_entry_header' ) ) :
	/**
	 * Prints HTML with meta information for ratings, year, quality, duration and views.
	 */
	function toroflix_entry_header($show_rating=true, $show_year=true, $show_quality=true, $show_runtime=true, $show_views=true ) {
        global $post;
        
        if(function_exists('the_ratings') and $show_rating==true) {
            echo '<div class="Vote">'.tr_the_ratings(false).'</div>';   
        }
        
        if($show_year==true){
            $date_field = get_post_meta($post->ID, TR_MOVIES_FIELD_DATE, true);
            $date_field_year = $date_field;
            if($date_field!=''){
                $date_field = explode('-', $date_field);
                $date_field_year = $date_field['0'] == '' ? '' : $date_field['0'];
                echo '<span class="Date">'.$date_field_year.'</span>';
            }
        }
             
        if($show_quality==true and toroflix_config('show_quality', 1)!=3){
            $trmovieslinks = unserialize(get_post_meta($post->ID, TR_MOVIES_FIELD_LINK, true));
            if(toroflix_config('show_quality', 1)==1) { $quality_total = count($trmovieslinks)-1; }else{ $quality_total = 0; }
            if(isset($trmovieslinks[$quality_total]['quality'])){
                $quality = get_term_by( 'id', $trmovieslinks[$quality_total]['quality'], 'quality' );

                echo '<span class="Qlty">'.$quality->name.'</span>';

            }
        }
        
        if($show_runtime==true){
            $runtime_field = get_post_meta($post->ID, TR_MOVIES_FIELD_RUNTIME, true);
            if(tr_check_type($post->ID)==2 and is_array($runtime_field)){
                $runtime_field = implode('m, ', $runtime_field).'m ';
            }elseif(tr_check_type($post->ID)==2 and !is_array($runtime_field)){
                $runtime_field = implode('m, ', explode(',', $runtime_field)).'m';
            }else{
                $runtime_field = $runtime_field;
            }

            if($runtime_field!=''){
                echo '<span class="Time">'.$runtime_field.'</span>';
            }  
        }
        
        if(function_exists('the_views') and $show_views==true) {
            echo '<span class="Views AAIco-remove_red_eye">'.the_views(false).'</span>';
        }
        
	}
endif;

if ( ! function_exists( 'toroflix_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags, cast and directors.
	 */
	function toroflix_entry_footer($show_tags=true, $limit_cast=0, $show_cat=true, $show_directors=true, $show_cast=true) {
        global $post;
        
        if($show_cat==true){
        
        /* translators: used between list items, there is a space after the comma */
        $categories_list = get_the_category_list( esc_html__( ', ', 'toroflix' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            printf( '<p class="Genre">' . esc_html__( '%1$sGenre:%2$s %3$s', 'toroflix' ) . '</p>', '<span>', '</span>', $categories_list ); // WPCS: XSS OK.
        }
            
        }
        
        if($show_directors==true){
            
        /* translators: used between list items, there is a space after the comma */

        $array_directors = array('');
        
        if(tr_check_type($post->ID)==2){ $taxonomy_directors = 'directors_tv'; }else{ $taxonomy_directors = 'directors'; }
        
        $term_list_directors = wp_get_post_terms($post->ID, $taxonomy_directors, array("fields" => "all"));
        
        if(!is_wp_error($term_list_directors) and !empty($term_list_directors)) {
            
            foreach($term_list_directors as $director_single) {
                $array_directors[]='<a href="'.get_term_link($director_single->term_id, $taxonomy_directors).'">'.$director_single->name.'</a>';
            }
            /* translators: 1: list of categories. */            
            printf( '<p class="Director">' . esc_html__( '%1$sDirector:%2$s %3$s', 'toroflix' ) . '</p>', '<span>', '</span>', implode(', ', array_filter($array_directors)) ); // WPCS: XSS OK.
            
        }
            
        }
        
        if($show_tags==true){
        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'toroflix' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            printf( '<p class="Genre">' . esc_html__( '%1$sTags:%2$s %3$s', 'toroflix' ) . '</p>', '<span>', '</span>', $tags_list ); // WPCS: XSS OK.
        }
        }
        
        if($show_cast==true){
        
        /* translators: used between list items, there is a space after the comma */
        
        $array_cast = array('');
        
        if(tr_check_type($post->ID)==2){ $taxonomy_cast = 'cast_tv'; }else{ $taxonomy_cast = 'cast'; }
        
        $term_list_cast = wp_get_post_terms($post->ID, $taxonomy_cast, array("fields" => "all"));
        
        if(!is_wp_error($term_list_cast) and !empty($term_list_cast)) {
            $i_cast = 1;
            foreach($term_list_cast as $cast_single) {
                $array_cast[]='<a href="'.get_term_link($cast_single->term_id, $taxonomy_cast).'">'.$cast_single->name.'</a>';
                if($i_cast==$limit_cast and $limit_cast>0){ break; }
                $i_cast++;
            }
            /* translators: 1: list of categories. */
            if(is_single()){
                printf(  esc_html__( '%1$sCast:%2$s %3$s', 'toroflix' ), '<section class="CastCn"><div class="Top AAIco-group"><div class="Title">', '</div><span class="Button Sm AATggl CastLink" data-tggl="CastUl"><span>'.__('View More', 'toroflix').'</span><span>'.__('View Less', 'toroflix').'</span></span></div>', '<ul id="CastUl" class="CastList Rows AX A06 B04 C03 D04 E03"><li>'.implode('</li><li>', array_filter($array_cast)).'</li></ul></section>' );
            }else{
                printf( '<p class="Cast">' . esc_html__( '%1$sCast:%2$s %3$s', 'toroflix' ) . '</p>', '<span>', '</span>', implode(', ', array_filter($array_cast)) ); // WPCS: XSS OK.
            }
            
        }
            
        }

	}
endif;

function tp_link_footer(){
    $array = array(

        __('Themes Movies Online', 'toroflix'),
        __('Theme Movie Online', 'toroflix'),
        __('Movies Online WordPress', 'toroflix'),
        __('Themes WordPress Movie', 'toroflix')

    );

    if(get_option('tf_link')==''){ update_option('tf_link', $array[array_rand($array, 1)]); $link=get_option('tf_link'); }else{ $link=get_option('tf_link'); }

    return '<a target="_blank" href="http://123stream.la/">'.$link.'</a>';
}
?>