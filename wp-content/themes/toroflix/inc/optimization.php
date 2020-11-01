<?php
$status_optimization = get_option('tr_optimization_status');
$status_optimization = $status_optimization = '' ? 0 : $status_optimization;
define( "TR_OPTIMIZATION", $status_optimization ); // Load javascript and css faster.

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

function tr_optimization_admin_css() {
    wp_enqueue_style('admin-optimization', get_template_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'tr_optimization_admin_css');

function tr_optimization_theme_menu() {
    global $submenu;

    add_theme_page( __('Optimization', 'toroflix'), __('Optimization', 'toroflix'), 'manage_options', 'tr_optimization', 'tr_optimization_page'); 
}
add_action('admin_menu', 'tr_optimization_theme_menu');

function tr_addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = esc_url( home_url( '' ) ).$url;
    }
    return $url;
}

function tr_optimization_page(){
    global $wp_filesystem, $status_optimization;
    
    if( empty( $wp_filesystem ) ) {
        WP_Filesystem();
    }
    
    $content = '';
    
    $tfserial=unserialize(get_option('tflicense'));

    $serial = $tfserial['serial'];
    
    $tr_optimization_js = unserialize(get_option('tr_optimization_js'));
    $tr_optimization_js = !empty($tr_optimization_js) ? array_filter($tr_optimization_js) : array();
    
    $tr_optimization_js_single = unserialize(get_option('tr_optimization_js_single'));
    $tr_optimization_js_single = !empty($tr_optimization_js_single) ? array_filter($tr_optimization_js_single) : array();
    
    $tr_optimization_css = unserialize(get_option('tr_optimization_css'));
    $tr_optimization_css = !empty($tr_optimization_css) ? array_filter($tr_optimization_css) : array();
    
    $tr_optimization_css_single = unserialize(get_option('tr_optimization_css_single'));
    $tr_optimization_css_single = !empty($tr_optimization_css_single) ? array_filter($tr_optimization_css_single) : array();
    
    // submit javascript
    
    if(isset($_POST['submit'])){
        
        global $wp_filesystem;
    
        $urls = isset($_POST['urls']) ? $_POST['urls'] : array('');
        $urls_single = isset($_POST['single']) ? $_POST['single'] : array('');
                
        if (file_exists( WP_CONTENT_DIR.'/minify.js' )) {
            $wp_filesystem->delete( WP_CONTENT_DIR.'/minify.js' );
        }
        
        if (file_exists( WP_CONTENT_DIR.'/minify_single.js' )) {
            $wp_filesystem->delete( WP_CONTENT_DIR.'/minify_single.js' );
        }
        
        foreach ($urls_single as &$value) {

            if (($key = array_search($value, $urls)) !== false) {
                unset($urls[$key]);
            }

        }

        update_option('tr_optimization_js', serialize($urls));
        update_option('tr_optimization_js_single', serialize($urls_single));

        // minify js
        
        if(isset($_POST['urls'])){
        
            $response_minify = wp_remote_post( 'http://toroflix.ml/en/', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array( 'trurls' => implode(',', $urls), 'trmproduct' => 'Toroflix', 'trminify' => 2, 'trmserial' => $serial ),
                'cookies' => array()
                )
            );


            if ( is_array( $response_minify ) ) {
              $header_minify = $response_minify['headers']; // array of http header lines
              $js_minify = $response_minify['body']; // use the content
            }

            $wp_filesystem->put_contents(
              WP_CONTENT_DIR.'/minify.js',
              $js_minify,
              FS_CHMOD_FILE // predefined mode settings for WP files
            );
            
        }
        
        // minify js single
        
        if(isset($_POST['single'])){
        
            $response_minify_single = wp_remote_post( 'http://toroflix.ml/en/', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array( 'trurls' => implode(',', $urls_single), 'trmproduct' => 'Toroflix', 'trminify' => 2, 'trmserial' => $serial ),
                'cookies' => array()
                )
            );


            if ( is_array( $response_minify_single ) ) {
              $header_minify_single = $response_minify_single['headers']; // array of http header lines
              $js_minify_single = $response_minify_single['body']; // use the content
            }

            $wp_filesystem->put_contents(
              WP_CONTENT_DIR.'/minify_single.js',
              $js_minify_single,
              FS_CHMOD_FILE // predefined mode settings for WP files
            );
            
        }
        
        //wp_redirect( 'themes.php?page=tr_optimization' );
        //exit();
        
    }
    
    // submit css
    
    if(isset($_POST['submit_css'])){
        
        delete_option('tr_css_print');
        delete_option('tr_css_prints');
    
        $urls = isset($_POST['urls']) ? $_POST['urls'] : '';
        $urls_single = isset($_POST['single']) ? $_POST['single'] : array('');
        
        $content = ''; $content_single = '';

        foreach ($urls_single as &$value) {

            if (($key = array_search($value, $urls)) !== false) {
                unset($urls[$key]);
            }

        }
        
        update_option('tr_optimization_css', serialize($urls));
        update_option('tr_optimization_css_single', serialize($urls_single));
        
        if(isset($_POST['urls'])){
            
            $response_minify = wp_remote_post( 'http://toroflix.ml/en/', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array( 'trurls' => implode(',', $urls), 'trmproduct' => 'Toroflix', 'trminify' => 1, 'trmserial' => $serial ),
                'cookies' => array()
                )
            );


            if ( is_array( $response_minify ) ) {
              $header_minify = $response_minify['headers']; // array of http header lines
              $css_minify = $response_minify['body']; // use the content
            }
            
                        
            $content = str_replace('img/', get_template_directory_uri().'/img/', str_replace('../fonts/', get_template_directory_uri().'/fonts/', $css_minify));
                        
        }
        
        if(isset($_POST['single'])){
        
            $response_minify_single = wp_remote_post( 'http://toroflix.ml/en/', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array( 'trurls' => implode(',', $urls_single), 'trmproduct' => 'Toroflix', 'trminify' => 1, 'trmserial' => $serial ),
                'cookies' => array()
                )
            );


            if ( is_array( $response_minify_single ) ) {
              $header_minify_single = $response_minify_single['headers']; // array of http header lines
              $css_minify_single = $response_minify_single['body']; // use the content
            }

            $content_single = str_replace('img/', get_template_directory_uri().'/img/', str_replace('../fonts/', get_template_directory_uri().'/fonts/', $css_minify_single));
                        
        }
        
        update_option('tr_css_print', serialize( array('all' => $content, 'single' => $content_single) ) );
        
        
        // fonts.css
        
            $response_minify_style = wp_remote_post( 'http://toroflix.ml/en/', array(
                'method' => 'POST',
                'timeout' => 45,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(),
                'body' => array( 'trurls' => get_template_directory_uri() . '/css/font-awesome.css,'.get_template_directory_uri() . '/css/material.css', 'trmproduct' => 'Toroflix', 'trminify' => 1, 'trmserial' => $serial ),
                'cookies' => array()
                )
            );


            if ( is_array( $response_minify_style ) ) {
              $header_minify_style = $response_minify_style['headers']; // array of http header lines
              $css_minify_style = $response_minify_style['body']; // use the content
            }

            $content_style = str_replace('img/', get_template_directory_uri().'/img/', str_replace('../fonts/', get_template_directory_uri().'/fonts/', $css_minify_style));
        
            $wp_filesystem->put_contents(
              WP_CONTENT_DIR.'/style_toroflix.css',
              $content_style,
              FS_CHMOD_FILE // predefined mode settings for WP files
            );
        
        // fonts.css
        
        //wp_redirect( 'themes.php?page=tr_optimization' );
        //exit();
        
    }
    
    // unzip
    
    if(isset($_FILES['tr_file_zip']['tmp_name'])){
        $filetype = wp_check_filetype($_FILES['tr_file_zip']['name']);
        if($filetype['ext']=='zip' and $filetype['type']=='application/zip'){
            $unzipfile = unzip_file( $_FILES['tr_file_zip']['tmp_name'], WP_CONTENT_DIR.'/tr_optimization/');
            if ( file_exists( WP_CONTENT_DIR.'/tr_optimization/js/minify.js' ) ) {
                copy( WP_CONTENT_DIR.'/tr_optimization/js/minify.js', WP_CONTENT_DIR.'/minify.js' );
            }
            if ( file_exists( WP_CONTENT_DIR.'/tr_optimization/js/minify_single.js' ) ) {
                copy( WP_CONTENT_DIR.'/tr_optimization/js/minify_single.js', WP_CONTENT_DIR.'/minify_single.js' );
            }
            tr_deleteDirectory( WP_CONTENT_DIR.'/tr_optimization/' );
        }
    }
    
    if(isset($_POST['tr_optimization_submit'])){
        $active = isset($_POST['tr_optimization_active']) ? 1 : 0;
        update_option('tr_optimization_status', $active);
        wp_redirect( 'themes.php?page=tr_optimization' );
        exit();
    }
