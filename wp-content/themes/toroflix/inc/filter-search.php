<?php
/**
 * Search Filter
 */

add_filter( 'template_include', 'tr_search_filter_template' );

function tr_search_filter_template( $template ){

    if( get_query_var('trfilter')!='' ){
        return get_template_part('template-parts/search-filter/search-filter');            
    }else{
        return $template;
    }

}

function tr_search_filter_insert_query_vars( $vars ){
    array_push($vars, 'trfilter');
    return $vars;
}

add_filter( 'query_vars','tr_search_filter_insert_query_vars' );

function tr_search_filter( $query ) {
    if ( !is_admin() && $query->is_search() && $query->is_main_query() && get_query_var('trfilter')!='' ) {

        $cat = ''; $cast = ''; $country = ''; $directors = ''; $quality = ''; $lang = ''; $server = ''; $years=''; $tr_post_type = ''; $suffix = '';

        $geners_sql = isset($_GET['geners']) ? array_map('intval', $_GET['geners']) : '';
        $cast_sql = isset($_GET['casts']) ? array_map('intval', $_GET['casts']) : '';
        $countries_sql = isset($_GET['countries']) ? array_map('intval', $_GET['countries']) : '';
        $directors_sql = isset($_GET['trdirectors']) ? array_map('intval', $_GET['trdirectors']) : '';
        $quality_sql = isset($_GET['qualitys']) ? array_map('intval', $_GET['qualitys']) : '';
        $lang_sql = isset($_GET['langs']) ? array_map('intval', $_GET['langs']) : '';
        $server_sql = isset($_GET['servers']) ? array_map('intval', $_GET['servers']) : '';
        $years_sql = isset($_GET['years']) ? implode('|', array_map('intval', $_GET['years'])) : '';
        
        if(get_query_var('trfilter')==2){
            $tr_post_type = array(
                'key' => 'tr_post_type', 
                'compare' => '=',
                'value' => 2
            );
            
            $suffix = '_tv';
        }
        
        if($geners_sql!=''){
            $cat =  array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $geners_sql,
            );
        }

        if($quality_sql!=''){
            $quality =  array(
                'taxonomy' => 'quality',
                'field'    => 'term_id',
                'terms'    => $quality_sql,
            );
        }
        
        if($countries_sql!=''){
            $country =  array(
                'taxonomy' => 'countries',
                'field'    => 'term_id',
                'terms'    => $countries_sql,
            );
        }

        if($lang_sql!=''){
            $lang =  array(
                'taxonomy' => 'language',
                'field'    => 'term_id',
                'terms'    => $lang_sql,
            );
        }

        if($server_sql!=''){
            $server =  array(
                'taxonomy' => 'server',
                'field'    => 'term_id',
                'terms'    => $server_sql,
            );
        }

        if($cast_sql!=''){
            $cast =  array(
                'taxonomy' => 'cast'.$suffix,
                'field'    => 'term_id',
                'terms'    => $cast_sql,
            );
        }

        if($directors_sql!=''){
            $directors =  array(
                'taxonomy' => 'directors'.$suffix,
                'field'    => 'term_id',
                'terms'    => $directors_sql,
            );
        }
        
        if($years_sql!=''){

            $years = array(
                'key' => 'field_date',
                'value' => '^('.$years_sql.')-[0-9]{2}-[0-9]{2}',
                'compare' => 'REGEXP'
            );
            
        }

        $query->set( 's', '' );
        
        $query->set( 'posts_per_page', toroflix_config('posts_per_search', 15) );
        
        $query->set( 'meta_query', array(
            $years,
            $tr_post_type
        ));

        $query->set( 'tax_query', array(
            array( 
                'relation' => 'AND',
                    $cat,
                    $cast,
                    $country,
                    $directors,
                    $quality,
                    $lang,
                    $server
            ),
        ));

    }
}
add_action( 'pre_get_posts', 'tr_search_filter' );

function tr_search_filter_head(){
    echo "\n\r".'<script type="text/javascript">var tr_arr_casts = ""; var tr_arr_directors = ""; var tr_arr_countries = "";</script>'."\n\r";
}

add_action('wp_head', 'tr_search_filter_head');
?>