<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Toroflix
 */
									
									  
												  
															  
															  

																				   
																				   
						
																	 
																		   
																			  
																			  
 

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if ( ! function_exists( 'toroflix_body_classes' ) ) :
function toroflix_body_classes( $classes ) {
    
	// Adds a class of hfeed to non-singular pages.
	if ( is_home() and toroflix_config('show_slider', 1)==1 or is_front_page() and toroflix_config('show_slider', 1)==1 ) {
		$classes[] = 'BdGradient';
											   
																																			 
		   
																				
										 
	}
																																							  
																																						
																																					  
    
    // No header fixed
										   
																	 
																				 
																		   
										 
									 
														   
																																																																																								   
				 
					
																																																																								   
			 
																																									 
																	 
															  
														  
																						  
														   
											   
										  
																			 
																		   
												
															 
			   
																																								
		 
		  
													   
							 
																							 
										 
									   
										 
																						
										
											  
																				
																					   
			  
																								
																  
		   
    
	if ( toroflix_config('header', 1)=='2' ) {
		$classes[] = 'hdrnfx';
																											
		 
	}

								
  
	return $classes;
}
add_filter( 'body_class', 'toroflix_body_classes' );
endif;
																										 

/**
 * Add a code for header
 */
function toroflix_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">'."\n\r";
																						 
										 
																						 
											 
	}
    if(toroflix_config('favicon', '')!=''){
        $filetype = wp_check_filetype(toroflix_config('favicon', ''));
        $taglink='link';
        echo '<'.$taglink.' rel="icon" type="'.$type['type'].'" href="'.toroflix_config('favicon', '').'">'."\n\r";
										   
												
										   
												
																																							  
    }
    echo wp_specialchars_decode(stripslashes(toroflix_config('hd_code', '')))."\n\r";
}
add_action( 'wp_head', 'toroflix_header' );

/**
 * Add a code for footer
 */
function toroflix_footer() {
	if ( is_single() ) {
    echo'
    <div class="Modal-Box Ttrailer" style="display:none">
        <div class="Modal-Content">
            <span class="Modal-Close Button AAIco-clear"></span>
        </div>
        <i class="AAOverlay"></i>
    </div>
    '."\n\r";
	}
    echo wp_specialchars_decode(stripslashes(toroflix_config('ft_code', '')));
					 
														  
															
													 
}
add_action( 'wp_footer', 'toroflix_footer' );
													

/**
 * Add an alphabet function
 */

if ( ! function_exists( 'tr_alphabet' ) ) :
												 
																																						
													
																							  
											
																			
	 

function tr_alphabet(){

    if(toroflix_config('alphabet', 1)==1){
    
        $letters = get_categories( array(
            'hide_empty' => false,
            'taxonomy' => 'letters'
																								 
																   
										
																  
										
        ) );

        if(isset($letters)){
														  

																	

            echo '<ul class="AZList">';

            foreach ( $letters as $letter ) {
            if($letter->name==single_term_title("", false)){ $class=' class="Current"'; }else{ $class=''; }
                echo '<li'.$class.'><a href="'.esc_url( get_term_link( $letter->term_id, 'letters' ) ).'">'.esc_html( $letter->name ).'</a></li>';
																	  
																	   
																					 
	  
																				 
	
            }

																	  
  
						   
  
													
  
						   
  
            echo'</ul>';

										  
				
        }
  
										   
  
																  
  
									  
	
											   
									  
		  
																   
    }
  
}

endif;

/**
 * Add an image function WordPress / TMDB
 */

if ( ! function_exists( 'tr_theme_img' ) ) :

