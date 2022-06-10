<?php
	if( ! $cart_status ) {
		/** Cart body header Notice start **/
			?>
				<div class="wfc_title">You have <span class="wfc_count-item"><?php echo $cart_count; ?></span> item(s) in your cart</div>
			<?php
		/** Cart body header Notice end **/
	} else {
		?>
			<div class="wfc_title"></div>
		<?php
	}
?>
