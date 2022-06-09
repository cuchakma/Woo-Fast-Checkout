<div class="wfc_list_wrap">

	<?php

	foreach ( $cart_products as $cart_key => $cart_item ) {

		$product_id = $cart_item['product_id'];

		$product_data = $cart_item['data'];

		if ( empty( $product_data ) || ! $product_data->exists() || $cart_item['quantity'] < 0 ) {
			continue;
		}

		$product_permalink = get_permalink( $product_id );

		$product_name = $product_data->get_name();

		$product_price = $product_data->get_price();

		$product_qty = $cart_item['quantity'];

		$product_thumbnail = $product_data->get_image();

		$product_subtotal = WC()->cart->get_product_subtotal( $product_data, $product_qty );

		?>
			<ul class="wfc_list wfc_list_item">

						<?php

							if( $cart_status ) {

								?>
									<li class="wfc_no_product">
										No Product in Cart
									</li>
								<?php

							} else { 
								?>
									<li class="wfc_product-item">

										<a href="#" class="thumb">

										<?php echo wp_kses_post( $product_thumbnail ); ?>

										</a>
			
										<div class="info">

											<a href="#" class="product-name"><?php echo wp_kses_post( $product_name ); ?></a>

											<div class="wfc_product-item-qty">

												<span class="number price">

													<span>

														<span class="money" data-currency-usd="<?php echo wp_kses_post( $product_qty ); ?>"><?php echo wp_kses_post( $product_qty ); ?></span>

													</span>
												</span>

												<span class="qty">Quantity: &nbsp;

													<div class="wfc_quantity">

														<form>

															<div class="wfc_quantity_row">
																
																<span class="wfc_quantity_col wfc_quantity_col_minus wfc_quantity_button">

																	<i class="fa-solid fa-minus"></i>

																</span>

																<span class="wfc_quantity_col wfc_quantity_col_input">

																	<input type="number" id="quantity_121" class="wfc_input_text num_qty text" step="1" min="1" max="" name="quantity" value="<?php echo wp_kses_post( $product_qty ); ?>" title="Qty" placeholder="" inputmode="numeric">

																</span>

																<span class="wfc_quantity_col wfc_quantity_col_plus wfc_quantity_button">

																	<i class="fa-solid fa-plus"></i>

																</span>

															</div>

														</form>

													</div>

												</span>

											</div>

										</div>
			
										<?php printf( '<a href="%s" class="js-remove-item remove" data-product-id="%d" data-product-sku="%d" data-cart_item_key="%s" title="%s"><i class="fa-solid fa-square-xmark"></i></a>', esc_url( wc_get_cart_remove_url( $cart_key ) ), filter_var( $product_id, FILTER_SANITIZE_NUMBER_INT ), filter_var( $product_qty, FILTER_SANITIZE_NUMBER_INT ), esc_attr( $cart_key ), 'Remove' ); ?>

									</li>	
								<?php } ?>
				</ul>
			<?php
	}

	?>

</div>
