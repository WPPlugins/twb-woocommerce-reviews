<?php 
// Exit if accessed directly
if (!defined('ABSPATH')) {  echo "Oops! No direct access please :)"; exit; }

//custom header output
add_action('wp_head', 'twb_wcr_custom_css_output', 99);
function twb_wcr_custom_css_output() { 
 $options =   get_option( 'twb_wc_reviews_option' );
?>
<style type="text/css">
.twb_wc_reviews .twb_wc_reviews_ct p,
.twb_wc_reviews .twb_wc_reviews_ct p:hover,
.twb_wc_reviews .twb_wc_reviews_ct p:focus,
.twb_wc_reviews .twb_wc_reviews_ratings_wrap .star-rating:before,
.twb_wcr_author,  .twb_wcr_date { 
	color:<?php if(isset($options['twb_wcr_txtcolor'])) echo $options['twb_wcr_txtcolor']; ?>;
}
<?php
	if(!isset($options['twb_wcr_layout']) ) { ?>
		.twb_wc_reviews_slide_wrap { 
			background-color:<?php 
			if(isset($options['twb_wcr_bgcolor'])) {
			echo $options['twb_wcr_bgcolor']; } else { echo'#a6946e';} ?> !important; }
	<?php }elseif($options['twb_wcr_layout'] == 'Slider') { ?>
		.twb_wc_reviews_slide_wrap { background-color:<?php if(isset($options['twb_wcr_bgcolor'])) echo $options['twb_wcr_bgcolor']; ?> !important; }
	<?php }elseif($options['twb_wcr_layout'] == 'List' || $options['twb_wcr_layout'] == 'Masonry' ) { ?>
		.twb_wc_reviews { background-color:<?php if(isset($options['twb_wcr_bgcolor'])) echo $options['twb_wcr_bgcolor']; ?> !important; }
		.twb_wc_reviews_wrapper .twb_wc_reviews {
					margin-bottom: 15px;
				}
				.twb_wc_reviews {
					box-shadow: inset  0px 0px 8px rgba(0, 0, 0, 0.16);
					-webkit-box-shadow:inset  0px 0px 8px rgba(0, 0, 0, 0.16);
					-moz-box-shadow:inset  0px 0px 8px rgba(0, 0, 0, 0.16);
					-ms-box-shadow:inset  0px 0px 8px rgba(0, 0, 0, 0.16);
					-o-box-shadow:inset  0px 0px 8px rgba(0, 0, 0, 0.16);
				}
				
				@media screen and (max-width:767px) {
					.twb_wc_reviews {
						width: 100% !important;
						margin-right: 0 !important;
						clear: both !important;
					}
				}
				
	<?php }
			if(isset($options['twb_wcr_custom_css']) ) { 
				echo $options['twb_wcr_custom_css']; 
}?>
</style>
<?php 
}

//custom footer output
add_action('wp_footer', 'twb_wcr_custom_footer_output', 99);
function twb_wcr_custom_footer_output() { 
	$options =   get_option( 'twb_wc_reviews_option' );
	
	if( isset( $options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'Slider' ){ ?>
	<script type="text/javascript">
	jQuery(document).ready(function($){	
		 $('.twb_wc_reviews_slide').slick({
			adaptiveHeight: true,
			autoplay: true,
			dots: false,
			infinite: true,
			  //centerMode: true,
			//variableWidth: true,
			fade: <?php if($options['twb_wcr_slider_effect'] == 'Fade') {echo'true';} else {echo'false';}?>,
			cssEase: 'linear',
			speed: <?php if(!isset($options['twb_wcr_slider_speed'])) {echo'300';}else{ echo $options['twb_wcr_slider_speed']; }?>,
			prevArrow: '<div class="twb_wcr_prev_arrow"></div>',
			nextArrow: '<div class="twb_wcr_next_arrow"></div>'
		  });
	});
	</script>
	<?php
	} elseif ( isset( $options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'List' )  {
		return;
	}elseif ( isset ($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'Masonry'){ ?>
	<script type="text/javascript">
	jQuery(document).ready(function($){		
	var $container = $('.twb_wc_reviews_slide_wrap'); // this is the content selector
			$container.imagesLoaded( function() {
				$container.masonry({
					itemSelector: '.twb_wc_reviews', // this is the item selector
					columnWidth: '.twb_wc_reviews',
					percentPosition: true,
					gutter:<?php if(!isset($options['twb_wcr_ms_gutter'])) {echo'20';}else{ echo $options['twb_wcr_ms_gutter']; }?>,
					
				});
			});
	
	});
	</script>
	<?php }else { ?>
	<script type="text/javascript">
	jQuery(document).ready(function($){	
		 $('.twb_wc_reviews_slide').slick({
			adaptiveHeight: true,
			autoplay: true,
			dots: false,
			infinite: true,
			  //centerMode: true,
			//variableWidth: true,
			fade: <?php if(isset($options['twb_wcr_slider_effect']) && $options['twb_wcr_slider_effect'] == 'Fade') {echo'true';} else {echo'false';}?>,
			cssEase: 'linear',
			speed: <?php if(!isset($options['twb_wcr_slider_speed'])) {echo'300';}else{ echo $options['twb_wcr_slider_speed']; }?>,
			prevArrow: '<div class="twb_wcr_prev_arrow"></div>',
			nextArrow: '<div class="twb_wcr_next_arrow"></div>'
		  });
	});
	</script>		
<?php	}
}
/*	var container = document.querySelector('#ms-container');
      var msnry = new Masonry( container, {
       itemSelector: '.ms-item',
        columnWidth: '.ms-item',                
      });
	   
	(function($) {
		  
	  	 var $container = $('.twb_wc_reviews_slide_wrap'); // this is the content selector
			$container.imagesLoaded( function() {
				$container.masonry({
					itemSelector: '.twb_wc_reviews', // this is the item selector
					columnWidth: '.twb_wc_reviews',
					percentPosition: true,
					gutter:25,
					
				});
			});
			
			
			//$(window).on("resize load", function() {
				//var desired_width = $(".twb_wc_reviews_slide_wrap").width()/2 - 10
				//$('.twb_wc_reviews').css("width", desired_width)
			//}); 
			
	 })( jQuery );*/