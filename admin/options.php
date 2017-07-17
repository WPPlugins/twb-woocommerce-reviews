<?php
// Add sub page to the Settings Menu
add_action('admin_menu', 'twb_settings');
add_action('admin_init', 'twb_settings_register' );
function twb_settings() {
	add_options_page('TWB Woocommerce Reviews Option Page', 'TWB Woocommerce Reviews', 'administrator', __FILE__, 'twb_wcr');
}
// Register our settings. Add the settings section, and settings fields
function twb_settings_register(){
	register_setting('twb_wc_reviews_settings', 'twb_wc_reviews_option', '' );
		add_settings_section('twb_section', 'Customize Layout', 'twb_section_fn', __FILE__);		
		add_settings_field( 'twb_hide_pimg',  'Hide Product Image?',  'twb_hide_pimg_fn',  __FILE__,  'twb_section' );
		add_settings_field( 'twb_hide_pname',  'Hide Product Name?',  'twb_hide_pname_fn',  __FILE__,  'twb_section' );
		add_settings_field( 'twb_remove_p_link',  'Remove Product link from title and image?',  'twb_remove_p_link_fn',  __FILE__,  'twb_section' );
		add_settings_field('twb_hide_star', 'Hide Star Ratings?', 'twb_hide_star_fn', __FILE__, 'twb_section');
		add_settings_field( 'twb_remove_review_link',  'Remove link from review text?',  'twb_remove_review_link_fn',  __FILE__,  'twb_section' );
		add_settings_field( 'twb_limit_review_txt',  'Limit review text? (Number of words to show in each review)',  'twb_limit_review_txt_fn',  __FILE__,  'twb_section' );
		add_settings_field( 'twb_hide_avatar',  'Hide Review Author Avatar?',  'twb_hide_vatar_fn',  __FILE__,  'twb_section' );
		add_settings_field('twb_hide_author', 'Hide Review Author Name?', 'twb_hide_author_fn', __FILE__, 'twb_section');
		add_settings_field('twb_show_date', 'Display Review Date?', 'twb_show_date_fn', __FILE__, 'twb_section');
		add_settings_field('twb_wcr_layout', 'Select Layout', 'twb_layout_select_fn', __FILE__, 'twb_section');
		add_settings_field('twb_wcr_slider_effect', 'Slider Effect', 'twb_layout_slider_effect_fn', __FILE__, 'twb_section', array( 'class' => 'twb_slider' ));
		add_settings_field('twb_wcr_slider_speed', 'Slider/Fade Effect Speed (in milliseconds)', 'twb_layout_slider_speed_fn', __FILE__, 'twb_section', array( 'class' => 'twb_slider' ));
		add_settings_field('twb_wcr_layout_col', 'Select Columns', 'twb_layout_col_fn', __FILE__, 'twb_section', array( 'class' => 'twb_list' ));
		add_settings_field('twb_wcr_layout_ms_col', 'Masonry Columns', 'twb_layout_ms_col_fn', __FILE__, 'twb_section', array( 'class' => 'twb_ms' ) );
		add_settings_field('twb_wcr_ms_gutter', 'Masonry Gutter Size', 'twb_layout_ms_gutter_fn', __FILE__, 'twb_section', array( 'class' => 'twb_ms' ));
		add_settings_field('twb_wcr_ms_external_lib', 'Load External Masonry Library (leave unchecked if not sure)', 'twb_wcr_ms_external_lib_fn', __FILE__, 'twb_section', array( 'class' => 'twb_ms' ));
		add_settings_field('twb_wcr_bgcolor', 'Background Color', 'twb_bgcolor_fn', __FILE__, 'twb_section');
		add_settings_field('twb_wcr_txtcolor', 'Text Color', 'twb_txtcolor_fn', __FILE__, 'twb_section');	
		add_settings_field('twb_wcr_custom_css', 'Custom CSS', 'twb_custom_css_fn', __FILE__, 'twb_section');
}

function twb_section_fn() {
	echo'';	
}

function twb_hide_pimg_fn() {	
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_hide_pimg'] )) 
  	$options['twb_hide_pimg'] = 0;
	
	echo'<input type="checkbox" id="twb_hide_pimg" name="twb_wc_reviews_option[twb_hide_pimg]" value="1" ' . checked(1, $options['twb_hide_pimg'], false) . '/>';
}

function twb_hide_pname_fn() {	
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_hide_pname'] )) 
  	$options['twb_hide_pname'] = 0;
	
	echo'<input type="checkbox" id="twb_hide_pname" name="twb_wc_reviews_option[twb_hide_pname]" value="1" ' . checked(1, $options['twb_hide_pname'], false) . '/>';
}

function twb_remove_p_link_fn() {	
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_remove_p_link'] )) 
  	$options['twb_remove_p_link'] = 0;
	
	echo'<input type="checkbox" id="twb_remove_p_link" name="twb_wc_reviews_option[twb_remove_p_link]" value="1" ' . checked(1, $options['twb_remove_p_link'], false) . '/>';
}