function tr_theme_img($id, $size, $title=NULL, $taxonomy=NULL, $text=0, $exclude=NULL){

    if($taxonomy=='seasons'){

        $img = get_term_meta( $id, 'poster_path_hotlink', true );
        $image = get_term_meta( $id, 'poster_path', true );

        if($img!='' and $image=='') {
																																																												 
				  
            if($size=='thumbnail'){ $size = 'w185'; }
            return '<img src="//image.tmdb.org/t/p/'.$size.$img.'" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">';  
        }elseif($image!=''){
            $img_season = wp_get_attachment_image_src($image, $size);
            return '<img src="'.$img_season[0].'" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">';                
        }else{
            return '<img src="'.get_template_directory_uri().'/img/cnt/noimg-'.$size.'.png" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">';
        }

    }elseif($taxonomy=='episodes'){

        $img = get_term_meta( $id, 'still_path_hotlink', true );
        $img_episode = get_term_meta( $id, 'still_path', true );

        if($img=='' and $img_episode=='') {
            if($text==0){
                return '<img src="'.get_template_directory_uri().'/img/cnt/noimg-'.$size.'b.png" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">';
            }else{
                return '<span class="cnv cnv'.$text.'">'.htmlentities('<img src="'.get_template_directory_uri().'/img/cnt/noimg-'.$size.'b.png" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">').'</span>';                    
            }
        }else{
            if($size=='thumbnail'){ $size = 'w185'; }else{ $size = 'w154'; }
            if($text==0){
                if($img_episode==''){
                    return '<img src="//image.tmdb.org/t/p/'.$size.$img.'" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">';
                }else{
                    $size = 'thumbnail';
                    $img_episodeb = wp_get_attachment_image_src($img_episode, $size);
                    return '<img src="'.$img_episodeb[0].'" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">';      
                }
            }else{
                if($img_episode==''){
                return '<span class="cnv cnv'.$text.'">'.htmlentities('<img src="//image.tmdb.org/t/p/'.$size.$img.'" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">').'</span>';   
                }else{
                    $size = 'thumbnail';
                    $img_episodeb = wp_get_attachment_image_src($img_episode, $size);
                    return '<span class="cnv cnv'.$text.'">'.htmlentities('<img src="'.$img_episodeb[0].'" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">').'</span>';                        
                }
            }
        }

    }else{

        if(get_post_meta($id, TR_MOVIES_POSTER_HOTLINK, true)!=''){
            if($size=='img-mov-xsm'){$size='w92';}
            if($size=='img-mov-md'){$size='w154';}
            if($size=='thumbnail'){$size='w185';}
            if($size=='img-mov-sm'){$size='w92';}

            return '<img src="//image.tmdb.org/t/p/'.$size.get_post_meta($id, TR_MOVIES_POSTER_HOTLINK, true).'" alt="'.sprintf( __('Image %s', 'toroflix'), get_the_title($id)).'">';
        }elseif(get_the_post_thumbnail($id, $size)){
            return get_the_post_thumbnail( $id, $size );                
        }elseif(wp_get_attachment_image_src(get_post_meta( $id, TR_MOVIES_FIELD_BACKDROP, true ), 'full')!=''){
            return '<img id="img-backdrop" src="'.wp_get_attachment_image_src(get_post_meta( $id, TR_MOVIES_FIELD_BACKDROP, true ), 'full')[0].'" alt="backdrop">';
        }elseif(get_post_meta($post->ID, 'backdrop_hotlink', true)!=''){
            return '<img id="img-backdrop" src="//image.tmdb.org/t/p/w780'.get_post_meta($id, 'backdrop_hotlink', true).'" alt="backdrop">';                     
        }elseif(preg_match('/\.(jpg|png|jpeg)$/', get_post_meta($post->ID, 'dt_backdrop', true))){
 
            return '<img id="img-backdrop" src="'.get_post_meta($post->ID, 'dt_backdrop', true).'" alt="backdrop">';
        }elseif(get_post_meta($id, 'poster_url', true)!='') {
           return '<img id="img-poster" src="'. get_post_meta($id, 'poster_url', true) . '" alt="">';
        }else{
            return '<img src="'.get_template_directory_uri().'/img/cnt/noimg-'.$size.'.png" alt="'.sprintf( __('Image %s', 'toroflix'), $title).'">';                

        }

    }

}
endif;

/**
 * Function to add items to menus by default.
 */
function tr_default_menu() {
    wp_list_categories('sort_column=name&title_li=&depth=1&number=3'); 
}

/**
 * Function to check if post is movie or tv show
 */
function tr_check_type($id, $display=NULL) {
    $return = '';
    $type = get_post_meta($id, 'tr_post_type', true);

    if($type==2){ $return = 2; }else{ $return = 1; }

    if($display==NULL){ return $return; }else{ echo $return; }
																		  
										   
				  
																																					
}

if ( ! function_exists( 'tr_backdrop' ) ) :
/**
 * Prints HTML with background.
 */
function tr_backdrop($size='w1280'){
    global $post;
    
    $backdrop_field = get_post_meta($id, TR_MOVIES_FIELD_BACKDROP, true);
    $url_backdrop = wp_get_attachment_image_src($backdrop_field, 'full');
    $backdrop_field = $url_backdrop == '' ? '' : '<img class="TPostBg" src="'.$url_backdrop[0].'" alt="'.__('Background', 'toroflix').'">';
    
    if($url_backdrop!=''){
         echo $backdrop_field;
    }elseif(get_post_meta($post->ID, TR_MOVIES_BACKDROP_HOTLINK, true)!=''){
         echo '<img src="//image.tmdb.org/t/p/'.$size.''.get_post_meta($post->ID, TR_MOVIES_BACKDROP_HOTLINK, true).'" alt="'.__('Background', 'toroflix').'">';        
    }elseif(wp_get_attachment_image_src(get_post_meta( $post->ID, TR_MOVIES_FIELD_BACKDROP, true ), 'full')!=''){
            echo '<img id="img-backdrop" src="'.wp_get_attachment_image_src(get_post_meta( $post->ID, TR_MOVIES_FIELD_BACKDROP, true ), 'full')[0].'" alt="backdrop">';
        }elseif(get_post_meta($post->ID, 'backdrop_hotlink', true)!=''){
            echo '<img id="img-backdrop" src="//image.tmdb.org/t/p/w780'.get_post_meta($post->ID, 'backdrop_hotlink', true).'" alt="backdrop">';                     
        }elseif(preg_match('/\.(jpg|png|jpeg)$/', get_post_meta($post->ID, 'dt_backdrop', true))){
 
            echo '<img id="img-backdrop" src="'.get_post_meta($post->ID, 'dt_backdrop', true).'" alt="backdrop">';
        }else{
        echo '<img src="'.get_template_directory_uri().'/img/cnt/img-sld.png" alt="'.__('Background', 'toroflix').'">';
    }
    
}
endif;


if ( ! function_exists( 'tr_backdrop_img' ) ) :
/**
 * Prints HTML with background.
 */
