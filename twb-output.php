<?php
// Add Shortcode 
add_shortcode( 'twb_wc_reviews', 'twb_wc_reviews_shortcode_fn' );
function twb_wc_reviews_shortcode_fn( $atts ) {
ob_start();
	// Attributes
	extract( shortcode_atts(
		array(
			'product_id' => '',
			'number' => '',
			'exclude' => '',
			'exclude_product' => '',
		), $atts )
	);
	
	if ($product_id) {
        $product_id = array_map('intval', explode(',', $product_id));
    }
	if ($exclude) {
        $exclude = array_map('intval', explode(',', $exclude));
    }
	if ($exclude_product) {
        $exclude_product = array_map('intval', explode(',', $exclude_product));
    }
	$twb_wc_reviews = get_comments( 
		array( 
			'status' => 'approve', 
			'post_status' => 'publish', 
			'post_type' => 'product',
			'parent' => '0',
			'post__in' => $product_id,
			'number' => $number,
			'comment__not_in' => $exclude,
			'post__not_in' => $exclude_product,
			) 
		);

		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 

        if ( $twb_wc_reviews ) { 
			$options =   get_option( 'twb_wc_reviews_option' ); 
			
			//check to see what layout is selected
			
			if(!isset($options['twb_wcr_layout']) ) {
				$layout = 'twb_wc_reviews_slide';
			
			}elseif( isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'Slider' ) {
				$layout = 'twb_wc_reviews_slide';
				
				
			}elseif( isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'List') {
				$layout = '';
				
				//check to see column count
				if($options['twb_wcr_layout_col'] == 'One') {
					$col = 'width:100%; margin-right:0;';
				} elseif($options['twb_wcr_layout_col'] == 'Two') {
					$col = 'width:49%; float:left; margin-right:2%;';
				} elseif($options['twb_wcr_layout_col'] == 'Three') {
					$col = 'width:32.333%; float: left;  margin-right:1.5%;';
				} else {
					$col = '';
				}
				
			}elseif( isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'Masonry') {
				$layout = '';
				
				//check to see column count
				if($options['twb_wcr_layout_ms_col'] == '3') {
					$mscol = 'width: calc(33.33% - 14px); float:left; margin:0 0 20px; ';
				} elseif($options['twb_wcr_layout_ms_col'] == '2') {
					$mscol = 'width: calc(50% - 14px); float:left; margin:0 0 20px;';
				} else {
					$mscol = 'width: calc(33.33% - 17px); float:left; margin:0 0 20px;';
				}		
			}else{
				$layout = '';
			}
?>
<div class="twb_wc_reviews_wrapper">
  <div class="twb_wc_reviews_slide_wrap <?php echo $layout; ?>">
    <?php  
				$count = 1;			
				foreach ( $twb_wc_reviews as $twb_wc_review ) { 				
				if( $count % 3 == 0 && isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'List' && $options['twb_wcr_layout_col'] == 'Three' ) {
					$margin = '0';
				}elseif( $count % 2 == 0 && isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'List' && $options['twb_wcr_layout_col'] == 'Two' ) {
					$margin = '0';
				}else {
					$margin = '';
				}
			?>
			
    <div class="twb_wc_reviews <?php //echo $layout; ?>" style="<?php if(isset ($col) ) { echo $col; } ?> <?php if(isset ($mscol) ) { echo $mscol; } ?> margin-right:<?php echo $margin; ?>;">
      <div>
        <div class="twb_wc_reviews_product_thumb">
		<?php if(!isset ($options['twb_remove_p_link']) ):?>		
			<a href="<?php echo get_permalink($twb_wc_review->comment_post_ID); ?>">
		<?php endif; ?>	
		<?php if(!isset ($options['twb_hide_pimg']) ):?>			
				<?php echo get_the_post_thumbnail($twb_wc_review->comment_post_ID, array( 150 , 150 ) ); ?>
		<?php endif; ?>			
		<?php if(!isset ($options['twb_hide_pname']) ):?>			
				<h3 class="twb_wc_reviews_product_title" style="color:<?php if(isset($options['twb_wcr_txtcolor'])) echo $options['twb_wcr_txtcolor'];?>;">
					<?php echo get_the_title($twb_wc_review->comment_post_ID); ?>
				</h3>
		<?php endif; ?>			
		<?php if(!isset ($options['twb_remove_p_link']) ):?>
			</a>	
		<?php endif; ?>
		</div>
		
        <?php 
		$rating = intval( get_comment_meta( $twb_wc_review->comment_ID, 'rating', true ) );
		if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' && !isset($options['twb_hide_star'] )  ) : ?>
			<div class="woocommerce twb_wc_reviews_ratings_wrap">
				<div style="color:<?php if(isset($options['twb_wcr_txtcolor'])) echo $options['twb_wcr_txtcolor'];?>;" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating ) ?>">
					<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%">
						<strong><?php echo $rating; ?></strong>
							<?php _e( 'out of 5', 'twb_wc_reviews' ); ?>
					</span>
				</div>
			</div>
		<?php endif; ?>
        
		<?php if(!isset ($options['twb_remove_review_link']) ):?>
		<a href="<?php echo esc_url( get_comment_link( $twb_wc_review->comment_ID ) ); ?>">
         <?php endif; ?>
		 <div class="twb_wc_reviews_ct"><?php 
			$comment = get_comment_text($twb_wc_review);
			if( isset($options['twb_limit_review_txt']) && !empty($options['twb_limit_review_txt']) ) {
				$twb_txt_limit = $options['twb_limit_review_txt'];
			}else{
				$twb_txt_limit = "500";				
			}
			echo apply_filters('the_content', wp_trim_words( $comment, $twb_txt_limit, '' ) ); 
		?></div>
		<?php if(!isset ($options['twb_remove_review_link']) ):?>
		 </a>
        <?php endif; ?>
		<?php
		//Avatar
		$twb_avatar= get_avatar( $twb_wc_review, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' );
			if( !isset($options['twb_hide_avatar'] )  ) 
				echo '<div class="twb_wc_reviews_avatar">'.$twb_avatar.'</div>';
			//author
			if(!isset($options['twb_hide_author']) )
				echo'<div class="twb_wcr_author">' .get_comment_author($twb_wc_review). '</div>'; 
			  //date
			  if(isset($options['twb_show_date']) )
				echo'<div class="twb_wcr_date">'. get_comment_date( wc_date_format(),  $twb_wc_review ). '</div>';
		?>
      </div>
    </div>
    <!--review-->
				<?php				
					if( 
					$count % 3 == 0 && isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'List' && $options['twb_wcr_layout_col'] == 'Three' 
					) {		
						echo'<div style="clear:both;"></div>';
					}elseif( 
					$count % 2 == 0 && isset($options['twb_wcr_layout']) && $options['twb_wcr_layout'] == 'List' && $options['twb_wcr_layout_col'] == 'Two' 
					) {
						echo'<div style="clear:both;"></div>';
					}else {
						echo'';
					}
					$count++;
			} //endforeach 
			?>
  </div>
</div>
<!--wrapper-->
<?php
		$twb_wcr_shortcode_deploy = ob_get_clean();
			return $twb_wcr_shortcode_deploy;
		//if reviews
		} else {
			echo'Either the reviews are pending or there are no reviews at all!';
		}
		//if wc is installed
		}else {
		echo'Please install Woocommerce plugin first.';	
		}
}//end function