function twb_hide_vatar_fn() {	
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_hide_avatar'] )) 
  	$options['twb_hide_avatar'] = 0;
	
	echo'<input type="checkbox" id="twb_hide_avatar" name="twb_wc_reviews_option[twb_hide_avatar]" value="1" ' . checked(1, $options['twb_hide_avatar'], false) . '/>';

}

function twb_hide_star_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;

	if (!isset( $options['twb_hide_star'] )) 
  	$options['twb_hide_star'] = 0;
	
	echo'<input type="checkbox" id="twb_hide_star" name="twb_wc_reviews_option[twb_hide_star]" value="1" ' . checked(1, $options['twb_hide_star'], false) . '/>';

}

function twb_remove_review_link_fn() {	
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_remove_review_link'] )) 
  	$options['twb_remove_review_link'] = 0;
	
	echo'<input type="checkbox" id="twb_remove_review_link" name="twb_wc_reviews_option[twb_remove_review_link]" value="1" ' . checked(1, $options['twb_remove_review_link'], false) . '/>';
}

function twb_limit_review_txt_fn() {	
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_limit_review_txt'] )) 
  	$options['twb_limit_review_txt'] = "";
	
	echo'<input type="number" id="twb_limit_review_txt" class="" name="twb_wc_reviews_option[twb_limit_review_txt]" value="'.$options['twb_limit_review_txt']. '" /> Number Only - Leave Empty to display full review text.';

}

function twb_hide_author_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;

	if (!isset( $options['twb_hide_author'] )) 
  	$options['twb_hide_author'] = 0;
	
	echo'<input type="checkbox" id="twb_hide_author" name="twb_wc_reviews_option[twb_hide_author]" value="1" ' . checked(1, $options['twb_hide_author'], false) . '/>';

}

function twb_show_date_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;

	if (!isset( $options['twb_show_date'] )) 
  	$options['twb_show_date'] = 0;
	
	echo'<input type="checkbox" id="twb_show_date" name="twb_wc_reviews_option[twb_show_date]" value="1" ' . checked(1, $options['twb_show_date'], false) . '/>';

}

function twb_layout_select_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	$items = array("Slider", "List", "Masonry" );
	
	if (!isset( $options['twb_wcr_layout'] )) 
  	$options['twb_wcr_layout'] = 'Slider';

	echo "<select id='twb_wcr_layout' name='twb_wc_reviews_option[twb_wcr_layout]'>";
	foreach($items as $item) {
		$selected = ($options['twb_wcr_layout']==$item) ? 'selected="selected"' : '';
		echo "<option id='$item' value='$item' $selected>$item</option>";
	}
	echo "</select>";
}

function twb_layout_slider_effect_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	$items = array("Slide", "Fade" );
	
	if (!isset( $options['twb_wcr_slider_effect'] )) 
  	$options['twb_wcr_slider_effect'] = 'Slide';
	
	echo "<select id='twb_wcr_slider_effect' class='' name='twb_wc_reviews_option[twb_wcr_slider_effect]'>";
	foreach($items as $item) {
		$selected = ($options['twb_wcr_slider_effect']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
	
	echo' (Only applicable if slider layout is selected)';

}

function twb_layout_slider_speed_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_wcr_slider_speed'] )) 
  	$options['twb_wcr_slider_speed'] = '300';
	
	echo'<input type="number" id="twb_wcr_slider_speed" class="" name="twb_wc_reviews_option[twb_wcr_slider_speed]" value="'.$options['twb_wcr_slider_speed']. '" />';
	
	echo' Default = 300 (Only applicable if slider layout is selected)';
	
}

function twb_layout_col_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	$items = array("One", "Two", "Three" );
	
	if (!isset( $options['twb_wcr_layout_col'] )) 
  	$options['twb_wcr_layout_col'] = 'One';

	echo"<select id='twb_wcr_layout_col' class='' name='twb_wc_reviews_option[twb_wcr_layout_col]'>";
	foreach($items as $item) {
		$selected = ($options['twb_wcr_layout_col']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
	echo' (Only applicable if List layout is selected)';

}

function twb_layout_ms_col_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	$items = array( "3", "2" );
	
	if (!isset( $options['twb_wcr_layout_ms_col'] )) 
  	$options['twb_wcr_layout_ms_col'] = '3';

	echo"<select id='twb_wcr_layout_ms_col' class='' name='twb_wc_reviews_option[twb_wcr_layout_ms_col]'>";
	foreach($items as $item) {
		$selected = ($options['twb_wcr_layout_ms_col']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$item</option>";
	}
	echo "</select>";
	echo' (Only applicable if Masonry layout is selected)';

}

function twb_layout_ms_gutter_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_wcr_ms_gutter'] )) 
  	$options['twb_wcr_ms_gutter'] = '20';
	
	echo'<input type="number" id="twb_wcr_ms_gutter" class="" name="twb_wc_reviews_option[twb_wcr_ms_gutter]" value="'.$options['twb_wcr_ms_gutter']. '" />';
	
	echo' Default = 20 (Only change if necessary.)';

}