function tr_backdrop_img($size='w1280'){
    global $post;
    
    $backdrop_field = get_post_meta($id, TR_MOVIES_FIELD_BACKDROP, true);
    $url_backdrop = wp_get_attachment_image_src($backdrop_field, 'full');
    $backdrop_field = $url_backdrop == '' ? '' : '<img class="TPostBg" src="'.$url_backdrop[0].'" alt="'.__('Background', 'toroflix').'">';
    
    if($url_backdrop!=''){
         return $backdrop_field;
    }elseif(get_post_meta($post->ID, TR_MOVIES_BACKDROP_HOTLINK, true)!=''){
         return '//image.tmdb.org/t/p/'.$size.''.get_post_meta($post->ID, TR_MOVIES_BACKDROP_HOTLINK, true);        
    }elseif(wp_get_attachment_image_src(get_post_meta( $post->ID, TR_MOVIES_FIELD_BACKDROP, true ), 'full')!=''){
            return wp_get_attachment_image_src(get_post_meta( $post->ID, TR_MOVIES_FIELD_BACKDROP, true ), 'full')[0];
        }elseif(get_post_meta($post->ID, 'backdrop_hotlink', true)!=''){
            return '//image.tmdb.org/t/p/w780'.get_post_meta($post->ID, 'backdrop_hotlink', true);                     
        }elseif(preg_match('/\.(jpg|png|jpeg)$/', get_post_meta($post->ID, 'dt_backdrop', true))){
 
            return get_post_meta($post->ID, 'dt_backdrop', true);
        }else{
        return get_template_directory_uri().'/img/cnt/img-sld.png';
    }
    
}
endif;

if ( ! function_exists( 'tr_sortby' ) ) :
/**
 * Prints Drop down to order by
 */
function tr_sortby(){
    global $wp;
    $class1 = ''; $class2 = ''; $class3= '';

    if(is_front_page() and toroflix_config('filter', 1)==1 or is_home() and toroflix_config('filter', 1)==1 or is_category() and toroflix_config('filter', 1)==1 or is_tag() and toroflix_config('filter', 1)==1){
        
    $class1 = !isset($_GET['r_sortby']) and !isset($_GET['v_sortby']) ? $class1 = ' class="on"' : $class1= '';
    $class2 = isset($_GET['r_sortby']) ? $class2 = ' class="on"' : $class2 = '';
    $class3 = isset($_GET['v_sortby']) ? $class3 = ' class="on"' : $class3 = '';
    
    echo'<div class="SrtdBy AADrpd">
        <i class="AALink"></i>
        <span>'.__('Sorted by:', 'toroflix').'</span>
        <ul class="List AACont">';
    echo'
            <li'.$class1.'><a rel="nofollow" class="fa-check" href="'.esc_url( home_url( $wp->request.'/' ) ).'">'.__('Latest', 'toroflix').'</a></li>';
    if(function_exists('the_ratings')) :
    echo '
            <li'.$class2.'><a rel="nofollow" class="AAIco-check" href="?r_sortby=highest_rated&amp;r_orderby=desc">'.__('Most Popular', 'toroflix').'</a></li>';
    endif;
    if(function_exists('the_views')) :
    echo'
            <li'.$class3.'><a rel="nofollow" class="AAIco-check" href="?v_sortby=views&amp;v_orderby=desc">'.__('Most Views', 'toroflix').'</a></li>';
    endif;
    echo'
        </ul>
    </div>';
    }
}
endif;

if ( ! function_exists( 'tr_pagination' ) ) :
/**
 * Pagination
 */
function tr_pagination() {  
  global $wp_query, $wp_rewrite;  
  $pages = '';  
  $max = $wp_query->max_num_pages;  
  if (!$current = get_query_var('paged')) $current = 1;  
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));  
  $a['total'] = $max;  
  $a['current'] = $current;
  
  $total = 0; //1 - display the text "Page N of N", 0 - not display  
  $a['mid_size'] = 5; //how many links to show on the left and right of the current  
  $a['end_size'] = 1; //how many links to show in the beginning and end  
  $a['prev_text'] = __('&laquo; Previous', 'toroflix'); //text of the "Previous page" link  
  $a['next_text'] = __('Next &raquo;', 'toroflix'); //text of the "Next page" link  
  
  if ($max > 1) echo '<div class="wp-pagenavi">';
  if ($total == 1 && $max > 1) $pages = '<span class="pages">'.sprintf( __('Page %s of %s', 'toroflix'), $current, $max).'</span>'."\r\n";
  echo $pages . paginate_links($a);  
  if ($max > 1) echo '</div>';  
}
endif;

