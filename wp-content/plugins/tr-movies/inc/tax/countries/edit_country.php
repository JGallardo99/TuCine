<?php
if ( !defined('NONCE_KEY') ) die('Die!');

    $error = ''; $ok = '';

    $term_id = empty($_GET['edit']) ? intval($_POST['edit']) : intval($_GET['edit']);

    $term = get_term( $term_id, 'country' );

    if(isset($_POST['submit_edit_country'])){
                        
        if(empty($_POST['name'])){
            
            $error.='<p class="msjadm-error">'.__('The name field is empty.', TRMOVIES).'</p>';
            
        }else{
        
            $parent_term = term_exists( stripslashes( wp_strip_all_tags( $_POST['name'] ) ), 'country' );
            
            if(!empty($parent_term) and $parent_term['term_id']!=$term->term_id){
                
                $error.='<p class="msjadm-error">'.__('The country you introduced already exists.', TRMOVIES).'</p>';

            }
            
        }
                                
        if(empty($error)){
            
            wp_update_term($term->term_id, 'country', array(
              'name' => stripslashes( wp_strip_all_tags( $_POST['name'] )),
              'slug' => stripslashes( wp_strip_all_tags( $_POST['name'] ))
            ));
                        
            $ok='<p class="msjadm-ok">'.__('The country was updated successfully.', TRMOVIES).'</p>';
            
        }
        
    }
?>
<main>
    <form action="admin.php?page=tr-movies-movie&action=links&action2=countries" method="post" class="Blkcn" enctype="multipart/form-data">
        <p class="Title"><?php _e('Edit Country', TRMOVIES); ?> <span>(<a target="_blank" href="term.php?taxonomy=country&tag_ID=<?php echo $term->term_id; ?>"><?php _e('Edit term', TRMOVIES); ?></a>)</span></p>

        <label class="Inprgt">
            <span><?php _e('Name'); ?></span>
            <input value="<?php if(isset($_POST['name'])){ echo stripslashes( wp_strip_all_tags( $_POST['name'] )); }else{ echo $term->name; } ?>" name="name" type="text" placeholder="<?php _e('Name of country', TRMOVIES); ?>">
        </label>
                
        <input type="hidden" name="edit" value="<?php echo $term->term_id; ?>">

        <p><button class="BtnSnd BtnStylA BtnFlR" name="submit_edit_country" type="submit"><?php _e('Save changes', TRMOVIES); ?></button></p>

    </form>
</main>