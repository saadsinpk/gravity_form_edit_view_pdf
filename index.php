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