function twb_wcr_ms_external_lib_fn() {	
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_wcr_ms_external_lib'] )) 
  	$options['twb_wcr_ms_external_lib'] = 0;
	
	echo'<input type="checkbox" id="twb_wcr_ms_external_lib" name="twb_wc_reviews_option[twb_wcr_ms_external_lib]" value="1" ' . checked(1, $options['twb_wcr_ms_external_lib'], false) . '/>';
	
	echo' Default is Disabled (Only check this box if wordpress masonry library not working.)';
}

function twb_bgcolor_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_wcr_bgcolor'] )) 
  	$options['twb_wcr_bgcolor'] = '#a6946e';
	
	echo'<input type="text" id="twb_wcr_bgcolor" class="twb-color-picker" name="twb_wc_reviews_option[twb_wcr_bgcolor]" data-default-color="#a6946e" value="'.$options['twb_wcr_bgcolor']. '" />';
}

function twb_txtcolor_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' ) ;
	
	if (!isset( $options['twb_wcr_txtcolor'] )) 
  	$options['twb_wcr_txtcolor'] = '#fff';

	echo'<input type="text" id="twb_wcr_txtcolor" class="twb-color-picker" name="twb_wc_reviews_option[twb_wcr_txtcolor]" data-default-color="#fff" value="'.$options['twb_wcr_txtcolor']. '" />';
}

function twb_custom_css_fn() {
	
	$options =   get_option( 'twb_wc_reviews_option' );
	
	if (!isset($options['twb_wcr_custom_css'])) 
	$options['twb_wcr_custom_css'] = "";
	
	echo'<textarea type="textarea" id="twb_wcr_custom_css" name="twb_wc_reviews_option[twb_wcr_custom_css]" rows="7" cols="70" style="border:1px solid #ccc; background-color:#FBFBFB;" placeholder="Custom CSS Here ...">'. $options['twb_wcr_custom_css']. '</textarea>';
}

// Display the admin options page
function twb_wcr() {
?>
<style type="text/css">
.twb_left_col, .twb_right_col {
	display: block;
}
.form-table th {
	min-width: 200px;
}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($){   
   		
		//$("#twb_wcr_layout option[value='Masonry (Coming soon)']").prop('disabled', true);
		
		//$('.form-table tr').each(function(i){
			//this.id="twb_wcr_"+i;
		//});
	
		$('.twb_list, .twb_ms').hide();  
		
		$('#twb_wcr_layout').change(function(){
			if($('#twb_wcr_layout').val() == 'List' ) {
				$('.twb_list').show();
				$('.twb_slider, .twb_ms').hide();
				
			} else if($('#twb_wcr_layout').val() == 'Masonry' ) {
				
				$('.twb_ms').show();
				$('.twb_slider, .twb_list').hide();
				
			}else{
				$('.twb_slider').show();
				$('.twb_list, .twb_ms').hide();  
			} 
		});
	
		<?php
			$options =   get_option( 'twb_wc_reviews_option' );
			
			if(isset( $options['twb_wcr_layout']) ) {
			
			if($options['twb_wcr_layout'] == 'List') : ?>
				$('.twb_list').show();
				$('.twb_slider, .twb_ms').hide();				
		<?php endif; 
		
			if($options['twb_wcr_layout'] == 'Masonry') : ?>
				$('.twb_ms').show();
				$('.twb_slider, .twb_list').hide();				
		<?php endif; 
		
		}?>
	});
</script>
<div class="wrap">
  <div class="icon32" id="icon-options-general"><br>
  </div>
  <h2>TWB Woocommerce Reviews</h2>
  <div class="" style="float:left; width: 70%; overflow:hidden; ">
    <form action="options.php" method="post" id="twb_form">
	<input style="float:right; margin-right:15px;" name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
      <?php settings_fields('twb_wc_reviews_settings'); ?>
      <?php do_settings_sections(__FILE__); ?>
	  <p class="submit">
        <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
      </p>
    </form>
  </div>
  <div class="postbox" style="float:right; width: 25%; padding:10px;">
	<p><strong><a href="https://wordpress.org/support/view/plugin-reviews/twb-woocommerce-reviews" target="_blank">Rate This Plugin</a></strong></p>
	<p><strong><a href="https://wordpress.org/plugins/twb-woocommerce-reviews/" target="_blank">Read Documentaion</a></strong></p>
	<p><strong><a href="https://theweb-designs.com/support/forum/twb-woocommerce-reviews/" target="_blank">Need Help? Contact me here.</a></strong></p>
    <br />
    <p><strong>Please Donate</strong></p>
    <p>Please help us keep this plugin updated and bug free. It takes alot of time and efforts to keep this up to date so your donations really make a difference. Thank you.</p>
    <p>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
      <input type="hidden" name="cmd" value="_s-xclick">
      <input type="hidden" name="hosted_button_id" value="FZP8YJ24EPFEC">
      <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
      <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
    </p>
  </div>
  <div class="postbox" style="float:right; width: 25%; padding:10px;">
  <h2 style="line-height:1.5;">WordPress Site Maintenance, malware removal, backups, version updates, speed optimization, referrer spam blocking ... - only $50 per month per site.</h2>
	<h3><a href="http://theweb-designs.com/wmo/" target="_blank">Click for more details</a></h3>
	</div>
</div>
<?php
}