?>
<div id="tr-optimization" class="wrap">
    <h1><?php _e('Optimization', 'toroflix'); ?> <form id="form_tr_optimization_active" action="themes.php?page=tr_optimization" method="post"><label><input onchange="document.getElementById('tr_optimization_submit').click();" type="checkbox" <?php checked($status_optimization, 1); ?> value="1" name="tr_optimization_active" id="tr_optimization_active"><span></span></label><input style="display:none" type="submit" name="tr_optimization_submit" id="tr_optimization_submit"></form></h1>

   <p>
        <a class="button" href="<?php echo esc_url( home_url( '/?tr_optimization_get='.md5(microtime()) ) ); ?>"><?php _e('Scan JS', 'toroflix'); ?></a>

        <a class="button" href="<?php echo esc_url( home_url( '/?tr_optimization_type=css&tr_optimization_get='.md5(microtime()) ) ); ?>"><?php _e('Scan CSS', 'toroflix'); ?></a>

        <a class="button tr_upload_zip" onclick="document.getElementById('tr_file_zip').click();" href="javascript:return false;"><?php _e('Upload ZIP', 'toroflix'); ?></a>

        <a href="https://developers.google.com/speed/pagespeed/insights/?url=<?php echo esc_url( tr_post_random_permalink() ); ?>" class="button" target="_blank"><?php _e('Google Speed', 'toroflix'); ?></a>
    
        <a href="<?php echo esc_url( 'http://toroflix.ml/docs/' ); ?>" class="button" target="_blank"><?php _e('USER GUIDE', 'toroflix'); ?></a>
    </p>
        
    <form style="display:none" id="tr_zip_optimization" enctype="multipart/form-data" action="themes.php?page=tr_optimization" method="post">
     <input onchange="document.getElementById('tr_zip_optimization').submit();" type="file" name="tr_file_zip" id="tr_file_zip">
    </form>
      
   <?php if($tr_optimization_js==''){ ?>
   <p><?php _e('You have not done a script search yet.', 'toroflix'); ?></p>
   <?php }else{ ?>
   
    <form action="themes.php?page=tr_optimization" method="post">
        <h2><?php _e('Javascript', 'toroflix'); ?></h2>
    <table class="tbopt table_tr_optimization_js">
        <thead>
            <tr>
                <th><?php _e('URL', 'toroflix'); ?></th>
                <th><?php _e('Actions', 'toroflix'); ?></th>
                <th><?php _e('Single', 'toroflix'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($tr_optimization_js)){ foreach($tr_optimization_js as $key => $value) { ?>
            <tr>
                <td>
                    <input type="text" name="urls[]" value="<?php echo $value; ?>">               
                </td>
                <td class="tblnks">
                    <a class="tr_optimiation_check" target="_blank" href="<?php echo $value; ?>"><span class="dashicons dashicons-yes"></span><?php _e('Check', 'toroflix'); ?></a>
                    <a class="troptimization_del_js" href="#"><span class="dashicons dashicons-no-alt"></span><?php _e('Delete', 'toroflix'); ?></a>
                    <a class="optimization_up" href="#"><span class="dashicons dashicons-arrow-up-alt2"></span><?php _e('Up', 'toroflix'); ?></a>
                    <a class="optimization_down" href="#"><span class="dashicons dashicons-arrow-down-alt2"></span><?php _e('Down', 'toroflix'); ?></a>
                </td>
                <td>
                    <input class="trsinglechecked" name="single[]" type="checkbox" value="<?php echo $value; ?>">
                </td>
            </tr>
            <?php } } ?>
            <?php if(isset($tr_optimization_js_single)){ foreach($tr_optimization_js_single as $key => $value) { ?>
            <tr>
                <td>
                    <input type="text" name="urls[]" value="<?php echo $value; ?>">               
                </td>
                <td class="tblnks">
                    <a class="tr_optimiation_check" target="_blank" href="<?php echo $value; ?>"><span class="dashicons dashicons-yes"></span><?php _e('Check', 'toroflix'); ?></a>
                    <a class="troptimization_del_js" href="#"><span class="dashicons dashicons-no-alt"></span><?php _e('Delete', 'toroflix'); ?></a>
                    <a class="optimization_up" href="#"><span class="dashicons dashicons-arrow-up-alt2"></span><?php _e('Up', 'toroflix'); ?></a>
                    <a class="optimization_down" href="#"><span class="dashicons dashicons-arrow-down-alt2"></span><?php _e('Down', 'toroflix'); ?></a>
                </td>
                <td>
                    <input class="trsinglechecked" checked name="single[]" type="checkbox" value="<?php echo $value; ?>">
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
    <p>
    <button type="button" class="button troptimization_add_js"><?php _e('Add js', 'toroflix'); ?></button>
    <button type="submit" name="submit" class="button"><?php _e('Save changes', 'toroflix'); ?></button>
    </p>
    </form>

   <?php } ?>
   
   
   <?php if($tr_optimization_css==''){ ?>
   <p><?php _e('You have not done a styles search yet.', 'toroflix'); ?></p>
   <?php }else{ ?>
   
    <form action="themes.php?page=tr_optimization" method="post">
    <h2><?php _e('CSS', 'toroflix'); ?></h2>
    <table class="tbopt table_tr_optimization_css">
        <thead>
            <tr>
                <th><?php _e('URL', 'toroflix'); ?></th>
                <th><?php _e('Actions', 'toroflix'); ?></th>
                <th><?php _e('Single', 'toroflix'); ?></th>
            </tr>
        </thead>
        <?php if(isset($tr_optimization_css)){ foreach($tr_optimization_css as $key => $value) { ?>
        <tr>
            <td>
                <input type="text" name="urls[]" value="<?php echo $value; ?>">               
            </td>
            <td class="tblnks">
                <a target="_blank" href="<?php echo $value; ?>"><span class="dashicons dashicons-yes"></span><?php _e('Check', 'toroflix'); ?></a>
                <a class="troptimization_del_css" href="#"><span class="dashicons dashicons-no-alt"></span><?php _e('Delete', 'toroflix'); ?></a>
                <a class="optimization_up" href="#"><span class="dashicons dashicons-arrow-up-alt2"></span><?php _e('Up', 'toroflix'); ?></a>
                <a class="optimization_down" href="#"><span class="dashicons dashicons-arrow-down-alt2"></span><?php _e('Down', 'toroflix'); ?></a>
            </td>
            <td>
                <input name="single[]" type="checkbox" value="<?php echo $value; ?>">
            </td>
        </tr>
        <?php } } ?>
        <?php if(isset($tr_optimization_css_single)){ foreach($tr_optimization_css_single as $key => $value) { ?>
        <tr>
            <td>
                <input type="text" name="urls[]" value="<?php echo $value; ?>">               
            </td>
            <td class="tblnks">
                <a target="_blank" href="<?php echo $value; ?>"><span class="dashicons dashicons-yes"></span><?php _e('Check', 'toroflix'); ?></a>
                <a class="troptimization_del_css" href="#"><span class="dashicons dashicons-no-alt"></span><?php _e('Delete', 'toroflix'); ?></a>
                <a class="optimization_up" href="#"><span class="dashicons dashicons-arrow-up-alt2"></span><?php _e('Up', 'toroflix'); ?></a>
                <a class="optimization_down" href="#"><span class="dashicons dashicons-arrow-down-alt2"></span><?php _e('Down', 'toroflix'); ?></a>
            </td>
            <td>
                <input checked name="single[]" type="checkbox" value="<?php echo $value; ?>">
            </td>
        </tr>
        <?php } } ?>
    </table>
    <p>
    <button type="button" class="button troptimization_add_css"><?php _e('Add CSS', 'toroflix'); ?></button>
    <button type="submit" name="submit_css" class="button"><?php _e('Save changes', 'toroflix'); ?></button>
    </p>
    </form>

   <?php } ?>
</div>
   
<?php  
}

if (!is_admin() and isset($_GET['tr_optimization_get']) and is_super_admin()) {
    function tr_optimization_callback($buffer) {
        
        $arr = array();

        if(isset($_GET['tr_optimization_type'])){
            
            global $wp_styles;
            
            unset($wp_styles->registered['admin-bar']);
            unset($wp_styles->registered['google-fonts']);
            unset($wp_styles->registered['toroflix-material']);
            unset($wp_styles->registered['toroflix-fontawesome']);
            foreach( $wp_styles->queue as $handle ) :
                if(isset($wp_styles->registered[$handle]->src)){
                    $arr[] = tr_addhttp($wp_styles->registered[$handle]->src);
                }
            endforeach;
            
            if(isset($_GET['trsingle'])){
                
                $tr_optimization_css = unserialize(get_option('tr_optimization_css'));
                $tr_optimization_css = !empty($tr_optimization_css) ? array_filter($tr_optimization_css) : array();

                foreach ($tr_optimization_css as &$value) {

                    if (($key = array_search($value, $arr)) !== false) {
                        unset($arr[$key]);
                    }

                }
                                                
                update_option('tr_optimization_css_single', serialize($arr));
                
                wp_redirect( esc_url( home_url( '/wp-admin/themes.php?page=tr_optimization' )) );
                
            }else{
            
                update_option('tr_optimization_css', serialize($arr));
                
                wp_redirect( tr_post_random_permalink().'?trsingle=1&tr_optimization_type=css&tr_optimization_get='.md5(microtime()) );
                
            }            
            
        }else{
            
            global $wp_scripts;

            unset($wp_scripts->registered['admin-bar']);
            unset($wp_scripts->registered['wp-embed']);
            foreach( $wp_scripts->queue as $handle ) :
                if(isset($wp_scripts->registered[$handle]->src)){
                    $arr[] = tr_addhttp($wp_scripts->registered[$handle]->src);
                }
            endforeach;
                                    
            if(isset($_GET['trsingle'])){
                
                $tr_optimization_js = unserialize(get_option('tr_optimization_js'));
                $tr_optimization_js = !empty($tr_optimization_js) ? array_filter($tr_optimization_js) : array();

                foreach ($tr_optimization_js as &$value) {

                    if (($key = array_search($value, $arr)) !== false) {
                        unset($arr[$key]);
                    }

                }
                                                
                update_option('tr_optimization_js_single', serialize($arr));
                
                wp_redirect( esc_url( home_url( '/wp-admin/themes.php?page=tr_optimization' )) );
                
            }else{
            
                update_option('tr_optimization_js', serialize($arr));
                
                wp_redirect( tr_post_random_permalink().'?trsingle=1&tr_optimization_get='.md5(microtime()) );
                
            }
        }
        
        exit;
    }

    function tr_optimization_buffer_start() {
        ob_start("tr_optimization_callback");
    }
    function tr_optimization_buffer_end() {
        ob_flush();
    }
    add_action('template_redirect', 'tr_optimization_buffer_start', -1);
    add_action('get_header', 'tr_optimization_buffer_start');
    add_action('wp_footer', 'tr_optimization_buffer_end', 999);
}

/* removed to make theme work for non registered users
if (TR_OPTIMIZATION==1 and !current_user_can('administrator') and !current_user_can('editor') and !is_admin()) {

function tr_remove_all_styles() {
    global $wp_styles;
    if(!isset($_GET['tr_optimization_get'])){
        $wp_styles->queue = array();
    }
}
add_action('wp_print_styles', 'tr_remove_all_styles', 100);

add_action( 'script_loader_tag', 'tr_remove_all_scripts', 10, 3 );

function tr_remove_all_scripts($tag, $handle, $src) {
    return '';
}

function footer_tr_optimization() {

echo'<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';

if ( file_exists( WP_CONTENT_DIR.'/minify.js' ) ) {
echo'<script type="text/javascript" src="'.WP_CONTENT_URL.'/minify.js"></script>';
}

if ( file_exists( WP_CONTENT_DIR.'/minify_single.js' ) and is_single() ) {
echo'<script type="text/javascript" src="'.WP_CONTENT_URL.'/minify_single.js"></script>';
}

echo'<link rel="stylesheet" id="google-fonts-css" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" type="text/css" media="all">';

echo"<link rel='stylesheet' id='toroflix-fontawesome-css' href='".WP_CONTENT_URL."/style_toroflix.css' type='text/css' media='all'>";


}
add_action( 'wp_footer', 'footer_tr_optimization', 200 );

function header_tr_optimization(){
    $css = unserialize (get_option('tr_css_print'));
?>
<style type="text/css">
    <?php echo $css['all']; ?>
    <?php if(is_single()){ echo $css['single']; } ?>
</style>
<?php
}

add_action('wp_head','header_tr_optimization', 100);
    
}
    */
?>