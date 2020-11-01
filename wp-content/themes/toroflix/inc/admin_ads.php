<?php
/* Manament Ads */

function tr_ads_theme_menu() {
  add_theme_page( __('Ads Manager', 'toroflix'), __('Ads Manager', 'toroflix'), 'manage_options', 'tr_ads', 'tr_ads_page');  
}
add_action('admin_menu', 'tr_ads_theme_menu');

function tr_ads_page() {
    
    $ok = ''; $ads = array(''); $ar_ads = array('');
    
    $_POST['ads'] = empty($_POST['ads']) ? '' : $_POST['ads'];
    
    if(isset($_POST['submit'])) {
        
        foreach((array)$_POST['ads'] as $item) {
            
            $ads_a = isset($_POST[$item.'_d']) ? $_POST[$item.'_d'] : '';
            $ads_b = isset($_POST[$item.'_m']) ? $_POST[$item.'_m'] : '';                
                
            $ar_ads[$item]=array( 'desktop' => $ads_a, 'mobile' => $ads_b );
            
        }
        
        update_option('tr_ads_toroflix', serialize( array_filter($ar_ads) ) );
        
        $ok.= '<p class="trmsjok">'.__('Changes have been saved successfully.', 'toroflix').'</p>';
        
    }
    
    $posts = get_posts('post_type=post&orderby=rand&numberposts=1');
    foreach($posts as $post) {
        $link = get_permalink($post);
    }
        
    $ads = unserialize(get_option('tr_ads_toroflix'));
        
    $array = array(
    
        'ads_hd_bt' => array ( 'title' => __('Header Bottom', 'toroflix'), 'value' => isset($ads['ads_hd_bt']) ? $ads['ads_hd_bt']['desktop'] : '', 'value_m' => isset($ads['ads_hd_bt']['mobile']) ? $ads['ads_hd_bt']['mobile'] : '', 'preview' => esc_url( home_url( '/?preview_bnr=1#ads_hd_bt' ) ) ),
        
        'ads_top_list' => array( 'title' => __('Top List', 'toroflix'), 'value' => isset($ads['ads_top_list']['desktop']) ? $ads['ads_top_list']['desktop'] : '', 'value_m' => isset($ads['ads_top_list']['mobile']) ? $ads['ads_top_list']['mobile'] : '', 'preview' => esc_url( home_url( '/?preview_bnr=1#ads_top_list' ) ) ),
        
        'bottom_list' => array( 'title' => __('Bottom List', 'toroflix'), 'value' => isset($ads['bottom_list']['desktop']) ? $ads['bottom_list']['desktop'] : '', 'value_m' => isset($ads['bottom_list']['mobile']) ? $ads['bottom_list']['mobile'] : '', 'preview' => esc_url( home_url( '/?preview_bnr=1#bottom_list' ) ) ),

        'single_top' => array( 'title' => __('Single Top', 'toroflix'), 'value' => isset($ads['single_top']['desktop']) ? $ads['single_top']['desktop'] : '', 'value_m' => isset($ads['single_top']['mobile']) ? $ads['single_top']['mobile'] : '', 'preview' => $link.'?preview_bnr=1#single_top' ),

        'single_bottom' => array( 'title' => __('Single Bottom', 'toroflix'), 'value' => isset($ads['single_bottom']['desktop']) ? $ads['single_bottom']['desktop'] : '', 'value_m' => isset($ads['single_bottom']['mobile']) ? $ads['single_bottom']['mobile'] : '', 'preview' => $link.'?preview_bnr=1#single_bottom' ),
        
    );

    echo '
    <div id="tr-dvrmngr" class="wrap">
    <h1>'.__('Ads Manager', 'toroflix').'</h1>
    
    '.$ok.'
    
    <p>'.__('Gerencie anúncios em seu site facilmente. Lembre-se de que, se você adicionar anúncios de desktop, eles não serão vistos no celular, a menos que você também o adicione no celular. Tenha em mente que se você exceder 300px de largura e seu banner não responde, ele não vai caber bem a todas as telas.', 'toroflix').'</p>
        
    <div class="tr_ads_admin">
    
        <form action="themes.php?page=tr_ads" method="post">
        
        <ul class="dvrmngr-list">';
    
        foreach ($array as $key => $value) {
            
            echo'
                <li>
                    <p>'.$value['title'].' <span><a target="_blank" href="'.esc_url($value['preview']).'">'.__('Preview', 'toroflix').'</a></span></p>
                    <span class="trads_type"><button data-id="'.$key.'" class="trads_type_a button current" type="button">'.__('Desktop', 'toroflix').'</button> <button data-id="'.$key.'" class="trads_type_b button" type="button">'.__('Mobile', 'toroflix').'</button></span>
                    <textarea placeholder="'.__('Insert code here', 'toroflix').'" class="'.$key.'_d" name="'.$key.'_d">'.esc_textarea(stripslashes($value['value'])).'</textarea>
                    <textarea placeholder="'.__('Insert code here', 'toroflix').'" class="'.$key.'_m" style="display:none" name="'.$key.'_m">'.esc_textarea(stripslashes($value['value_m'])).'</textarea>
                    <input type="hidden" name="ads[]" value="'.$key.'">
                </li>';
            
        }
                
    echo'
        </ul>
        
        <button name="submit" type="submit" class="button button-primary">'.__('Save changes', 'toroflix').'</button>
        
        </form>
        
    </div>
    </div>
    ';
    
}

?>