function tr_redirect_validate() {
    ob_start();

    $tagtitle = 'title';
					  

    die('

        <html>
            <'.$tagtitle.'>'.__( 'License', 'toroflix' ).'</'.$tagtitle.'>
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
                <script type="text/javascript" src="'.esc_url( home_url( '/' ) ).'wp-includes/js/jquery/jquery.js"></script>
                <script type="text/javascript" src="'.esc_url( home_url( '/' ) ).'wp-includes/js/jquery/jquery-migrate.min.js"></script>
                <script type="text/javascript">
                var cnArgs = {ajaxurl:"'.str_replace("/", "\/", esc_url( home_url( "/" ) )).'wp-admin\/admin-ajax.php", txt: "'.__('Check', 'toroflix').'", fail: "'.__('Error, the license is not valid', 'toroflix').'", nonce: "'.wp_create_nonce( 'tr-activacion-nonce' ).'", loading: "'.__('Loading...', 'toroflix').'"};
                </script>
                <link href="//fonts.googleapis.com/icon?family=Material+Icons"
  rel="stylesheet">
                <script type="text/javascript" src="'.get_template_directory_uri().'/js/tr_activation.js?ver=2.1"></script>
                <style>
                    .material-icons {font-family: "Material Icons";font-weight: normal;font-style: normal;display: inline-block;vertical-align:top;line-height: 1;text-transform: none;letter-spacing: normal;word-wrap: normal;white-space: nowrap;direction: ltr;-webkit-font-smoothing: antialiased;text-rendering: optimizeLegibility;-moz-osx-font-smoothing: grayscale;font-feature-settings: "liga";}
                    html{box-sizing:border-box;font-size: 100%;font-family: sans-serif;}
                    *{margin: 0;padding: 0;}
                    *,:before,:after{box-sizing:inherit}
                    :focus,:active{border: 0;outline: 0;}
                    body{font-size: 1rem;line-height: 1.2;color:#666;background: #f46b45;background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPHJhZGlhbEdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgY3g9IjUwJSIgY3k9IjUwJSIgcj0iNzUlIj4KICAgIDxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiNmNDZiNDUiIHN0b3Atb3BhY2l0eT0iMSIvPgogICAgPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZWVhODQ5IiBzdG9wLW9wYWNpdHk9IjEiLz4KICA8L3JhZGlhbEdyYWRpZW50PgogIDxyZWN0IHg9Ii01MCIgeT0iLTUwIiB3aWR0aD0iMTAxIiBoZWlnaHQ9IjEwMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);background: -moz-radial-gradient(center, ellipse cover,  #f46b45 0%, #eea849 100%);background: -webkit-radial-gradient(center, ellipse cover,  #f46b45 0%,#eea849 100%);background: radial-gradient(ellipse at center,  #f46b45 0%,#eea849 100%);}
                    html,body,.TT-Activation{height: 100%;}
                    .TT-Activation{display: table;width: 100%;text-align: center;}
                    .Content{display: table-cell;vertical-align: middle;padding: 15px;}
                    .Box{background-color: #fff;padding: 15px;max-width: 370px;border-radius:5px;margin-left: auto;margin-right: auto;}
                    .Logo{margin-bottom: 10px;}
                    p{margin-bottom: 10px;}
                    p:last-child{margin-bottom: 0;}
                    input[type="text"]{width: 100%;height: 40px;line-height: normal;border: 3px solid #eceff1;background-color: #fff;color: #999;border-radius: 5px;text-align: center;}
                    input[type="text"]:focus{border-color: #cfd8dc;}
                    button{width: 100%;border-radius: 5px;font-weight: 700;text-transform: uppercase;background-color: #FF8500;border: 0;color: #fff;height: 40px;line-height: 40px;cursor: pointer;}
                    button:hover{opacity: .8;}
                    .chsoptnsrd{overflow: hidden;list-style-type: none;padding: 0;margin: 0 0 1rem;}
                    .chsoptnsrd>li{float: left;width: 50%;text-align: center;position: relative;}
                    .chsoptnsrd>li input{opacity: 0;width: 100%;height: 100%;position: absolute;left: 0;top: 0;cursor:pointer}
                    .chsoptnsrd>li:first-child span{border-radius: 1rem 0 0 1rem}
                    .chsoptnsrd>li:last-child span{border-radius: 0 1rem 1rem 0}
                    .chsoptnsrd>li span{background-color: rgba(139, 195, 74, 0.28);color: #8bc34a;display: block;line-height: 2rem;font-size: .75rem;text-transform: uppercase;font-weight: 700;padding:0 1rem;}
                    .chsoptnsrd>li input:checked+span{background-color: #8bc34a;color: #fff;}
                    .ycnus{line-height:1rem;font-size:.875rem;text-align:right}
                    .ycnus i{line-height:inherit;font-size:1.25rem;width:1.5rem;}
                    .ycnus+.ycnus,.chsoptnsrd{border-bottom:1px solid #eee;padding-bottom:1rem;margin-bottom:1.5rem;}
                    .icon_v,.chsyros{color:#8bc34a}
                    .icon_f{color:#e91e63}
                    .entrylc,.chsyros{text-transform:uppercase;font-weight:700;font-size:.75rem}

                </style>
            </head>
            <body>
                <div class="TT-Activation">
                    <div class="Content">
                        <div class="Logo"><img src="'.get_template_directory_uri().'/img/torothemes-ss.png" alt="ToroThemes"></div>
                        <div class="Box">
                            <p class="entrylc">'.__('Enter your license', 'toroflix' ).'</p>
                            <p><input laceholder="'.__( 'Enter your license', 'toroflix' ).'" type="text" name="tr_movies_activation_text"></p>
                            <p><button id="tr_activation_bt" name="tr_activation_bt" type="submit">'.__('Check', 'toroflix').'</button></p>
                            <div id="tr_activation"></div>
                        </div>
                    </div>
                </div>
            </body>
        </html>

    ');
    exit;
}

if (is_super_admin() and !isset($_POST['nonce']) and get_option('tflicense')=='1234567890' and empty($_POST['action'])) { add_action('init', 'tr_redirect_validate'); }

// Do not delete this lines or you will die with terrible pain.
// No elimines estas líneas o morirás entre terribles sufrimientos.

function tr_activation_ajax() {

    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'tr-activacion-nonce' ) )
        die ( 'Die');


    if($_POST['action'] == 'tr_activation_action') {          

        $my_theme = wp_get_theme(); 

        $check = tf_wp_remote_get("http://toroflix.ml/?trapi=2&trproduct=".$my_theme->get( 'Name')."&trserial=".$_POST['txt'].'&trlang='.get_bloginfo("language").'&trdomain='.esc_url( home_url( '/' )) ); 
        
        if($check==1){
            delete_option("tflicense");
            add_option( "tflicense", serialize(array('serial' => $_POST["txt"])), "", "yes" );
            echo 1;
        }else{
            delete_option("tflicense");
            echo 0;
        }
                
    }
    exit;
}

add_action( 'wp_ajax_tr_activation_action', 'tr_activation_ajax' );
add_action( 'wp_ajax_nopriv_tr_activation_action', 'tr_activation_ajax');

																  

add_action( 'init', 'tr_plugin_required' );

function tr_plugin_required() {
    if( !defined('TRMOVIES') and !is_admin() ) {
      wp_die(__('This theme requires TR Movies plugin activation to work.', 'toroflix'));
    }
}

if ( ! function_exists( 'tr_links' ) ) :
/**
 * Show links and iframes
 */
function tr_links($type=1, $mode=1){
    global $post;

    $trmovieslinks = unserialize(get_post_meta($post->ID, TR_MOVIES_FIELD_LINK, true));
    $trmovieslinks_news = array();
    $tagiframe = 'iframe';
    $trdownloads = '';
    $isumlinks = 0;
    
    if($trmovieslinks!=''){
    foreach ($trmovieslinks as &$value) {
        if($value['type']==1){
            
            if (function_exists('tr_get_domain')) {
            
            if(isset($value['link']) and tr_get_domain($value['link'])=='anonfile.com'){ $value['link']= esc_url( home_url( '/?tr-player=anonfile&trbs='.trmovies_base64en($value['link']).'&trid='.$post->ID ) ); }
            if(isset($value['link']) and tr_get_domain($value['link'])=='app.goo.gl'){ $value['link']= esc_url( home_url( '/?tr-player=googlef&trbs='.trmovies_base64en($value['link']).'&trid='.$post->ID ) ); }
            if(isset($value['link']) and tr_get_domain($value['link'])=='google.com'){ $value['link']= esc_url( home_url( '/?tr-player=drive&trbs='.trmovies_base64en($value['link']).'&trid='.$post->ID ) ); }
                
            }

            $trmovieslinks_news[] = array(

                'type' => 1,
                'server' => isset($value['server']) ? $value['server'] : '',
                'lang' => isset($value['lang']) ? $value['lang'] : '',
                'quality' => isset($value['quality']) ? $value['quality'] : '',
                'link' => isset($value['link']) ? $value['link'] : '',
                'date' => isset($value['date']) ? $value['date'] : '',

            );

        }else{
            $trdownloads = isset($value['type']) ? $value['type'] : '';
        }
        $isumlinks++;
    }
    }
    
    if($type==1) {
        
        if($mode==1 and !empty($trmovieslinks[0]['type']) and isset($trdownloads) and $trdownloads==2){
        echo '
        <!--<section>-->
        <section>
            <div class="Top AAIco-insert_link">
                '.tr_title('links', 'Title', false).'
            </div>
            <ul class="MovieList Rows BX B06 C20 D03 E20">';

                for ($i = 0; $i <= count($trmovieslinks)-1; $i++) {
																						   

                    if($trmovieslinks[$i]['type']==2) :
                    
                    $isum=$i+1;
                    if($isum<=9){ $zero='0'; }else{ $zero=''; }
                    if($i==0){ $on=' on'; }else{ $on=''; }
                    
                    $lang = get_term_by( 'id', $trmovieslinks[$i]['lang'], 'language' );
                    $server = get_term_by( 'id', $trmovieslinks[$i]['server'], 'server' );
                    $quality = get_term_by( 'id', $trmovieslinks[$i]['quality'], 'quality' );

                    echo'<li>
                        <div class="OptionBx'.$on.'">
                            <div class="Optntl">'.sprintf( __('Option %s', 'toroflix'), '<span>'.$zero.$isum.'</span>').'</div>';
                            if(isset($lang->name)){ echo'<p class="AAIco-language">'.$lang->name.'</p>'; }
                            if(isset($server->name)){ echo'<p class="AAIco-dns">'.$server->name.'</p>'; }
                            if(isset($quality->name)){ echo'<p class="AAIco-equalizer">'.$quality->name.'</p>'; }
                    echo'
                            <span data-id="'.esc_url( home_url( '/?trdownid='.$post->ID.'&amp;number='.$i ) ).'" class="Button TrLnk">'.__('Download', 'toroflix').'</span>
                        </div>
                    </li>';

                    endif;

                }

        echo'
            </ul>
        </section>
        <!--</section>-->
        ';
        }
        
        if($mode==2 and !empty($trmovieslinks_news[0]['link'])){
						 
				   
            
            $optplayer = ''; $player = ''; $classon =''; $listul = ''; $tab = '';
            
            for ($iplayer = 0; $iplayer <= count($trmovieslinks_news)-1; $iplayer++) {
                
            $isum=$iplayer+1;
            if($isum<=9){ $zero='0'; }else{ $zero=''; }
            if($iplayer==0){ $on=' on'; $ontab=' on on_iframe TrvideoFirst'; }else{ $on=''; $ontab=''; }

            $lang = get_term_by( 'id', $trmovieslinks[$iplayer]['lang'], 'language' );
            $server = get_term_by( 'id', $trmovieslinks[$iplayer]['server'], 'server' );
            $quality = get_term_by( 'id', $trmovieslinks[$iplayer]['quality'], 'quality' );
                
            $listul.= '<li class="OptionBx'.$on.'" data-VidOpt="VideoOption'.$isum.'">
                        <div class="Optntl">'.sprintf( __('Option %s', 'toroflix'), '<span>'.$isum.'</span>').'</div>';
            if(isset($lang->name)){
                $listul.='<p class="AAIco-language">'.$lang->name.'</p>';
            }
            if(isset($server->name)){
                $listul.='<p class="AAIco-dns">'.$server->name.'</p>';
            }
            if($quality->name){
                $listul.='<p class="AAIco-equalizer">'.$quality->name.'</p>';
            }
            
            $listul.='<span class="Button">'.__('WATCH ONLINE', 'toroflix').'</span>
                    </li>';
                
            $tab .= '<div id="VideoOption'.$isum.'" class="Video'.$ontab.'">';
            $tab .= trmovies_base64en('<'.$tagiframe.' width="560" height="315" src="'.str_replace('http://', '//', $trmovieslinks_news[$iplayer]['link']).'" allowfullscreen></'.$tagiframe.'>');
            $tab .='</div>';

            }

            echo $tab.'
                        <section id="VidOpt" class="VideoOptions">
                        <div class="Top AAIco-list">
                        <div class="Title">'.__('Options', 'toroflix').'</div>
                        </div>
                        <ul class="ListOptions">'.$listul.'</ul>
                        </section>
                        <span class="BtnOptions AAIco-list AATggl" data-tggl="VidOpt"><i class="AAIco-clear"></i></span>
                        <span class="BtnLight AAIco-lightbulb_outline lgtbx-lnk"></span>
                        <span class="lgtbx"></span>';

									
																
								  
        }
    }
}
endif;

if ( ! function_exists( 'tr_related' ) ) :
/**
 * Show related posts
 */
function tr_related($type=NULL){
    global $post;
  
    $position=toroflix_config('show_related', 2);
    
    if($position==1){ $position='top'; }elseif($position==2){ $position='bottom'; }
													  
    if($type==$position and $position<3){
    
    if ( false === ( $trelated_query_results = get_transient( 'trelated_query_results' ) ) ) {
        $post_categories = wp_get_post_categories( $post->ID );
        
        $args=array(

            'posts_per_page'=> toroflix_config('posts_per_related', 8),
            'orderby' => 'rand',
            'ignore_sticky_posts'=> 1,
            'post_type' => 'post',
            'category__in' => $post_categories,
            'post__not_in' => array($post->ID),

        );
        
        // The Query
        $trelated_query_results = new WP_Query( $args );
        set_transient( 'trelated_query_results', $trelated_query_results, 12 * HOUR_IN_SECONDS );
    }

    // The Loop
    if ($trelated_query_results->have_posts() ) :
    
    if(toroflix_config('sidebar', 3)==2) {
        $array_r = array(2,3,4,6,8,10,12);
    }else{
        $array_r = array(2,3,4,6,5,7,8);
    }
    
    echo'
    <!--<section>-->
    <section>
        <div class="Top AAIco-movie_filter">
            '.tr_title('related', 'Title', false).'
        </div>
        <div class="RelatedList owl-carousel" data-r0="'.$array_r[0].'" data-r360="'.$array_r[1].'" data-r560="'.$array_r[2].'" data-r760="'.$array_r[3].'" data-r960="'.$array_r[4].'" data-r1360="'.$array_r[5].'" data-r1600="'.$array_r[6].'">';
    
            while( $trelated_query_results->have_posts() ) {	
                $trelated_query_results->the_post();
            echo'
            <!--<TPostMv>-->
            <div class="TPostMv">
                <div class="TPost B">
                    <a href="'.get_permalink().'">
                        <div class="Image">
                            <figure class="Objf TpMvPlay AAIco-play_arrow">'.tr_theme_img(get_the_ID(), 'img-mov-md', get_the_title()).'</figure>';
                            echo toroflix_entry_header(false, false, true, false, false);
            echo'
                        </div>
                        <div class="Title">'.get_the_title().'</div>
                    </a>
                </div>
            </div>
            <!--</TPostMv>-->';
            }
    echo'
        </div>
    </section>
    <!--</section>-->
    ';

	/* Restore original Post Data */
    wp_reset_postdata();

    endif;
    }
    
}
endif;

if ( ! function_exists( 'tr_get_the_comments_navigation' ) ) :
/**
 * Remove H2 from comments pagination
 */
function tr_get_the_comments_navigation( $args = array() ) {
    $navigation = '';

    $navigation = preg_replace('#<h([1-6]).*?class="(.*?)".*?>(.*?)<\/h[1-6]>#si', '', get_the_comments_navigation($args));

    echo $navigation;
}
endif;

/**
 * Support SVG
 */
add_filter( 'upload_mimes', 'svg_upload_mimes' );
function svg_upload_mimes( $existing_mimes = array() ) {
	// Add the file extension to the array
	$existing_mimes['svg'] = 'image/svg+xml';
	return $existing_mimes;
}

/**
 * WP-Postratings filter
 */
if( function_exists('the_ratings') ):
function tr_the_ratings($display=true){
    
    $return = the_ratings($start_tag = 'div', 0, false);
    
    if($display==true){
        echo $return;
    }else{
        return $return;
    }
}
add_filter('the_ratings', 'tr_the_ratings', 9999);
endif;

add_action('wp_ajax_tr_livearch', 'tr_livearch');
add_action('wp_ajax_nopriv_tr_livearch', 'tr_livearch');
/**
 * Tr LiveSearch filter
 */
function tr_livearch(){
        
    if(!wp_verify_nonce( $_POST['nonce'], 'tr-livesearch' )){
        exit();
    }
    
    if(isset($_POST['action']) and $_POST['action']=='tr_livearch'){
        
        $args = array(
        
            'posts_per_page' => 20,
            's' => $_POST['trsearch'],
            'post_type' => 'post'
            
        );
                
        $the_query = new WP_Query( $args );
                
        if ( $the_query->have_posts() ) {
            echo '<div class="MovieListTop">';
            while ( $the_query->have_posts() ) {
		      $the_query->the_post();

                $date_field = get_post_meta(get_the_ID(), TR_MOVIES_FIELD_DATE, true);
                $date_field_year = $date_field;
                if($date_field!=''){
                    $date_field = explode('-', $date_field);
                    $date_field_year = $date_field['0'] == '' ? __('Unknown', 'toroflix') : $date_field['0'];
                }
                
                echo'
                <div class="TPost B">
                    <a href="'.get_permalink().'">
                    <div class="Image">
                        <figure class="Objf TpMvPlay AAIco-play_arrow">'.tr_theme_img(get_the_ID(), 'img-mov-md', get_the_title()).'</figure>';
                toroflix_entry_header(false, false, true, false, false);
                echo'
                    </div>
                        <div class="Title">'.get_the_title().'</div>
                    </a>
                </div>
                ';
                
            }
            echo '</div>';
            if($the_query->found_posts>5){ echo '<a rel="nofollow" class="Button" href="'.esc_url( home_url( '/?s='.str_replace('-', '+', sanitize_title( $_POST['trsearch'] ) ) ) ).'">'.__('All results', 'toroflix').'</a>'; }
            wp_reset_postdata();
        }else{
            echo '
            <div class="error-404 not-found AAIco-sentiment_very_dissatisfied">
                <p class="Top"><span class="Title">'.__('No results found.', 'toroflix').'</span></p>
            </div>
            ';
        }
        
    }
    
    wp_die();
														 

}

/**
 * Posts Random Permalink
 */
function tr_post_random_permalink($post_type='post'){
    global $post;
    $args = array( 
        'orderby' => 'rand',
        'posts_per_page' => '1', 
        'post_type' => 'post'
    );
    $myposts = get_posts( $args );
    foreach ( $myposts as $post ) : setup_postdata( $post );
        return get_permalink();
    endforeach;
    wp_reset_postdata();
}

/**
 * Delete directory not empty
 */
function tr_deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!tr_deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

/**
 * Redirect Downloads
 */
function tr_redirect_downloads(){

    if(isset($_GET['trdownid'])){
        status_header( 404 );
        nocache_headers();
        
        $trmovieslinks = unserialize(get_post_meta(intval($_GET['trdownid']), TR_MOVIES_FIELD_LINK, true));
        $url = isset($_GET['number']) ? $trmovieslinks[intval($_GET['number'])]['link'] : esc_url( home_url( '/' ) );
        if ( wp_redirect( $url ) ) {
            exit;
        }
        die();
    }

}
add_filter( "template_redirect", "tr_redirect_downloads", -1 );

/**
 * Function banners
 */
function tr_banners($id){

    $ads = unserialize(get_option('tr_ads_toroflix'));
    $class = '';
    if(isset($_GET['preview_bnr']) and is_super_admin()){
        $class = ' bnr_preview_tr';
        $ads[$id]['desktop'] = '<img class="tr_preview_bnr" src="'.get_template_directory_uri().'/img/cnt/toroflix-bnr.png" alt="'.$id.'">';
    }
    
    if(isset($ads[$id]) and $ads[$id]['desktop'] and !wp_is_mobile() or isset($_GET['preview_bnr']) and is_super_admin() and isset($ads[$id]) and !wp_is_mobile()){
        echo '<div class="bnr'.$class.'" id="'.$id.'">'.$ads[$id]['desktop'].'</div>';
    }
    
    if(isset($ads[$id]) and $ads[$id]['mobile'] and wp_is_mobile()){
        echo '<div class="bnr'.$class.'" id="'.$id.'">'.$ads[$id]['mobile'].'</div>';
    }
}

/**
 * Function config
 */
function toroflix_config($option, $default=NULL){

    if(empty(get_theme_mod('toroflix_theme_options')[$option])){
        $return = $default;
    }else{
        $return = get_theme_mod('toroflix_theme_options')[$option];
    }
    
    return $return;
    
}

/**
 * Content sidebar class
 */
function tr_content_class($type=1) {
    if($type==1){
        $class = toroflix_config('sidebar', 3)==1 ? ' TpLCol' : '';
        $classb = toroflix_config('sidebar', 3)==2 ? ' NoSdbr' : '';
        echo ' class="TpRwCont'.$class.$classb.'"';
    }else{
        if(toroflix_config('show_hover', 2)==1){ $class = ''; }else{ $class = ' Alt'; }
        echo ' class="MovieList Rows AX A04 B03 C20 D03 E20'.$class.'"';
    }
}

/**
 * Text SEO
 */
function tr_seo_text($type) {
    
    $description = '';
    
    if(is_category()){
        $description = category_description();
    }elseif(is_front_page()){
        $description = toroflix_config('description_homepage', '');        
    }
    
    $position=toroflix_config('show_text_seo', 3);
    
    if($position==1){ $position='top'; }elseif($position==2){ $position='bottom'; }
    if($type==$position and $description!='' and $position!=3){
        echo '<div class="Description tr-seo-content">'.$description.'</div>';
				  
												  
    }
}

/**
 * Filter Pre Get Posts
 */
function tr_pre_get_posts( $query ) {
    if ( !is_admin() && $query->is_main_query() && $query->is_home() ) {
        $query->set( 'posts_per_page', toroflix_config('posts_per_home', 15) );
    }
    
    if ( !is_admin() && $query->is_main_query() && $query->is_category() ) {
        $query->set( 'posts_per_page', toroflix_config('posts_per_category', 15) );
    }
    
    if ( !is_admin() && $query->is_main_query() && $query->is_tag() ) {
        $query->set( 'posts_per_page', toroflix_config('posts_per_tag', 15) );
    }
    
    if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
        $query->set( 'posts_per_page', toroflix_config('posts_per_search', 15) );
    }
    
    if ( !is_admin() && $query->is_main_query() ) {
        $query->set( 'ignore_sticky_posts', 1 );
    }
}
add_action( 'pre_get_posts', 'tr_pre_get_posts' );

/**
 * Titles for seo
 */
function tr_title($tag, $class, $display=TRUE) {
    
    $class = !empty($class) ? ' class="'.$class.'"' : '';
    
    if($tag=='carrousel') {
        $tag = toroflix_config('carrousel_seo_tag', 'div');
        $text = toroflix_config('carrousel_seo', __('Most popular', 'toroflix'));
    }
    
    if($tag=='list') {
        if(is_front_page()){
            $tag = toroflix_config('home_seo_tag', 'h1');
            $text = toroflix_config('h1_home_seo', __('Latest Movies', 'toroflix'));
        }elseif(is_category()){
            $tag = toroflix_config('category_seo_tag', 'h1');
            $text = toroflix_config('h1_category_seo', __('{title} Movies', 'toroflix')); 
            $text = str_replace('{title}', single_cat_title("", false), $text);
        }elseif(is_tag()){
            $tag = toroflix_config('tag_seo_tag', 'h1');
            $text = toroflix_config('h1_tag_seo', __('{title} Movies', 'toroflix'));
            $text = str_replace('{title}', single_tag_title("", false), $text);
        }elseif(is_search()){
            $tag = toroflix_config('search_seo_tag', 'h1');
            $text = toroflix_config('h1_search_seo', __('{title} Movies', 'toroflix'));
            $text = str_replace('{title}', get_search_query(), $text);
        }
    }
													
					  
    
    if($tag=='search_filter') {
        $tag = toroflix_config('filter_seo_tag', 'h1');
        $text = toroflix_config('h1_searchf_seo', __('Advanced Search', 'toroflix'));
    }
    
    if($tag=='single_movies') {
        global $post;
        $tag = toroflix_config('singlem_seo_tag', 'h1');
        $text = toroflix_config('h1_singlem_seo', __('{title}', 'toroflix'));
        $text = str_replace('{title}', $post->post_title, $text);
    }
    
    if($tag=='letters') {
        $tag = toroflix_config('abc_seo_tag', 'h1');
        $text = toroflix_config('h1_abc_seo', __('Movies By Letter', 'toroflix'));
    }
  
    
    if($tag=='related') {
        $tag = toroflix_config('related_seo_tag', 'div');
        $text = toroflix_config('relatedm_seo', __('Related Movies', 'toroflix'));
    }
    
    if($tag=='links') {
        $tag = toroflix_config('links_seo_tag', 'div');
        $text = toroflix_config('links_seo', __('Links', 'toroflix'));
    }
    
    if($tag=='listitle'){
        global $post;
        $tag = toroflix_config('titlelist_seo_tag', 'div');
        $text = $post->post_title;
    }
    
    $return = '<'.$tag.$class.'>'.$text.'</'.$tag.'>';
    
    if($display==TRUE){ echo $return; }else{ return $return; }
}

/**
 * Delete Transient
 */
function tr_delete_transient( $wp_customize ) {
    delete_transient('trslidermoved_query_results');
    delete_transient('trsliderfixed_query_results');
}
add_action( 'customize_save', 'tr_delete_transient', 100 );
add_action( 'save_post', 'tr_delete_transient', 100 );

/**
 * WP Remote Get
 */
function tf_wp_remote_get($url, $type) {

    $response = wp_remote_get( $url );
    if ( is_array( $response ) ) {
      $header = $response['headers'];
      $data = $response['body'];
    }

    return $data;
}
?>