<?php
if ( !defined('NONCE_KEY') ) die('Die!');

    $error = ''; $ok = ''; $content = '';

    include( plugin_dir_path( __FILE__ ) . 'submit/movie_edit_submit.php');
?>
    <section>
        <div class="Top">
            <h1><?php _e('Edit Movie', TRMOVIES); ?></h1>
            <?php tr_movies_menu(); ?>
        </div>
       
        <ul class="Blkcn TbsBxCn">
            <li class="tr_tab current" data-tab="tr_movies_tab_1"><button type="button"><?php _e('Edit Details', TRMOVIES); ?></button></li>
            <li class="tr_tab" data-tab="tr_movies_tab_2"><button type="button"><?php _e('Edit Links', TRMOVIES); ?></button></li>
            <li class="EdtPstLnk">

                <a target="_blank" href="<?php echo admin_url('post.php?post='.$post->ID.'&action=edit'); ?>"><?php _e('Edit Movie', TRMOVIES); ?></a>
            </li>
            <?php if($post->post_status=='publish'){ ?>
            <li class="EdtPstLnk ViewPstLnk">
                <a target="_blank" href="<?php echo get_permalink($post->ID); ?>"><?php _e('View', TRMOVIES); ?></a>
            </li>
            <?php } ?>
        </ul>

        <?php echo $ok.$error; ?>

        <form action="<?php echo admin_url('admin.php?page=tr-movies-movie&action=edit&id='.$post->ID); ?>" method="post" enctype="multipart/form-data">
            
            <div id="tr_movies_tab_1" class="AdmCls tr_movies_tab">
                <main>
                    
                    <p class="Blkcn TtlInp">
                        <input value="<?php if( isset( $_POST['title'] ) and empty( $ok ) ){ echo stripslashes( wp_strip_all_tags( $_POST['title'] ) ); }else{ echo $post->post_title; } ?>" type="text" name="title" placeholder="<?php _e("Movie's name", TRMOVIES); ?>">
                    </p>

                    <div class="Blkcn">
                        <p class="Title"><?php _e("Categories", TRMOVIES); ?></p>
                        <ul class="ListCheck Clfx">
                            <?php
                            $categories = get_categories( array(
                            'orderby' => 'name',
                            'hide_empty'  => 0,
                            ) );

                            foreach ( $categories as $category ) {
                            ?>
                            <li>
                                <label><input<?php if (isset($_POST['categories']) and in_array($category->term_id, $_POST['categories']) or !isset($_POST['categories']) and in_array($category->term_id, $post_categories)) { ?> checked<?php } ?> name="categories[]" value="<?php echo $category->term_id; ?>" type="checkbox"> <?php echo $category->name; ?></label>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="Blkcn">
                        <p class="Title ttlmbnt"><?php _e('Synopsis', TRMOVIES); ?></p>
                        <?php
                            $settings = array(
                                'textarea_rows' => 15,
                                'tabindex' => 1,
                                'media_buttons' => true
                            );

                            wp_editor($content, 'content', $settings);
                        ?>
                    </div>
                    <div class="Blkcn TrailerBx">
                        <label>
                            <span class="Title"><?php _e('Trailer', TRMOVIES); ?><i class="dashicons dashicons-format-video"></i></span>
                            <textarea class="txtara" name="trailer" placeholder="<?php _e('Insert code iframe here', TRMOVIES); ?>"><?php if( isset( $_POST['trailer'] ) and empty( $ok ) ){ echo stripslashes( $_POST['trailer'] );  }elseif( get_post_meta($post->ID, TR_MOVIES_FIELD_TRAILER, true)!='' ){ echo stripslashes( get_post_meta($post->ID, TR_MOVIES_FIELD_TRAILER, true) ); }?></textarea>
                        </label>
                    </div>
                </main>
                <aside>
                    <div class="Blkcn">
                        <ul class="StsOptns">
                            <li><input <?php checked( $post->post_status, 'publish' ); ?> type="radio" name="status" value="publish"><span><?php _e('Published', TRMOVIES); ?></span></li>
                            <li><input <?php checked( $post->post_status, 'pending' ); ?> type="radio" name="status" value="pending"><span> <?php _e('Pending', TRMOVIES); ?></span></li>
                            <li><input <?php checked( $post->post_status, 'draft' ); ?> type="radio" name="status" value="draft"><span> <?php _e('Draft', TRMOVIES); ?></span></li>
                        </ul>
                    </div>
                    <div class="Blkcn">
                        <p class="Title"><?php _e("Original name", TRMOVIES); ?></p>
                        <input value="<?php if( isset( $_POST['original_title'] ) and empty( $ok ) ){ echo stripslashes( wp_strip_all_tags( $_POST['original_title'] ) ); }elseif( get_post_meta($post->ID, TR_MOVIES_FIELD_ORIGINALTITLE, true)!='' ){ echo get_post_meta($post->ID, TR_MOVIES_FIELD_ORIGINALTITLE, true); } ?>" type="text" name="original_title" placeholder="<?php _e("Original name", TRMOVIES); ?>">
                    </div>
                    
                    <div class="Blkcn Blkcnjs">
                        <p class="Title"><?php _e('Cast', TRMOVIES); ?></p>
                        
                        <?php
                            $cnt_cast = array(); $ar_cast = '';
                            if(isset($_POST['trc_cast'])){ $ar_cast = $_POST['trc_cast']; }else{ $ar_cast = $term_cast; }
                            foreach ($ar_cast as &$value) {
                                echo '<input class="norepeat'.sanitize_title($value).'" type="hidden" value="'.$value.'" name="trc_cast[]">';
                                $cnt_cast[] = '<span>'.$value.' <i class="dashicons dashicons-no-alt del_tr_suggest" data-input="'.sanitize_title($value).'"></i></span>';
                            }
                        
                        ?>
                        
                        <div class="Lstslct" id="cnt_cast">
                            <?php if(!empty($cnt_cast)){ echo implode(', ', $cnt_cast); } ?>
                        </div>
                        
                        <input type="text" name="cast" id="trc_cast" autocomplete="off" value="">
                        
                        <script type="text/javascript">

                            jQuery(document).ready(function($) {
                                $("#trc_cast").suggest(ajaxurl + "?action=ajax-tag-search&tax=cast", {multiple:true, multipleSep: ","});
                            });

                        </script>
                    </div>
                    <div class="Blkcn Blkcnjs">
                        <p class="Title"><?php _e('Directors', TRMOVIES); ?></p>
                        
                        <?php
                            $cnt_directors = array(); $ar_directors = '';
                            if(isset($_POST['trc_directors'])){ $ar_directors = $_POST['trc_directors']; }else{ $ar_directors = $term_directors; }
                            foreach ($ar_directors as &$value) {
                                echo '<input class="norepeat'.sanitize_title($value).'" type="hidden" value="'.$value.'" name="trc_directors[]">';
                                $cnt_directors[] = '<span>'.$value.' <i class="dashicons dashicons-no-alt del_tr_suggest" data-input="'.sanitize_title($value).'"></i></span>';
                            }
                        
                        ?>
                        
                        <div class="Lstslct" id="cnt_directors">
                            <?php if(!empty($cnt_directors)){ echo implode(', ', $cnt_directors); } ?>
                        </div>
                        
                        <input type="text" name="directors" id="trc_directors" autocomplete="off" value="">
                        
                        <script type="text/javascript">

                            jQuery(document).ready(function($) {
                                $("#trc_directors").suggest(ajaxurl + "?action=ajax-tag-search&tax=directors", {multiple:true, multipleSep: ","});
                            });

                        </script>
                    </div>
                    <div class="Blkcn Blkcnjs">
                        <p class="Title"><?php _e('Tags', TRMOVIES); ?></p>
                        
                        <?php
                            $cnt_tags = array(); $ar_tags = '';
                            if(isset($_POST['trc_tags'])){ $ar_tags = $_POST['trc_tags']; }else{ $ar_tags = $term_tags; }
                            foreach ($ar_tags as &$value) {
                                echo '<input class="norepeat'.sanitize_title($value).'" type="hidden" value="'.$value.'" name="trc_tags[]">';
                                $cnt_tags[] = '<span>'.$value.' <i class="dashicons dashicons-no-alt del_tr_suggest" data-input="'.sanitize_title($value).'"></i></span>';
                            }
                        
                        ?>
                        
                        <div class="Lstslct" id="cnt_tags">
                            <?php if(!empty($cnt_tags)){ echo implode(', ', $cnt_tags); } ?>
                        </div>
                        
                        <input type="text" name="tags" id="trc_tags" autocomplete="off" value="">
                        
                        <script type="text/javascript">

                            jQuery(document).ready(function($) {
                                $("#trc_tags").suggest(ajaxurl + "?action=ajax-tag-search&tax=post_tag", {multiple:true, multipleSep: ","});
                            });

                        </script>
                    </div>
                    <div class="Blkcn Blkcnjs">
                        <p class="Title"><?php _e('Countries', TRMOVIES); ?></p>
                                                
                        <?php
                            $cnt_countries = array(); $ar_countries = '';
if(isset($_POST['trc_countries'])){$ar_countries = $_POST['trc_countries']; }
elseif(get_post_meta($post->ID, 'countries', true)!=''){
    $ar_countries = explode(', ', get_post_meta($post->ID, 'countries', true));
}else{ $ar_countries = $term_countries; }

                            foreach ($ar_countries as &$value) {
                                echo '<input class="norepeat'.sanitize_title($value).'" type="hidden" value="'.$value.'" name="trc_countries[]">';
                                $cnt_countries[] = '<span>'.$value.' <i class="dashicons dashicons-no-alt del_tr_suggest" data-input="'.sanitize_title($value).'"></i></span>';
                            }
                        
                        ?>
                        
                        <div class="Lstslct" id="cnt_countries">
                            <?php if(!empty($cnt_countries)){ echo implode(', ', $cnt_countries); } ?>
                        </div>
                        
                        <input type="text" name="countries" id="trc_countries" autocomplete="off" value="">
                        
                        <script type="text/javascript">

                            jQuery(document).ready(function($) {
                                $("#trc_countries").suggest(ajaxurl + "?action=ajax-tag-search&tax=country", {multiple:true, multipleSep: ","});
                            });

                        </script>
                    </div>
                    <div class="Blkcn">
                        <p class="Title"><?php _e("Info", TRMOVIES); ?></p>
                        <label class="Inprgt">
                            <span><?php _e("Duration", TRMOVIES); ?></span>
                            <input value="<?php if( isset( $_POST['duration'] ) and empty( $ok ) ){ echo stripslashes( wp_strip_all_tags( $_POST['duration'] ) ); }elseif( get_post_meta($post->ID, TR_MOVIES_FIELD_RUNTIME, true)!='' ){ echo get_post_meta($post->ID, TR_MOVIES_FIELD_RUNTIME, true); } ?>" type="text" name="duration" placeholder="<?php _e("Duration", TRMOVIES); ?>">
                        </label>
                        <label class="Inprgt">
                            <span><?php _e("Release data", TRMOVIES); ?></span>
                            <input value="<?php if( isset( $_POST['release'] ) and empty( $ok ) ){ echo stripslashes( wp_strip_all_tags( $_POST['release'] ) ); }elseif( get_post_meta($post->ID, TR_MOVIES_FIELD_DATE, true)!='' ){ echo get_post_meta($post->ID, TR_MOVIES_FIELD_DATE, true); } ?>" type="text" name="release" placeholder="<?php _e("Release data", TRMOVIES); ?>">
                        </label>
                    </div>
                    <div class="Blkcn">
                        <p class="Title"><?php _e('Poster', TRMOVIES); ?></p>
                        <p class="InpFlImg" id="tr_poster">
                            <?php if(get_the_post_thumbnail_url( $post->ID, 'thumbnail' )!=''){ ?>
                            <img id="img-poster" src="<?php echo get_the_post_thumbnail_url( $post->ID, 'thumbnail' ); ?>" alt="">
                            <?php }elseif(get_post_meta($post->ID, TR_MOVIES_POSTER_HOTLINK, true)){ ?>
                            <img id="img-poster" src="<?php echo '//image.tmdb.org/t/p/w342'.get_post_meta($post->ID, TR_MOVIES_POSTER_HOTLINK, true); ?>" alt="">                            
                            <?php }elseif(get_post_meta($post->ID, 'poster_url', true)){ ?>
                            <img id="img-poster" src="<?php echo get_post_meta($post->ID, 'poster_url', true); ?>" alt="">                            
                            <?php }else{ ?>
                            <img id="img-poster" src="<?php echo TR_MOVIES_PLUGIN_URL; ?>assets/img/noimgb.png" alt="">   
                            <?php } ?>
                            <input id="inp-poster" type="file" name="poster">
                            <span><?php _e("Click here for upload image", TRMOVIES); ?></span>
                        </p>
                    </div>
                    <div class="Blkcn BackdropImg">
                        <p class="Title"><?php _e('Backdrop', TRMOVIES); ?></p>
                        <p class="InpFlImg" id="tr_backdrop">
                            <?php
                            $backdrop = wp_get_attachment_image_src(get_post_meta( $post->ID, TR_MOVIES_FIELD_BACKDROP, true ), 'full');

                            if($backdrop[0]!=''){
                                echo '<img id="img-backdrop" src="'.$backdrop[0].'" alt="backdrop">';
                            }elseif(get_post_meta($post->ID, 'backdrop_hotlink', true)!=''){
                                echo '<img id="img-backdrop" src="//image.tmdb.org/t/p/w780'.get_post_meta($post->ID, 'backdrop_hotlink', true).'" alt="backdrop">';                     
                            }elseif(preg_match('/\.(jpg|png|jpeg)$/', get_post_meta($post->ID, 'dt_backdrop', true))){
                                echo '<img id="img-backdrop" src="'.get_post_meta($post->ID, 'dt_backdrop', true).'" alt="backdrop">';
                            }else{
                            ?>
                            <img id="img-backdrop" src="<?php echo TR_MOVIES_PLUGIN_URL; ?>assets/img/noimgb.png" alt="" />

                            <?php
                            }
                            ?>
                            <input type="file" name="backdrop" id="inp-backdrop">
                            <span><?php _e("Click here for upload image", TRMOVIES); ?></span>
                        </p>
                    </div>
                    <button class="BtnSnd" type="submit" name="submit"><?php _e('Save changes', TRMOVIES); ?></button>
                </aside>
            </div>
            
            <div id="tr_movies_tab_2" class="tr_movies_tab" style="display:none">
              
                <?php
                    $trmovieslinks = unserialize(get_post_meta($post->ID, 'trmovieslink', true));    
                ?>

                <div class="links_options">
                    <button id="trmovies_addlink" type="button"><i class="dashicons dashicons-plus-alt"></i><?php _e('Add link', TRMOVIES); ?></button>
                    <div class="lnkopcn">
                        <div class="links_options_generate">
                            <i class="dashicons dashicons-admin-links"></i>
                            <input type="text" name="url_generate" placeholder="<?php _e('Enter url of Yaske.org', TRMOVIES); ?>"><button id="trmovies_generate" type="button"><?php _e('Generate', TRMOVIES); ?></button>
                        </div>
                        <div style="display:none" class="trmoviesnotsupport"><?php _e('URL INVALID, SUPPORT YASKE.ORG'); ?></div>
                    </div>
                </div>
                
                <div class="ToroPlay-tblcn Blkcn">
                    <table class="ToroPlay-tbl">
                        <thead>
                            <tr>
                                <th><?php _e('TYPE', TRMOVIES); ?></th>
                                <th><?php _e('SERVER', TRMOVIES); ?></th>
                                <th><?php _e('LANGUAGE', TRMOVIES); ?></th>
                                <th><?php _e('QUALITY', TRMOVIES); ?></th>
                                <th><?php _e('LINK', TRMOVIES); ?></th>
                                <th><?php _e('DATE', TRMOVIES); ?></th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(count($trmovieslinks)>0){ ?>

                            <?php for ($i = 0; $i <= count($trmovieslinks)-1; $i++) { ?>

                            <tr class="tr-movies-row">
                                <td>
                                    <select name="trmovies_type[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
    <!--manual selected -lava -->    <option value="1" selected <?php if(!empty($trmovieslinks[$i]['type'])){ selected( $trmovieslinks[$i]['type'], 1 ); } ?>><?php _e('Online', TRMOVIES); ?></option>
                                        <option value="2" <?php if(!empty($trmovieslinks[$i]['type'])) { selected( $trmovieslinks[$i]['type'], 2 ); } ?>><?php _e('Download', TRMOVIES); ?></option>
                                    </select>
                                </td>
                                <td>
                                    <select name="trmovies_server[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
                                        <?php
                                            $servers = get_categories( array(
                                                'orderby' => 'name',
                                                'hide_empty' => 0,
                                                'taxonomy' => 'server'
                                            ) );

                                            foreach ( $servers as $server ) {
                                                echo '<option '.selected( $trmovieslinks[$i]['server'], $server->term_id, false ).' value="'.$server->term_id.'">'.$server->name.'</option>';
                                            }
                                        ?>
                                    </select>                    
                                </td>
                                <td>
                                    <select name="trmovies_lang[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
                                        <?php
                                            $languages = get_categories( array(
                                                'orderby' => 'name',
                                                'hide_empty' => 0,
                                                'taxonomy' => 'language'
                                            ) );

                                            foreach ( $languages as $lang ) {
                                                echo '<option '.selected( $trmovieslinks[$i]['lang'], $lang->term_id, false ).' value="'.$lang->term_id.'">'.$lang->name.'</option>';
                                            }
                                        ?>
                                    </select>                      
                                </td>
                                <td>
                                    <select name="trmovies_quality[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
                                        <?php
                                            $qualitys = get_categories( array(
                                                'orderby' => 'name',
                                                'hide_empty' => 0,
                                                'taxonomy' => 'quality'
                                            ) );

                                            foreach ( $qualitys as $quality ) {
                                                echo '<option '.selected( $trmovieslinks[$i]['quality'], $quality->term_id, false ).' value="'.$quality->term_id.'">'.$quality->name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>

                <?php 

                if (get_post_meta($post->ID, 'Checkbx2', true)!='') {
                    $putLink = 'https://gomostream.com/movie/'.get_post_meta($post->ID, 'Checkbx2', true).'/';
               ?>
                <input name="trmovies_link[]" value="<?php echo $putLink; ?>" type="text">
                <?php }else{ ?>
                                    
                                    <input name="trmovies_link[]" value="<?php if(isset($trmovieslinks[$i]['link'])){ echo $trmovieslinks[$i]['link']; } ?>" type="text">
                    <?php }?>
                                </td>
                                <td>
                                    <input type="text" value="<?php if(isset($trmovieslinks[$i]['date'])){ echo $trmovieslinks[$i]['date']; } ?>" name="trmovies_date[]">
                                </td>
                                <td><button data-id="<?php if(isset($_GET['post'])){ echo intval($_GET['post']); } ?>" id="trmovies_removelink" type="button" class="BtnTrpy"><i class="dashicons dashicons-dismiss"></i><?php _e('Delete', TRMOVIES); ?></button></td>
                                <td>
                                    <a href="#" class="BtnTrpy move-up tr-move-up"><i class="dashicons dashicons-arrow-up"></i><?php _e('Up', TRMOVIES); ?></a>
                                    <a href="#" class="BtnTrpy move-down tr-move-down"><i class="dashicons dashicons-arrow-down"></i><?php _e('Down', TRMOVIES); ?></a>
                                </td>
                            </tr>

                            <?php } ?>

                            <?php }else{ ?>

                            <tr class="tr-movies-row">
                                <td>
                                    <select name="trmovies_type[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
                                        <option value="1"><?php _e('Online', TRMOVIES); ?></option>
                                        <option value="2"><?php _e('Download', TRMOVIES); ?></option>
                                    </select>
                                </td>
                                <td>
                                    <select name="trmovies_server[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
                                        <?php
                                            $servers = get_categories( array(
                                                'orderby' => 'name',
                                                'hide_empty' => 0,
                                                'taxonomy' => 'server'
                                            ) );

                                            foreach ( $servers as $server ) {
                                                echo '<option value="'.$server->term_id.'">'.$server->name.'</option>';
                                            }
                                        ?>
                                    </select>                    
                                </td>
                                <td>
                                    <select name="trmovies_lang[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
                                        <?php
                                            $languages = get_categories( array(
                                                'orderby' => 'name',
                                                'hide_empty' => 0,
                                                'taxonomy' => 'language'
                                            ) );

                                            foreach ( $languages as $lang ) {
                                                echo '<option value="'.$lang->term_id.'">'.$lang->name.'</option>';
                                            }
                                        ?>
                                    </select>                      
                                </td>
                                <td>
                                    <select name="trmovies_quality[]">
                                        <option value=""><?php _e('Select', TRMOVIES); ?></option>
                                        <?php
                                            $qualitys = get_categories( array(
                                                'orderby' => 'name',
                                                'hide_empty' => 0,
                                                'taxonomy' => 'quality'
                                            ) );

                                            foreach ( $qualitys as $quality ) {
                                                echo '<option value="'.$quality->term_id.'">'.$quality->name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input name="trmovies_link[]" value="" type="text">
                                </td>
                                <td>
                                    <input type="text" value="<?php echo date('d'); ?>/<?php echo date('m'); ?>/<?php echo date('Y'); ?>" name="trmovies_date[]">
                                </td>
                                <td><button id="trmovies_removelink" type="button" class="BtnTrpy"><i class="dashicons dashicons-dismiss"></i><?php _e('Delete', TRMOVIES); ?></button></td>
                                <td>
                                    <a href="#" class="BtnTrpy move-up tr-move-up"><i class="dashicons dashicons-arrow-up"></i><?php _e('Up', TRMOVIES); ?></a>
                                    <a href="#" class="BtnTrpy move-down tr-move-down"><i class="dashicons dashicons-arrow-down"></i><?php _e('Down', TRMOVIES); ?></a>
                                </td>
                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                <button class="BtnSnd Alt" type="submit" name="submit"><?php _e('Save changes', TRMOVIES); ?></button>
            </div>
            <input type="hidden" name="id_post" value="<?php echo $post->ID; ?>">
        </form>
    </section>

