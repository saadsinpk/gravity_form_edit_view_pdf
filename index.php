<?php
/*
Plugin Name: Sid Techno
Plugin URI: http://www.sidtechno.com
Description: Sid Techno custom plugin for gravity view pdf button
Author: Muhammad Saad
Author URI: http://www.sidtechno.com
Version: 1.0.0
*/

function sid_footer() {
	if ( ! is_admin() ) {
		if(isset($_POST['is_gv_edit_entry'])) {
			$forms = GFAPI::get_forms();
			$form_id = array_keys($forms[0]['gfpdf_form_settings'])[0];
			$entry_id = $_POST['lid'];
			?>
			<script>
				jQuery( document ).ready(function() {
					jQuery(".gv-notice").html("<a href='<?php echo get_site_url();?>/pdf/<?php echo $form_id;?>/<?php echo $entry_id;?>/download/' style='font-size:18px'>Download Entry</a>");
					console.log( "ready! Saad! Test!" );
				});
			</script>
		<?php }
	}
}
add_action( 'wp_footer', 'sid_footer' );

function gravityviewlist_display() {
	global $wpdb;
    $output = '<div class="formslist"><ol>';
    // by default, only active and not in trash
    // https://docs.gravityforms.com/api-functions/#get-forms
    $forms = GFAPI::get_forms();
    // echo "<pre>";
    	// print_r(get_post_meta(15152, '_gravityview_form_id'));
    // echo "</pre>";
    // exit();
    foreach ( $forms as $form) {
    	$formId = $form['fields'][0]->formId;
    	$title_link = '';
		$data = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value = %s", '_gravityview_form_id', $formId) , ARRAY_N );
		if(isset($data[0])) {
			$data[0][1];
			$title_link = get_permalink($data[0][1]);
		}
        $output .= $url."<li><a href='".$title_link."'>".$form['title'] . '</a></li>';
    }
    return $output . '</ol></div>';
}
add_shortcode( 'gravityviewlist', 'gravityviewlist_display' );
