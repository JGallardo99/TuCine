<?php
// Disables Kses only for textarea saves
remove_filter('pre_term_description', 'wp_filter_kses');

// Disables Kses only for textarea admin displays
remove_filter('term_description', 'wp_kses_data');

add_filter('edit_category_form_fields', 'tr_cat_description');
function tr_cat_description($tag) {
?>      
<table class="form-table">

<tr class="form-field">
                
<th scope="row" valign="top">
<label for="description">
<?php _e('Description', 'toroflix'); ?>
</label>
</th>
             
<td>
    <?php
        $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
        wp_editor(wp_specialchars_decode($tag->description), 'cat_description', $settings);
    ?>               
<br/>               
<span class="description">
<?php _e('The description is not prominent by default; however, some themes may show it.', 'toroflix'); ?>
</span>              
</td>

</tr>
 
</table>

<?php
}

add_action('admin_head', 'tr_remove_default_category_description');
function tr_remove_default_category_description()
{
    global $current_screen;
    if ( $current_screen->id == 'edit-category' )
    {
    ?>
<script type="text/javascript">
        jQuery(function($) {
            $('textarea#description').closest('tr.form-field').remove();
        });        
</script>

<?php
    }
}
?>