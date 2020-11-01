<?php 
$letters = get_categories( array(
    'hide_empty' => false,
    'taxonomy'   => 'letters'
) ); 

$term = get_queried_object();
if($term)
	$name = strtolower($term->name);

if(isset($letters)){ ?>
    <ul class="AZList">
        <?php foreach ( $letters as $letter ) { ?>
            <li <?php if($name == strtolower($letter->name)){ echo 'class="Current"';} ?>><a href="<?php echo esc_url( get_term_link( $letter->term_id, 'letters' ) ); ?>"><?php echo esc_html( $letter->name ); ?></a></li>
        <?php } ?>
    </ul>
<?php }