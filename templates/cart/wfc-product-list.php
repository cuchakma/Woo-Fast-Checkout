<?php
if ( empty( $cart_products ) ) {
	?>
			<h5 class="wfc-no-products">No Products In Cart</h5>
	<?php
	return;
}
?>

<tbody class="wfc-products-main">

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
					<tr>
						<td>
						<?php printf( '<a href="%s" class="wfc_remove_product btn btn-dange" data-product-id="%d" data-product-sku="%d" data-cart_item_key="%s"><i class="fa-solid fa-trash"></i>%s</a>', esc_url( wc_get_cart_remove_url( $cart_key ) ), filter_var( $product_id, FILTER_SANITIZE_NUMBER_INT ), filter_var( $product_qty, FILTER_SANITIZE_NUMBER_INT ), esc_attr( $cart_key ), 'Remove' ); ?>
						</td>

						<td>
						<?php echo wp_kses_post( $product_thumbnail ); ?>
						</td>

						<td>
							<h5 class="sc_product_title">
							<?php echo wp_kses_post( $product_name ); ?>
							</h5>
						</td>

						<td>
							<p class="sc_product_price">
							<?php echo wp_kses_post( $product_price ); ?>
							</p>
						</td>

						<td>
							<input type="number" class="sc_product_quantity" value="<?php echo wp_kses_post( $product_qty ); ?>">
						</td>

						<td>
							<p class="sc_total">
							<?php echo wp_kses_post( $product_subtotal ); ?>
							</p>
						</td>
					</tr>
			<?php
	}

	?>

</tbody>
